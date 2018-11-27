module.exports = ctx => ({
  map: ctx.env === 'development' ? { inline: false } : false,
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
    'postcss-scope-to': ctx.env === 'editor'
            ? {
			  scopeTo: '.editor-styles-wrapper',

			  suffix: ':not([class^="components-"]):not([class^="editor-"]):not([class^="block-"]):not([aria-owns])',

              remove: [
                'html',
                ':disabled',
                '[readonly]',
                '[disabled]'
			  ],
            }
            : false,
    cssnano: ctx.env === 'production' ? { preset: 'default' } : false
  }
})
