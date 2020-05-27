const searchToggle = () => {
	const navPanel = document.querySelector('.app-header__nav');

	// If menu is empty, return early.
	if (!navPanel) {
		return;
	}

	const toggleButton = document.querySelector('.search-toggle');
	const closeButton = document.querySelector('.search-close');
	const searchInput = document.querySelector(
		'.app-header__nav .site-search--products input[type=search]'
	);

	const closeSearch = () => {
		navPanel.classList.remove('search-active');
		searchInput.blur();
		toggleButton.setAttribute('aria-expanded', 'false');
		toggleButton.setAttribute('aria-pressed', 'false');
	};

	const openSearch = () => {
		navPanel.classList.add('search-active');
		searchInput.focus();
		toggleButton.setAttribute('aria-expanded', 'true');
		toggleButton.setAttribute('aria-pressed', 'true');
	};

	toggleButton.addEventListener(
		'click',
		() => {
			openSearch();
		},
		false
	);
	closeButton.addEventListener(
		'click',
		() => {
			closeSearch();
		},
		false
	);
};

export default searchToggle;
