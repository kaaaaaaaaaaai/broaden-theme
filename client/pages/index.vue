<template>
    <div>
        <div id="themeList">
            <div class="card-group">
                <div v-for="theme in themeContents" class="card col-md-3">
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

