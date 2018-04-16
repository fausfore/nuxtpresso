import {
  FETCH_POSTS,
  SET_POSTS,
  ADD_POSTS,
  FETCH_POSTS_OVER
} from "./posts.const"

export const mutations = {
  // Get posts from Api
  [FETCH_POSTS](state) {
    state.posts = {
      ...state.posts,
      loading: true
    }
  },
  // Add one by one post
  [ADD_POSTS](state, payload) {
    state.posts = {
      ...state.posts,
      data: [...state.posts.data, payload]
    }
  },
  // Change the state to loaded
  [FETCH_POSTS_OVER](state, payload) {
    state.posts = {
      ...state.posts,
      loaded: true,
      loading: false
    }
  }
}
