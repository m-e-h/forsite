module.exports = ctx => ({
	map: ctx.env === "development" ? {inline: false} : false,
	plugins: {
		"postcss-import": {},
		"postcss-simple-vars": {},
		"postcss-color-function": {},
		"postcss-preset-env": { stage: 0 },
		"postcss-extend-rule": {},
		cssnano: ctx.env === "production" ? { preset: "default" } : false
	}
});
