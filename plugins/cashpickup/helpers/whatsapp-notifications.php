<?php

if (!function_exists('cashpickup_whatsapp_notify')) {
	function cashpickup_whatsapp_notify(
		array $record,
		array $recipientIds,
		string $recipientLabel,
		string $notificationLabel,
		string $nextAction,
		string $viewPath
	): array {
		$summary = [
			'sent' => 0,
			'ready' => 0,
			'failed' => 0,
			'skipped' => 0,
			'recipient_label' => $recipientLabel,
			'reasons' => [],
			'links' => [],
		];

		try {
			$helperPath = realpath(__DIR__ . '/../../backoffice/helpers/whatsapp-notifications.php');
			if (!$helperPath || !is_file($helperPath)) {
				throw new \RuntimeException('The WhatsApp notification helper is unavailable.');
			}
			require_once $helperPath;
			if (!function_exists('backoffice_whatsapp_notify_transaction')
				|| !function_exists('backoffice_whatsapp_flash_result')) {
				throw new \RuntimeException('The WhatsApp notification service is unavailable.');
			}

			$recipientIds = array_values(array_unique(array_filter(
				array_map('intval', $recipientIds),
				static fn(int $id): bool => $id > 0
			)));
			if (!$recipientIds) {
				$summary['skipped'] = 1;
				$summary['reasons'][] = 'No cashpickup notification recipient was available.';
			}

			$amount = (float)($record['amount_involved'] ?? $record['amount_requested'] ?? 0);
			$details = [
				'Customer' => trim((string)($record['sender_details'] ?? '')),
				'Amount' => 'GH₵ ' . number_format($amount, 2),
				'Tracking ID' => trim((string)($record['tracking_id'] ?? '')),
				'Next action' => $nextAction,
			];
			if (trim((string)($record['denial_reason'] ?? '')) !== '') {
				$details['Reason'] = trim((string)$record['denial_reason']);
			}
			$status = trim((string)($record['approval_status'] ?? ''));
			$transactionStatus = trim((string)($record['transaction_status'] ?? ''));
			if ($transactionStatus !== '') {
				$status .= ($status !== '' ? ' / ' : '') . $transactionStatus;
			}

			foreach ($recipientIds as $recipientId) {
				$notification = [
					'type' => 'Cash Pickup',
					'id' => (int)($record['id'] ?? 0),
					'status' => $status,
					'details' => $details,
					'view_url' => rtrim(ROOT, '/') . '/' . trim($viewPath, '/'),
					'recipient_id' => $recipientId,
					'recipient_label' => $recipientLabel,
					'notification_label' => $notificationLabel,
					'flash' => false,
					'auto_send' => true,
				];
				$result = backoffice_whatsapp_notify_transaction($notification);
				$summary['sent'] += (int)($result['sent'] ?? 0);
				$summary['ready'] += (int)($result['ready'] ?? 0);
				$summary['failed'] += (int)($result['failed'] ?? 0);
				$summary['skipped'] += (int)($result['skipped'] ?? 0);
				$summary['links'] = array_merge($summary['links'], (array)($result['links'] ?? []));
				$summary['reasons'] = array_merge($summary['reasons'], (array)($result['reasons'] ?? []));
			}

			backoffice_whatsapp_flash_result($summary);
		} catch (\Throwable $e) {
			error_log('[cashpickup] WhatsApp notification preparation failed: ' . $e->getMessage());
			$summary['failed']++;
			$summary['reasons'][] = 'WhatsApp notification could not be prepared.';
		}

		return $summary;
	}
}

