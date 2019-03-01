<div class="bg-light col-lg-4 mx-auto mt-5 py-4 rounded shadow-lg" id="register-box">
    <h2 class="text-center mt-2">S'inscrire</h2>

    <hr>

    <?php $f = new \core\FormView("Inscription"); ?>
    <form action="" method="post" role="form" class="p-2" id="register-frm">

    <input type="hidden" name="formid" value="<?= $f->id ?>">

        <?php $e = $f->erreur("nom") ?>
        <div class="form-group">
        <input type="text" name="nom" class="form-control <?=$e?'is-invalid':""?>" placeholder="Prénom" value="<?= $f->get("nom") ?>" required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>    
        </div>

        <?php $e = $f->erreur("prenom") ?>
        <div class="form-group">
        <input type="text" name="prenom" class="form-control <?=$e?'is-invalid':""?>" placeholder="Nom" value="<?= $f->get("prenom") ?>" required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>    
        </div>

        <?php $e = $f->erreur("courriel") ?>
        <div class="form-group">
        <input type="text" name="courriel" class="form-control <?=$e?'is-invalid':""?>" placeholder="Courrier électronique" value="<?= $f->get("courriel") ?>" required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>    
        </div>

        <?php $e = $f->erreur("motDePasse") ?>
        <div class="form-group">
        <input type="password" name="motDePasse" class="form-control <?=$e?'is-invalid':""?>" placeholder="Mot de passe" value="<?= $f->get("notDePasse") ?>" required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>    
        </div>

        <?php $e = $f->erreur("confirmMotDePasse") ?>
        <div class="form-group">
        <input type="password" name="confirmMotDePasse" class="form-control <?=$e?'is-invalid':""?>" placeholder="Veuillez confirmer votre mot de passe" value="<?= $f->get("confirmMotDePasse") ?>" required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>    
        </div>

        <?php $e = $f->erreur("cleInvitation") ?>
        <div class="form-group">
        <input type="text" name="cleInvitation" class="form-control <?=$e?'is-invalid':""?>" placeholder="*No. d'Invitation" value="<?= $cle != "" ? $cle : $f->get("cleInvitation") ?>" required>
            <?php if ($e): ?>
                <div class="invalid-feedback"><?=$e?></div>
            <?php endif ?>    
        </div>
        <div class="form-group">
            <input type="submit" name="register" id="register" value="S'inscrire" class="btn btn-primary btn-block">
        </div>
        <div class="form-group mb-0">
            <p class="text-center">Déjà inscrit ? <a href="connexion" id="login-btn">Se connecter ici</a></p>
        </div>
    </form>
</div>