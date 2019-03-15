
<div class="row">

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <form action="" method="get" class="form-inline">
                    <div class="input-group">
                        <input name="recherche" type="text" class="form-control" placeholder="Recherche">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Go</button> 
                        </div>
                    </div>
                </form>
                
                <hr>

                <h2>Tags</h2>
                    
                <div class="mt-3">
                    <?php foreach ($tags as $tag): ?>
                        <span class="badge badge-info"><?= $tag ?></span>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <?php foreach ($blogs as $blog): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h1><a href="<?= WEBROOT."blog/".$blog->getId()?>"><?= $blog->getTitre() ?></a></h1>
                    <?php $blog->getId()?>
                    <p>
                        Écrit par <a href=""><?= $blog->getAuteur()->getNomComplet() ?></a>
                        <br>
                        <?= \core\Util::formatDate($blog->getPublication()) ?>
                    </p>
                    
                    <?php foreach ($blog->getTags() as $tag): ?>
                        <button type="button" class="btn btn-info btn-sm"><?= $tag ?></button>
                    <?php endforeach ?>

                    <hr>

                    <p><?= $blog->getResume() ?></p>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>