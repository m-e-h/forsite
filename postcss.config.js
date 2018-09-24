module.exports = ctx => ({
	map: ctx.env === "development" ? true : false,
	plugins: {
		"postcss-import": {},
		"postcss-simple-vars": {},
		"postcss-color-function": {},
		"postcss-preset-env": { stage: 0 },
		cssnano: ctx.env === "production" ? { preset: "default" } : false
	}
});
