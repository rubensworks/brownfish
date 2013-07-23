<?php
class FileUpload extends CWidget
{

	public function init() {
		
	}
	
	public function run() {
		Yii::app()->clientScript->registerScript('variables_file_upload',"
				Dropzone.autoDiscover = false;
				var acceptedFiles = \"".implode(",",Config::getValue(Config::$KEYS['FILE_ALLOWED_TYPES']))."\";
		", CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/file_upload.js');
		$this->render('fileUpload');
    }

}
?>