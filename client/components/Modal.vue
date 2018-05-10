<template>
<<<<<<< HEAD
  <div class="">
    <section>
=======
      <b-modal  :width="640" scroll="keep" @close="onChange">
>>>>>>> c9b83b38637ecf3abfcb38c7be63474d3c542ae0
           <div class="card">
               <div class="card-content">
                   <div class="media">
                       <div class="media-left">
                       </div>
                       <div class="media-content">
                           <p class="title is-4">John Smith</p>
                           <p class="subtitle is-6">@johnsmith</p>
                       </div>
                   </div>

                   <div class="content">
                       Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                       Phasellus nec iaculis mauris. <a>@bulmaio</a>.
                       <a>#css</a> <a>#responsive</a>
                       <br>
                       <small>11:09 PM - 1 Jan 2016</small>
                   </div>
               </div>
           </div>
       </b-modal>
</template>

<script>
    export default {
        name: "Modal",
        props:["isCardModalActive"],

        methods:{
            onChange(e){
                console.log("close")
                //this.isCardModalActive = false
                this.$emit("update", true)
            },
        }
    }
</script>
