<template>
  <div>
    <img class="card-img-top" :src="data.picture" :alt="data.title">
    <div class="card-body">
      <a href="#" class="btn btn-primary">投票</a>
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
        }
    }
</script>