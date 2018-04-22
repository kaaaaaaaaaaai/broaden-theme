<template>
    <div>
        <p>
            <router-link to="/top">トップページ</router-link>
            <router-link to="/users">ユーザー一覧ページ</router-link>
        </p>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "Start"
    }
</script>
