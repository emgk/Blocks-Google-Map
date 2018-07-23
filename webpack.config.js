const path = require('path');

module.exports = {

    entry: path.resolve(__dirname, './src/blocks-google-maps.js'),
    output: {
        filename: 'blocks-google-maps.js',
        path: path.resolve(__dirname, './assets/blocks')
    },
    devtool: 'source-map',
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: 'babel-loader'
            },
        ]
    },
};