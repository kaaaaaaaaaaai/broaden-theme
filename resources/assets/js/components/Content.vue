<template>
  <div>
    <div>
      aaaaaa
    </div>
    <div>
      <content></content>
    </div>
  </div>
</template>

<script>
    export default {
        name: 'Content',
        data() {
            return {
                text: 'eeeeeeee'
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
