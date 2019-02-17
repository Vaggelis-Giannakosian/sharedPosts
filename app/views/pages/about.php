<?php require APROOT.'/views/inc/header.php'; ?>

<h1><?php echo $data['title']; ?></h1>
<?php //echo APROOT; ?>
<p><?php echo $data['description']; ?></p>
<p>Version: <strong><?php echo APPVERSION; ?></strong></p>
<?php require APROOT.'/views/inc/footer.php';?>
