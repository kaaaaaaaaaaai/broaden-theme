<template>
    <nav class="navbar is-White" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
              <div class="navbar-item">
                <nuxt-link to="/about" class="navbar-item">About Lit</nuxt-link>
              </div>
              <div class="navbar-item">
                <nuxt-link to="/" class="navbar-item">
                  <img src="../static/images/title-logo.jpg" alt="">
                </nuxt-link>
              </div>
                <div class="navbar-item">
                  <nuxt-link to="/create" class="navbar-item">お題作成</nuxt-link>
                </div>
        </div><!-- navbar-brand END -->
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

<style media="screen">
.navbar .navbar-brand {
text-align: center;
display: block;
width: 100%;
}

.navbar .navbar-brand > .navbar-item,
.navbar .navbar-brand .navbar-link {
display: inline-block;
}
</style>
