module.exports = ctx => ({
	map: ctx.env === "development" ? { inline: false } : false,
	plugins: {
		"postcss-import": {},
		"postcss-simple-vars": {},
		"postcss-preset-env": {
			stage: 0,
			features: {
				"color-mod-function": true,
				"all-property": false
			}
		},
		"postcss-extend-rule": {},
		"postcss-discard-comments": {},
		"postcss-discard-empty": {},
		"postcss-increase-specificity": ctx.env === "editor" ? {stackableRoot: '[data-block]',repeat: 2} : false,
		cssnano: ctx.env === "production" ? { preset: "default" } : false
	}
});
