<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Millipede</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{ stylesheet_link('css/style.css') }}
</head>
<body>

<div class="alert alert-info hidden">{{ flash.output() }}</div>

{{ content() }}

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</body>
</html>