<template>
    <div class="section">
        <div class="container">
            <h1 class="title">Trending</h1>
            <div id="themeList">
                <div class="columns is-multiline is-mobile is-centered">
                    <div v-for="theme in popularContents" class="column is-3">
                        <vue-item :data="theme"></vue-item>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h1 class="title">Newest</h1>
            <div>
                <div class="columns is-multiline is-mobile is-centered">
                    <div v-for="theme in Contents" class="column is-3">
                        <vue-item :data="theme"></vue-item>
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
