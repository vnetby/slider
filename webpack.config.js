const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const autoprefixer = require('autoprefixer');
// const MiniCssExtractPlugin = require('mini-css-extract-plugin');


// const HardSourceWebpackPlugin = require('hard-source-webpack-plugin');


const theme = './wp-content/themes/vnet-wp';
const MODE = 'development';


const HEAD_SCRIPTS = {
  mode: MODE,
  entry: theme + '/js/dev/DOM/index.js',
  output: {
    path: path.resolve(theme, 'js'),
    filename: 'head.min.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            cacheDirectory: true,
            presets: ['@babel/preset-env', '@babel/preset-react'],
            plugins: ['@babel/plugin-transform-shorthand-properties']
          }
        }
      },
      {
        test: /\.less$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            {
              loader: 'css-loader',
              options: {
                url: false,
                sourceMap: true
              }
            },
            {
              loader: 'postcss-loader',
              options: {
                plugins: [autoprefixer({ grid: true })],
                sourceMap: true
              }
            },
            {
              loader: 'less-loader',
              options: {
                sourceMap: true
              }
            }
          ]
        })
      },
      {
        test: /\.(woff|woff2|eot|ttf|svg|otf|png)$/,
        loader: 'file-loader',
        options: {
          name: '../[path][name].[ext]',
          context: theme + '/'
        }
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin({
      filename: '../css/head.min.css'
    })
  ],
  devtool: 'source-map',
  watch: true
};




const SCRIPTS = {
  mode: MODE,
  entry: theme + '/js/dev/index.js',
  output: {
    path: path.resolve(theme, 'js'),
    filename: 'main.min.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            cacheDirectory: true,
            presets: ['@babel/preset-env', '@babel/preset-react'],
            plugins: ['@babel/plugin-transform-shorthand-properties']
          }
        }
      },
      {
        test: /\.less$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [

            {
              loader: 'css-loader',
              options: {
                url: false,
                sourceMap: true
              }
            },
            {
              loader: 'postcss-loader',
              options: {
                plugins: [autoprefixer({ grid: true })],
                sourceMap: true
              }
            },
            {
              loader: 'less-loader',
              options: {
                sourceMap: true
              }
            }
          ]
        })
      },
      {
        test: /\.(woff|woff2|eot|ttf|svg|otf|png)$/,
        loader: 'file-loader',
        options: {
          name: '../[path][name].[ext]',
          context: theme + '/'
        }
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin({
      filename: '../css/main.min.css'
    })
    // new HardSourceWebpackPlugin()
  ],
  devtool: 'source-map',
  watch: true
};


module.exports = [HEAD_SCRIPTS, SCRIPTS];



