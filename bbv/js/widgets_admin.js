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
          	var col_id = $(ui.item).parent().parent().attr("id");
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
  function saveWidget(id, col_id, row_order, name) {
	real_id = chop_id(id);
	real_col_id = chop_id(col_id);
	
	if(typeof(name)==='undefined') name = $("#"+id).find(".name").val();

	var req = $.ajax({
		url: url_update+"/"+real_id,
		data: {
			page_id: model_id,
			col_id: real_col_id,
			row_order: row_order,
			name: name
		},
		invokedata: {
		    real_id: real_id,
		    name: name
		}
	});

	disable_widget(real_id);

	req.done(function(data, textStatus, jqXHR) {
		$("#widget_"+this.invokedata.real_id).find(".name").val(this.invokedata.name);
		enable_widget(this.invokedata.real_id);
	});

	req.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Er is iets misgelopen, probeer het later opnieuw.");
	});
  }

  // Make a new widget and save it at the database
  function newWidget(col_id) {
	var req = $.ajax({
		url: url_create,
		data: {
			page_id: model_id,
			col_id: col_id,
			row_order: $("#column_"+col_id).find(".content").sortable("toArray").length
		}
	});

	req.done(function(data, textStatus, jqXHR) {
		var result = $.parseJSON(data);
		
		var $widget = $("#widget_template").clone();
		
		$widget.attr("id", "widget_"+result.id);
		$("#column_"+col_id).find(".content").append($widget);
		$widget.find(".name").val(result.name);

		$(".sortable").sortable("refresh");
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

  // Disable a widget while saving
  function disable_widget(id) {
	saving = true;
	$("#widget_"+id).fadeTo(0.7);
	$("#widget_"+id).find(".name").prop('disabled', true);
	$("#widget_"+id).find(".move_widget").removeClass("move_widget").addClass("move_widget_disabled");
	$("#widget_"+id).find(".delete_widget").removeClass("delete_widget").addClass("delete_widget_disabled");
  }

  // Enable the widget again after saving
  function enable_widget(id) {
	saving = false;
	$("#widget_"+id).fadeTo(1);
	$("#widget_"+id).find(".name").prop('disabled', false);
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
	  var id = $(this).parent().parent().parent().attr("id");
	  deleteWidget(chop_id(id));
  });
  
  // Make a new widget onclick
  $(".add_widget").live("click", function() {
	newWidget(chop_id($(this).attr('id')));
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
	  
	  var id = $(this).parent().parent().parent().attr("id");
	  real_id = chop_id(id);
	  var req = $.ajax({
			url: url_update+"/"+real_id,
			data: {
				name: $(this).parent().parent().find(".name").val()
			}
	  });

	  disable_widget(real_id);

      req.done(function(data, textStatus, jqXHR) {
		enable_widget(real_id);
	  });

	  req.fail(function(jqXHR, textStatus, errorThrown) {
		alert("Er is iets misgelopen, probeer het later opnieuw.");
	  });
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
});