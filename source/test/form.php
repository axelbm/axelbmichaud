<style>
.erreur{
	color: red;
	margin: 0px;
}
</style>

<?php

$form = core\MainForm::getInstance();


if ($form) {
};

?>

<?php $f = new \core\FormView("Connexion"); ?>
<form action="" method="post">
	<input type="hidden" name="formid" value="<?= $f->id ?>">
	Courriel :<br>
	<input type="text" name="courriel" value="<?= $f->get("courriel") ?>">
	<?php if ($e = $f->erreur("courriel")) echo "<p class=\"erreur\">$e</p>"; ?>
	<br>
	Mot de Passe :<br>
	<input type="text" name="motDePasse" value="<?= $f->get("motDePasse") ?>">
	<?php if ($e = $f->erreur("motDePasse")) echo "<p class=\"erreur\">$e</p>"; ?>
	<br><br>
	<input type="submit" value="Submit">
</form> 

<?php $f = new \core\FormView("Connexion"); ?>
<form action="" method="post">
	<input type="hidden" name="formid" value="<?= $f->id ?>">
	Courriel :<br>
	<input type="text" name="courriel" value="<?= $f->get("courriel") ?>">
	<?php if ($e = $f->erreur("courriel")) echo "<p class=\"erreur\">$e</p>"; ?>
	<br>
	Mot de Passe :<br>
	<input type="text" name="motDePasse" value="<?= $f->get("motDePasse") ?>">
	<?php if ($e = $f->erreur("motDePasse")) echo "<p class=\"erreur\">$e</p>"; ?>
	<br><br>
	<input type="submit" value="Submit">
</form> 

<?php $f = new \core\FormView("Connexion"); ?>
<form action="" method="post">
	<input type="hidden" name="formid" value="<?= $f->id ?>">
	Courriel :<br>
	<input type="text" name="courriel" value="<?= $f->get("courriel") ?>">
	<?php if ($e = $f->erreur("courriel")) echo "<p class=\"erreur\">$e</p>"; ?>
	<br>
	Mot de Passe :<br>
	<input type="text" name="motDePasse" value="<?= $f->get("motDePasse") ?>">
	<?php if ($e = $f->erreur("motDePasse")) echo "<p class=\"erreur\">$e</p>"; ?>
	<br><br>
	<input type="submit" value="Submit">
</form> 