if (!function_exists('cashpickup_whatsapp_approver_ids')) {
	function cashpickup_whatsapp_approver_ids(): array
	{
		try {
			$db = new \Core\Database;
			$rows = $db->query(
				"SELECT DISTINCT u.id
				 FROM users u
				 JOIN user_roles_map urm ON urm.user_id = u.id AND urm.disabled = 0
				 JOIN user_roles ur ON ur.id = urm.role_id
				 WHERE u.deleted = 0
				 AND LOWER(TRIM(ur.role)) IN (
					'admin', 'is_admin', 'manager', 'is_manager',
					'general manager', 'general_manager', 'generalmanager', 'gm', 'is_general_manager',
					'operations manager', 'operations_manager', 'operationsmanager',
					'ops manager', 'ops_manager', 'opsmanager', 'is_operations_manager'
				 )"
			) ?: [];
			if (!empty($db->has_error)) {
				throw new \RuntimeException('Unable to load Cash Pickup approvers.');
			}
			return array_values(array_unique(array_filter(array_map(
				static fn($row): int => (int)($row->id ?? 0),
				$rows
			), static fn(int $id): bool => $id > 0)));
		} catch (\Throwable $e) {
			error_log('[cashpickup] WhatsApp approver lookup failed: ' . $e->getMessage());
			return [];
		}
	}
}

if (!function_exists('cashpickup_whatsapp_participant_ids')) {
	function cashpickup_whatsapp_participant_ids(array $record, array $extraIds = []): array
	{
		$recipientIds = array_merge(
			$extraIds,
			[(int)($record['created_by'] ?? 0), (int)($record['assigned_user_id'] ?? 0)]
		);
		$receiveId = (int)($record['receive_id'] ?? 0);
		if ($receiveId > 0) {
			try {
				$db = new \Core\Database;
				$rows = $db->query(
					"SELECT created_by FROM cashpickups WHERE id = :id AND (deleted IS NULL OR deleted = 0) LIMIT 1",
					['id' => $receiveId]
				) ?: [];
				if (!empty($db->has_error)) {
					throw new \RuntimeException('Unable to load the cashpickup creator.');
				}
				if (!empty($rows)) {
					$recipientIds[] = (int)($rows[0]->created_by ?? 0);
				}
			} catch (\Throwable $e) {
				error_log('[cashpickup] WhatsApp participant lookup failed: ' . $e->getMessage());
			}
		}

		return array_values(array_unique(array_filter(
			array_map('intval', $recipientIds),
			static fn(int $id): bool => $id > 0
		)));
	}
}

if (!function_exists('cashpickup_whatsapp_assignment_link')) {
	function cashpickup_whatsapp_assignment_link(int $recipientId, array $record, string $viewPath, string $nextAction): array
	{
		try {
			$helperPath = realpath(__DIR__ . '/../../backoffice/helpers/whatsapp-notifications.php');
			if (!$helperPath || !is_file($helperPath)) {
				throw new \RuntimeException('The WhatsApp notification helper is unavailable.');
			}
			require_once $helperPath;
			if (!function_exists('backoffice_whatsapp_phone')) {
				throw new \RuntimeException('The WhatsApp phone resolver is unavailable.');
			}

			$phoneResult = backoffice_whatsapp_phone($recipientId);
			$phone = trim((string)($phoneResult['phone'] ?? ''));
			if ($phone === '') {
				return ['url' => '', 'reason' => (string)($phoneResult['reason'] ?? 'The assigned user has no WhatsApp number.')];
			}

			$id = (int)($record['id'] ?? 0);
			$customer = trim((string)($record['sender_details'] ?? 'Customer'));
			$trackingId = trim((string)($record['tracking_id'] ?? ''));
			$amount = (float)($record['amount_involved'] ?? 0);
			$message = 'Hello, a cash pickup has been assigned to you.'
				. "\nPickup #" . $id
				. "\nCustomer: " . $customer
				. "\nAmount: GH₵ " . number_format($amount, 2)
				. ($trackingId !== '' ? "\nTracking ID: " . $trackingId : '')
				. "\nNext action: " . $nextAction
				. "\nDetails: " . rtrim(ROOT, '/') . '/' . trim($viewPath, '/');

			return [
				'url' => 'https://wa.me/' . rawurlencode($phone) . '?text=' . rawurlencode($message),
				'reason' => '',
			];
		} catch (\Throwable $e) {
			error_log('[cashpickup] Assignment WhatsApp link preparation failed: ' . $e->getMessage());
			return ['url' => '', 'reason' => 'WhatsApp message could not be prepared.'];
		}
	}
}