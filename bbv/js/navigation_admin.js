// Chops stuff like 'navigation_3' to '3'
function chop_id(id) {
	u_pos = id.indexOf("_");
	return id.substring(u_pos+1);
}

// Make the sorting elements, the sortable('refresh') method can't handle too much live stuff, so
// we have to call this on every element update.
function doSort() {
	$(".navigation_column").sortable({
		items: ".navigation_node",
		connectWith: ".navigation_column",
		cursor: 'move',
		opacity: 0.7,
		handle: ".move",
		revert: true,
		stop: function(event, ui) {
			var col_id = $(ui.item).closest('.navigation_node').parent().closest('.navigation_node').attr("id");
			var row_order = ui.item.index();
			var id = $(event.toElement).closest('.navigation_node').attr("id");
			
			var items = $("#"+col_id).find(".navigation_column").sortable("toArray");
			var rows = items.length;

			// Save all the elements in that column
			var offset = 0;
			for(var i=0;i<rows;i++) {
				if($("#"+items[i]).parent().closest(".navigation_node").attr("id") != col_id) {
					// sortable("toArray") also takes all sub-nodes, so we have to ignore these manually
					offset++;
				} else {
					update_element(chop_id(items[i]), {parent_id: chop_id(col_id), row_order: (i-offset)});
				}
			}
		}
	}).disableSelection();
}

//Make the sortable columns
$(function() {
	doSort();
});

//This is used to handle the ajax request results
function handle_request_result(request, real_id) {
	// We will disable the widget until the request has been successfully completed
	disable_widget(real_id);
	request.done(function(data, textStatus, jqXHR) {
		enable_widget(real_id);
	});

	request.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Er is iets misgelopen, probeer het later opnieuw.");
	});
}

//Disable a widget while saving
function disable_widget(id) {
	saving = true;
	$("#navigation_"+id).fadeTo(0.7);
	$("#navigation_"+id).find(".nav_label").prop('disabled', true);
	$("#navigation_"+id).find(".route").prop('disabled', true);
	$("#navigation_"+id).find(".move").removeClass("move").addClass("move_disabled");
	$("#navigation_"+id).find(".delete").removeClass("delete").addClass("delete_disabled");
}

// Enable the widget again after saving
function enable_widget(id) {
	saving = false;
	$("#navigation_"+id).fadeTo(1);
	$("#navigation_"+id).find(".nav_label").prop('disabled', false);
	$("#navigation_"+id).find(".route").prop('disabled', false);
	$("#navigation_"+id).find(".move_disabled").removeClass("move_disabled").addClass("move");
	$("#navigation_"+id).find(".delete_disabled").removeClass("delete_widget_disabled").addClass("delete");
}

// Make a new navigation element and save it at the database
function new_navigation($node, label, type, route, parent_id, row_order) {
	var req = $.ajax({
		url: url_create,
		data: {
			label: label,
			type: type,
			route: route,
			parent_id: parent_id,
			row_order: row_order,
		}
	});

	req.done(function(data, textStatus, jqXHR) {
		var result = $.parseJSON(data);
		
		// Clone from template
		var $navigation = $("#navigation_template").clone();

		// Set correct id
		$navigation.attr("id", "navigation_"+result.id);
		
		// Fill in the correct name
		$navigation.find(".nav_label").val(result.label);
		
		// Display the correct node type
		if(type == TYPE_NODE) $navigation.find(".route").hide();
		if(type == TYPE_LEAF) $navigation.find(".node_controls").hide();
		
		// Remove navigation_column of leaf elements
		if(type ==  TYPE_LEAF) $navigation.find(".navigation_column").remove();
		
		// Append to given column
		$node.find(".navigation_column").first().append($navigation);
		
		// Refresh the sortable column
		doSort();
	});

	req.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Er is iets misgelopen, probeer het later opnieuw.");
	});
}

// Delete a navigation element on the server, async is optional and by default true
// If async is false, the ajax request will be called synchronous
function delete_navigation(id, async) {
	if(typeof(async)==='undefined') async=true;
	if(!async || confirm("Weet je zeker dat je dit element wilt verwijderen? Alle sub-elementen zullen ook verwijderd worden.")) {
		var req = $.ajax({
			url: url_delete+"/"+id,
			async: async
		});

		// Wait until the request has been completed to remove the widget
		req.done(function(data, textStatus, jqXHR) {
			$("#navigation_"+id).hide("fast", function(){
				$(this).remove();
			});
		});

		req.fail(function(jqXHR, textStatus, errorThrown) {
			alert("Er is iets misgelopen, probeer het later opnieuw.");
		});
	}
}

// Update an element with a certain data set
function update_element(real_id, data) {
	var req = $.ajax({
		url: url_update+"/"+real_id,
		data: data
	});
	handle_request_result(req, real_id);
}

$(document).ready(function() {
	$(".add_element").live("click", function() {
		$node = $(this).closest(".navigation_node");
		new_navigation($node, "Nieuw element", TYPE_NODE, "", chop_id($node.attr("id")), 0);
	});
	
	$(".add_link").live("click", function() {
		$node = $(this).closest(".navigation_node");
		new_navigation($node, "Nieuwe link", TYPE_LEAF, "", chop_id($node.attr("id")), 0);
	});
	
	$(".remove").live("click", function() {
		var id = chop_id($(this).closest(".navigation_node").attr("id"));
		delete_navigation(id);
	});
	
	// Set changes true if a textfield has been changed
	$(".nav_label, .route").live("keyup", function() {
		changes = true;
	});
	
	// Save label on focus out
	$(".nav_label").live("focusout", function() {
		changes = false;
		$node = $(this).closest('.navigation_node');
		real_id = chop_id($node.attr("id"));
		update_element(real_id, {label: $node.find(".nav_label").val()});
	});
	
	// Save route on focus out
	$(".route").live("focusout", function() {
		changes = false;
		$node = $(this).closest('.navigation_node');
		real_id = chop_id($node.attr("id"));
		update_element(real_id, {route: $node.find(".route").val()});
	});
	
	// Build the spinner and show it if an ajax request is going on
	new Spinner(spin_opts).spin(document.getElementById('saving'));
	$('#saving')
	.hide()  // hide it initially
	.ajaxStart(function() {
		$(this).show();
	})
	.ajaxStop(function() {
		$(this).hide();
	});
	
	// Show an alert if there are changes or savings
	$(window).bind('beforeunload', function(){
		if(changes || saving){
			return 'Niet alle widgets zijn opgeslaan.';
		}
	});
});