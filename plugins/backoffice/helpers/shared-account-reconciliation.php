<?php

require_once dirname(__DIR__, 2) . '/users-manager/helpers/shared-account-assignments.php';

if (!function_exists('backoffice_reconciliation_assigned_shared_account_balances')) {
	function backoffice_reconciliation_assigned_shared_account_balances(array $assignedAccountKeys, ?string $date = null): array
	{
		$assignedAccountKeys = array_values(array_unique(array_filter(array_map(
			static fn($key): string => strtoupper(trim((string)$key)),
			$assignedAccountKeys
		))));
		if (empty($assignedAccountKeys)) {
			return [];
		}

		$db = new \Core\Database;
		$transStatusColumn = $db->query("SHOW COLUMNS FROM drawer_balances LIKE 'trans_status'") ?: [];
		if (!empty($db->has_error)) {
			throw new \RuntimeException('Unable to inspect shared-account balance history: ' . (string)$db->error);
		}
		$latestRowExpression = !empty($transStatusColumn)
			? "COALESCE(
				MAX(CASE WHEN LOWER(COALESCE(db.trans_status, '')) <> 'opening snapshot' THEN db.id END),
				MAX(db.id)
			)"
			: 'MAX(db.id)';
		$rows = $db->query(
			"SELECT b.id, b.channel_key, b.closing_balance
			 FROM drawer_balances b
			 INNER JOIN (
				SELECT db.channel_key, {$latestRowExpression} AS max_id
				FROM drawer_balances db
				INNER JOIN cashdrawers cd ON cd.id = db.drawer_id
				WHERE db.channel_type = 'ecash'
					AND DATE(cd.date_created) = :shared_day
				GROUP BY db.channel_key
			 ) last_row ON last_row.max_id = b.id
			 ORDER BY b.id DESC",
			array_merge(
				['shared_day' => trim((string)$date) !== '' ? $date : date('Y-m-d')]
			)
		) ?: [];
		if (!empty($db->has_error)) {
			throw new \RuntimeException('Unable to load assigned shared-account balances: ' . (string)$db->error);
		}

		$balances = [];
		foreach ($rows as $row) {
			$key = users_manager_normalize_shared_account_key($row->channel_key ?? '');
			if ($key === null || !in_array($key, $assignedAccountKeys, true) || array_key_exists($key, $balances)) {
				continue;
			}
			$balances[$key] = (float)($row->closing_balance ?? 0);
		}

		return $balances;
	}
}
