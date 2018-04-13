<script>
import axios from "axios"

export default {
  async asyncData({ params }, callback) {
    // Must be a number
    return await axios
      .get(`http://localhost:8000/wp-json/wp/v2/posts?slug=${params.slug}`)
      .then(response => {
        callback(null, { data: response.data[0] })
      })
      .catch(e => {
        callback({ statusCode: 404, message: "Post not found" })
      })
  }
}
</script>

<template>
  <section>
    <div class="content">
      <h1>{{ data.title.rendered }}</h1>
      <article v-html="data.content.rendered"/>
    </div>
  </section>
</template>
