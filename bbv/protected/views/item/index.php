<?php
$this->breadcrumbs=array(
	$class::model()->getMultipleItemName(),
);

?>
<section>
<h1><?php echo $class::model()->getMultipleItemName(); ?></h1>

<form class="item_list_search">
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
echo CHtml::dropDownList("category_id", $category_id, $categoryList, array("class"=>"category_id_search"));
echo "<div class='tags_search'>".CHtml::textField("tags", $tags, array("class"=>"tags"))."</div>";
?>
<?php $this->widget(
				'bootstrap.widgets.TbButton',
				array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'icon'=>'search white',
					'label'=>Yii::t('messages', 'form.general.search'),
					'htmlOptions'=>array('class'=>'submit_search'),
					)
				); ?>
</form>

<?php
$this->widget('ItemList', array(
		'class' => $class,
		'criteria' => $criteria,
));

?>
</section>