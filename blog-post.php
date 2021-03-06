<?php

  ini_set( 'display_errors', 1 );
  ini_set( 'display_startup_errors', 1 );
  error_reporting( E_ALL );
  include './includes/Blogposts.Class.php';
  
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blogpost Page</title>

</head>
<body>
  <h1>Blogposts</h1>
  <?php include './includes/navigation.php'; ?>
  <?php
    $myblogs = new Blogs( dirname( __FILE__ ) . '/data/articles.json');
   
    $myblogs->output();
  ?>
  <h2>Display Article by ID</h2>
  <p>This article with id:<?php $id ?> is:</p>
  <?php
    $myblogs->findblogByIndex( 10 );
  ?>
</body>
</html>