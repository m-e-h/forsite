const siteBranding = document.querySelector( '.app-header__branding' );
const titleText = document.querySelector( '.app-header__text' );
const siteTitle = document.querySelector( '.app-header__title' );
const siteDesc = document.querySelector( '.app-header__description' );
const docBody = document.querySelector( 'body' );

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

// // Header Branding.
wp.customize( 'custom_logo', value => {
	value.bind( to => {
		if ( '' === to && titleText.classList.contains( 'screen-reader-text' ) ) {
			siteBranding.classList.add( 'screen-reader-text' );
		} else {
			siteBranding.classList.remove( 'screen-reader-text' );
		}
	});
});

// Header text.
wp.customize( 'header_textcolor', value => {
	value.bind( to => {
		if ( 'blank' === to ) {
			titleText.classList.add( 'screen-reader-text' );

			if ( docBody.classList.contains( 'wp-custom-logo' ) ) {
				siteBranding.classList.remove( 'screen-reader-text' );
			} else {
				siteBranding.classList.add( 'screen-reader-text' );
			}
		} else {
			siteBranding.classList.remove( 'screen-reader-text' );
			titleText.classList.remove( 'screen-reader-text' );
			root.style.setProperty( '--header-text-color', to );
		}
	});
});
