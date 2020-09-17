module.exports = {
  publicPath: process.env.NODE_ENV === 'production'
    ? '/app/'
    : '/',
  chainWebpack: config => {
    config.plugin('html').tap(args => {
      args[0].title = 'App'
      return args
    })
  }
}
