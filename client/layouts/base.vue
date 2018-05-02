<template>
    <div>
        <navbar/>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        ようこそ！
                    </h1>
                    <h2 class="subtitle">
                        お題を投稿しましょう！
                    </h2>
                </div>
            </div>
        </section>

        <div class="container is-fluid">
            <nuxt/>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="content has-text-centered">
                    <p>
                        <strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>. The source code is licensed
                        <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
                        is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    import Navbar from "../components/navbar.vue"
    export default {
        components:{
            Navbar
        }
    }
</script>