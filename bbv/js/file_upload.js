$(document).ready(function() {
	// Init dropzone
	var dropzone = $('#FileItemDropzone').dropzone({
		acceptedFiles: acceptedFiles,
		paramName: "FileItem[file]",
		init: function() {
				this.on("success", function(file) {
						this.removeFile(file);
						alert('add to list, or reload list');
				});
				this.on("error", function(file) {
						this.removeFile(file);
						alert('show nice alert-error');
				});
				this.on("uploadprogress", function(file, progress) {
					$(".upload-progress >.bar").width(progress+"%");
					if(progress==100)
						$(".upload-progress >.bar").hide();
					else
						$(".upload-progress >.bar").show();
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