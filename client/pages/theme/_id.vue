<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">{{detailTheme.scene}}</h1>
                    <h1 class="title">{{detailTheme.id}}</h1>
                    <h2 class="subtitle">
                        お題を投稿しましょう！
                    </h2>
                </div>
            </div>
        </section>
        <div class="section">
            <div class="container">
                <h1 class="title">Newest</h1>
                <div>
                    <div class="columns is-multiline is-mobile is-centered">
                        <div v-for="image in detailTheme.images" class="column is-4">
                            <article class="tile is-child notification is-info">
                                <figure class="image is-4by3">
                                    <img :src="getThumbnail(image.filename)">
                                </figure>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile">
            <div class="tile is-ancestor is-2">
                <!--<div class="tile  is-vertical is-3">-->
                    <!--<div class="tile is-parent">-->
                        <!--<article class="tile is-child notification is-info" @dragleave.prevent @dragover.prevent @drop.prevent="onDrop">-->
                            <!--<p class="title">Middle tile</p>-->
                            <!--<p class="subtitle">With an image</p>-->
                            <!--<figure class="image is-4by3">-->
                                <!--<img src="/images/draganddrop.png">-->
                            <!--</figure>-->
                        <!--</article>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="tile is-parent" v-for="image in detailTheme.images">-->
                    <!--<article class="tile is-child notification is-info">-->
                        <!--<p class="title">{{image.filename}}</p>-->
                        <!--<p class="subtitle">With an image</p>-->
                        <!--<figure class="image is-4by3">-->
                            <!--<img src="https://bulma.io/images/placeholders/640x480.png">-->
                        <!--</figure>-->
                    <!--</article>-->
                <!--</div>-->
            </div>
        </div>
        <b-modal :active.sync="isCardModalActive" :width="640" scroll="keep">
            <div class="box">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img :src="dataUrl" alt="Placeholder image">
                        </figure>
                    </div>
                    <footer class="card-footer">
                        <a href="#" class="card-footer-item" @click="upload">投稿する</a>
                    </footer>
                </div>
            </div>
        </b-modal>

    </div>
</template>

<script>
    import { mapState } from 'vuex'
    export default {
        name: "_id",
        layout:"base",
        data(){
          return {
              isCardModalActive:false,
              dataUrl:"でもこれ？",
              uploadFile: null
          }
        },
        computed:{
            ...mapState([
                "detailTheme"
            ])
        },
        async asyncData({ store, params, error }){
            await store.dispatch("GET_DETAIL_THEME",{id: params.id}).catch(()=>{
                error({ statusCode: 404, message: 'Post not found' });
            })
        },
        methods:{
            getThumbnail($piece){
                return process.env.FRONT_API_URL + "/" + $piece
            },
            //inputタグとドラッグ&ドロップから呼ばれる
            onDrop:function(event){
                let fileList = event.target.files ?
                    event.target.files:
                    event.dataTransfer.files;
                var reader = new FileReader();

                this.isCardModalActive = true;
                this.uploadFile = fileList[0];
                //dataURL形式でファイルを読み込む
                reader.readAsDataURL(fileList[0]);

                //ファイルの読込が終了した時の処理
                reader.onload = (e) => {
                    console.log(this.dataUrl);
                    this.dataUrl =  reader.result;
                };
            },
            upload:function(){
                const formData = new FormData();
                formData.append('file', this.uploadFile);
                this.$store.dispatch("UPLOAD_IMAGE_OF_THEME",{themeId: this.detailTheme.id, data:formData})
            }
        },
    }
</script>

<style scoped>

</style>