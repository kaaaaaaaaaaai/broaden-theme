<template>
    <div>
        <section class="hero">
            <div class="hero-head is-white">
                <b-tabs v-model="activeTab" position="is-centered" class="block">
                  <b-tab-item label="人気のお題"></b-tab-item>
                  <b-tab-item label="新しいお題"> </b-tab-item>
                </b-tabs>
            </div>
            <div class="hero-body is-paddingless">
                <div class="container has-text-centered">
                  <figure>
                      <img src="../static/images/hero-img.jpg"></img>
                  </figure>
                </div>
            </div>
        </section>
        <div class="container is-fluid">

        <div class="section" v-if="!activeTab">
            <div class="container">
              <div class="card">
                <header class="card-header-title  is-centered">
                      <h2 class="title">人気のお題</h2>
                </header>
                <div class="card-content is-light">
                  <div id="themeList" class="content">
                      <div class="columns is-multiline is-mobile is-centered">
                          <div v-for="theme in popularContents" class="column is-6-mobile is-3-desktop is-3-tablet">
                              <vue-item :data="theme"></vue-item>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="section" v-if="activeTab">
            <div class="container">
              <div class="card">
                <header class="card-header-title  is-centered">
                      <h2 class="title">新しいお題</h2>
                </header>
                <div class="card-content">
                  <div class="columns is-multiline is-mobile is-centered">
                      <div v-for="theme in Contents" class="column is-6-mobile is-3-desktop is-3-tablet">
                          <vue-item :data="theme"></vue-item>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    //Vue.component('vue-item', Item)
    import VueItem from "../components/Item.vue"
    import { mapState } from 'vuex'
    export default {
        layout:"base",
        name: 'Content',
        computed: mapState([
            'Contents',
            'popularContents'
        ]),
        data: function() {
            return {
                contentInfo : [],
                activeTab: 0,
            };
        },
        //キャメルケースで登録して使うときはスネークケースらしい
        components :{
            VueItem,
        },
        mounted() {
            this.$store.dispatch("GET_RECENT_THEME",{page:1})
            this.$store.dispatch("GET_POPULAR_THEME",{page:1})
        },
        methods :{

        }
    }
</script>

<style media="screen">
img{
 height: auto;
 max-width: 350px;
}
</style>
