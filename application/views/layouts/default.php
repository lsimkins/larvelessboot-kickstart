<?php Asset::container('header')->add('bootstrap-less', 'libraries/bootstrap/less/bootstrap.less', 'less', array('rel' => 'stylesheet/less'))?>
<?php Asset::container('header')->add('bootstrap-responsive', 'libraries/bootstrap/less/responsive.less', 'less', array('rel' => 'stylesheet/less')) ?>

<?php Asset::container('footer')->add('less', 'libraries/less.min.js') ?>
<?php Asset::container('footer')->add('jquery', 'libraries/jquery.js'); ?>
<?php Asset::container('footer')->add('bootstrap-js', 'libraries/bootstrap/js/bootstrap.min.js'); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Laravel Bootstrap Project</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta charset="utf-8">
		
		<?php echo Asset::container('header')->styles(); ?>
		<?php echo Asset::styles(); ?>
		
		<?php echo Asset::container('header')->scripts(); ?>
	</head>
	
	<body>
		<div class="container">
			<?php echo $content ?>
		</div>
		
		<?php echo Asset::container('footer')->scripts(); ?>
		<?php echo Asset::scripts(); ?>
	</body>
</html>
