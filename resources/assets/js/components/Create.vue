<template>
  <div>
    <h4>
      お題の作成
    </h4>

    <form class="" action="index.html" method="post">
      <div class="row">
          <label for="title">作品名</label>
          <input type="text" class="form-control" id="title" placeholder="" value="" required />
      </div>
      <div class="row">
        <label for="charctar">キャラ</label>
        <input type="text" name="charctar" class="form-control" value="" placeholder="" required />
      </div>
      <div class="row">
        <label for="seen">シチュエーション</label>
        <input type="textarea" name="seen" class="form-control" value="" placeholder="" />
      </div>
      <div>
          <hr class="mb-4">
          <button type="submit" name="createTheme" class="btn btn-primary btn-lg btn-block">お題を作る</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
    name: 'Create',
    data() {
        return
          "OK"
        ;
    },
    mounted() {
        console.log('Create mounted.')
    }
}
</script>
