<?php
use Core\Session;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= PROJECT_ROOT?>css/bootstrap/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= PROJECT_ROOT?>css/custom.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="<?=PROJECT_ROOT ?>js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="<?=PROJECT_ROOT ?>js/sample.js"></script>

    <title><?= $this->setTitle(); ?></title>
    <?php $this->content('head') ?>
  </head>
  <body>
    <?php include 'main_menu.php' ?>
    <div class="container-fluid" style="min-height:cal(100% - 125px)">
          <?= Session::displayMsg()?>
          <?= $this->content('body') ?>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="<?=PROJECT_ROOT ?>js/bootstrap/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>