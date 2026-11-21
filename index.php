<?php

session_start();
ob_start();

$minPHPVersion = '8.0';
if(phpversion() < $minPHPVersion)
    die("You need a minimum of PHP version $minPHPVersion to run this app");


define('DS', DIRECTORY_SEPARATOR);
define('ROOTPATH', __DIR__.DS);

require 'config.php';
require 'app'.DS.'core'.DS.'init.php';
require_once ROOTPATH . 'plugins/basic-admin/helpers/session-lock.php';

ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);
register_app_error_handlers();

$ACTIONS            = [];
$FILTERS            = [];
$APP['URL']         = split_url($_GET['url'] ?? 'home');
$APP['permissions'] = [];
$USER_DATA          = [];
$CURRENT_PATH       = trim((string)($_GET['url'] ?? 'home'));

/** load plugins **/
$PLUGINS = get_plugin_folders();
if(!load_plugins($PLUGINS))
    die("<center><h1 style='font-family:tahoma'>No plugins were found! Please put at least one plugin in the plugins folder</h1></center>");

require_once ROOTPATH . 'app' . DS . 'core' . DS . 'drawer_balances_schema.php';
add_action('before_controller', 'ensure_drawer_balances_schema', -1000);

$APP['permissions'] = do_filter('permissions',$APP['permissions']);

