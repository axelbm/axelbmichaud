<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		
		<title><?= $titre ?></title>

		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

		<link href="/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
		
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix-core.js"></script>

		<link rel="shortcut icon" href="<?=PUBLICROOT?>favicon.png"/>
		
		<?php foreach($vue->getScripts() as $fichier): ?>
			<script src="<?=$fichier?>"></script>
		<?php endforeach; ?>

		<?php foreach($vue->getStyles() as $fichier): ?>
			<link rel="stylesheet" href="<?=$fichier?>">
		<?php endforeach; ?>

		<script>
			<?php foreach($vue->getJSVars() as $key => $value): ?>
				var <?=$key?> = <?=json_encode($value)?>;
			<?php endforeach; ?>
		</script>
	</head>

	<body>
		<?php $notification = \app\outils\Notification::getPopupInfo(); ?>
		<?php if (isset($notification)): ?>
			<?php require "morceaux/popup.php"; ?>
		<?php endif ?>

		<div id="container">
			<?php//require "morceaux/header.php"; ?>
			<?php require "morceaux/navbar.php"; ?>
			
			<div id="content" class="container">
				<?= $contenue ?>
			</div>

			<?php require "morceaux/footer.php"; ?>
		</div>
	</body>
</html>



