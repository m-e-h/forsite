module.exports = (ctx) => ({
	map: ctx.env === 'development' ? { inline: false } : false,
	plugins: {
		'postcss-import': {},
		'postcss-nested': {},
		'postcss-preset-env': {
			stage: 0,
			features: {
				'nesting-rules': false, // Uses postcss-nesting which doesn't behave like Sass.
				'color-mod-function': true,
				'all-property': false
			},
			autoprefixer: {
				grid: true
			}

		},
		'postcss-editor-styles':
			ctx.env === 'editor' ?
				{
					repeat: 1,
					ignore: [
						':root',
						':root:root',
						':root:root:root',
						'.wp-toolbar',
						':root:not(.wp-toolbar)'
					],
					tags: [
						'a',
						'svg',
						'a:hover',
						'a:focus',
						'button',
						'button:hover',
						'button:focus',
						'input',
						'label',
						'select',
						'textarea',
						'form',
						'input[type="button"]',
						'input[type="submit"]',
						'input[type="reset"]',
						'[type="button"]',
						'[type="submit"]',
						'[type="reset"]',
						'[readonly]'
					],
					tagSuffix:
							':not([class^="components-"]):not([class^="editor-"]):not([class^="block-"]):not([aria-owns]):not([id^="mceu_"]):not([class*="dashicons-"])'
				} :
				false,
		cssnano: ctx.env !== 'development' ? { preset: 'default' } : false
	}
});
