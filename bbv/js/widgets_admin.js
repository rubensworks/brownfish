// Chops stuff like 'widget_3' to '3'
function chop_id(id) {
	u_pos = id.indexOf("_");
	return id.substring(u_pos+1);
}

// Make the sortable columns
$(function() {
	$(".sortable").sortable({
		items: ".widget-drag",
		connectWith: ".sortable",
		cursor: 'move',
		opacity: 0.7,
		handle: ".move_widget",
		revert: true,
		stop: function(event, ui) {
			var col_id = $(ui.item).closest('.content').parent().attr("id");
			var row_order = ui.item.index();
			var id = event.toElement.parentNode.parentNode.parentNode.id;

			var items = $("#"+col_id).find(".content").sortable("toArray");
			var rows = items.length;

			// Save all the widgets in that column
			for(var i=0;i<rows;i++) {
				saveWidget(items[i], col_id, i);
			}
		}
	}).disableSelection();
});

// This is used to handle the ajax request results
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

// Save a moved widget
function saveWidget(id, col_id, row_order, name, filter_category, category_id, filter_tags, tags) {
	real_id = chop_id(id);
	real_col_id = chop_id(col_id);

	// Check optional parameters and fill them in if required
	if(typeof(name)==='undefined')
		name = $("#"+id).find(".name").val();
	if(typeof(filter_category)==='undefined')
		filter_category = $("#"+id).find(".filter_category").is(":checked")?1:0;
	if(typeof(category_id)==='undefined')
		category_id = $("#"+id).find(".category_id").val();
	if(typeof(filter_tags)==='undefined')
		filter_tags = $("#"+id).find(".filter_tags").is(":checked")?1:0;
	if(typeof(tags)==='undefined')
		tags = $("#"+id).find(".tags").val();

	var req = $.ajax({
		url: url_update+"/"+real_id,
		data: {
			page_id: model_id,
			col_id: real_col_id,
			row_order: row_order,
			name: name,
			filter_category: filter_category,
			category_id: category_id,
			filter_tags: filter_tags,
			tags: tags
		},
	});
	handle_request_result(req, real_id);
}

// Make a new widget and save it at the database
function newWidget(col_id, item_type) {
	var req = $.ajax({
		url: url_create,
		data: {
			page_id: model_id,
			col_id: col_id,
			row_order: $("#column_"+col_id).find(".content").sortable("toArray").length,
			item_type: item_type
		}
	});

	req.done(function(data, textStatus, jqXHR) {
		var result = $.parseJSON(data);

		// Clone from template
		var $widget = $("#widget_template").clone();

		// Set correct id
		$widget.attr("id", "widget_"+result.id);

		// Set correct widget type radio names
		$widget.find(".widget_type_list").attr("name", "widget_type_"+result.id);
		$widget.find(".widget_type_single").attr("name", "widget_type_"+result.id);

		// Set correct widget item_id autocomplete id
		$widget.find("#item_id_").attr("id", "item_id_"+result.id);

		// Append to given column
		$("#column_"+col_id).find(".content").append($widget);

		// Set the given name
		$widget.find(".name").val(result.name);

		// Display the correct item type
		$widget.find(".item_type").text(result.item_type_display);

		// Refresh the sortable column
		$(".sortable").sortable("refresh");

		// Enable tagging
		$widget.find(".tags").addClass("input_tags").tagit();

		// Enable item_id autocomplete
		$('#item_id_'+result.id).autocomplete({
			'minLength':'3',
			'showAnim':'fold',
			'select': function(event, ui) {
				update_item_id($(this), ui.item['id']);
			},
			'source':url_autocomplete+result.item_type,
		});
	});

	req.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Er is iets misgelopen, probeer het later opnieuw.");
	});
}

