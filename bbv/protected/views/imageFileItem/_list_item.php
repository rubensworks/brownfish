<a class="image-file-item-row" href="<?php echo CHtml::normalizeUrl(array('/ImageFileItem/view', 'id'=>$data->id)); ?>">
	<?php echo CHtml::image(Yii::app()->easyImage->thumbSrcOf($data->getFile(), array(
			'type' => 'png',
			'resize' => array('width' => 200, 'height' => 200),
			//'crop' => array('width' => 100, 'height' => 100),
	)), $data->item->name); ?>
</a>