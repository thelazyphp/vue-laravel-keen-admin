module.exports = {
  publicPath: process.env.NODE_ENV === 'production'
    ? '/realty/'
    : '/',

  chainWebpack (config) {
    config.plugin('html').tap(args => {
      args[0].title = 'Realty'
      return args
    })
  }
}
