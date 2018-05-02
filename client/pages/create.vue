<template>
  <div>
    <h4>
      お題の作成
    </h4>

    <form class="" id="createForm" @submit="checkForm" action="/api/theme/add" method="post">
      <div class="row" v-if="errors.length">
        <b>以下の部分についてフォームを確認してください：</b>
        <ul>
          <li v-for="error in errors"> {{ error }} </li>
        </ul>
      </div>
      <div class="row">
        <label for="title">作品名</label>
        <input type="text" class="form-control" id="title" name="title" v-model="title" placeholder="" value="" required />
      </div>
      <div class="row">
        <label for="character">キャラ</label>
        <input type="text" name="character" id="character" class="form-control" value="" placeholder="" required v-model="character"/>
      </div>
      <div class="row">
        <label for="seen">シチュエーション</label>
        <input type="textarea" name="seen" id="seen" class="form-control" v-model="seen" value="" placeholder="" />
      </div>
      <div>
        <hr class="mb-4">
        <button type="submit" name="createTheme" id="createTheme" class="btn btn-primary btn-lg btn-block">お題を作る</button>
      </div>
    </form>
  </div>
</template>

<script>
    export default {
        layout:"base",
        name: 'Create',
        data() {
            return{
                errors      : [],
                title       : null,
                character    : "",
                characterList: [],
                seen        : null,
            };
        },
        watch:{
          character:function(val){
              console.log(val);
              console.log(this.character);
              this.characterList = val.split(",");

              if(Object.keys(this.characterList).length > 3){
                  this.errors = [];
                  this.errors.push("キャラ名は３つまでにしてください");
              }
          }
        },
        //フォームのバリデーションチェック
        methods:{
            checkForm:(e) => {
                this.errors = [];

                if(!this.title){
                    this.errors.push("作品名は必要です");
                    e.preventDefault();
                }

                if(!this.character){
                    this.errors.push("キャラは最低一人以上必要です");
                    e.preventDefault();
                }

                if(!Object.keys(this.errors).length){
                    console.log("no matter");
                    return true;
                }
            },
        },
        mounted() {
            console.log('Create mounted.')
        }
    }
</script>
