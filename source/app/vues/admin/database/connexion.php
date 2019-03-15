

<h2>Connexion a la base de données</h2>

<hr>

<?php $f = new \core\FormView("admin\\ConnexionDatabase"); ?>
<form action="" method="post" role="form" class="col-md-6" id="login-frm">
    <input type="hidden" name="formid" value="<?= $f->id ?>">
    
    <?php if($e = $f->erreur("global")): ?>
        <div class="text-danger"><p><?=$e?></p></div>
    <?php endif ?>

    <?php $e = $f->erreur("host") ?>
    <div class="form-group" >
        <input type="text" name="host" class="form-control <?=$e?'is-invalid':""?>" placeholder="Adresse"
                value="<?= $f->get("host") ?>" required>
        <?php if ($e): ?>
            <div class="invalid-feedback"><?=$e?></div>
        <?php endif ?>
    </div>

    <?php $e = $f->erreur("port") ?>
    <div class="form-group" >
        <input type="text" name="port" class="form-control <?=$e?'is-invalid':""?>" placeholder="Port (3306)"
                value="<?= $f->get("port") ?>">
        <?php if ($e): ?>
            <div class="invalid-feedback"><?=$e?></div>
        <?php endif ?>
    </div>

    <?php $e = $f->erreur("table") ?>
    <div class="form-group" >
        <input type="text" name="table" class="form-control <?=$e?'is-invalid':""?>" placeholder="Nom de la bdd" 
                value="<?= $f->get("table") ?>" required>
        <?php if ($e): ?>
            <div class="invalid-feedback"><?=$e?></div>
        <?php endif ?>
    </div>

    <?php $e = $f->erreur("identifiant") ?>
    <div class="form-group" >
        <input type="text" name="identifiant" class="form-control <?=$e?'is-invalid':""?>" placeholder="Identifiant"
                value="<?= $f->get("identifiant") ?>" required>
        <?php if ($e): ?>
            <div class="invalid-feedback"><?=$e?></div>
        <?php endif ?>
    </div>

    <?php $e = $f->erreur("motDePasse") ?>
    <div class="form-group">
        <input type="password" name="motDePasse" class="form-control <?=$e?'is-invalid':""?>" placeholder="Mot de passe"
                value="<?= $f->get("motDePasse") ?>">
        <?php if ($e): ?>
            <div class="invalid-feedback"><?=$e?></div>
        <?php endif ?>
    </div>

    <div class="form-group">
        <input type="submit" value="Connecter la base de données" class="btn btn-primary">
    </div>
</form>
