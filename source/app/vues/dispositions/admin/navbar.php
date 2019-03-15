<nav id="navbar" class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top mb-4">

	<div class="container">
        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Link 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link 3</a>
            </li>
        </ul>
            
        <ul class="navbar-nav">
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    axel
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->
            <li class="nav-item active">

                <?php $f = new \core\FormView("admin\\Deconnexion"); ?>
                <form action="" method="post">
                    <input type="hidden" name="formid" value="<?= $f->id ?>">
                    <button type="submit" class="btn btn-danger">Quitter</button>
                </form>
            </li>
        </ul>
    </div>
</nav>