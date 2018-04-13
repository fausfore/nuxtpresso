<script>
import Header from "~/components/header.vue"
import AppLogo from "~/components/AppLogo.vue"

export default {
  components: {
    AppLogo,
    Header
  },
  head: {
    link: [
      {
        rel: "stylesheet",
        href: "https://use.fontawesome.com/releases/v5.0.10/css/all.css"
      }
    ]
  }
}
</script>


<template>
  <section class="container">
    <Header/>
    <nuxt-child/>
  </section>
</template>
