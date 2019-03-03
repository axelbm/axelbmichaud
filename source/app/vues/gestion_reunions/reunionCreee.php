<div class="container">
	<h1 align="center"> - Mes Réunions - </h1> 
	<br>

	<!-- Navigation -->
    <a href="calendrier"  class="btn btn-primary float-right ">Revenir à mes invitations</a> 
	<a href="formReunion"  class="btn btn-primary float-right">Ajouter une Réunion</a><br><br>
	
	<!-- Pagination -->
    <?php if ($nombredepage > 1): ?>
		<div class="pagination">
			<a href="<?=WEBROOT."reunionCreee"?>">&laquo;</a>

			<?php for ( $i = max(0, $page - 4); $i < min($nombredepage, $page + 4); $i++ ) :?>
					<a href="<?=WEBROOT."reunionCreee/$i"?>"><?=$i+1?></a>
			<?php endfor ?>

			<a href="<?=WEBROOT."reunionCreee/$nombredepage"?>">&raquo;</a>
		</div>
		<br>
  	<?php endif ?>

	<!-- Liste des réunions -->
	<div>
		<?php foreach ($reunions as $reunion): ?>
			<hr>
			<h4>
				<?php \app\modeles\Participation::badgeStatic($reunion->getStatutId()) ?>
				<?= strftime($reunion->getDate()->format('d F Y - H\hi')) ?>
			</h4>
			<div>
				<a href="<?= WEBROOT."detailsReunion/".$reunion->getId() ?>">Détails</a> |
				<a href="<?= WEBROOT."ajoutparticipation/".$reunion->getId() ?>">Inviter des participants</a>
			</div>
			<p>
				<?php $count=$reunion->nbInvite();
				if ($count > 1):?>
					<?= $count ?> personnes ont été invitées.
				<?php else: ?>
					<?= $count ?> personne invitée.
				<?php endif ?>
			</p>
			
			<?php $pointdordres=$reunion->getPointDordres();
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
