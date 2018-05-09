<template>
  <section class="section">
    <div class="container">

        <div class="columns is-multiline is-centered">
          <div class="column is-8">
            <form class="" id="createForm">
              <div class="field" v-if="errors.length">
                <b>以下の部分についてフォームを確認してください：</b>
                <ul>
                  <li v-for="error in errors"> {{ error }} </li>
                </ul>
              </div>
              <div class="field">
                <div class="control">
                  <label for="title" class="label">作品名</label>
                  <input type="input" class="input" id="title" name="title" v-model="title" placeholder="作品名" value="" required />
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <label for="character" class="label">キャラ</label>
                  <input type="input" name="character" id="character" class="input" value="" placeholder="「,」区切りで3キャラまで" required v-model="character"/>
                  <div class="control tags">
                    <span class="tag is-info" v-for="tag in characterList"> {{ tag }} </span>
                  </div>
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <label for="seen" class="label">シチュエーション</label>
                  <textarea type="textarea" name="seen" id="seen" class="textarea" v-model="seen" value="" placeholder="シチュや設定など" />
                </div>
              </div>
              <div class="field">
                <div class="control has-text-centered">
                  <hr class="mb-4">
                  <button type="button" name="createTheme" id="createTheme" class="button is-success is-fullwidth is-medium" v-on:click="upload"><strong>作成する</strong></button>
                </div>
              </div>
            </form>
          </div>

        </div>
    </div>
  </section>

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
