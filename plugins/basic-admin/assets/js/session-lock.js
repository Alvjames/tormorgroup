(function(){
	var toggle = document.querySelector('.session-lock-password-toggle');
	if (!toggle) return;

	var password = document.getElementById(toggle.getAttribute('aria-controls'));
	if (!password) return;

	toggle.addEventListener('click', function(){
		var showPassword = password.type === 'password';
		password.type = showPassword ? 'text' : 'password';
		toggle.textContent = showPassword ? 'Hide' : 'Show';
		toggle.setAttribute('aria-label', showPassword ? 'Hide password' : 'Show password');
		toggle.setAttribute('aria-pressed', showPassword ? 'true' : 'false');
	});
})();
