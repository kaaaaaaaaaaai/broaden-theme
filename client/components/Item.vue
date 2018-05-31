<template>
    <div class="imageContainer card">
        <div class="card-image">
          <figure class="image is-2by1" @click="isCardModalActive = true">
            <img :src="data.thumb_url" :alt="data.title">
          </figure>
        </div>
      <b-modal :active.sync="isCardModalActive" :width="640" scroll="keep">
        <div class="card">
            <header class="card-header">
            <p class="card-header-title">
              テーマ
            </p>
            <p class="card-header-icon">
              <span><b-icon icon="account-multiple" type="is-info"></b-icon> + {{data.vote}}</span>
            </p>
            </header>
            <div class="card-content">
                <div class="content">
                  <p>  {{ data.scene }} </p>
                </div>
            </div>
            <footer class="card-footer">
              <p class="card-footer-item">
                    <button class="button is-primary" @click= "vote"><b-icon icon="volume-high"></b-icon><span>応援する</span></button>
                    <b-tooltip
                            label="お題を応援することによって残り時間を延長できます。お題の絵を書いてくれる人が増えるカモ!?"
                            position="is-top"
                            size="is-large"
                            multilined>
                            <b-icon
                                    icon="info-circle"
                                    size="is-medium">
                            </b-icon>
                    </b-tooltip>
              </p>
              <p class="card-footer-item">
                <span>残り:{{data.diffInMinutes}}分</span>
              </p>
                <p class="card-footer-item">
                    <nuxt-link :to="{name:'theme-id', params:{id:data.id}}">
                    <button class="button is-primary"><span>投稿画像へ</span></button>
                    </nuxt-link>
                </p>
            </footer>
        </div>
      </b-modal>
    </div>
</template>

<style scoped>
  .imageContainer{
    /*box-shadow: 7px 10px 7px 0px rgba(10,10,10,.2);*/
    border-radius: 10px;
    overflow: hidden;
  }
  .imageContainer__image--round{
    border-radius: 5px;
  }
  .imageContainer__image--round:hover{
      transform: scale(1.05);
      transition: 0.3s;
  }
</style>

<script>
    import axios from 'axios';
    export default {
        name: "Item",
        props: ["data"],
        data() {
            return {
                isCardModalActive: false
            }
        },
        components :{
        },
        methods: {
            //投票apiに接続する
            vote: function(event){
                this.$store.dispatch("POST_VOTE_BY_ID", {id:this.data.id})
                console.log("voted");
            },
            onCancel(data){
                this.isCardModalActive = !this.isCardModalActive
                this.$emit('close')
            }
        },
    }
</script>
