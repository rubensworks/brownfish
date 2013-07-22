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
	public $afterView;
	public $options = array();

	public function init()
	{
		parent::init();
	}
	
	public function run(){
		Yii::app()->clientScript->registerScript('tagging','$(document).ready(function() {
	        $(".input_tags").tagit();
	    });');
		Yii::app()->clientScript->registerScript('wysihtml5','
		// Custom templates for the WYSIWYG editor
		var myCustomTemplates = {
			    image : function(locale) {
			      return "<li><div class=\"btn-group\">" +
			        "<a id=\"addFiles\" class=\"btn\" title=\"" + locale.link.insert + "\"><i class=\"icon-picture\"></i></a>" +
			      "</div></li>";
			    },
		};
        $(".item_content").wysihtml5({
				"html": true,
				"color": true,
				"stylesheets": ["'.Yii::app()->createAbsoluteUrl('/css/wysihtml5.css').'"],
				"customTemplates": myCustomTemplates
		});
		// Open file upload modal
		$("#addFiles").live("click", function(){
			$("#uploadFile").modal();
		});');
		$this->render('itemForm',array(
			'model'=>$this->model,
			'view'=>$this->view,
			'afterView'=>$this->afterView,
			'htmlOptions'=>array_merge(
					array('class'=>'well'),
					$this->options
					),
		));
    }

}
?>