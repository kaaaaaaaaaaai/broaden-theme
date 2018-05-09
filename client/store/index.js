import Vuex from 'vuex'

const store = () => new Vuex.Store({
    state: {
        Contents: [],
        popularContents: []
    },
    mutations: {
        SET_THUMBNAIL_URL(state, valName){
            eval(`state.${valName}`).forEach((c) => {
                c.thumb_url = process.env.apiUrl + '/theme_img/' + c.id + '.jpg'
            })
        }
    },
    getters:{
    },
    actions: {
        GET_RECENT_THEME({commit, state, getters}, {page}){
            this.$axios.$get("api/theme/recent")
                .then((response) => {
                    state.Contents = response.data
                    commit("SET_THUMBNAIL_URL", "Contents")
                    console.log(response)
                });
        },
        GET_POPULAR_THEME({commit, state, getters}, {page}){
            this.$axios.$get("api/theme/recent")
                .then((response) => {
                    state.popularContents = response.data
                    commit("SET_THUMBNAIL_URL", "popularContents")
                });
        },
        POST_VOTE_BY_ID({},{id}){
            this.$axios.$post(`api/theme/vote/${id}`)
                .then((response) => {

                }).catch((error) => {
                    console.log(error);
            });
        }
    }
})

export default store
