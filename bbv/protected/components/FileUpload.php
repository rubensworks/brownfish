<?php
class FileUpload extends CWidget
{

	public function init() {
		
	}
	
	public function run() {
		Yii::app()->clientScript->registerScript('variables_file_upload',"
				Dropzone.autoDiscover = false;
				var acceptedFiles = \"".implode(",",Config::getValue(Config::$KEYS['FILE_ALLOWED_TYPES']))."\";
				var widget_id = \"".$this->id."\";
				var messages = new Object();
				messages.uploading = \"".Yii::t('messages', 'form.general.uploading')."\";
				messages.filesUploaded = \"".Yii::t('messages', 'form.general.filesUploaded')."\";
				messages.filesUploadFailed = \"".Yii::t('messages', 'form.general.filesUploadFailed')."\";
				messages.uploadHere = \"".Yii::t('messages', 'form.general.uploadHere')."\";
		", CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/file_upload.js');
		$this->render('fileUpload');
    }

}
?>