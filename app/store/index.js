import Vuex from "vuex"
import axios from "axios"
import createLogger from "vuex/dist/logger"

import * as FromPosts from "./posts"

const createStore = () => {
  return new Vuex.Store({
    state: {
      posts: FromPosts.defaultValue
    },
    mutations: {
      ...FromPosts.mutations
    },
    actions: { ...FromPosts.actions },
    getters: { ...FromPosts.getters },
    plugins: [createLogger(), ...FromPosts.plugins]
  })
}

export default createStore
