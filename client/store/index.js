import Vuex from 'vuex'

const store = () => new Vuex.Store({
    state: {
        Contents: []
    },
    mutations: {

    },
    getters:{
        allContents(state) {
            return state.Contents
        },
    },
    actions: {
        GET_RECENT_THEME({commit, state, getters}, {page}){
            const data = this.$axios.$get("api/theme/recent")
                .then((response) => {
                    state.Contents = response.data
                    console.log(state.Contents)
            });

        }
    }
})

export default store
