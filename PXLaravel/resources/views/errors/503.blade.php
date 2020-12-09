<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>We Will Back Soon</title>
  <link rel="stylesheet" href="countdown/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
    <image width="50%" src="frontend/image/logo.png"></image>
    <h1>We Will Back Soon</h1>
    <h1>{!! $exception->getMessage() !!}</h1>
    <ul>
        <li><span id="days"></span>days</li>
        <li><span id="hours"></span>Hours</li>
        <li><span id="minutes"></span>Minutes</li>
        <li><span id="seconds"></span>Seconds</li>
    </ul>
</div>
<!-- partial -->
  <script  src="countdown/script.js"></script>

</body>
</html>
