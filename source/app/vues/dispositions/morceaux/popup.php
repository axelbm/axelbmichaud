<div class="modal fade" id="popupModal">
    <?php
        if ($tail = $notification->options("tail")) {
            $tail = "modal-$tail";
        }
    ?>
    <div class="modal-dialog <?= $tail ?>">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?= $notification->getTitre() ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p><?= $notification->getContenu(); ?></p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<script>
    $("#popupModal").modal()
</script>