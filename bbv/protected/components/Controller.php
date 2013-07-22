<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function beforeAction($action) {
		Yii::app()->bootstrap->register();
		
		$baseUrl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
		
		// Jquery UI
		Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
		$cs->registerCssFile($cs->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
		
		// Tag it
		$cs->registerScriptFile($baseUrl.'/js/tag-it.min.js');
		$cs->registerCssFile($baseUrl.'/css/jquery.tagit.css');
		
		// Bootstrap WYSIHTML5
		$cs->registerScriptFile($baseUrl.'/js/wysihtml5-0.3.0_rc2.min.js');
		$cs->registerScriptFile($baseUrl.'/js/bootstrap-wysihtml5.js');
		$cs->registerCssFile($baseUrl.'/css/wysihtml5.css');
		$cs->registerCssFile($baseUrl.'/css/bootstrap-wysihtml5.css');
		
		// Spin
		$cs->registerScriptFile($baseUrl.'/js/spin.min.js');
		
		// Dropzone
		$cs->registerScriptFile($baseUrl.'/js/dropzone.min.js');
		$cs->registerCssFile($baseUrl.'/css/basic.css');
		$cs->registerCssFile($baseUrl.'/css/dropzone.css');
		
		// Google Analytics
		if(isset(Yii::app()->params['googleAnalyticsTrackingID'])) {
			Yii::app()->clientScript->registerScript('googleAnalytics',"
			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', '".Yii::app()->params['googleAnalyticsTrackingID']."']);
			  _gaq.push(['_trackPageview']);
			
			  (function() {
			    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();", CClientScript::POS_END);
		}
		
		return parent::beforeAction($action);
	}
}