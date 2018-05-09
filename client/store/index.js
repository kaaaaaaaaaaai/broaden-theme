import Vuex from 'vuex'

const store = () => new Vuex.Store({
    state: {
        Contents: []
    },
    mutations: {
        SET_THUMBNAIL_URL(state){
            state.Contents.forEach((c) => {
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
                    commit("SET_THUMBNAIL_URL")
            });

        }
    }
})

export default store
