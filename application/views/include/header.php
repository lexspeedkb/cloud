<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?$v = 5?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/main.css?v=<?=$v?>">
    <script src="/assets/js/jquery.uploadifive.js?v=<?=$v?>" type="text/javascript"></script>

    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>
<div id="preloader"></div>
<body>
    <input type="hidden" id="PARAMS_Domain" value="<?=$_SERVER['HTTP_HOST']?>">
    <div class="wheel-load">