<?php if (isset($user)) { ?>

    <div class="page-header">
        <h1>Mes disques -> <?php echo $user; ?></h1>
    </div>

    <?php echo $addDisk; ?>
    <hr>
    <?php echo $lg; ?>

<?php } else { ?>

    <?php echo $alert; ?>

<?php } ?>

<?php echo $script_foot; ?>