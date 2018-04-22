<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Hello Vue</title>
    <link rel="stylesheet" href="css/app.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div id="app">
    <router-link to="/top">トップページ</router-link>
    <router-link to="/users">ユーザー一覧ページ</router-link>
    <router-view></router-view>
</div>

<script src="js/app.js"></script>
</body>
</html>