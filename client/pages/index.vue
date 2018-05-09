<template>
    <div class="section">
        <div class="container">
            <h1 class="title">Trending</h1>
            <div id="themeList">
                <div class="columns is-multiline is-mobile is-centered">
                    <div v-for="theme in themeContents" class="column is-3">
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
            this.$axios.$get("api/theme/recent")
                .then((response) => {
                    //respons Dataの加工 本当ならどこかに切り出したい。
                    response.data.forEach(function(i){
                        i["thumb_url"] = process.env.apiUrl + '/theme_img/' + i.id + '.jpg'
                    });
                    this.themeContents = response.data;
                    console.log(response);
                }).catch((error) => {
                console.log(error);
            });

            console.log('Component mounted.')
        }
    }
</script>

