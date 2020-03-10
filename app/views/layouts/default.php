<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= PROJECT_ROOT?>css/bootstrap/bootstrap.min.css" crossorigin="anonymous">

    <title><?= $this->setSiteTitle('pogi gil'); ?></title>
    <?php $this->content('head') ?>
  </head>
  <body>
    <?= $this->content('body') ?>
    <h1>Hello, world!</h1>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?=PROJECT_ROOT?>js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="<?=PROJECT_ROOT ?>js/bootstrap/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>