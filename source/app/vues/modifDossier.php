<div class="col-lg-8 offset-lg-2 bg-light rounded" id="dossier-box">
    <h2 class="text-center mt-2">Modifier le Dossier</h2>
    <br>
    <?php $f = new \core\FormView("ModifDossier"); ?>
    <form action="" method="post" role="form" class="p-2" id="dossier-frm">

        <input type="hidden" name="formid" value="<?= $f->id ?>">
        <input type="hidden" name="id" value="<?= $dossier->getId() ?>">
        <div class="form-group">
        <div class="form-group">
        <h4><?= $dossier->getNom() ?></h4>
        </div>
        <div class="form-group">
        <input id="x" type="hidden" name="description" value="<?= $dossier->getDescription() ?>">
        <trix-editor input="x"></trix-editor>
       </div>
        <input type="submit" name="ajouter" id="ajouter" value="Ajouter" class="btn btn-primary float-right"><br><br>
        </div>
    </form>
</div>