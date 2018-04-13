module.exports = {
  css: ["bulma", "@/assets/styles/main.scss"],
  router: {
    middleware: "stats"
  },
  modules: ["@nuxtjs/toast"],
  plugins: [`~plugins/vee-validate`],
  head: {
    title: "app",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "Nuxt.js project" }
    ],
    link: [
      { rel: "icon", type: "image/x-icon", href: "/favicon.ico" },
      {
        rel: "stylesheet",
        href: "https://use.fontawesome.com/releases/v5.0.10/css/all.css"
      }
    ]
  },
  toast: {
    position: "top-right",
    iconPack: "fontawesome",
    duration: 2000
  },
  loading: { color: "#3B8070" },
  build: {
    vendor: ["axios", "vee-validate"],
    postcss: {
      plugins: {
        "postcss-custom-properties": {
          warnings: false
        }
      }
    },
    babel: {
      plugins: ["transform-decorators-legacy", "transform-class-properties"]
    },
    extend(config, { isDev, isClient }) {
      if (isDev && isClient) {
        config.module.rules.push({
          enforce: "pre",
          test: /\.(js|vue)$/,
          loader: "eslint-loader",
          exclude: /(node_modules)/
        })
      }
    }
  }
}
