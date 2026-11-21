<?php

date_default_timezone_set('Africa/Accra');

$postdata = $req->post();
$redirectTo = $admin_route . '/' . $plugin_route . '/view_bank_transfer/' . (int)$id;
$fail = static function (string $message) use ($redirectTo): void {
	message_fail($message);
	redirect($redirectTo);
	exit;
};

if (!csrf_verify($postdata)) {
	set_value('errors', ['reject_reason' => 'Form expired. Refresh the page and try again.']);
	redirect($redirectTo);
	exit;
}

$reason = trim((string)($postdata['reject_reason'] ?? ''));
if ($reason === '') {
	set_value('errors', ['reject_reason' => 'Enter a clear reason for rejecting this transaction.']);
	redirect($redirectTo);
	exit;
}

$session = get_session();
$userId = (int)($session->id ?? 0);
if ($userId <= 0 || (int)$id <= 0) {
	$fail('Invalid transaction or user.');
}

$db = new \Core\Database;
if (!$db->beginTransaction()) {
	error_log('[backoffice bank transfer] unable to begin party rejection for #' . (int)$id . ': ' . $db->error);
	$fail('Unable to reject this transaction right now. Please try again.');
}

$rows = $db->query(
	"SELECT created_by, withdrawing_user_id, withdrawn_by, second_party_user_id,
	        second_party_verified_by, third_party_user_id, third_party_reviewed_by,
	        transaction_status
	 FROM bank_transfers_backoffice
	 WHERE id = :id AND (deleted IS NULL OR deleted = 0)
	 FOR UPDATE",
	['id' => (int)$id]
);
if ($db->has_error) {
	$db->rollBack();
	error_log('[backoffice bank transfer] unable to load transaction for rejection #' . (int)$id . ': ' . $db->error);
	$fail('Unable to load this transaction. Please try again.');
}
if (empty($rows)) {
	$db->rollBack();
	$fail('Bank transfer not found.');
}

$row = $rows[0];
$partyIds = array_unique(array_filter(array_map('intval', [
	$row->created_by ?? 0,
	$row->withdrawing_user_id ?? 0,
	$row->withdrawn_by ?? 0,
	$row->second_party_user_id ?? 0,
	$row->second_party_verified_by ?? 0,
	$row->third_party_user_id ?? 0,
	$row->third_party_reviewed_by ?? 0,
])));
if (!in_array($userId, $partyIds, true)) {
	$db->rollBack();
	$fail('Only a party to this transaction can reject it.');
}

$status = strtolower(trim((string)($row->transaction_status ?? '')));
if (!str_starts_with($status, 'pending')) {
	$db->rollBack();
	$fail('Only a pending transaction can be rejected.');
}

$stageStatusColumn = match ($status) {
	'pending withdrawal' => 'withdrawal_status',
	'pending 2nd party', 'pending creator approval' => 'second_party_status',
	'pending creator receipt' => 'creator_receipt_status',
	'pending 3rd party' => 'third_party_status',
	default => null,
};
$stageStatusUpdate = $stageStatusColumn !== null
	? ', ' . $stageStatusColumn . " = 'Rejected'"
	: '';
$rejectedAt = date('Y-m-d H:i:s');

$db->query(
	"UPDATE bank_transfers_backoffice
	 SET transaction_status = 'Rejected',
	     third_party_reject_reason = :reason,
	     rejected_by = :rejected_by,
	     rejected_at = :rejected_at,
	     updated_by = :updated_by,
	     date_updated = :date_updated
	     {$stageStatusUpdate}
	 WHERE id = :id
	   AND (deleted IS NULL OR deleted = 0)
	   AND LOWER(TRIM(COALESCE(transaction_status,''))) LIKE 'pending%'
	   AND (
	        created_by = :creator_id
	        OR withdrawing_user_id = :withdrawer_id
	        OR withdrawn_by = :withdrawn_by_id
	        OR second_party_user_id = :second_party_id
	        OR second_party_verified_by = :verified_by_id
	        OR third_party_user_id = :third_party_id
	        OR third_party_reviewed_by = :reviewed_by_id
	   )",
	[
		'reason' => $reason,
		'rejected_by' => $userId,
		'rejected_at' => $rejectedAt,
		'updated_by' => $userId,
		'date_updated' => $rejectedAt,
		'id' => (int)$id,
		'creator_id' => $userId,
		'withdrawer_id' => $userId,
		'withdrawn_by_id' => $userId,
		'second_party_id' => $userId,
		'verified_by_id' => $userId,
		'third_party_id' => $userId,
		'reviewed_by_id' => $userId,
	]
);
if ($db->has_error || (int)$db->affected_rows !== 1) {
	$db->rollBack();
	error_log('[backoffice bank transfer] party rejection save failed for #' . (int)$id . ': ' . $db->error);
	$fail('Unable to reject this transaction. It may have already been updated; refresh and try again.');
}

if (!$db->commit()) {
	$db->rollBack();
	error_log('[backoffice bank transfer] party rejection commit failed for #' . (int)$id . ': ' . $db->error);
	$fail('Unable to save the rejection. Please try again.');
}

set_value('errors', []);
message_success('Bank transfer rejected.');
redirect($redirectTo);
exit;
