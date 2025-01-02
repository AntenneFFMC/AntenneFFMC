const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	mode: 'production',
	entry: './plugins/auto/antenneffmc/squelettes/dev/js/index.js',
	output: {
		path: path.resolve('./plugins/auto/antenneffmc/squelettes'),
		filename: 'main.js'
	},
	module: {
		rules: [{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
				}
			},
			{
				test: /\.scss$/,
				use: [{
						loader: MiniCssExtractPlugin.loader,
						options: {
							// publicPath: "../"
						}
					},
					'css-loader',
					'postcss-loader',
					'sass-loader'
				]
			},
			{
				test: /\.(woff(2)?|ttf|eot|svg)$/i,
				include: [
					path.resolve(__dirname, 'dev/fonts')
				],
				use: []
			}
		]
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: 'main.css'
		})
	]

};