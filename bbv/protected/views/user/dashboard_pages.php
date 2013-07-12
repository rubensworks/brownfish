<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills',
    'stacked'=>true, // whether this is a stacked menu
    'items'=>array(
        array('label'=>Yii::t('messages', 'dashboard.pages'), 'url'=>array('page/admin')),
        array('label'=>Yii::t('messages', 'dashboard.pages.navigation'), 'url'=>array('navigation/admin')),
    ),
)); ?>