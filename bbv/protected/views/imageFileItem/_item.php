<div class="image-file-item-row">
	<?php echo CHtml::image(Yii::app()->easyImage->thumbSrcOf($data->getFile(), array(
			'type' => 'png',
			'resize' => array('width' => 200, 'height' => 200),
			'crop' => array('width' => 100, 'height' => 100),
	)), $data->item->name,array('id'=>$data->id)); ?>
</div>