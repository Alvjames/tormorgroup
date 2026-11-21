/**put the javascript for your plugin here**/

(function(){
	function initializePasswordToggle(){
		var toggle = document.querySelector('.password-toggle');
		if (!toggle) return;

		var password = document.getElementById(toggle.getAttribute('aria-controls'));
		var icon = toggle.querySelector('i');
		if (!password || !icon) return;

		toggle.addEventListener('click', function(){
			var showPassword = password.type === 'password';
			password.type = showPassword ? 'text' : 'password';
			toggle.setAttribute('aria-label', showPassword ? 'Hide password' : 'Show password');
			toggle.setAttribute('aria-pressed', showPassword ? 'true' : 'false');
			icon.classList.toggle('fa-eye', !showPassword);
			icon.classList.toggle('fa-eye-slash', showPassword);
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initializePasswordToggle, {once: true});
	} else {
		initializePasswordToggle();
	}
})();
