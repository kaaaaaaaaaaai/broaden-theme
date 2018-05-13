import Vuex from 'vuex'
const inBrowser = typeof window !== 'undefined'

const store = () => new Vuex.Store({
    state: {
        Contents: [],
        popularContents: [],
        loggedIn: false,
        token: null
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
                    //console.log(c.diffInMinutes);
                    //this.chengeLimitColor(this.data.close_time);
                    if(c.diffInMinutes == 0){
                        clearInterval(c.countdown);
                        console.log("end this theme");
                    }
                }, 1000)
            })
        },
        setUser (state, { user }) {
            state.user = user
            state.loggedIn = Boolean(user)
        },

        setToken (state, { token }) {
            state.token = token

            // Store token in cookies
            if (inBrowser) {
                if (token) {
                    this.$cookies.set('token', token, { expires: 30 })
                } else {
                    this.$cookies.remove('token')
                }
            }
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
            this.$axios.$get("api/theme/popular")
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
        },
        nuxtServerInit ({ dispatch, state, commit }, { error }) {
            const token = this.$cookies.cookies.token

            if (!token) {
                return Promise.resolve()
            }

            return dispatch('fetchUserByAccessToken', { token }).catch(e => {
                return dispatch('logout').catch(e => {
                    error({ message: e.message, statusCode: e.statusCode })
                })
            })
        },

        fetchUserByPasswordGrant ({ commit, dispatch }, { email, password }) {
            const params = {
                grant_type: 'password',
                client_id: process.env.clientId,
                client_secret: process.env.clientSecret,
                username: email,
                password: password,
                scope: '*'
            }

            return this.$axios.$post('/oauth/token', params).then(data => {
                return dispatch('fetchUserByAccessToken', { token: data.access_token })
                    .catch(e => Promise.reject(e))
            })
        },

        fetchUserByAccessToken ({ commit, dispatch }, { token }) {
            commit('setToken', { token })

            return this.$axios.$get('/users/@me').then(user => {
                commit('setUser', { user })
            })
        },

        logout ({ commit }) {
            commit('setUser', { user: null })

            // Revoke access token
            return this.$axios.delete('/oauth/token/destroy').then(() => {
                commit('setToken', { token: null })
            }).catch(e => {
                commit('setToken', { token: null })
            })
        }
    }
})

export default store
