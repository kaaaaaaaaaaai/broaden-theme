<template>
    <div class="imageContainer">
      <figure class="image is-2by1" @click="isCardModalActive = true">
        <img class="imageContainer__image--round" :src="data.thumb_url" :alt="data.title">
      </figure>
      <b-modal :active.sync="isCardModalActive" :width="640" scroll="keep" :onCancel="onCancel">
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
                <span><button class="button is-primary" @click= "vote"><b-icon icon="volume-high"></b-icon><span>投票する</span></button></span>
              </p>
              <p class="card-footer-item">
                <span>残り:{{data.diffInMinutes}}</span>
              </p>
            </footer>
        </div>
      </b-modal>
    </div>
</template>

<style scoped>
  .imageContainer{
    box-shadow: 7px 10px 7px 0px rgba(10,10,10,.2);
    border-radius: 5px;
  }
  .imageContainer__image--round{
    border-radius: 5px;
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
        },
    }
</script>
