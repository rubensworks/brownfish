<div id="uploadStatus"></div>

<div id="dropzone" class="fade well">Drop files here</div>
<span class="muted">Select file manually</span>
<input
	id="fileupload" type="file" name="files[]" data-url="<?php echo CHtml::normalizeUrl(array('/FileItem/upload')); ?>" />
<div id="fileProgress" class="progress progress-striped active"
	style="display: none">
	<div class="bar" style="width: 0%;"></div>
</div>