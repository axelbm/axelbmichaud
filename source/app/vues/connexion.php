<p class="text-center">
    <img src="<?=PUBLICROOT.'images/logo.png'?>"  alt="Logo AFH">

</p>

<div class="bg-light col-lg-4 mx-auto mt-5 py-4 rounded shadow-lg" id="login-box">
    <h2 class="text-center">Se connecter</h2>

    <hr>

    <?php $f = new \core\FormView("Connexion"); ?>
    <form action="" method="post" role="form" class="p-2" id="login-frm">

        <input type="hidden" name="formid" value="<?= $f->id ?>">

        <?php $e = $f->erreur("courriel") ?>
        <div class="form-group" >
            <input type="text" name="courriel" class="form-control <?=$e?'is-invalid':""?>" placeholder="Courrier électronique" value="<?= $f->get("courriel") ?>" required>
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
            <small id="passwordForgotten" class="form-text ml-0"><a href="#" id="forgot-btn">Mot de passe oublié ?</a></small>
        </div>

        <div class="form-group">	
            <div class="custom-control custom-checkbox">	
                <input type="checkbox" name="resterConnecter" class="custom-control-input" id="customCheck" <?= $f->get("resterConnecter") == 'on' ? 'checked' : ''?>>	
                <label for="customCheck" class="custom-control-label">Se souvenir de moi</label>
            </div>	
        </div>

        <div class="form-group">
            <input type="submit" name="login" id="login" value="Se connecter" class="btn btn-primary btn-block">
        </div>

        <div class="form-group mb-0">
            <p class="text-center mb-0">
                Première fois ? <a href="inscription" id="register-btn">S'inscrire ici</a>
            </p>
        </div>
    </form>
</div>
