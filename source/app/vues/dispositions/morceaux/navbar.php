<nav id="navbar" class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">

	<div class="container">
		<div>
			<!-- Links -->
			
			<ul class="navbar-nav">
				<!-- <a class="nav-item" href="<?=WEBROOT?>">
					<img src="<?= PUBLICROOT.'images/logo blanc.png'?>" alt="Logo" style="height: 30px; margin: 5px 10px 5px 0px;">
				</a> -->

				<a href="<?=WEBROOT?>" class="navbar-brand">@axelbm</a>

				<li class="nav-item">
					<a class="nav-link text-light" href="<?=WEBROOT.'blog'?>">Blog</a>
				</li>

				<li class="nav-item">
					<a class="nav-link text-light" href="<?=WEBROOT.'projet'?>">Projets</a>
				</li>

				<li class="nav-item">
					<a class="nav-link text-light" href="<?=WEBROOT.'tutoriel'?>">Tutoriels</a>
				</li>
				
				
				<li class="nav-item">
					<a class="nav-link text-light" href="<?=WEBROOT?>apropos">À-propos</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link text-light" href="<?=WEBROOT?>mecontacter">Me contacter</a>
				</li>

				<?php if (isset($utilisateur) && $utilisateur->estAdministrateur()): ?>
					<!-- <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle text-light" href="#" id="navbardrop" data-toggle="dropdown">
							Administration
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?=WEBROOT?>invitation">Inviter</a>
							
							<?php if ($utilisateur->estSuperAdministrateur()): ?>
								<a class="dropdown-item" href="<?=WEBROOT?>superAdmin">Super Admin</a>
							<?php endif ?>
						</div>
					</li> -->
					
				<?php endif ?>
			</ul>
		</div>

		<?php if (!isset($erreur)): ?>
			<?php if (isset($utilisateur)): ?>
				<div class="dropdown">
					<a class="nav-link dropdown-toggle text-light" href="#" data-toggle="dropdown">
						<?=$utilisateur->getNomComplet();?>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#">Mon profil</a>
						<a class="dropdown-item" href="#">Paramètres</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?=WEBROOT?>deconnexion">Se déconnecter</a>
					</div>
				</div>
			<?php else: ?>
				<a class="btn btn-light btn-sm" href="<?=WEBROOT?>connexion">Connexion</a>
			<?php endif ?>
		<?php endif ?>
	</div>
	

</nav>

