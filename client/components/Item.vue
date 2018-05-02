<template>
  <div v-show="isExist">
    <img class="card-img-top" :src="'http://localhost:8000/theme_img/'+data.id+'.jpg'" :alt="data.title">
    <div class="card-body">
      <button type="button" name="button" class="btn btn-primary btn-block"
              v-bind:class="{'disabled': isSending}"
              v-on:click="vote">投票</button>
      <p>投票数 {{ data.vote }} </p>
      <p>
        残り<strong v-bind:class="{'text-success':isNormal,'text-warning':isWarning,'text-danger': isDanger}">{{ data.close_time }}</strong>min
      </p>
    </div>
  </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Item",
        props: ["data"],
        data:() => {
            return{
                isExist:    true,
                isNormal:   true,
                isWarning:  false,
                isDanger:   false,
                isSending:  false
            }
        },
        mounted() {
            // props で受け取ったら自分のデータと同じように this で使用できるようになる
            console.log(this.data)
        },
        methods: {
            //投票apiに接続する
            vote: function(event){
                axios.post(process.env.apiUrl+`/api/theme/vote/${this.data.id}`,{
                    transformResponse: [() =>{
                        this.isSending = true;
                    }]
                })
                    .then((responce) => {
                        console.log(responce);
                        alert("投票しました");
                        this.isSending = false;
                    }).catch((error) => {
                    console.log(error);
                });
            },
        },
        //残り時間を分単位で算出する
        created: function() {
            const now = new Date();
            const closeTimeSorce = this.data.close_time.replace(/\-/g,'/');
            const target = new Date(closeTimeSorce);
            const diff = (target.getTime() - now.getTime())/(1000 * 60);

            //四捨五入で代入
            this.data.close_time = Math.round(diff);

            const timer = setInterval(() => {
                this.data.close_time--;
                console.log(this.data.close_time);

                chengeLimitColor(this.data.close_time);

                if(this.data.close_time == 0){
                    clearInterval(timer);
                    this.isExist = false;
                    console.log("end this theme");
                }
            },60000);
        },
        //timeによって色を変える
        chengeLimitColor:(time) => {
            if(time < 60){
                this.isNormal = false;
                this.isAlert  = false;
                this.isDanger = true;
            }else if(time < 300){
                this.isNormal = false;
                this.isAlert  = true;
            }
        }
    }
</script>
