<div class="file-item-row">
	<div class="name">
		<i class="extension <?php echo $data->getMimeTypeClass() ?>"></i>
		<?php echo CHtml::link($data->item->name.'.'.$data->extension, $data->getDownloadLink()); ?><br />
	</div>
	<div class="content">
		<?php echo $data->item->content; ?>
	</div>
</div>