const siteBranding = document.querySelector( '.app-header__branding' );
const titleText = document.querySelector( '.app-header__text' );
const siteTitle = document.querySelector( '.app-header__title' );
const siteDesc = document.querySelector( '.app-header__description' );

let root = document.documentElement;

// Site title.
wp.customize( 'blogname', value => {
	value.bind( to => {
		siteTitle.textContent = to;
	});
});

// Site description.
wp.customize( 'blogdescription', value => {
	value.bind( to => {
		siteDesc.textContent = to;
	});
});

// Primary color.
wp.customize( 'header_bg_color', value => {
	value.bind( to => {
		root.style.setProperty( '--header-bg-color', to );
	});
});

// Primary color.
wp.customize( 'primary_color', value => {
	value.bind( to => {
		root.style.setProperty( '--color-1', to );
	});
});

// Secondary color.
wp.customize( 'accent_color', value => {
	value.bind( to => {
		root.style.setProperty( '--color-2', to );
	});
});

// Header text.
wp.customize( 'header_textcolor', value => {
	value.bind( to => {

		root.style.setProperty( '--header-text-color', to );

		const hasLogo = document.querySelector( '.custom-logo-link' ).style.display;

		if ( 'blank' === to ) {
			if ( 'none' === hasLogo ) {
				siteBranding.classList.add( 'screen-reader-text' );
			} else {
				siteBranding.classList.remove( 'screen-reader-text' );
				titleText.classList.add( 'screen-reader-text' );
			}
		} else {
			siteBranding.classList.remove( 'screen-reader-text' );
			titleText.classList.remove( 'screen-reader-text' );
		}

	});
});
