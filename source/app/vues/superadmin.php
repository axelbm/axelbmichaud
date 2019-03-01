<div class="bg-light col-lg-4 mx-auto mt-5 py-4 rounded shadow-lg" id="register-box">
    <h2 class="text-center mt-2">Droits d'administrations</h2>
    <h6 class="text-center mt-2">du super Admin !</h6>

    <hr>

    <?php $f = new \core\FormView("SuperAdmin"); ?>
    <form action="" method="post" role="form" class="p-2" id="admin-frm">
        <input type="hidden" name="formid" value="<?= $f->id ?>">

        <?php $e = $f->erreur("courriel") ?>
        <div class="form-group">
            <input type="text" name="courriel" class="form-control <?=$e?'is-invalid':""?>" placeholder="Courrier électronique" required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <button type="submit" name="admin" value=true class="btn btn-success btn-block">Confier les droits d'administrateur</button>
        </div>
        <div class="form-group mb-0">
            <button type="submit" name="admin" value=false class="btn btn-danger btn-block">Retirer les droits d'administrateur</button>
        </div>
    </form>
</div>