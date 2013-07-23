// Auto-hide alerts
function autoHide($upload_info) {
	setTimeout(function() {
		$upload_info.html('');
    }, 10000);
}

$(document).ready(function() {
	// Init dropzone
	var $widget = $("#file_upload_"+widget_id);
	var $bar = $widget.find(".upload-progress >.bar");
	var $upload_info = $widget.find(".upload-info");
	var fileUploadedEvent = $.Event("fileUploaded");
	var dropzone = $widget.find('.dropzone').dropzone({
		dictDefaultMessage: messages.uploadHere,
		acceptedFiles: acceptedFiles,
		paramName: "FileItem[file]",
		init: function() {
				this.on("sending", function(file) {
					$upload_info.html('<div class="alert alert-info">'+messages.uploading+'...</div>');
				})
				this.on("success", function(file) {
					this.removeFile(file);
					$upload_info.html('<div class="alert alert-success">'+messages.filesUploaded+'</div>');
					autoHide($upload_info);
					
					// Call listener
					$($widget).trigger(fileUploadedEvent);
				});
				this.on("error", function(file) {
					this.removeFile(file);
					$upload_info.html('<div class="alert alert-error">'+messages.filesUploadFailed+'</div>');
					autoHide($upload_info);
				});
				this.on("uploadprogress", function(file, progress) {
					$bar.width(progress+"%");
					if(progress==100)
						$bar.hide();
					else
						$bar.show();
				});
				},
	});
	
	// Enable drag & drop file uploader
	$(document).bind('dragover', function (e) {
	    var dropZone = $('.dropzone'),
	        timeout = window.dropZoneTimeout;
	    if (!timeout) {
	        dropZone.addClass('in');
	    } else {
	        clearTimeout(timeout);
	    }
	    if (e.target === dropZone[0]) {
	        dropZone.addClass('hover');
	    } else {
	        dropZone.removeClass('hover');
	    }
	    window.dropZoneTimeout = setTimeout(function () {
	        window.dropZoneTimeout = null;
	        dropZone.removeClass('in hover');
	    }, 100);
	});
});