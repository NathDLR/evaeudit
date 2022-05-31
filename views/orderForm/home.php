<h1><?= lang['Order Form'] ?></h1>
<table id="order_form">
    <thead>
    <tr>
        <th><?= lang['Company name'] ?></th>
        <th><?= lang['Status'] ?></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($content as $anOrderForm){ ?>
    <tr>
        <td><?=$anOrderForm['COMPANY_NAME'];?></td>
        <td><?=$anOrderForm['STATUS'];?></td>
        <td><a href="<?=URL;?>admin/order_form/show/<?=$anOrderForm['ORDER_FORM_ID'];?>" class="btn btn-primary">Modifier</a></td>
        <td><a href="<?=URL;?>pdf/order/<?=$anOrderForm['ORDER_FORM_ID'];?>" class="btn btn-primary">Show</a></td>
    </tr>
    <?php } ?>
    </tbody>
</table>