<template>
    <nav class="navbar is-white" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <div class="navbar-item"><nuxt-link to="/" class="navbar-item">Lit</nuxt-link></div>
            <div class="navbar-burger" @click="toggleMenu" :class="{'is-active': isMenuActive}">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div><!-- navbar-brand END -->
        <div class="navbar-menu" id="navMenu" :class="{'is-active': isMenuActive}">
            <div class="navbar-end">
                <nuxt-link to="/" class="navbar-item">トップ</nuxt-link>
                <nuxt-link to="/create" class="navbar-item">お題作成</nuxt-link>
                <nuxt-link to="/about" class="navbar-item">About Lit</nuxt-link>
                <nuxt-link to="/contact" class="navbar-item">ლ(´ڡ`ლ)</nuxt-link>
            </div>
        </div><!-- navbar-menu END -->
    </nav>
</template>

<script>
    export default {
        data: () => {
            return {isMenuActive: false}
        },
        methods: {
            toggleMenu () {
                this.isMenuActive = !this.isMenuActive
            }
        }
    }
</script>