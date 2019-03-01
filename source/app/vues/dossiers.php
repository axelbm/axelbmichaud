<div class="container">
	<h1 align="center"> - Les dossiers - </h1><br><br>
	<a href="formDossier" class="btn btn-primary float-right">Nouveau Dossier</a><br><br>

	<?php if ($nombredepage > 1){ ?>
	<div class="pagination">

	
	<a href="<?=WEBROOT."dossiers"?>">&laquo;</a>
	<?php for ( $i = max(0, $page - 4); $i < min($nombredepage, $page + 4); $i++ ) :?>
			<a href="<?=WEBROOT."dossiers/$i"?>"><?=$i+1?></a>
	<?php endfor ?>
	<a href="<?=WEBROOT."dossiers/$nombredepage"?>">&raquo;</a>

</div><br>
	<?php } ?>

  <div>
		<?php foreach ($dossiers as $dossier): ?>
			<hr>
			<h4>
				<h4 class="card-title"><?= $dossier->getNom() ?></h4>
			</h4>
			<div>
				<a href="<?= WEBROOT."detailsDossier/".$dossier->getId() ?>">Détails</a> 
			</div>
			
			<?php $pointdordres=$dossier->getPointDordres();
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
