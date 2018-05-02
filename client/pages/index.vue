<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Primary title
                    </h1>
                    <h2 class="subtitle">
                        Primary subtitle
                    </h2>
                </div>
            </div>
        </section>
        <div id="themeList">
            <div class="columns is-multiline is-mobile">
                <div v-for="theme in themeContents" class="column is-one-quarter">
                    <vue-item :data="theme"></vue-item>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //Vue.component('vue-item', Item)
    import axios from "axios"
    import VueItem from "../components/Item.vue"

    export default {
        layout:"base",
        name: 'Content',
        data: function() {
            return {
                themeContents : [],
            };
        },
        //キャメルケースで登録して使うときはスネークケースらしい
        components :{
            VueItem
        },
        mounted() {
            axios.get(process.env.apiUrl + "/api/theme/recent")
                .then((responce) => {
                    //respons Dataの加工 本当ならどこかに切り出したい。
                    responce.data.data.forEach(function(i){
                        i["thumb_url"] = process.env.apiUrl + '/theme_img/' + i.id + '.jpg'
                    });
                    this.themeContents = responce.data.data;
                    console.log(responce);
                }).catch((error) => {
                console.log(error);
            });

            console.log('Component mounted.')
        }
    }
</script>

