<div class="bg-light col-lg-8 mx-auto mt-5 py-4 rounded shadow-lg" id="dossier-box">
    <h2 class="text-center mt-2">Nouveau Dossier</h2>
    <hr>
    <?php $f = new \core\FormView("AjouterDossier"); ?>
    <form action="" method="post" role="form" class="p-2" id="dossier-frm">

        <input type="hidden" name="formid" value="<?= $f->id ?>">

        <div class="form-group">
            <input type="text" name="nom" class="form-control" placeholder="Titre" required>
        </div>

        <div class="form-group">
            <input id="x" type="hidden" name="description">
            <trix-editor input="x" style="min-height:250px"></trix-editor>
        </div>
        
        <input type="submit" name="ajouter" id="ajouter" value="Ajouter" class="btn btn-primary float-right">
        <br>
    </form>
</div>