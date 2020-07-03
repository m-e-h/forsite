const navigation = () => {
	const navPanel = document.querySelector('.app-header__nav');

	// If menu is empty, return early.
	if (!navPanel) {
		return;
	}

	const toggleButton = document.querySelector('#main-nav__toggle');

	const closeMenu = () => {
		navPanel.classList.remove('is-active');
		toggleButton.setAttribute('aria-expanded', 'false');
		toggleButton.setAttribute('aria-pressed', 'false');
	};

	const openMenu = () => {
		navPanel.classList.add('is-active');
		toggleButton.setAttribute('aria-expanded', 'true');
		toggleButton.setAttribute('aria-pressed', 'true');
	};

	toggleButton.addEventListener(
		'click',
		() => {
			if (navPanel.classList.contains('is-active')) {
				closeMenu();
			} else {
				openMenu();
			}
		},
		true
	);
};

export default navigation;
