<?php
require_once('include/session.php');
require_once('include/config.php');
require_once('include/dashboardFunctions.php');
require_once('include/authorityFunctions.php');
require_once('include/check.php');
logged_in();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>GRP | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris charts -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar 2.2.5-->
    <link href="plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
   
   
   
   
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- jQuery UI 1.11.1 -->
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  	<!-- Morris.js charts -->
    <script src="plugins/raphael/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>
    <script src="plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <?php
	  	top_header();		//function in include/dashboardFunctions.php
	  ?>
      
      <?php
	  	sidebar();		//function in include/dashboardFunctions.php
	  ?>

		<?php
			content();		//function in include/dashboardFunctions.php
		?>

      <?php
	  	footer();		//function in include/dashboardFunctions.php
	  ?>
    </div><!-- ./wrapper -->

   
    <!-- Page specific script -->
    <script type="text/javascript">
      $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            });

          });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
		var id = 0;
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },
          //Random default events
          events: [
		  
           {
			  id: -1,
              title: 'Click for Google',
			  allDay: true,
              start: new Date(y, m, 5),
              end: 0000-00-00,
              url: 'http://google.com/',
              backgroundColor: "#3c8dbc", //Primary (light-blue)
              borderColor: "#3c8dbc" //Primary (light-blue)
            },
			
			{
			  id: -2,
              title: 'Click for Google',
              start: new Date(y, m, 10),
              end: 0000-00-00,
              url: 'http://google.com/',
              backgroundColor: "#3c8dbc", //Primary (light-blue)
              borderColor: "#3c8dbc" //Primary (light-blue)
            }
			
          ],
          editable: true,
          droppable: true, // this allows things to be dropped onto the calendar !!!
          drop: function (date, allDay) { // this function is called when something is dropped
			
				
            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
		
            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).css("background-color");
            copiedEventObject.borderColor = $(this).css("border-color");
			copiedEventObject.id = id++;
			
			alert(copiedEventObject.start);
			//alert(copiedEventObject.id);
			

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove();
            }
			
			
          },
		  
		  
		  //to delete event on delete zone
		  eventDragStop: function( event, jsEvent, ui, view ) { 
		  
		  		var trashEl = $('#deleteEventZone');
				var ofs = trashEl.offset();
			
				var x1 = ofs.left;
				var x2 = ofs.left + trashEl.outerWidth(true);
				var y1 = ofs.top;
				var y2 = ofs.top + trashEl.outerHeight(true);
			
				if (jsEvent.pageX >= x1 && jsEvent.pageX<= x2 &&
					jsEvent.pageY>= y1 && jsEvent.pageY <= y2) {
					var ans = confirm('DELETE '+event.title+'?');
					if(ans == true)
						$('#calendar').fullCalendar('removeEvents', event.id);
    			}
		  
		  },
		  
		  
		  //to edit the date of event
		  eventDrop: function(event, delta, revertFunc) {

				alert(event.title + " was dropped on " + event.start.format());
		
				if (!confirm("Are you sure about this change?")) {
					revertFunc();
				}
		
			},
			
			
			//to edit the length of event
			eventResize: function(event, delta, revertFunc) {

				alert(event.title + " end is now " + event.end.format());
		
				if (!confirm("is this okay?")) {
					revertFunc();
				}
		
			},
			
			
			//to get day view of the day clicked
			dayClick: function(date, jsEvent, view) {
				//alert(date);
				$('#calendar').fullCalendar('changeView', 'agendaDay');
				$('#calendar').fullCalendar('gotoDate', date);
			},
			
			
			
			//to change name of event when clicked on it
			eventClick: function(calEvent, jsEvent, view) {
		
				var ans = confirm('Do you want to change name of event: ' + calEvent.title);
				
				if(ans == true){
					var title = prompt('Enter the new name for the event');
					calEvent.title = title;
					$('#calendar').fullCalendar('updateEvent',calEvent);
				}
		
			}
			
	
	
        });

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
          e.preventDefault();
          //Save color
          currColor = $(this).css("color");
          //Add color effect to button
          $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
          e.preventDefault();
          //Get value and make sure it is not null
          var val = $("#new-event").val();
          if (val.length == 0) {
            return;
          }

          //Create events
          var event = $("<div />");
          event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
          event.html(val);
          $('#external-events').prepend(event);

          //Add draggable funtionality
          ini_events(event);

          //Remove event from text input
          $("#new-event").val("");
		  
		  
		  
        });
      });
	  
	  
	  
	  
	  	
		



	  $("#admin_dashboard").addClass('active');

    </script>

    
  </body>
</html>