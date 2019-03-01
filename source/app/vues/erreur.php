
<img src="<?=PUBLICROOT?>images/404.png" alt="Smiley face"/>

<h1 class="code text-dark"><?= $code ?></h1>
<h1><small class="text-muted"><?= $message ?></small></h1>

<?php if (isset($description)): ?>
    <p class="text-muted"><?= $description ?></p>
<?php endif ?>

<a href="<?=WEBROOT?>">Retour à la page d'accueil</a>