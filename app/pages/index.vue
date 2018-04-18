<script>
import Header from "~/components/header.vue"
import axios from "axios"
import config from "../core/env.dev"

export default {
  metaInfo: {
    name: "TA MERE",
    title: "le titre"
  },
  components: {
    Header
  },
  data: () => ({
    meta_data: {
      title: undefined,
      desc: undefined
    }
  }),
  created() {
    this.fetchMetaData()
  },
  mounted() {
    console.log("HEAD", this.head)
  },
  head: () => ({
    meta: [
      { charset: "utf-8" }
      /*
      { hid: "description", name: "title", content: this.meta_data.title },
      {
        hid: "description",
        name: "description",
        content: this.meta_data.desc
      }
      */
    ],
    link: [
      {
        rel: "stylesheet",
        href: "https://use.fontawesome.com/releases/v5.0.10/css/all.css"
      }
    ]
  }),
  methods: {
    async fetchMetaData() {
      return await axios
        .get(`${config.apiUrl}/wp-json`)
        .then(response => {
          console.log("DATA", response)
          let data = response.data
          this.meta_data = {
            title: data.name,
            desc: data.description
          }
        })
        .catch(e => {})
    }
  }
}
</script>


<template>
  <section class="container">
    <Header/>
    <pre>{{ meta_data }}</pre>
    <nuxt-child/>
  </section>
</template>
