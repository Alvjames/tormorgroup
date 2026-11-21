<?php

if(!function_exists('basic_admin_render_session_lock_screen'))
{
	function basic_admin_render_session_lock_screen(string $error = '', string $returnTo = ''): void
	{
		$session = get_session();
		$name = trim((string)($session->first_name ?? '') . ' ' . (string)($session->last_name ?? ''));
		if($name === ''){
			$name = 'Your account';
		}

		$initials = '';
		foreach(array_slice(preg_split('/\s+/', $name) ?: [], 0, 2) as $part){
			$initials .= strtoupper(substr($part, 0, 1));
		}

		$lockCss = ROOT . '/plugins/basic-admin/assets/css/session-lock.css?v=20261121-1';
		$colorModesVersion = @filemtime(ROOTPATH . 'plugins/basic-admin/assets/js/color-modes.js') ?: '1';
		$colorModesJs = ROOT . '/plugins/basic-admin/assets/js/color-modes.js?v=' . rawurlencode((string)$colorModesVersion);
		$passwordToggleVersion = @filemtime(ROOTPATH . 'plugins/basic-admin/assets/js/session-lock.js') ?: '1';
		$passwordToggleJs = ROOT . '/plugins/basic-admin/assets/js/session-lock.js?v=' . rawurlencode((string)$passwordToggleVersion);
		$rootUrl = rtrim(ROOT, '/');
		$unlockUrl = $rootUrl . '/admin/unlock';
		$logoutUrl = $rootUrl . '/logout';
		if($returnTo === ''){
			$returnTo = basic_admin_session_lock_return_url();
		}
		$csrfField = csrf('session_lock_csrf', 24);
		header('Cache-Control: no-store, private');
		header('Content-Type: text/html; charset=utf-8');
		echo '<!doctype html><html lang="en" data-bs-theme="auto"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">';
		echo '<title>Workspace locked | ' . esc(APP_NAME) . '</title><script src="' . esc($colorModesJs) . '"></script><link rel="stylesheet" href="' . esc($lockCss) . '"></head>';
		echo '<body class="session-lock-page"><main class="session-lock-card" role="main">';
		echo '<div class="session-lock-brand"><img src="' . esc(APP_LOGO2) . '" alt=""><span>' . esc(APP_NAME) . '</span></div>';
		echo '<div class="session-lock-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M7.5 10V7.5a4.5 4.5 0 0 1 9 0V10M6.5 10h11a1.5 1.5 0 0 1 1.5 1.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 5 18.5v-7A1.5 1.5 0 0 1 6.5 10Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="15" r="1.1" fill="currentColor"/></svg></div>';
		echo '<p class="session-lock-eyebrow">PRIVATE WORKSPACE</p><h1>Workspace locked</h1>';
		echo '<p class="session-lock-copy">Your workspace was secured after a period of inactivity. Enter your password to continue where you left off.</p>';
		echo '<div class="session-lock-user"><span class="session-lock-avatar">' . esc($initials) . '</span><span>' . esc($name) . '</span></div>';
		if($error !== ''){
			echo '<p class="session-lock-error" role="alert">' . esc($error) . '</p>';
		}
		echo '<form class="session-lock-form" method="post" action="' . esc($unlockUrl) . '">';
		echo $csrfField;
		echo '<input type="hidden" name="return_to" value="' . esc($returnTo) . '">';
		echo '<label for="sessionLockPassword">Password</label><div class="session-lock-password-field"><input id="sessionLockPassword" name="password" type="password" autocomplete="current-password" required autofocus>';
		echo '<button class="session-lock-password-toggle" type="button" aria-label="Show password" aria-pressed="false" aria-controls="sessionLockPassword">Show</button></div>';
		echo '<button class="session-lock-submit" type="submit">Unlock workspace <span aria-hidden="true">&rarr;</span></button></form>';
		echo '<a class="session-lock-signout" href="' . esc($logoutUrl) . '">Sign out instead</a>';
		echo '<p class="session-lock-footnote"><span aria-hidden="true">&#128274;</span> Your work is still here, safe and private.</p>';
		echo '</main><script src="' . esc($passwordToggleJs) . '"></script></body></html>';
	}
}

if(!function_exists('basic_admin_session_lock_return_url'))
{
	function basic_admin_session_lock_return_url(): string
	{
		$requestUri = (string)($_SERVER['REQUEST_URI'] ?? '');
		$route = trim((string)($_GET['url'] ?? ''), '/');
		if($route !== 'admin' && !str_starts_with($route, 'admin/')){
			return $requestUri !== '' ? $requestUri : ROOT . '/admin';
		}

		$queryParams = $_GET;
		unset($queryParams['url']);
		$query = http_build_query($queryParams);
		$returnTo = rtrim(ROOT, '/') . '/' . $route;
		return $query !== '' ? $returnTo . '?' . $query : $returnTo;
	}
}
