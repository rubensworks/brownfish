<div class="image-file-item-row">
	<?php echo Yii::app()->easyImage->thumbOf($data->getFile(), array(
			'type' => 'png',
			'resize' => array('width' => 200, 'height' => 200),
			'crop' => array('width' => 100, 'height' => 100),
	)); ?>
</div>