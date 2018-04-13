<script>
import { mapActions } from "vuex"
import { mapGetters } from "vuex"
import Loader from "~/components/loader.vue"

import * as FromPosts from "../../store/posts"

export default {
  components: {
    Loader
  },
  computed: {
    ...mapGetters({
      posts: "postData$",
      loaded: "postLoaded$",
      loading: "postLoading$"
    })
  },
  created() {
    if (!this.loaded) {
      this.fetchPosts()
    }
  },
  methods: {
    ...mapActions(["fetchPosts"])
  }
}
</script>

<template>
  <section class="container">
    <section class="hero is-primary">
      <div class="hero-body">
        <p class="title">
          All Posts
        </p>
        <Loader v-if="loading"/>
      </div>
    </section>
    <article>
      <ul>
        <li v-for="post of posts" :v-if="post" :key="post.id">
          <div class="card">
            <div class="card-image">
              <figure class="image is-4by3">
                <img :src="post.media_infos" alt="Placeholder image">
              </figure>
            </div>
            <div class="card-content">
              <div class="media">
                <div class="media-content">
                  <p class="title is-4">{{ post.title.rendered }}</p>
                  <p class="subtitle is-6">@{{ post.author_infos.name }}</p>
                </div>
              </div>
              <div class="content">
                <p v-html="post.excerpt.rendered"/>
                <br>
                <time datetime="2016-1-1">{{ post.date }}</time>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </article>
  </section>
</template>

<style lang="scss" scoped>
.hero-body {
  position: relative;
  .title {
    margin-bottom: initial;
  }
  .spinner {
    right: 1.5rem;
  }
}
</style>
