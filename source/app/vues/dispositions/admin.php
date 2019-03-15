<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		
		<title><?= $titre ?></title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
		
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

	<body class="bg-light">
		<?php require "admin/navbar.php"; ?>

		<div id="container" class="container">
			<div class="row">
				<div class="col-md-3">
					<?php require "admin/sidenav.php"; ?>
				</div>
				
				<div id="content" class="card col-md-9">
					<div class="card-body">
						<?= $contenue ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>


