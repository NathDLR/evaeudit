<div class="modal fade" id="finalizeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Prêt à finaliser le rapport ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Sélectionnez 'Finaliser' si le rapport est prêt a être envoyé.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                <a class="btn btn-primary" href="<?= URL ?>auditor/finalize/update">Finaliser</a>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= lang['Ready to leave'] ?> ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"><?= lang['Logout text'] ?></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal"><?= lang['Cancel'] ?></button>
                <a class="btn btn-primary" href="<?= URL ?>auth/logout"><?= lang['Logout'] ?></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="validModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attention !</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de valider le bon de commande.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal"><?= lang['Cancel'] ?></button>
                <a class="btn btn-danger" href="<?=URL?>admin/order_form/valid/<?= $content['ORDER_FORM_ID'] ?? $order['ORDER_FORM_ID'] ?? '#' ?>">Valider</a>
            </div>
        </div>
    </div>
</div>


