<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">{{detailTheme.scene}}</h1>
                    <h2 class="subtitle">
                        {{detailTheme.character_text}}
                    </h2>
                </div>
            </div>
        </section>
        <div class="notification is-info is-hidden-tablet">
            <button class="delete"></button>
            画像の投稿はPCからできます。
        </div>

        <div class="section">
            <div class="container">
                <h1 class="title">一覧</h1>
                <div>
                    <div class="columns is-multiline is-mobile is-centered">
                        <div class="column is-3-mobile is-paddingless is-3-tablet is-hidden-mobile" @dragleave.prevent @dragover.prevent @drop.prevent="onDrop">
                            <figure class="image" >
                                <img src="/images/draganddrop.png">
                            </figure>
                        </div>
                        <div v-for="image in detailTheme.images" class="column is-paddingless is-3-desktop is-3-tablet is-4-mobile">
                                <img :src="image.thumb_url" class="image" @click="openDetailModal(image.thumb_url)" style='    width:auto;height:auto;max-width:100%;max-height:8em;'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <b-modal :active.sync="isDetailImageModalActive" :width="640" scroll="keep">
            <div class="box">
                <div class="card">
                    <div class="card-image">
                        <figure class="image">
                            <img :src="detailUrl" alt="Placeholder image">
                        </figure>
                    </div>
                </div>
            </div>
        </b-modal>
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
              uploadFile: null,
              isDetailImageModalActive:false,
              detailUrl:null
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
            },
            openDetailModal(image_url){
                this.detailUrl = image_url;
                this.isDetailImageModalActive = true;
            }
        },
    }
</script>

<style scoped>

</style>