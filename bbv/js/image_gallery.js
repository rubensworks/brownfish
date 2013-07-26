var modal = '<div id="gallery" class="modal hide fade">\
<div class="modal-header">\
<a class="close" data-dismiss="modal">&times;</a>\
<h3>Gallery</h3>\
</div>\
<div class="modal-body gallery-body">\
\
</div>\
</div>';
var $modal = $(modal);

$(document).ready(function() {
	$(".image-file-item-row").live("click", function() {
		var id = $(this).find("img").attr("id");
		var $img = $("<img />");
		$img.load(function(){
			// TODO: better modal resizing here?
		});
		$img.attr('src', imageDisplayUrl+id);
		var $a = $("<a />").attr('href', imageViewUrl+id).append($img);
		$modal.modal().find(".modal-body").html($a);
		
		
	});
});