add_action('before_controller', function () use ($CURRENT_PATH) {
    try {
        $ses = new \Core\Session;
        $isAccountStatusRequest = (URL(0) === 'account-status');
        $isAdminLockRequest = URL(0) === 'admin' && URL(1) === 'lock';
        $isAdminUnlockRequest = URL(0) === 'admin' && URL(1) === 'unlock';
        $isLogoutRequest = URL(0) === 'logout';
        $isAjaxRoute = preg_match('/(^|\/)ajax_/', $CURRENT_PATH) === 1;
        $wantsJson = $isAccountStatusRequest
            || $isAjaxRoute
            || stripos((string)($_SERVER['HTTP_ACCEPT'] ?? ''), 'application/json') !== false
            || strtolower((string)($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '')) === 'xmlhttprequest';

        $sessionUserId = (int)$ses->user('id');
        $isLoggedIn = $ses->is_logged_in();
        $isLocked = $isLoggedIn && $ses->is_locked();
        $skipReturnCapture = false;
        if (
            ($_SERVER['REQUEST_METHOD'] ?? '') === 'GET'
            && !$wantsJson
            && $ses->get('session_lock_return_capture_pending') === true
        ) {
            $ses->pop('session_lock_return_capture_pending');
            $skipReturnCapture = true;
        }
        $route = trim($CURRENT_PATH, '/');
        if (
            $sessionUserId > 0
            && $isLoggedIn
            && !$isLocked
            && !$skipReturnCapture
            && ($_SERVER['REQUEST_METHOD'] ?? '') === 'GET'
            && !$wantsJson
            && ($route === 'admin' || str_starts_with($route, 'admin/'))
            && !in_array($route, ['admin/lock', 'admin/unlock'], true)
        ) {
            $returnTo = rtrim(ROOT, '/') . '/' . $route;
            $returnParams = $_GET;
            unset($returnParams['url']);
            $returnQuery = http_build_query($returnParams);
            if ($returnQuery !== '') {
                $returnTo .= '?' . $returnQuery;
            }
            $ses->set('session_lock_return_to', $returnTo);
        }

        $lockedReturnTo = static function () use ($ses, $route): string {
            $returnTo = (string)$ses->get('session_lock_return_to');
            if ($route !== 'admin') {
                $returnTo = rtrim(ROOT, '/') . '/' . $route;
                $returnParams = $_GET;
                unset($returnParams['url']);
                $returnQuery = http_build_query($returnParams);
                if ($returnQuery !== '') {
                    $returnTo .= '?' . $returnQuery;
                }
                $ses->set('session_lock_return_to', $returnTo);
                return $returnTo;
            }

            $referer = (string)($_SERVER['HTTP_REFERER'] ?? '');
            $refererPath = parse_url($referer, PHP_URL_PATH);
            if (!is_string($refererPath)) {
                return $returnTo;
            }
            $refererPath = '/' . ltrim($refererPath, '/');
            $rootUrl = rtrim(ROOT, '/');
            $rootPath = rtrim((string)(parse_url($rootUrl, PHP_URL_PATH) ?? ''), '/');
            $adminPath = $rootPath . '/admin';
            if (!str_starts_with($refererPath, $adminPath . '/')) {
                return $returnTo;
            }

            $returnTo = $rootUrl . substr($refererPath, strlen($rootPath));
            $refererQuery = (string)(parse_url($referer, PHP_URL_QUERY) ?? '');
            if ($refererQuery !== '') {
                $returnTo .= '?' . $refererQuery;
            }
            $ses->set('session_lock_return_to', $returnTo);
            return $returnTo;
        };

        if (!$isLoggedIn) {
            if ($isAccountStatusRequest || $wantsJson) {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'logged_in' => false,
                    'deleted' => false,
                    'message' => 'Your session has expired. Please log in again.',
                    'redirect' => ROOT . '/login',
                ]);
                die;
            }
            return;
        }

        if ($isAdminLockRequest) {
            header('Content-Type: application/json');
            if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST' || !csrf_verify($_POST, 'session_lock_csrf')) {
                http_response_code(419);
                echo json_encode(['success' => false, 'locked' => $isLocked, 'message' => 'The lock request expired. Refresh the page and try again.']);
                die;
            }

            if (!$ses->lock()) {
                http_response_code(401);
                echo json_encode(['success' => false, 'locked' => false, 'message' => 'Your session is no longer available.']);
                die;
            }

            echo json_encode(['success' => true, 'locked' => true]);
            die;
        }

        if ($isLocked && !$isAdminUnlockRequest && !$isAccountStatusRequest && !$isLogoutRequest) {
            if ($wantsJson) {
                http_response_code(423);
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'logged_in' => true, 'locked' => true, 'message' => 'Your workspace is locked. Enter your password to continue.']);
                die;
            }

            http_response_code(423);
            basic_admin_render_session_lock_screen('', $lockedReturnTo());
            die;
        }

        $sessionUser = get_session();
        $userId = (int)($sessionUser->id ?? 0);
        if ($userId <= 0) {
            return;
        }

        $db = new \Core\Database;
        if (!$db->table_exists(['users'])) {
            return;
        }

        $rows = $db->query(
            "SELECT id, first_name, last_name, deleted, disabled FROM users WHERE id = :id LIMIT 1",
            ['id' => $userId]
        ) ?: [];
        $currentUser = $rows[0] ?? null;
        $isDeleted = empty($currentUser) || (int)($currentUser->deleted ?? 0) === 1;

        if (!$isDeleted) {
            $isLocked = $ses->is_locked();

            if ($isAdminUnlockRequest) {
                if (!$isLocked && ($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
                    redirect('admin');
                }

                $unlockError = '';
                if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST' || !csrf_verify($_POST, 'session_lock_csrf')) {
                    $unlockError = 'This unlock request expired. Please try again.';
                } else {
                    $ses->lock();
                    if ((int)($currentUser->disabled ?? 0) === 1) {
                        $unlockError = 'This account is disabled. Please sign out and contact an administrator.';
                    } else {
                        $credentials = $db->query(
                            "SELECT password FROM users WHERE id = :id LIMIT 1",
                            ['id' => $userId]
                        ) ?: [];
                        $passwordHash = (string)($credentials[0]->password ?? '');
                        $password = (string)($_POST['password'] ?? '');

                        if ($password !== '' && $passwordHash !== '' && password_verify($password, $passwordHash) && $ses->unlock()) {
                            $ses->set('session_lock_return_capture_pending', true);
                            if ($wantsJson) {
                                header('Content-Type: application/json');
                                echo json_encode(['success' => true, 'locked' => false]);
                                die;
                            }
                            $returnTo = (string)($_POST['return_to'] ?? '');
                            if ($returnTo === '') {
                                $returnTo = (string)$ses->get('session_lock_return_to');
                            }
                            if ($returnTo === '') {
                                $returnTo = (string)($_SERVER['HTTP_REFERER'] ?? '');
                            }
                            $returnPath = parse_url($returnTo, PHP_URL_PATH);
                            if (is_string($returnPath)) {
                                $returnPath = '/' . ltrim($returnPath, '/');
                            }
                            $returnQuery = (string)(parse_url($returnTo, PHP_URL_QUERY) ?? '');
                            $returnFragment = (string)(parse_url($returnTo, PHP_URL_FRAGMENT) ?? '');
                            $rootUrl = rtrim(ROOT, '/');
                            $rootPath = rtrim((string)(parse_url($rootUrl, PHP_URL_PATH) ?? ''), '/');
                            $adminPath = $rootPath . '/admin';
                            $redirectTo = $rootUrl . '/admin';
                            if ((!is_string($returnPath) || ($returnPath !== $adminPath && !str_starts_with($returnPath, $adminPath . '/'))) && $returnQuery !== '') {
                                parse_str($returnQuery, $returnParams);
                                $requestedRoute = trim((string)($returnParams['url'] ?? ''), '/');
                                if ($requestedRoute === 'admin' || str_starts_with($requestedRoute, 'admin/')) {
                                    $returnPath = $rootPath . '/' . $requestedRoute;
                                    unset($returnParams['url']);
                                    $returnQuery = http_build_query($returnParams);
                                }
                            }
                            if (is_string($returnPath) && ($returnPath === $adminPath || str_starts_with($returnPath, $adminPath . '/'))) {
                                $relativePath = substr($returnPath, strlen($rootPath));
                                if ($relativePath !== '/admin/unlock' && !str_starts_with($relativePath, '/admin/unlock/')) {
                                    $redirectTo = $rootUrl . $relativePath;
                                    if ($returnQuery !== '' && !preg_match('/[\r\n]/', $returnQuery)) {
                                        $redirectTo .= '?' . $returnQuery;
                                    }
                                    if ($returnFragment !== '' && !preg_match('/[\r\n]/', $returnFragment)) {
                                        $redirectTo .= '#' . $returnFragment;
                                    }
                                }
                            }
                            header('Location: ' . $redirectTo);
                            die;
                        }

                        $unlockError = 'That password did not unlock this workspace. Please try again.';
                    }
                }

                if ($wantsJson) {
                    http_response_code(401);
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'locked' => true, 'message' => $unlockError]);
                    die;
                }

                http_response_code(423);
                basic_admin_render_session_lock_screen($unlockError, (string)($_POST['return_to'] ?? ''));
                die;
            }

            if ($isAccountStatusRequest) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'logged_in' => true, 'deleted' => false, 'locked' => $isLocked]);
                die;
            }

            if ($isLocked && !$isLogoutRequest) {
                if ($wantsJson) {
                    http_response_code(423);
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'logged_in' => true, 'locked' => true, 'message' => 'Your workspace is locked. Enter your password to continue.']);
                    die;
                }

                http_response_code(423);
                basic_admin_render_session_lock_screen('', $lockedReturnTo());
                die;
            }

            return;
        }

        $ses->logout();
        $message = 'Your account has been removed by an administrator. Access to the app has been blocked. Please contact an administrator if you believe this is a mistake.';

        if ($wantsJson) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'logged_in' => false,
                'deleted' => true,
                'message' => $message,
                'redirect' => ROOT . '/login',
            ]);
            die;
        }

        http_response_code(403);
        $loginUrl = ROOT . '/login';
        render_app_error_screen(403, 'Account access blocked', $message, $loginUrl, 'Return to login', true);
        die;
    } catch (\Throwable $e) {
        if (!empty($_SESSION['APP']['locked']) && !$isLogoutRequest) {
            error_log('[session-lock] Locked-session request could not be completed: ' . $e->getMessage());
            if ($wantsJson) {
                http_response_code(423);
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'logged_in' => true, 'locked' => true, 'message' => 'Your workspace is locked. Enter your password to continue.']);
                die;
            }

            http_response_code(423);
            basic_admin_render_session_lock_screen(
                'Unable to verify your password right now. Please try again.',
                (string)($_POST['return_to'] ?? '')
            );
            die;
        }
        return;
    }
}, 0);

