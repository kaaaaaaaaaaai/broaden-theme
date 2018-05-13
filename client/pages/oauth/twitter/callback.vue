<template>
    <div>
        <p v-if="attempting">Twitterでログインしています。</p>
        <p>{{ failedMessage }}</p>
    </div>
</template>

<script>
    import { mapMutations } from 'vuex'
    export default {
        //middleware: 'guest',
        data () {
            return {
                failedMessage: null
            }
        },
        computed: {
            attempting () {
                return !this.failedMessage
            }
        },
        methods: mapMutations([
            'setToken',
            'setUser'
        ]),
        async mounted () {
            try {
                const callbackData = await this.$axios.$get('/api/oauth/twitter/callback', { params: this.$route.query })
                this.setToken({ token: callbackData.access_token })
                this.setUser({ user: callbackData.user })
                this.$router.replace('/')
            } catch (error) {
                this.failedMessage = error.message
            }
        }
    }
</script>