<template>
    <div>
        <p>
            <router-link to="/create">新規作成</router-link>
        </p>
        <div class="container">
          <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Start"
    }
</script>
