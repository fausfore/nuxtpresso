import axios from "axios"
import {
  FETCH_POSTS,
  SET_POSTS,
  ADD_POSTS,
  FETCH_POSTS_OVER
} from "./posts.const"

export function isEmpty(o) {
  for (var i in o) {
    if (o.hasOwnProperty(i)) {
      return false
    }
  }
  return true
}

async function getPosts() {
  const { data } = await axios.get("http://localhost:8000/wp-json/wp/v2/posts/")
  return data
}

async function buildPost(posts, method) {
  // Re-build Posts
  for (let i = 0; i < posts.length; i++) {
    posts[i].author_infos = await getAuthor(posts[i].author)
    posts[i].media_infos = await getMedias(posts[i].featured_media)
    method(ADD_POSTS, posts[i])
  }
  method(FETCH_POSTS_OVER)
}

async function getAuthor(author_id) {
  return await axios
    .get(`http://localhost:8000/wp-json/wp/v2/users/${author_id}`)
    .then(response => response.data)
}

async function getMedias(media_id) {
  return await axios
    .get(`http://localhost:8000/wp-json/wp/v2/media/${media_id}`)
    .then(response => {
      const { media_details } = response.data
      if (isEmpty(media_details)) {
        return "https://bulma.io/images/placeholders/1280x960.png"
      } else {
        return `http://localhost:8000/wp-content/uploads/${media_details.file}`
      }
    })
}

export const actions = {
  async fetchPosts({ commit }) {
    // Start init
    commit(FETCH_POSTS)
    // Get All Posts
    const posts = await getPosts()
    // End
    buildPost(posts, commit)
  }
}
