<?php
class FileUpload extends CWidget
{

	public function init() {
		
	}
	
	public function run() {
		Yii::app()->clientScript->registerScript('dropZone',"
			var dropzone = $('#FileItemDropzone').dropzone({
				acceptedFiles: \"".implode(",",Config::getValue(Config::$KEYS['FILE_ALLOWED_TYPES']))."\",
				paramName: \"FileItem[file]\",
			});");
		Yii::app()->clientScript->registerScript('dropZone',"Dropzone.autoDiscover = false;", CClientScript::POS_HEAD);
		$this->render('fileUpload');
    }

}
?>