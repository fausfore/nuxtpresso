export const getters = {
  postState$: state => state.posts,
  postData$: state => state.posts.data,
  postLoaded$: state => state.posts.loaded,
  postLoading$: state => state.posts.loading
}
