<template>
  <div>
    <h4>
      お題の作成
    </h4>

    <form class="" id="createForm">
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
      <div class="row tags">
        <span class="tag is-info" v-for="tag in characterList"> {{ tag }} </span>
      </div>
      <div class="row">
        <label for="seen">シチュエーション</label>
        <input type="textarea" name="seen" id="seen" class="form-control" v-model="seen" value="" placeholder="" />
      </div>
      <div>
        <hr class="mb-4">
        <button type="button" name="createTheme" id="createTheme" class="btn btn-primary btn-lg btn-block" v-on:click="upload">お題を作る</button>
      </div>
    </form>
  </div>
</template>

<script>
    import axios from "axios";

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
            upload(){
                let formData = new FormData();

                formData.append('character_text',this.character);
                formData.append('product',this.title);
                formData.append('scene',this.seen);

                axios.post(process.env.apiUrl + '/api/theme/add', formData)
                   .then((response) => {
                        console.log(response);
                        this.$router.push("/");
                   })
                   .catch((error) => {
                        console.log(error);
                   });

            },
        },
        mounted() {
            console.log('Create mounted.')
        }
    }
</script>
