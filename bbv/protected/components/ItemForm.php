<?php
/**
 * 
 * @author Ruben Taelman
 * An easy to use item form that contains all the common item field for create and edit actions.
 * Other fields can easily be plugged in.
 * 
 * @param $model The extended model from item, so $model->item should be present with a link to a real
 * Item class instance.
 * @param $view A view that will be rendered after the common form elements for an Item. $form and $model
 * will be passed trough to this view.
 *
 */
class ItemForm extends CWidget
{
	public $model;
	public $view;

	public function init()
	{
		parent::init();
	}
	
	public function run(){
		Yii::app()->clientScript->registerScript('logoFix','$(document).ready(function() {
        $(".input_tags").tagit();
    });');
		$this->render('itemForm',array(
			'model'=>$this->model,
			'view'=>$this->view,
		));
    }

}
?>