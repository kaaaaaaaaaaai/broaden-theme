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
    <example-component></example-component>
</div>
<script src="js/app.js"></script>
</body>
</html>