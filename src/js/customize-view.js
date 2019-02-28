const siteHeader = document.querySelector( '.app-header' );
const siteTitle = document.querySelector( '.app-header__title' );
const siteDesc = document.querySelector( '.app-header__description' );

// https://googlechrome.github.io/samples/css-custom-properties/
// Auxiliary method. Sets the value of a custom property at the document level.
const setVariable = function( propertyName, value ) {
	document.documentElement.style.setProperty( propertyName, value );
};

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

// Header text color.
wp.customize( 'header_textcolor', value => {
	value.bind( to => {
		setVariable( '--header-text-color', to );

		let headerText = [ siteTitle, siteDesc ];

		headerText.forEach( text => {
			if ( 'blank' === to ) {
				text.style.clip = 'rect(0 0 0 0)';
				text.style.position = 'absolute';
			} else {
				text.style.color = to;
				text.style.clip = 'auto';
				text.style.position = 'relative';
			}
		});
	});
});

// Primary color.
wp.customize( 'header_bg_color', value => {
	value.bind( to => {
		setVariable( '--header-bg-color', to );
	});
});

// Primary color.
wp.customize( 'primary_color', value => {
	value.bind( to => {
		setVariable( '--color-1', to );
	});
});

// Secondary color.
wp.customize( 'accent_color', value => {
	value.bind( to => {
		setVariable( '--color-2', to );
	});
});
