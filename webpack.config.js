const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	mode: 'production',
	entry: './squelettes/dev/js/index.js',
	output: {
		path: path.resolve('./squelettes'),
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
			},
			{
				test: /\.(gif|png|jpe?g|svg)$/i,
				use: [{
						loader: 'file-loader',
						options: {
							name: 'images/[folder]/[name].[ext]'
						}
					},
					{
						loader: 'image-webpack-loader',
						options: {
							mozjpeg: {
								progressive: true,
								quality: 65
							},
							// optipng.enabled: false will disable optipng
							optipng: {
								enabled: false,
							},
							pngquant: {
								quality: '65-90',
								speed: 4
							},
							gifsicle: {
								interlaced: false,
							},
							// the webp option will enable WEBP
							webp: {
								quality: 75
							}
						}
					},
				],
			}
		]
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: 'main.css'
		})
	]

};