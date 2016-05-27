<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>LucasMotto.cl</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,700italic,600' rel='stylesheet' type='text/css'>
		<?= $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon')); ?>
		<?= $this->Html->css(array(
			'bootstrap.min', 'font-awesome.min', 'template', 'responsive'
		)); ?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<?= $this->Html->scriptBlock(sprintf("var webroot = '%s';", $this->webroot)); ?>
		<?= $this->Html->scriptBlock(sprintf("var fullwebroot = '%s';", $this->Html->url('/', true))); ?>
		<?= $this->Html->script(array(
			'jquery-1.11.3.min', 'bootstrap.min' , 'admin_productos' , 'core-utils.js'
		)); ?>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<?= $this->fetch('meta'); ?>
		<?= $this->fetch('css'); ?>
		<?= $this->fetch('script'); ?>
	</head>
	<body>

		<?= $this->element('/template/header'); ?>

		<div id="content-page">
			<?= $this->fetch('content'); ?>
		</div>
		
		<?= $this->element('/template/footer'); ?>

	</body>
</html>
