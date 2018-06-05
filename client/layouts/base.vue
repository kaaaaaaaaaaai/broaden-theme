<template>
    <div>
        <navbar/>
        <nuxt class="has-background-grey-lighter  "/>
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

<style>
  @import url(https://fonts.googleapis.com/earlyaccess/notosansjapanese.css);

  body{
    font-family: 'Noto Sans Japanese', sans-serif;
    font-size: 100%;
  }

  .has-background-grey-lighter{
    background-color: #E5E7ED;
  }
</style>
