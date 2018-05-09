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
            const data = this.$axios.$get("api/theme/recent")
                .then((response) => {
                    state.Contents = response.data
                    commit("SET_THUMBNAIL_URL", "Contents")
                });
        },
        GET_POPULAR_THEME({commit, state, getters}, {page}){
            const data = this.$axios.$get("api/theme/recent")
                .then((response) => {
                    state.popularContents = response.data
                    commit("SET_THUMBNAIL_URL", "popularContents")
                });
        }
    }
})

export default store
