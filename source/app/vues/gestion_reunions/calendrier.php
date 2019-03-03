<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Modifier ma participation</h4>
			</div>

			<?php $f = $vue->newForm("ChangementStatut"); ?>
			<form method="post">
				<input type="hidden" name="formid" value="<?= $f->id ?>">
				<input id="reunionid" type="hidden" name="reunionid" value="">

				<!-- Modal body -->
				<div class="modal-body">
					<select id="statut" class="form-control" id="sel1" name="statut">
						<option value="Pres">Je participe</option>
						<option value="Hes">Hésitant</option>
						<option value="Abs">Absent</option>
					</select>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<input type="submit" value="Confirmer" class="btn btn-primary btn-block">
				</div>
			</form>

		</div>
	</div>
</div>


<div class="container">
	<h1 align="center"> - Réunion(s) - </h1> 
	<h6 align="center"> (Auxquelles vous êtes invité) </h6> 
	<br>

	<?php if ($estadmin):?>
		<a href="reunionCreee" class="btn btn-primary float-right">Mes Réunions</a><br>
	<?php endif ?>

	<br>

	<?php if ($nombredepage > 1): ?>
		<div class="pagination">
			<a href="<?=WEBROOT."calendrier"?>">&laquo;</a>

			<?php for ( $i = max(0, $page - 4); $i < min($nombredepage, $page + 4); $i++ ) :?>
				<a href="<?=WEBROOT."calendrier/$i"?>"><?=$i+1?></a>
			<?php endfor ?>

			<a href="<?=WEBROOT."calendrier/$nombredepage"?>">&raquo;</a>
		</div><br>
	<?php endif ?>

	<div>
		<?php foreach ($reunions as $reunion): 
			$reunion->mettreAJourStatut();?>
			<hr>

			<h4 class="card-title"><?= strftime($reunion->getDate()->format('Y-M-d H:i')) ?></h4>

			<div>
				<span>Organisé par : <a href="#"><?= $reunion->getCreateur() ?></a></span>
				<br>
				<?php \app\modeles\Participation::badgeStatic($participations[$reunion->getId()])?>
				<a href="<?= WEBROOT."detailsReunion/".$reunion->getId() ?>">Détails</a>

				<?php if ($participations[$reunion->getId()] != "Org"): ?>
					| <a href="" class="modifLink" value="<?=$reunion->getId()?>">Modifier ma participation</a>
				<?php endif ?>
			</div>

			<p>
				<?php $count=$reunion->nbInvite();
				if ($count > 1):?>
					<?= $count ?> personnes ont été invitées.
				<?php else: ?>
					<?= $count ?> personne a été invitée.
				<?php endif ?>
			</p>
			
			<?php $pointdordres = $reunion->getPointDordres();
			if (count($pointdordres)): ?>
				<h5>Points d'ordre</h5>
				<ul>
					<?php foreach ($pointdordres as $pointdordre): ?>
						<li><?= $pointdordre->getTitre()?></li>
					<?php endforeach ?>
				</ul>
			<?php endif ?>
		<?php endforeach ?>
	</div>
</div>



