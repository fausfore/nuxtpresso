importScripts("/_nuxt/workbox.3de3418b.js", "custom-sw.js")

const workboxSW = new self.WorkboxSW({
  cacheId: "nuxt-testing",
  clientsClaim: true,
  directoryIndex: "/"
})

workboxSW.precache([
  {
    url: "/_nuxt/app.298a777bd333ac7b07e7.js",
    revision: "6de6215bd1f5cc4f8e5c1fa39c331b18"
  },
  {
    url: "/_nuxt/layouts/default.753efa7e7fdd19100b12.js",
    revision: "08dfdff62469bf115188b480da3851a2"
  },
  {
    url: "/_nuxt/manifest.e9bc4663f456dbfc0661.js",
    revision: "99258c97033db5baf7958de9153f51d3"
  },
  {
    url: "/_nuxt/pages/index.da9107cd0cd7c597c13e.js",
    revision: "2cf24ea50fe9fbd857a7e1acc5d5e7ee"
  },
  {
    url: "/_nuxt/vendor.6c83226fb3437797dafa.js",
    revision: "95cd1938090166cc0856d6590508b3c3"
  }
])

workboxSW.router.registerRoute(
  new RegExp("/_nuxt/.*"),
  workboxSW.strategies.cacheFirst({}),
  "GET"
)

workboxSW.router.registerRoute(
  new RegExp("/.*"),
  workboxSW.strategies.networkFirst({}),
  "GET"
)

workboxSW.router.registerRoute(
  new RegExp("https://my-cdn.com/posts/.*"),
  workboxSW.strategies.networkFirst({
    cacheName: "our-cache",
    cacheExpiration: { maxEntries: 10, maxAgeSeconds: 300 }
  }),
  "GET"
)