add_action('before_controller', function () {
    try {
        $ses = new \Core\Session;
        if (!$ses->is_logged_in()) {
            return;
        }

        $user = get_session();
        $userId = (int)($user->id ?? 0);
        if ($userId <= 0) {
            return;
        }

        $isAdminPath = (URL(0) === 'admin');
        $module = strtolower(trim((string)($isAdminPath ? URL(1) : URL(0))));
        $action = strtolower(trim((string)($isAdminPath ? URL(2) : URL(1))));
        if ($action === '') {
            return;
        }

        $startActionsByModule = [
            'back_office' => [
                'make_request' => true,
                'make_payment' => true,
                'pay_commission' => true,
                'pay_dailycommission' => true,
                'self_stocking' => true,
            ],
            'cashpickup' => [
                'add' => true,
            ],
            'reversals' => [
                'add' => true,
            ],
            'payment_services' => [
                'add' => true,
            ],
            'agencybanking' => [
                'add' => true,
                'withdrawal' => true,
                'direct_transfer' => true,
                'deposit' => true,
                'account_opening' => true,
                'balance_enquiry' => true,
                'mini_statement' => true,
                'funds_transfer' => true,
                'interbank' => true,
                'international_transfer' => true,
            ],
            // momoremit plugin_route is singular (/admin/momoremit/...), so we must map it here
            'momoremit' => [
                'add' => true,
                'cit' => true,
                'deposit' => true,
                'withdrawal' => true,
                'cashin' => true,
            ],
            'momoremits' => [
                'add' => true,
                'cit' => true,
                'deposit' => true,
                'withdrawal' => true,
                'cashin' => true,
            ],
            'operations_accounts' => [
                'add_account' => true,
                'add_wallet' => true,
                'add_cashdrawer' => true,
                'add_sim' => true,
                'bulk_assign_sims' => true,
                'transfer' => true,
                'exchange_denominations' => true,
            ],
            'cfa' => [
                'add' => true,
                'buy' => true,
                'sell' => true,
            ],
            'airtimebundle' => [
                'add' => true,
                'airtime' => true,
                'bundle' => true,
            ],
            'ezwich' => [
                'add' => true,
                'withdrawal' => true,
                'transfer' => true,
            ],
            'sims' => [
                'add' => true,
                'sell' => true,
                'bulk-sell' => true,
            ],
        ];

        $genericStartActions = [
            'add' => true,
            'create' => true,
            'new' => true,
        ];

        $moduleStart = $startActionsByModule[$module] ?? [];
        $isStart = isset($genericStartActions[$action]) || isset($moduleStart[$action]) || str_starts_with($action, 'make_');
        if (!$isStart) {
            return;
        }

        $db = new \Core\Database;
        if ($module === 'operations_accounts' && $action === 'add_cashdrawer') {
            $today = date('Y-m-d');
            $hasDrawerToday = false;
            if (function_exists('operations_account_has_cashdrawer_today')) {
                $hasDrawerToday = operations_account_has_cashdrawer_today($userId, $today);
            } elseif ($db->table_exists(['cashdrawers'])) {
                $drawerRows = $db->query(
                    "SELECT id FROM cashdrawers WHERE user_id = :uid AND DATE(date_created) = :today LIMIT 1",
                    ['uid' => $userId, 'today' => $today]
                ) ?: [];
                $hasDrawerToday = !empty($drawerRows);
            }
            if (!$hasDrawerToday) {
                return;
            }
        }

        $blocking = [];
        $cashPickupCanApprove = user_can('is_admin')
            || user_can('is_general_manager')
            || user_can('is_operations_manager');
        if (!$cashPickupCanApprove && $db->table_exists(['user_roles_map', 'user_roles'])) {
            require_once __DIR__ . '/plugins/cashpickup/helpers/permissions.php';
            $cashPickupCanApprove = \CashpickupPermissions\can_assign_customer_payout($db, $userId);
        }
        $cashPickupApproverPredicate = $cashPickupCanApprove ? '1 = 1' : '1 = 0';

        $checks = [
            ['label' => 'Backoffice Requests', 'table' => 'requests', 'sql' => "SELECT COUNT(id) AS c FROM requests WHERE (deleted IS NULL OR deleted = 0) AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND assigned = :uid"],
            ['label' => 'Backoffice Payments', 'table' => 'payments_backoffice', 'sql' => "SELECT COUNT(id) AS c FROM payments_backoffice WHERE (deleted IS NULL OR deleted = 0) AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND pay_to = :uid"],
            ['label' => 'Backoffice Commissions', 'table' => 'commissions', 'sql' => "SELECT COUNT(id) AS c FROM commissions WHERE (deleted IS NULL OR deleted = 0) AND bulk_parent_id IS NULL AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND pay_to = :uid"],
            ['label' => 'Cash Pickup', 'table' => 'cashpickups', 'sql' => "SELECT COUNT(id) AS c
                FROM cashpickups cp
                WHERE (cp.deleted IS NULL OR cp.deleted = 0)
                AND LOWER(TRIM(COALESCE(cp.approval_status,'pending'))) = 'pending'
                AND (
                    (
                        LOWER(TRIM(COALESCE(cp.transaction_side,''))) = 'receive'
                        AND LOWER(TRIM(COALESCE(cp.credit_mode,''))) = 'credit'
                        AND LOWER(TRIM(COALESCE(cp.transaction_status,''))) = 'pending payout'
                        AND (
                            SELECT COALESCE(SUM(COALESCE(p.amount_paid_out,0) + COALESCE(p.pickup_charge,0)),0)
                            FROM cashpickups p
                            WHERE (p.deleted IS NULL OR p.deleted = 0)
                            AND LOWER(TRIM(COALESCE(p.transaction_side,''))) = 'pay'
                            AND p.receive_id = cp.id
                            AND LOWER(TRIM(COALESCE(p.transaction_status,''))) = 'approved'
                            AND (p.confirmed_by IS NOT NULL AND p.confirmed_by != '')
                            AND COALESCE(p.amount_paid_out,0) > 0
                            AND (
                                p.approval_status IS NULL
                                OR p.approval_status = ''
                                OR LOWER(TRIM(p.approval_status)) IN ('approved','pending')
                            )
                        ) < COALESCE(cp.amount_involved,0)
                        AND (
                            cp.assigned_user_id = :uid
                            OR (COALESCE(cp.assigned_user_id,0) = 0 AND cp.created_by = :uid)
                        )
                    )
                    OR (
                        {$cashPickupApproverPredicate}
                        AND (
                            NOT (
                                LOWER(TRIM(COALESCE(cp.transaction_side,''))) = 'receive'
                                AND LOWER(TRIM(COALESCE(cp.credit_mode,''))) = 'credit'
                                AND LOWER(TRIM(COALESCE(cp.transaction_status,''))) = 'pending payout'
                            )
                            OR (
                                SELECT COALESCE(SUM(COALESCE(p.amount_paid_out,0) + COALESCE(p.pickup_charge,0)),0)
                                FROM cashpickups p
                                WHERE (p.deleted IS NULL OR p.deleted = 0)
                                AND LOWER(TRIM(COALESCE(p.transaction_side,''))) = 'pay'
                                AND p.receive_id = cp.id
                                AND LOWER(TRIM(COALESCE(p.transaction_status,''))) = 'approved'
                                AND (p.confirmed_by IS NOT NULL AND p.confirmed_by != '')
                                AND COALESCE(p.amount_paid_out,0) > 0
                                AND (
                                    p.approval_status IS NULL
                                    OR p.approval_status = ''
                                    OR LOWER(TRIM(p.approval_status)) IN ('approved','pending')
                                )
                            ) >= COALESCE(cp.amount_involved,0)
                            AND COALESCE(cp.amount_involved,0) > 0
                        )
                    )
                )"],
            ['label' => 'Reversals', 'table' => 'reversals', 'sql' => "SELECT COUNT(id) AS c FROM reversals WHERE LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND (created_by = :uid OR agent_involved = :uid)"],
            ['label' => 'Payment Services', 'table' => 'payment_services', 'sql' => "SELECT COUNT(id) AS c FROM payment_services WHERE (deleted IS NULL OR deleted = 0) AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND created_by = :uid"],
            ['label' => 'Payments', 'table' => 'payments', 'sql' => "SELECT COUNT(id) AS c FROM payments WHERE (deleted = 0 OR deleted IS NULL) AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND created_by = :uid"],
            ['label' => 'Agency Banking', 'table' => 'agencybankings', 'sql' => "SELECT COUNT(id) AS c FROM agencybankings WHERE (deleted IS NULL OR deleted = 0) AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND created_by = :uid"],
            ['label' => 'MoMo & Remittances', 'table' => 'momoremits', 'sql' => "SELECT COUNT(id) AS c FROM momoremits WHERE (deleted IS NULL OR deleted = 0) AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND created_by = :uid"],
            ['label' => 'CFA Exchange', 'table' => 'cfas', 'sql' => "SELECT COUNT(id) AS c FROM cfas WHERE (deleted IS NULL OR deleted = 0) AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND created_by = :uid"],
            ['label' => 'Airtime & Bundles', 'table' => 'airtimebundles', 'sql' => "SELECT COUNT(id) AS c FROM airtimebundles WHERE (deleted IS NULL OR deleted = 0) AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND created_by = :uid"],
            ['label' => 'Ezwich', 'table' => 'ezwichs', 'sql' => "SELECT COUNT(id) AS c FROM ezwichs WHERE (deleted IS NULL OR deleted = 0) AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND created_by = :uid"],
            ['label' => 'SIMs', 'table' => 'sims', 'sql' => "SELECT COUNT(id) AS c FROM sims WHERE (deleted IS NULL OR deleted = 0) AND LOWER(TRIM(COALESCE(transaction_status,''))) = 'pending' AND (created_by = :uid OR assigned = :uid)"],
        ];

        foreach ($checks as $check) {
            if (!$db->table_exists([$check['table']])) {
                continue;
            }
            $rows = $db->query($check['sql'], ['uid' => $userId]) ?: [];
            $c = (int)(($rows[0]->c ?? 0));
            if ($c > 0) {
                $blocking[$check['label']] = $c;
            }
        }

        if (empty($blocking)) {
            return;
        }

        $lines = [];
        foreach ($blocking as $label => $count) {
            $lines[] = $label . ' (' . $count . ')';
        }
        message_fail('Transaction denied. Please approve or reject your pending transactions first: ' . implode(', ', $lines) . '.');
		if ($isAdminPath) {
			$redirectTo = 'admin' . (!empty($module) ? ('/' . $module) : '');
			redirect($redirectTo);
		}
		$referer = trim((string)($_SERVER['HTTP_REFERER'] ?? ''));
		if ($referer !== '') {
			redirect($referer);
		}
		redirect('home');
    } catch (\Throwable $e) {
        return;
    }
});

/*load the app*/
$app = new \Core\App();
$app->index();

/** 
 * Global shutdown handler: Close all database connections after every request
 * This prevents "Too many connections" errors on shared hosting with low MySQL limits
 */
register_shutdown_function(function() {
    \Core\Database::close();
});