// Delete a widget on the server, async is optional and by default true
// If async is false, the ajax request will be called synchronous
function deleteWidget(id, async) {
	if(typeof(async)==='undefined') async=true;
	if(!async || confirm("Weet je zeker dat je deze widget wilt verwijderen?")) {
		var req = $.ajax({
			url: url_delete+"/"+id,
			async: async
		});

		// Wait until the request has been completed to remove the widget
		req.done(function(data, textStatus, jqXHR) {
			$("#widget_"+id).hide("fast", function(){
				$(this).remove();
			});
		});

		req.fail(function(jqXHR, textStatus, errorThrown) {
			alert("Er is iets misgelopen, probeer het later opnieuw.");
		});
	}
}

// Update a field for a certain widget where the field is the name of the column to be updated
// and the $node is some tag inside the widget
function update_widget_field($node, field) {
	$widget = $($node).closest('.widget-drag');
	real_id = chop_id($widget.attr('id'));
	var data = {};
	data[field] = $widget.find("."+field).val();
	update_widget(real_id, data);
}

//Update a field for a certain widget where the field is the name of the column to be updated
//and the $node is some tag inside the widget and the $node is a checkbox
function update_widget_checkbox($node, field) {
	$widget = $($node).closest('.widget-drag');
	real_id = chop_id($widget.attr('id'));
	var data = {};
	data[field] = $widget.find("."+field).is(":checked")?1:0;
	update_widget(real_id, data);
}

//Enable/disable checkboxes with auto-save
function toggle_setup(type) {
	$("."+type).live("change", function() {
		$widget = $(this).closest('.widget-drag');
		real_id = chop_id($widget.attr('id'));
		var data = {};
		data[type] = $widget.find("."+type).is(":checked")?1:0;
		update_widget(real_id, data);

		if($widget.find("."+type).is(":checked"))
			$widget.find("."+type+"_setup").show("fast");
		else
			$widget.find("."+type+"_setup").hide("fast");
	});
}

//Enable/disable radio's with auto-save
function toggle_setup_radio(type, field, values) {
	$("."+field+"_"+type).live("change", function() {
		$widget = $(this).closest('.widget-drag');
		real_id = chop_id($widget.attr('id'));
		var data = {};
		data[field] = values[$widget.find("."+field+"_"+type).is(":checked")?1:0];
		update_widget(real_id, data);

		$widget.find("."+field+"_setup").hide("fast");
		if($widget.find("."+field+"_"+type).is(":checked"))
			$widget.find("."+field+"_"+type+"_setup").show("fast");
	});
}

// Disable a widget while saving
function disable_widget(id) {
	saving = true;
	$("#widget_"+id).fadeTo(0.7);
	$("#widget_"+id).find(".name").prop('disabled', true);
	$("#widget_"+id).find(".filter_category").prop('disabled', true);
	$("#widget_"+id).find(".category_id").prop('disabled', true);
	$("#widget_"+id).find(".filter_tags").prop('disabled', true);
	$("#widget_"+id).find(".tags").prop('disabled', true);
	$("#widget_"+id).find(".clear").prop('disabled', true);
	$("#widget_"+id).find(".move_widget").removeClass("move_widget").addClass("move_widget_disabled");
	$("#widget_"+id).find(".delete_widget").removeClass("delete_widget").addClass("delete_widget_disabled");
}

// Enable the widget again after saving
function enable_widget(id) {
	saving = false;
	$("#widget_"+id).fadeTo(1);
	$("#widget_"+id).find(".name").prop('disabled', false);
	$("#widget_"+id).find(".filter_category").prop('disabled', false);
	$("#widget_"+id).find(".category_id").prop('disabled', false);
	$("#widget_"+id).find(".filter_tags").prop('disabled', false);
	$("#widget_"+id).find(".tags").prop('disabled', false);
	$("#widget_"+id).find(".clear").prop('disabled', false);
	$("#widget_"+id).find(".move_widget_disabled").removeClass("move_widget_disabled").addClass("move_widget");
	$("#widget_"+id).find(".delete_widget_disabled").removeClass("delete_widget_disabled").addClass("delete_widget");
}

