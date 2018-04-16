<script>
import Header from "~/components/header.vue"

export default {
  components: {
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
