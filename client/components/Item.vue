<template>
  <div class="card" @click="isCardModalActive = true">
    <div v-show="isExist">
      <img class="card-img-top" :src="data.thumb_url" :alt="data.title">
      <div class="card-body">
        <button type="button" name="button" class="btn btn-primary btn-block"
                v-bind:class="{'disabled': isSending}"
                v-on:click="vote">投票</button>
        <p>投票数 {{ data.vote }} </p>
        <p>
          残り<strong v-bind:class="{'text-success':isNormal,'text-warning':isWarning,'text-danger': isDanger}">{{ data.diffInMinutes }}</strong>min
        </p>
      </div>
    </div>
    <b-modal :active.sync="isCardModalActive" has-modal-card>
            <modal></modal>
    </b-modal>
  </div>
</template>

<script>
    import axios from 'axios';
    import Modal from "../components/Modal.vue"
    export default {
        name: "Item",
        props: ["data"],
        data: function() {
            return {
                isExist:    true,
                isNormal:   true,
                isWarning:  false,
                isDanger:   false,
                isSending:  false,
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
            chengeLimitColor(time) {
                if(time < 60){
                    this.isNormal = false;
                    this.isAlert  = false;
                    this.isDanger = true;
                }else if(time < 3300){
                    this.isNormal = false;
                    this.isAlert  = true;
                }
            }
        },
        //残り時間を分単位で算出する
        mounted() {
            // const now = new Date();
            // const closeTimeSorce = this.data.close_time.replace(/\-/g,'/');
            // const target = new Date(closeTimeSorce);
            // const diff = (target.getTime() - now.getTime())/(1000 * 60);
            //
            // //四捨五入で代入
            // this.data.close_time = Math.round(diff);
            //
            // const timer = setInterval(() => {
            //     this.data.close_time--;
            //     console.log(this.data.close_time);
            //
            //     this.chengeLimitColor(this.data.close_time);
            //
            //     if(this.data.close_time == 0){
            //         clearInterval(timer);
            //         this.isExist = false;
            //         console.log("end this theme");
            //     }
            // },6000);
            //timeによって色を変える
        },
    }
</script>
