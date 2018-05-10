<template>
    <div class="imageContainer">
      <figure class="image is-2by1" @click="isCardModalActive = true">
        <img class="imageContainer__image--round" :src="data.thumb_url" :alt="data.title">
      </figure>
      <b-modal :active.sync="isCardModalActive" :width="640" scroll="keep">
        <div class="content">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Phasellus nec iaculis mauris. <a>@bulmaio</a>.
          <a>#css</a> <a>#responsive</a>
          <br>
          <small>11:09 PM - 1 Jan 2016</small>
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
            },
        },
    }
</script>
