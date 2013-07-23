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
			"customTemplates": myCustomTemplates
	});
	// Open file upload modal
	$("#addFiles").live("click", function(){
		$("#uploadFile").modal();
	});
});