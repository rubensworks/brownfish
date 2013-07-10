<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills',
    'stacked'=>true, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Categorien', 'url'=>array('category/admin')),
        array('label'=>'DummyItems', 'url'=>array('dummyitem/admin')),
    	array('label'=>'Nieuws', 'url'=>array('newsitem/admin')),
    	array('label'=>'Tekst items', 'url'=>array('textitem/admin')),
    ),
)); ?>