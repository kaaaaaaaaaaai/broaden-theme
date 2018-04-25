<template>
  <div>
    <img class="card-img-top" :src="data.picture" :alt="data.title">
    <div class="card-body">
      <button type="button" name="button" class="btn btn-primary btn-block" v-on:click="vote">投票</button>
      {{ data.time }}
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
              .then(function(responce){
                console.log(responce);
                alert("投票しました");
              }).catch(function(error){
                console.log(error);
              });
          }
        }
    }
</script>
