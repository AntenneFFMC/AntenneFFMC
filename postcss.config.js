module.exports = ({ options }) => ({
  plugins: [
    require('autoprefixer')({grid: "autoplace"}),
    require('postcss-flexbugs-fixes'),
    require('cssnano')
  ]
});
