<div class="bg-light col-lg-4 mx-auto mt-5 py-4 rounded shadow-lg" id="register-box">
    <h2 class="mt-2 text-center">Invitation de membre</h2>

    <hr>

    <p class="mx-4 text-center">Vous allez envoyez une clé d'invitation au courriel entré pour qu'il puisse ensuite s'inscrire.</p>

    <hr>

    <?php $f = $vue->newForm("Invitation"); ?>
    <form action="" method="post" role="form" class="p-2" id="register-frm">

        <input type="hidden" name="formid" value="<?= $f->id ?>">
        
        <?php $e = $f->erreur("courriel") ?>
        <div class="form-group">
            <input type="text" name="courriel" class="form-control <?=$e?'is-invalid':""?>" placeholder="Courrier électronique" value="<?= $f->get("courriel") ?>" required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>
        </div>
        <div class="form-group mb-0">
            <input type="submit" name="login" id="login" value="Inviter" class="btn btn-primary btn-block">
        </div>
    </form>
</div>