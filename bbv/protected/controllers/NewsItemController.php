<?php
/**
 * Container for all the News actions
 * @author Ruben Taelman
 *
 */
class NewsItemController extends AbstractItemController
{
	protected $conditionalDateScript = "
			function checkDateCondition(\$element) {
				if (!\$element.attr('checked')) {
			        $('.startdate').attr('disabled', true);
					$('.enddate').attr('disabled', true);
			    } else {
			        $('.startdate').removeAttr('disabled');
					$('.enddate').removeAttr('disabled');
			    }
			}
				
			checkDateCondition($('.conditional_date'));
				
			$('.conditional_date').bind('click', function () {			
			    checkDateCondition($(this));
			});
		";
	
	public function getItemClassName() {
		return "NewsItem";
	}
	
	public function getListColumns() {
		return array(
				'id',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform CRUD
				'actions'=>array('create','update','admin','delete'),
				'roles'=>array('manageNews'),
			),
			array('allow',  // allow all users
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Add extra clientscripts to the default item create form
	 */
	public function actionCreate() {
		Yii::app()->clientScript->registerScript('conditionalDate',$this->conditionalDateScript);
		return parent::actionCreate();
	}
	
	/**
	 * Add extra clientscripts to the default item update form
	 * @param $id id of the model to update
	 */
	public function actionUpdate($id) {
		Yii::app()->clientScript->registerScript('conditionalDate',$this->conditionalDateScript);
		return parent::actionUpdate($id);
	}
}
