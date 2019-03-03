<div class="bg-light col-lg-4 mx-auto mt-5 py-4 rounded shadow-lg" id="reunion-box">
    <h2 class="text-center mt-2">Nouvelle Réunion</h2>

    <hr>

    <?php $f = new \core\FormView("AjouterReunion"); ?>
    <form action="" method="post" role="form" class="p-2" id="reunion-frm">
        <input type="hidden" name="formid" value="<?= $f->id ?>">
        
        <?php $e = $f->erreur("date") ?>
        <div class="form-group">
            <input type="date" name="date" class="form-control <?=$e?'is-invalid':""?>" value="<?= $f->get("date") ?>"  required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>
        </div>

        <?php $e = $f->erreur("heure") ?>
        <div class="form-group" >
            <input type="time" name="heure" class="form-control <?=$e?'is-invalid':""?>" value="<?= $f->get("heure") ?>"  required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>
        </div>

        <div class="form-group mb-0">
            <input type="submit" name="ajouter" id="ajouter" value="Ajouter" class="btn btn-primary btn-block">
        </div>
    </form>
</div>
