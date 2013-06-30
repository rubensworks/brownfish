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

  // Save a moved widget
  function saveWidget(id, col_id, row_order, name, filter_category, category_id, filter_tags, tags) {
	real_id = chop_id(id);
	real_col_id = chop_id(col_id);
	
	if(typeof(name)==='undefined') name = $("#"+id).find(".name").val();
	if(typeof(filter_category)==='undefined') filter_category = $("#"+id).find(".filter_category").is(":checked")?1:0;
	if(typeof(category_id)==='undefined') category_id = $("#"+id).find(".category_id").val();
	if(typeof(filter_tags)==='undefined') filter_tags = $("#"+id).find(".filter_tags").is(":checked")?1:0;
	if(typeof(tags)==='undefined') tags = $("#"+id).find(".tags").val();

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
		invokedata: {
		    real_id: real_id
		}
	});

	disable_widget(real_id);

	req.done(function(data, textStatus, jqXHR) {
		enable_widget(this.invokedata.real_id);
	});

	req.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Er is iets misgelopen, probeer het later opnieuw.");
	});
  }

  // Make a new widget and save it at the database
  function newWidget(col_id, type) {
	var req = $.ajax({
		url: url_create,
		data: {
			page_id: model_id,
			col_id: col_id,
			row_order: $("#column_"+col_id).find(".content").sortable("toArray").length,
			type: type
		}
	});

	req.done(function(data, textStatus, jqXHR) {
		var result = $.parseJSON(data);
		
		var $widget = $("#widget_template").clone();
		
		$widget.attr("id", "widget_"+result.id);
		$("#column_"+col_id).find(".content").append($widget);
		$widget.find(".name").val(result.name);

		$(".sortable").sortable("refresh");
		
		$widget.find(".tags").addClass("input_tags").tagit();
	});

	req.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Er is iets misgelopen, probeer het later opnieuw.");
	});
  }

  // Delete a widget on the server
  function deleteWidget(id, async) {
	if(typeof(async)==='undefined') async=true;
	if(!async || confirm("Weet je zeker dat je deze widget wilt verwijderen?")) {
		var req = $.ajax({
			url: url_delete+"/"+id,
			async: async
		});
	
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

  // Disable a widget while saving
  function disable_widget(id) {
	saving = true;
	$("#widget_"+id).fadeTo(0.7);
	$("#widget_"+id).find(".name").prop('disabled', true);
	$("#widget_"+id).find(".filter_category").prop('disabled', true);
	$("#widget_"+id).find(".category_id").prop('disabled', true);
	$("#widget_"+id).find(".filter_tags").prop('disabled', true);
	$("#widget_"+id).find(".tags").prop('disabled', true);
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

	  disable_widget(real_id);

      req.done(function(data, textStatus, jqXHR) {
		enable_widget(real_id);
	  });

	  req.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Er is iets misgelopen, probeer het later opnieuw.");
	  });
  }
  
  // Common save tags code from the starting tag-it node
  function save_tags($node) {
	  $widget = $($node).closest('.widget-drag');
	  real_id = chop_id($widget.attr('id'));
	  var data = {tags: $widget.find(".tags").val()};
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
	  var type = $('input:radio[name=widget_type]:checked').val();
	  newWidget($('#newWidget').data("col_id"), type);
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
  
  // Register toggle checkbox listeners
  toggle_setup("filter_category");
  toggle_setup("filter_tags");
  
  // Save on category change
  $(".category_id").live("change", function() {
	  $widget = $(this).closest('.widget-drag');
	  real_id = chop_id($widget.attr('id'));
	  var data = {category_id: $widget.find(".category_id").val()};
	  update_widget(real_id, data);
  });
  
  // Save tags on add and remove
  $(".input_tags").tagit({
	  singleField: true,
	  singleFieldNode: $('.tags'),
	  afterTagAdded: function() {
		  save_tags($(this));
	  },
	  afterTagRemoved: 
		  function() {
		  save_tags($(this));
	  }
  });
});