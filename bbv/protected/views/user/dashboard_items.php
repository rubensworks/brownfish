<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills',
    'stacked'=>true, // whether this is a stacked menu
    'items'=>array(
        array('label'=>Yii::t('messages','dashboard.items.categories'), 'url'=>array('category/admin')),
        array('label'=>Yii::t('messages','dashboard.items.dummyItems'), 'url'=>array('dummyitem/admin')),
    	array('label'=>Yii::t('messages','dashboard.items.news'), 'url'=>array('newsitem/admin')),
    	array('label'=>Yii::t('messages','dashboard.items.text'), 'url'=>array('textitem/admin')),
    ),
)); ?>