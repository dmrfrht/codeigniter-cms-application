<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view("includes/head") ?>
  <?php $this->load->view("{$viewFolder}/{$subViewFolder}/page_style") ?>
</head>

<body class="simple-page">

<?php $this->load->view("{$viewFolder}/{$subViewFolder}/content") ?>

<?php $this->load->view("{$viewFolder}/{$subViewFolder}/page_script") ?>

</body>
</html>