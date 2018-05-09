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
        },
        SET_COUNTDOWN_CLOSE_ITEM(state, valName){
            eval(`state.${valName}`).forEach((c) => {
                c.countdown = setInterval(()=>{

                    c.diffInMinutes--;
                    console.log(c.diffInMinutes);
                    //this.chengeLimitColor(this.data.close_time);
                    if(c.diffInMinutes == 0){
                        clearInterval(c.countdown);
                        console.log("end this theme");
                    }
                }, 1000)
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
                    commit("SET_THUMBNAIL_URL", "Contents");
                    commit("SET_COUNTDOWN_CLOSE_ITEM", "Contents");


                    console.log(response)
                });
        },
        GET_POPULAR_THEME({commit, state, getters}, {page}){
            this.$axios.$get("api/theme/recent")
                .then((response) => {
                    state.popularContents = response.data
                    commit("SET_THUMBNAIL_URL", "popularContents")
                    commit("SET_COUNTDOWN_CLOSE_ITEM", "popularContents")
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
