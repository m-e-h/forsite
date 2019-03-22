const siteBranding = document.querySelector( '.app-header__branding' );
const siteTitle = document.querySelector( '.app-header__title' );
const siteDesc = document.querySelector( '.app-header__description' );
const siteCrumbs = document.querySelector( '.breadcrumbs' );
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

// Header text.
wp.customize( 'header_textcolor', value => {
	value.bind( to => {
		if ( 'blank' === to ) {
			siteTitle.classList.add( 'screen-reader-text' );
			siteDesc.classList.add( 'screen-reader-text' );
		} else {
			siteTitle.classList.remove( 'screen-reader-text' );
			siteDesc.classList.remove( 'screen-reader-text' );
			root.style.setProperty( '--header-text-color', to );
		}
	});
});

// Header Breadcrumbs.
wp.customize( 'forsite_breadcrumbs', value => {
	value.bind( to => {
		if ( false === to ) {
			siteCrumbs.classList.add( 'screen-reader-text' );
		} else {
			siteCrumbs.classList.remove( 'screen-reader-text' );
		}
	});
});
