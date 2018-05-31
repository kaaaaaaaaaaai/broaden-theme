<template>
    <div>
        <section class="hero">
            <div class="hero-body">
                <div class="container has-text-centered">
                  <figure class="">
                      <img src="../static/images/hero-img.jpg" width="450" height="120"></img>
                  </figure>
                </div>
            </div>
        </section>
        <div class="container is-fluid">

        <div class="section">
            <div class="container">
                <h1 class="title">人気のお題</h1>
                <div id="themeList">
                    <div class="columns is-multiline is-mobile is-centered">
                        <div v-for="theme in popularContents" class="column is-6-mobile is-3-desktop is-3-tablet">
                            <vue-item :data="theme"></vue-item>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <h1 class="title">新しいお題</h1>
                <div>
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
                contentInfo : []
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
