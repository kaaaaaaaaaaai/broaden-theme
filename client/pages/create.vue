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
        <input type="text" class="form-control" id="title" name="title" v-model="title" placeholder="" value="" required @mouseover="createCharctarList" />
      </div>
      <div class="row">
        <label for="charctar">キャラ</label>
        <input type="text" name="charctar" id="charctar" class="form-control" v-model="charctar" value="" placeholder="" required />
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
                charctar    : null,
                charctarList: [],
                seen        : null,
            };
        },
        //フォームのバリデーションチェック
        methods:{
            checkForm:(e) => {
                this.errors = [];

                if(!this.title){
                    this.errors.push("作品名は必要です");
                    e.preventDefault();
                }

                if(!this.charctar){
                    this.errors.push("キャラは最低一人以上必要です");
                    e.preventDefault();
                }

                if(!Object.keys(this.errors).length){
                    console.log("no matter");
                    return true;
                }
            },
            createCharctarList:(e) => {
                this.charctarList = this.charctar.split(",");

                if(Object.keys(this.charctarList).length > 3){
                    this.errors = [];
                    this.errors.push("キャラ名は３つまでにしてください");
                }


            }
        },
        mounted() {
            console.log('Create mounted.')
        }
    }
</script>
