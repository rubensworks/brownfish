// Insert a selected FileItem to the content
function insertFileItem(include) {
	var editorInstance = $(".item_content").data("wysihtml5").editor;
	editorInstance.composer.commands.exec("insertHTML", include);
	$('#uploadFile').modal('toggle');
}

$(document).ready(function() {
	// Tagging
	$(".input_tags").tagit();
	
	// Custom templates for the WYSIWYG editor
	var myCustomTemplates = {
		    image : function(locale) {
		      return "<li><div class=\"btn-group\">" +
		        "<a id=\"addFiles\" class=\"btn\" title=\"" + locale.link.insert + "\"><i class=\"icon-picture\"></i></a>" +
		      "</div></li>";
		    },
	};
	$(".item_content").wysihtml5({
			"html": true,
			"color": true,
			"stylesheets": [stylesheet],
			"customTemplates": myCustomTemplates,
			"parserRules": wysihtml5ParserRules,
	});
	// Open file upload modal
	$("#addFiles").live("click", function(){
		$("#uploadFile").modal();
	});
	
	// Reload file table on file uploaded
	var $widget = $("#file_upload_"+widget_id);
	$widget.on("fileUploaded", function() {
		$("#fileUploadTable").yiiGridView.update('fileUploadTable');
	});
});