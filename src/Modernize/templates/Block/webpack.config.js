// webpack.config.js template

// This webpack configuration file is a starting point for building Gutenberg blocks in your WordPress plugin.
// It extends the default configuration provided by @wordpress/scripts to support additional features like SASS/SCSS.
// Modify and extend this configuration to suit your project's specific requirements.

const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const { merge } = require('webpack-merge');
const path = require('path');

// Merging the custom configuration with the default configuration.
module.exports = merge(defaultConfig, {
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    'style-loader', // Injects CSS into the DOM.
                    'css-loader',   // Translates CSS into CommonJS modules.
                    'sass-loader'   // Compiles Sass to CSS.
                ],
            },
        ],
    },
    entry: {
        'sample-block-1': path.resolve(__dirname, 'src/blocks/sample-block-1/index.js'),
        'sample-block-2': path.resolve(__dirname, 'src/blocks/sample-block-2/index.js'),
    },
    output: {
        path: path.resolve(__dirname, 'build'),
        filename: '[name]/index.js',
    },
});

// For more details on webpack configuration, visit https://webpack.js.org/configuration/.
// To learn more about extending @wordpress/scripts, check out https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/.
