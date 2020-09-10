module.exports = {
  publicPath: '/realty/',

  chainWebpack: config => {
    config
    .plugin('html')
    .tap(args => {
      args[0].title = 'Realty'
      return args
    })
  },

  configureWebpack: {
    resolve: {
      alias: {
        'morris.js': 'morris.js/morris.js'
      }
    }
  }
}
