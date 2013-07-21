<?php
$this->breadcrumbs=array(
	$class::model()->getMultipleItemName(),
);

?>
<section>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label' => Yii::t('messages', 'form.general.filter'),
		'icon' => 'filter white',
	    'type' => 'primary',
	    'htmlOptions' => array(
			'class' => 'pull-right',
	        'data-toggle' => 'modal',
	        'data-target' => '#filterModal',
	    ),
	)); ?>

	<h1><?php echo $class::model()->getMultipleItemName(); ?></h1>

	<form class="item_list_search">
		<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'filterModal')); ?>
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h4>Filter</h4>
		</div>
		<div class="modal-body">

			<?php
			$category_id = NULL;
			if(isset($_GET['category_id']))
				$category_id=$_GET['category_id'];
			$tags = NULL;
			if(isset($_GET['tags']))
				$tags=$_GET['tags'];
			$categories = Category::model()->findAll();
			$categories = array_merge(array(NULL), $categories);
			$categoryList = CHtml::listData($categories, 'category_id', 'name');

			echo CHtml::label(Yii::t('messages', 'model.category.category'), false);
			echo CHtml::dropDownList("category_id", $category_id, $categoryList, array("class"=>"category_id"));
			echo CHtml::label(Yii::t('messages', 'model.general.tags'), false);
			echo CHtml::textField("tags", $tags, array("class"=>"tags"));
			?>

		</div>

		<div class="modal-footer">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>Yii::t('messages', 'form.general.search'),
					'icon'=>'search white',
					'htmlOptions'=>array('class'=>'submit_search'),
		    )); ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
					'label'=>Yii::t('messages', 'form.general.close'),
					'url'=>'#',
					'htmlOptions'=>array('data-dismiss'=>'modal'),
		    )); ?>
		</div>
		<?php $this->endWidget(); ?>
	</form>

<?php
$this->widget('ItemList', array(
		'class' => $class,
		'criteria' => $criteria,
));

?>
</section>