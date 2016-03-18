<?php echo $msg; ?>
<table class='table table-condensed table-hover'>
	<thead><tr><th colspan='3'><?php echo $model; ?></th></tr></thead>
		<tbody>
		<?php foreach ($objects as $object) { ?>
			<tr>
			<td><?php echo $object; ?></td>
			<td class='td-center'><a class='btn btn-primary btn-xs update' href='<?php echo $this->url->get($baseHref . '/frm/' . $object->getId()); ?>' data-ajax="<?php echo $baseHref . '/frm/' . $object->getId(); ?>"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>
			<td class='td-center'><a class='btn btn-warning btn-xs delete' href='<?php echo $this->url->get($baseHref . '/delete/' . $object->getId()); ?>' data-ajax="<?php echo $baseHref . '/delete/' . $object->getId(); ?>"><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>
			</tr>
		<?php } ?>
		</tbody>
</table>
<a class='btn btn-primary add' href='<?php echo $this->url->get($baseHref . '/frm'); ?>' data-ajax="<?php echo $baseHref . '/frm/'; ?>">Ajouter...</a>
<?php if (isset($script_foot)) { ?>
    <?php echo $script_foot; ?>
<?php } ?>