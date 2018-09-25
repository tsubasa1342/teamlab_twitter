<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <title>
      <?= $this->fetch('title') ?>
  </title>
  <?= $this->Html->css('styles.css') ?>
  <?= $this->Html->script('http://code.jquery.com/jquery.min.js'); ?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <?= $this->html->meta('icon'); ?>

</head>
<body>
  <?= $this->element('header'); ?>
  <?= $this->Flash->render(); ?>
  <div class="container">
      <?= $this->fetch('content') ?>
  </div>
</body>
</html>