// Delete all the widgets in a certain column
function delete_in_column(id) {
	var items = $("#column_"+id).find(".content").sortable("toArray");
	var rows = items.length;

	// Save all the widgets in that column
	for(var i=0;i<rows;i++) {
		deleteWidget(chop_id(items[i]), false);
	}
}

// Update a widget with a certain data set
function update_widget(real_id, data) {
	var req = $.ajax({
		url: url_update+"/"+real_id,
		data: data
	});
	handle_request_result(req, real_id);
}

// Common save tags code from the starting tag-it node
function save_tags($node) {
	update_widget_field($node, "tags");
}

// Update the item id
function update_item_id($node, id) {
	$widget = $node.closest('.widget-drag');
	real_id = chop_id($widget.attr('id'));
	var data = {item_id: id};
	update_widget(real_id, data);
}

$(document).ready(function() {
	// Check the amount of columns and ask for deletion if the amount has decreased
	$('#page-form').submit(function() {
		if($("#columns").val() < current_columns){
			// Check if there are non-empty columns that will be deleted
			var to_delete = false;
			for(var i=$("#columns").val();i<current_columns;i++) {
				var items = $("#column_"+i).find(".content").sortable("toArray");
				if(items.length > 0) to_delete = true;
			}

			// Delete those widgets in the to-remove columns after confirmation (if they are non-empty)
			if(to_delete) {
				if(!confirm("Het aantal kolommen zal verminderen en de widgets in die kolommen zullen gewist worden, ben je dit zeker?"))
					return false;
				for(var i=$("#columns").val();i<current_columns;i++) {
					delete_in_column(i);
				}
			}
		}
	});

	// Delete widget onclick
	$(".delete_widget").live("click", function() {
		var id = $(this).closest('.widget-drag').attr("id");
		deleteWidget(chop_id(id));
	});

	// Open the widget selection modal
	$(".add_widget").live("click", function() {
		$('#newWidget').modal('toggle');
		$('#newWidget').data("col_id", chop_id($(this).attr('id')));
	});

	// Add the selected widget to the selected column
	$("#confirm_add_widget").live("click", function() {
		var item_type = $('input:radio[name=widget_type]:checked').val();
		newWidget($('#newWidget').data("col_id"), item_type);
	});

	// Show an alert if there are changes or savings
	$(window).bind('beforeunload', function(){
		if(changes || saving){
			return 'Niet alle widgets zijn opgeslaan.';
		}
	});

	// Set changes true if a name has been changed
	$(".name").live("keyup", function() {
		changes = true;
	});

	// Save name of a widget on focus out
	$(".name").live("focusout", function() {
		changes = false;

		var id = $(this).closest('.widget-drag').attr("id");
		real_id = chop_id(id);

		update_widget(real_id, {name: $(this).closest('.widget-drag').find(".name").val()});
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

	// Register toggle checkbox and radio listeners
	toggle_setup("filter_category");
	toggle_setup("filter_tags");
	toggle_setup_radio("list", "widget_type", ["SINGLE", "LIST"]);
	toggle_setup_radio("single", "widget_type", ["LIST", "SINGLE"]);

	// Save on category change
	$(".category_id").live("change", function() {
		update_widget_field($(this), "category_id");
	});

	// Save tags on add and remove
	$(".input_tags").tagit({
		singleField: true,
		singleFieldNode: $('.tags'),
		afterTagAdded: function(event, ui) {
			if(!ui.duringInitialization) save_tags($(this));
		},
		afterTagRemoved: function(event, ui) {
			if(!ui.duringInitialization) save_tags($(this));
		}
	});
	
	// Save on clear change
	$(".clear").live("change", function() {
		update_widget_checkbox($(this), "clear");
	});

	//Save on amount change
	$(".amount").live("change", function() {
		update_widget_field($(this), "amount");
	});
});