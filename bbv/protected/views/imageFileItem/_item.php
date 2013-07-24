<div class="file-item-row">
	<div class="name">
		<?php echo CHtml::image(CHtml::normalizeUrl(array('/ImageFileItem/display', 'id'=>$data->id))); ?>
	</div>
	<div class="content">
		<?php echo $data->item->content; ?>
	</div>
</div>