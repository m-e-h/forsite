const siteHeader = document.querySelector('.app-header');
const siteTitle = document.querySelector('.app-header__title');
const siteDesc = document.querySelector('.app-header__description');

const root = document.documentElement;

// Site title.
wp.customize('blogname', (value) => {
	value.bind((to) => {
		siteTitle.textContent = to;
	});
});

// Site description.
wp.customize('blogdescription', (value) => {
	value.bind((to) => {
		siteDesc.textContent = to;
	});
});

// Primary color.
wp.customize('header_bg_color', (value) => {
	value.bind((to) => {
		root.style.setProperty('--header-bg-color', to);
	});
});

wp.customize('foreground_color', (value) => {
	value.bind((to) => {
		root.style.setProperty('--foreground_color', to);
	});
});

// Primary color.
wp.customize('primary_color', (value) => {
	value.bind((to) => {
		root.style.setProperty('--color-1', to);
	});
});

// Secondary color.
wp.customize('accent_color', (value) => {
	value.bind((to) => {
		root.style.setProperty('--color-2', to);
	});
});

// Header text.
wp.customize('header_color', (value) => {
	value.bind((to) => {
		siteHeader.style.setProperty('--header-text-color', to);
	});
});

// Header text.
wp.customize('header_text', (value) => {
	value.bind((to) => {
		if (to === false) {
			siteTitle.style.cssText = 'clip:rect(0 0 0 0);position:absolute';
			siteDesc.style.cssText = 'clip:rect(0 0 0 0);position:absolute';
		} else {
			siteTitle.style.cssText = 'clip:unset;position:relative';
			siteDesc.style.cssText = 'clip:unset;position:relative';
		}
	});
});
