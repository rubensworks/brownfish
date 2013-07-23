<div id="file_upload_<?php echo $this->id; ?>">
	<div class="upload-info"></div>
	<form action="<?php echo CHtml::normalizeUrl(array('FileItem/upload'))?>" class="dropzone square"></form>
	<div class="upload-progress hide">
	  <div class="bar" style="width: 0%;"></div>
	</div>
</div>