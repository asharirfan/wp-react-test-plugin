/**
 * Webpack Configuration.
 */

const path = require( 'path' );
module.exports = {
	watch: true,
	mode: 'development',
	entry: ['./assets/src/app.js'],
	output: {
		path: path.resolve(__dirname, 'assets/build/js'),
		filename: 'react-test-build.js'
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						/**
						 * Compiles ES 2015, ES 2016 and ES 2017.
						 *
						 * @see https://babeljs.io/docs/plugins/preset-env/
						 */
						presets: ['env', 'react']
					}
				}
			}
		]
	}
};

