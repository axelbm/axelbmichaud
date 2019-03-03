<h4>
    <?php if ($pointdordre->getCompteRendu() != ""): ?>
        <span class="badge badge-info">Terminé</span>
    <?php endif ?>
    <?= $pointdordre->getTitre() ?>
</h4>

<h6>
    <?php if ($dossier = $pointdordre->getDossier()):?>
        Dossier <a href="<?= WEBROOT.'detailsdossier/'.$dossier->getId()?>"><?= $dossier->getNom() ?></a>
        <br>
    <?php endif ?>
    Pour la réunion du <a href="<?= WEBROOT.'detailsreunion/'.$reunion->getId()?>"><?= $reunion->getDate()->format('d F Y - H\hi')?></a>
</h6>

<hr>

<p><?= $pointdordre->getDescription() ?></p>

<hr>

<h4>Compte rendu</h4>

<h6>
    <?php if ($reunion->getCreateur() == $utilisateur->getCourriel() && $reunion->peutModifier()): ?>
        <?php if ($editer): ?>
            <a href="<?=WEBROOT.'detailspoints/'.$pointdordre->getId()?>">Annuler</a>
        <?php else: ?>
            <a href="<?=WEBROOT.'detailspoints/'.$pointdordre->getId().'/editer'?>">Modifier</a>
        <?php endif ?>
    <?php endif ?>
</h6>

<hr>

<?php if ($editer): ?>
    <?php $f = $vue->newForm("modifCompteRendu"); ?>
    <form method="post">
        <input type="hidden" name="formid" value="<?= $f->id ?>">
        <input type="hidden" name="id" value="<?= $pointdordre->getId() ?>">

        <div class="form-group">
            <input id="compterendu" value="<?=$pointdordre->getCompteRendu()?>" type="hidden" name="compterendu">
            <trix-editor input="compterendu" style="min-height:200px"></trix-editor>
        </div>

        <div class="form-group">
            <input type="submit" name="Sauvegarder"  class="btn btn-primary"><br><br>
        </div>
    </form>
<?php else: ?>
    <?=$pointdordre->getCompteRendu()?>
<?php endif ?>