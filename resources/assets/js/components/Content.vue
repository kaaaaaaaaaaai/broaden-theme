<template>
  <div>
    <div id="themeList">
      <div class="card-group">
        <div v-for="theme in themeContents" class="card col-md-3">
          <img class="card-img-top" :src="theme.picture" :alt="theme.title">
          <div class="card-body">
            <a href="#" class="btn btn-primary">投票</a>
            {{ theme.time }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        name: 'Content',
        data() {
            return {
              themeContents:[
                {title:'sample',picture:'/sample'+'1'+'.jpg',time:'90'+"sec"},
                {title:'sample2',picture:'/sample'+'1'+'.jpg',time:'90'+"sec"},
                {title:'sample3',picture:'/sample'+'1'+'.jpg',time:'90'+"sec"},
                {title:'sample4',picture:'/sample'+'1'+'.jpg',time:'90'+"sec"}
              ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
