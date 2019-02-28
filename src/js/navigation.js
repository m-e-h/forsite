const navigation = () => {
	let mainNav = document.getElementById( 'js-menu--primary' );

	// If menu is empty, return early.
	if ( ! mainNav ) {
		return;
	}

	mainNav.insertAdjacentHTML(
		'beforebegin',
		'<button id="primary-menu__toggle" class="menu-toggle" aria-expanded="false" aria-pressed="false"><svg xmlns="http://www.w3.org/2000/svg" class="icon menu-icon" viewBox="0 0 24 24"><path d="m21 6v2h-18v-2zm-18 12h18v-2h-18zm0-5h18v-2h-18z"/></svg></button>'
	);

	let toggleButton = document.getElementById( 'primary-menu__toggle' );

	const closeMenu = () => {
		mainNav.classList.remove( 'is-active' );
		toggleButton.setAttribute( 'aria-expanded', 'false' );
		toggleButton.setAttribute( 'aria-pressed', 'false' );
	};

	const openMenu = () => {
		mainNav.classList.add( 'is-active' );
		toggleButton.setAttribute( 'aria-expanded', 'true' );
		toggleButton.setAttribute( 'aria-pressed', 'true' );
	};

	toggleButton.addEventListener(
		'click',
		function() {
			if ( mainNav.classList.contains( 'is-active' ) ) {
				closeMenu();
			} else {
				openMenu();
			}
		},
		true
	);
};

export default navigation;
