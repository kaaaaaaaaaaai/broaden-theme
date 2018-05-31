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
                  <label for="summary" class="label">お題 ※必須</label>
                  <textarea type="textarea" class="textarea" id="summary" name="summary" v-model="title" placeholder="お題" value="" required />
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <label for="detail" class="label">詳細</label>
                  <textarea type="textarea" name="detail" id="detail" class="textarea" value="" placeholder="シチュエーションなどの詳細情報" />
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
                summary       : null,
                detail      : null,
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

                formData.append('detail',this.character);
                formData.append('summary',this.title);

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
