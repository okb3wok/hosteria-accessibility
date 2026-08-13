import path from 'path';
import { fileURLToPath } from 'url';
import HtmlWebpackPlugin from 'html-webpack-plugin';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
const isProduction = process.env.NODE_ENV === 'production';
import CopyWebpackPlugin from 'copy-webpack-plugin';
import TerserPlugin from 'terser-webpack-plugin';
import Dotenv from 'dotenv-webpack';
import dotenv from 'dotenv';

dotenv.config();

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

console.log(`isProduction: ${isProduction}`);

export default {
  mode: isProduction ? 'production' : 'development',
  entry: './src/index.js',
  output: {
    clean: true,
    path: path.resolve(__dirname, `${process.env.PLUGIN_SLUG}`),
    filename: `assets/${process.env.PLUGIN_SLUG}.js`,
    environment: {
      arrowFunction: true,
    },
    pathinfo: false,
  },
  devServer: {
    static:{
      directory: path.join(__dirname, 'src'),
    },
    port: 8018,
    host: 'localhost',
    hot: true,
    open: true,
    compress: true,
    liveReload: true,
  },
  module: {
    rules: [
      // {
      //   test: /\.js$/,
      //   exclude: /node_modules/,
      //   use: {
      //     loader: 'babel-loader',
      //     options: {
      //       presets: ['@babel/preset-env'],
      //     },
      //   },
      // },
      {
        test: /\.s[ac]ss|css$/i,
        use: [
          isProduction ? MiniCssExtractPlugin.loader : 'style-loader',
          'css-loader',
          'postcss-loader',
        ],
      },
      {
        test: /\.(ttf|woff2)$/i,
        type: 'asset/resource',
        generator: { filename: 'assets/fonts/[name][ext]' },
      }

    ],
  },

  devtool: isProduction ? false : 'inline-source-map',
  plugins: [
    new Dotenv(),
    new MiniCssExtractPlugin({
      filename: `assets/${process.env.PLUGIN_SLUG}.css`
    }),
    ...(!isProduction ? [
      new HtmlWebpackPlugin({
        filename: 'index.html',
        template: './src/index.html',
        inject: false
      })
    ] : []),
    new CopyWebpackPlugin({
      patterns: [
        {
          from: path.resolve(__dirname, 'src/php'),
          to: path.resolve(__dirname, `${process.env.PLUGIN_SLUG}`),
          transform(content, absoluteFrom) {
            if (absoluteFrom.endsWith('.php') ||
              absoluteFrom.endsWith('.css') ||
              absoluteFrom.endsWith('.js') ||
              absoluteFrom.endsWith('.txt')) {
              let code = content.toString();

              code = code.replace(/%%(\w+)%%/g, (match, p1) => {
                return process.env[p1] !== undefined ? process.env[p1] : match;
              });

              return code;
            }
            return content;
          },
        }
      ],
    }),
  ],
  optimization: {
    minimize: true,
    minimizer: [
      new TerserPlugin({
        terserOptions: {
          compress: false,
          mangle: false,
          ecma: 2022,
          output: {
            beautify: true,
            comments: false,
          },
        },
        extractComments: false,
      }),
    ],
  },
};
