<div class="well span6 text-center">
	<i class="extension <?php echo $data->getMimeTypeClass() ?>"></i>
	<?php echo CHtml::link($data->item->name.'.'.$data->extension, $data->getDownloadLink()); ?><br />
</div>