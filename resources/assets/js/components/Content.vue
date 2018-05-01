<template>
  <div>
    <div id="themeList">
      <div class="card-group">
        <div v-for="theme in themeContents" class="card col-md-3">
          <vue-item :data="theme"></vue-item>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        name: 'Content',
        data: function() {
          return {
            themeContents : [],
          };
        },
        mounted() {
          axios.get("/api/theme/recent")
            .then((responce) => {
              this.themeContents = responce.data.data;
              console.log(responce);
            }).catch((error) => {
              console.log(error);
            });

            console.log('Component mounted.')
        }
    }
</script>
