<template>
    <p>Twitterへリダイレクトしています</p>
</template>

<script>
    export default {
        //middleware: 'guest',
        asyncData ({ app, error }) {
            return app.$axios.$get('/api/oauth/twitter/redirect')
                .then(data => {
                    console.log(data)
                    return { twitterAuthUrl: data.redirect_url }
                })
                .catch(e => error({ message: e.message, statusCode: e.statusCode }))
        },
        mounted () {
            console.log(this.twitterAuthUrl)
                //window.location.href = this.twitterAuthUrl
            const windowLogin = window.open(this.twitterAuthUrl)
        }
    }
</script>