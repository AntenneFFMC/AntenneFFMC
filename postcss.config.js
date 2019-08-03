module.exports = ({ options }) => ({
  plugins: [
    require('autoprefixer')({grid: "autoplace"}),
    require('postcss-flexbugs-fixes'),
    options.env === 'production' ? require('cssnano') : false
  ]
});
