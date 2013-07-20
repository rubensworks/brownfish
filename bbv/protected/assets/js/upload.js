var fileUploader;
var messages.uploading = "Uploading...";

// Initialize the file uploader
fileUploader = $('#fileupload').fileupload(
		{
			dataType : 'json',
			add : function(e, data) {
				data.context = $("#uploadStatus").html(
						'<div class="alert alert-info">' + messages.uploading
								+ '...</div>');
				data.submit();
				$('#fileProgress').show();
			},
			done : function(e, data) {
				$.each(data.result.files, function(index, file) {
					appendFile(file);
				});
				data.context.html('<div class="alert alert-success">'
						+ messages.filesUploaded + '</div>');
				$('#fileProgress .bar').css('width', '0%').parent().hide();
			},
			progressall : function(e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#fileProgress .bar').css('width', progress + '%');
			},
			fail : function(e, data) {
				$("#uploadStatus").html(
						'<div class="alert alert-error">'
								+ messages.filesUploadFailed + '</div>');
				$('#fileProgress').hide();
			},
			dropZone : $('#dropzone'),
		});

// Enable drag & drop file uploader
$(document).bind('dragover', function(e) {
	var dropZone = $('#dropzone'), timeout = window.dropZoneTimeout;
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
	window.dropZoneTimeout = setTimeout(function() {
		window.dropZoneTimeout = null;
		dropZone.removeClass('in hover');
	}, 100);
});

// Close modal and cancel any uploads
$(".cancelUpload").live("click", function() {
	$('#fileProgress').hide();
	$("#uploadStatus").html('');
	fileUploader.abort();
});