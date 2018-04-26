<template>
  <div>
    <img class="card-img-top" :src="'/theme_img/'+data.id+'.jpg'" :alt="data.title">
    <div class="card-body">
      <button type="button" name="button" class="btn btn-primary btn-block" v-on:click="vote">投票</button>
      <p></p>{{ data.close_time }}
    </div>
  </div>
</template>

<script>
    export default {
        name: "Item",
        props: ["data"],
        mounted() {
            // props で受け取ったら自分のデータと同じように this で使用できるようになる
            console.log(this.data)
        },
        methods: {
          vote: function(event){
            axios.get("")
              .then((responce) => {
                console.log(responce);
                alert("投票しました");
              }).catch((error) => {
                console.log(error);
              });
          }
        },
        created: function() {
            const now = new Date();
            const closeTimeSorce = this.data.close_time.replace(/\-/g,'/');
            const target = new Date(closeTimeSorce);
            const diff = (now.getTime() - target.getTime())/(1000*60)

            this.data.close_time = diff;

            setInterval(() => {
                this.data.close_time--;
                console.log(this.data.close_time);
            },60000);
        }
    }
</script>
