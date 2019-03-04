

<div class="bg-light col-lg-4 mx-auto mt-5 py-4 rounded shadow-lg" id="login-box">
    <h2 class="text-center">Premiere Connexion</h2>

    <hr>

    <?php $f = new \core\FormView("admin\\PremiereConnexion"); ?>
    <form action="" method="post" role="form" class="p-2" id="login-frm">

        <input type="hidden" name="formid" value="<?= $f->id ?>">

        <?php $e = $f->erreur("code") ?>
        <div class="form-group" >
            <input type="text" name="code" class="form-control <?=$e?'is-invalid':""?>" placeholder="Code de securité" value="<?= $f->get("code") ?>" required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>
            <small class="form-text ml-0 text-secondary">Le code se trouve dans le fichier <code>code_secret.p</code> dans le dossier racine du site.</small>
        </div>

        <br>
        <h3>Nouveau compte admin</h3>
        <br>

        <?php $e = $f->erreur("identifiant") ?>
        <div class="form-group" >
            <input type="text" name="identifiant" class="form-control <?=$e?'is-invalid':""?>" placeholder="Identifiant" value="<?= $f->get("identifiant") ?>" required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>
        </div>

        <?php $e = $f->erreur("motDePasse") ?>
        <div class="form-group">
            <input type="password" name="motDePasse" class="form-control <?=$e?'is-invalid':""?>" placeholder="Mot de passe" value="<?= $f->get("motDePasse") ?>" required aria-describedby="passwordForgotten">
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <input type="submit" value="Créer le compte" class="btn btn-primary btn-block">
        </div>
    </form>
</div>
