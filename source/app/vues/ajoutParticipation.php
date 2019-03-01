<div class="bg-light col-lg-4 mx-auto mt-4 py-4 rounded shadow-lg" id="register-box">
    <h2 class="text-center mt-2">Inviter des membres</h2>
    <h6 class="text-center mt-2">à rejoindre la réunion</h6>
	<h2 class="text-center mt-2"><?= $reunion->getDate()->format('Y-F-d H:i') ?></h2>
	
	<hr>

    <?php $f = new \core\FormView("AjouterParticipation"); ?>
    <form action="" method="post" role="form" class="p-2" id="participation-frm">
		<input type="hidden" name="formid" value="<?= $f->id ?>">
		<input type="hidden" name="reunionid" value="<?= $reunion->getId() ?>">
		
		<div class="form-group">
			<input type="text" class="form-control" id="recherche" onkeyup="rechercher()" placeholder="Recherche" autocomplete="off">
		</div>

		<div class="container1 form-control rounded">
			<?php foreach ($utilisateurs as $i => $user) { ?>
        		<div class="custom-control form-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" name="courriels[]" value="<?=$user["courriel"]?>" id="cb<?=$i?>">
					<label class="custom-control-label" for="cb<?=$i?>">
						<?=$user["nom"]?><br>
						<small class="text-muted"><?=$user["courriel"]?></small>
					</label>
				</div>
			<?php }?>
		</div><br>
		
		<div class="form-group mb-1">
			<input type="submit" value="Inviter" class="btn btn-primary btn-block">
		</div>

		<p class="text-center mb-0">
			<a href="<?=WEBROOT."detailsreunion/".$reunion->getId()?>">Retour à la réunion</a>
		</p>
    </form>
</div>
