<template>
  <section>
    <div class="content">
      <h1>{{ data.title.rendered }}</h1>
      <article v-html="data.content.rendered"/>
    </div>
  </section>
</template>

<script>
import axios from "axios"
import config from "../../../core/env.dev"

export default {
  async asyncData({ params }, callback) {
    // Must be a number
    return await axios
      .get(`${config.apiUrl}/wp-json/wp/v2/pages?slug=${params.slug}`)
      .then(response => {
        callback(null, { data: response.data[0] })
      })
      .catch(e => {
        callback({ statusCode: 404, message: "Post not found" })
      })
  }
}
</script>
