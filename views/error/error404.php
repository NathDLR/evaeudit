<?php $this->setT('Erreur 404 | Page introuvable');?>

<div class="text-center">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead text-gray-800 mb-5"><?= $errorMsg;?></p>
    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
    <a href="<?= URL ?><?= $_SESSION['role'];?>/">&larr; Back to Dashboard</a>
</div>

