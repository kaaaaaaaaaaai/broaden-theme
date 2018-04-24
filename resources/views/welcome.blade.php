<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>broaden-theme</title>
    <link rel="stylesheet" href="css/app.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div id="app">
</div>

<script type="text/x-template" id="contentText">
  <div  v-for="theme in themeList">
    <div class="card mb-4 box-shadow">
            title
            <div class="card-body">
              <p class="card-text">charctor</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">tweet</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">count</small>
              </div>
            </div>
            </div>
  </div>
</script>

<script src="js/app.js"></script>
</body>
</html>
