<!DOCTYPE html>
<!--[if IE 9]>
<html lang="tr" class="ie9"> <![endif]-->
<!--[if gt IE 9]>
<html lang="tr" class="ie"> <![endif]-->
<!--[if !IE]><!-->
<html dir="ltr" lang="tr">
<!--<![endif]-->
<head>
  <?php $this->load->view("includes/head") ?>
</head>

<!-- body classes:  -->
<!-- "boxed": boxed layout mode e.g. <body class="boxed"> -->
<!-- "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> -->
<!-- "transparent-header": makes the header transparent and pulls the banner to top -->
<!-- "gradient-background-header": applies gradient background to header -->
<!-- "page-loader-1 ... page-loader-6": add a page loader to the page (more info @components-page-loaders.html) -->
<body class="no-trans front-page transparent-header  page-loader-5">

<!-- scrollToTop -->
<!-- ================ -->
<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

<!-- page wrapper start -->
<!-- ================ -->
<div class="page-wrapper">

  <?php $this->load->view("includes/header") ?>

  <!-- main content -->


  <?php $this->load->view("includes/footer") ?>

</div>

<?php $this->load->view("includes/include_script") ?>
</body>

</html>