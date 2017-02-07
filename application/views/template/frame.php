<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $_title?> | Template</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <?php 
    if (!empty($_styles)) {
        echo $_styles;
    }
  ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php echo $_header; ?>
  <?php echo $_sidebar; ?>
  <?php echo $_content; ?>
  <?php echo $_footer; ?>

</div>

<?php 
  if (!empty($_scripts)) {
    echo $_scripts;
  }
?>

</body>
</html>
