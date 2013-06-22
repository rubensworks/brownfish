<div class="well">
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills',
    'stacked'=>true, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Categorien', 'url'=>'../category'),
        array('label'=>'DummyItems', 'url'=>'../item'),
    	array('label'=>'Nieuws', 'url'=>'../newsitem/admin'),
    ),
)); ?>
</div>