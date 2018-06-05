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
  .has-background-grey-lighter{
    background-color: #E5E7ED;
  }
</style>
