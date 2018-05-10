<template>
    <div class="imageContainer" @click="isCardModalActive = true">
      <figure class="image is-2by1">
        <img class="imageContainer__image--round" :src="data.thumb_url" :alt="data.title">
      </figure>
      <b-modal :active.sync="isCardModalActive" has-modal-card>
              <modal></modal>
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
    import Modal from "../components/Modal.vue"
    export default {
        name: "Item",
        props: ["data"],
        data: function() {
            return {
                isCardModalActive: false
            }
        },
        components :{
            Modal
        },
        methods: {
            //投票apiに接続する
            vote: function(event){
                this.$store.dispatch("POST_VOTE_BY_ID", {id:this.data.id})
            },
        },
        //残り時間を分単位で算出する
        mounted() {
        },
    }
</script>
