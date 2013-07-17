<?php
/**
 * 
 * @author Ruben Taelman
 * Display the live navigation form for a certain root. And if no root was given, it will take the main
 * navigation root.
 *
 */
class NavigationForm extends CWidget
{
	public $root_id;
	protected $root;

	public function init()
	{
		if($this->root_id == NULL) {
			$root = Navigation::model()->findByPk(Config::getValue(Config::$KEYS['MAIN_NAV']));
			if($root === NULL) {
				$root = Navigation::generateRoot("MAIN_NAV_ROOT");
				Config::setValue(Config::$KEYS['MAIN_NAV'], $root->id);
			}
		} else $root = Navigation::model()->findByPk($this->root_id);
		if($root === NULL) throw new CException('error.navigation.rootElementDoesNotExist');
		$this->root = $root;
		parent::init();
	}
	
	public function run(){
		// Register javascript file for dynamic navigation management
		$baseUrl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/navigation_admin.js');
		
		// Dynamic js parameters to register on the page
		Yii::app()->clientScript->registerScript('widget_variables',"
			var changes = false;
	  		var saving = false;
		
	  		var url_create = \"".CHtml::normalizeUrl(array("/navigation/create"))."\";
	  		var url_update = \"".CHtml::normalizeUrl(array("/navigation/update"))."\";
	  		var url_delete = \"".CHtml::normalizeUrl(array("/navigation/delete"))."\";
	  		var TYPE_NODE = \"".Navigation::$TYPE_NODE."\";
	  		var TYPE_LEAF = \"".Navigation::$TYPE_LEAF."\";
	  	    var TYPE_ROOT = \"".Navigation::$TYPE_ROOT."\";
                        var lang = {
                            somethingWentWrong : '". Yii::t('messages', 'error.somethingWentWrong') ."',
                            removeMessage : '" . Yii::t('messages', 'form.navigation.removeMessage') ."',
                            newElement : '" . Yii::t('messages', 'form.navigation.newElement') . "',
                            newLink : '" . Yii::t('messages', 'form.navigation.newLink') . "',
                            notAllWidgetSaved : '". Yii::t('messages', 'form.widgets.notAllSaved') ."',
                        };
	  	
	  		var root_id = ".$this->root->id.";
		", CClientScript::POS_END);
		
		$this->render('navigationForm',array(
				'root'=>$this->root,
		));
		parent::run();
    }

}
?>