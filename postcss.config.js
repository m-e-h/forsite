module.exports = ctx => ({
	map: 'development' === ctx.env ? { inline: false } : false,
	plugins: {
		'postcss-import': {},
		'postcss-simple-vars': {},
		'postcss-preset-env': {
			stage: 0,
			features: {
				'color-mod-function': true,
				'all-property': false
			}
		},
		'postcss-extend-rule': {},
		'postcss-discard-comments': {},
		'postcss-discard-empty': {},
		'postcss-editor-styles':
			'editor' === ctx.env ?
				{
					remove: [
						'html',
						':disabled',
						'[readonly]',
						'[disabled]'
					]
				} :
				false,
		cssnano: 'production' === ctx.env ? { preset: 'default' } : false
	}
});
