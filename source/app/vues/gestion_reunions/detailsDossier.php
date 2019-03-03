<h1>
    <?= $dossier->getNom() ?>
</h1>

<?php if ($utilisateur->estAdministrateur()): ?>
    <?php if ($editer): ?>
        <a href="<?=WEBROOT.'detailsdossier/'.$dossier->getId()?>">Annuler</a>
    <?php else: ?>
        <a href="<?=WEBROOT.'detailsdossier/'.$dossier->getId().'/editer'?>">Modifier</a>
    <?php endif ?>
<?php endif ?>

<hr>

<?php if ($editer): ?>
    <?php $f = $vue->newForm("ModifDossier"); ?>
    <form method="post">
        <input type="hidden" name="formid" value="<?= $f->id ?>">
        <input type="hidden" name="id" value="<?= $dossier->getId() ?>">

        <div class="form-group">
            <input id="description" value="<?=$dossier->getDescription()?>" type="hidden" name="description">
            <trix-editor input="description" style="min-height:300px"></trix-editor>
        </div>

        <div class="form-group">
            <input type="submit" name="Sauvegarder"  class="btn btn-primary"><br><br>
        </div>
    </form>
<?php else: ?>
    <?=$dossier->getDescription()?>
<?php endif ?>


<div>
    <?php foreach ($pointdordres as $pointdordre): ?>
        <?php $reunion = $pointdordre->getReunion(); ?>
        <hr>
        <h4>
            <?php if ($pointdordre->getCompteRendu() != ""): ?>
                <span class="badge badge-info">Terminé</span>
            <?php endif ?>
            <?= $pointdordre->getTitre() ?>
        </h4>


        <h6>
            Pour la réunion du <a href="<?=WEBROOT.'detailsreunion/'.$reunion->getId()?>"><?= $reunion->getDate()->format('d F Y - H\hi')?></a>
            <br>
            <a href="<?=WEBROOT.'detailspoints/'.$pointdordre->getId()?>">Détails</a>
        </h6>
        
        <!-- <?php if ($estcreateur): ?>
            | <a href="<?= WEBROOT."detailsPoint/".$pointdordre->getId() ?>">Modifier</a> | <a href="#">Annuler</a>
        <?php endif ?> -->
        <hr>

        <p><?= $pointdordre->getDescription() ?></p>
    <?php endforeach ?>
</div>