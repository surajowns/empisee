
!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$calendar = $('#calendar'),
        this.$event = ('#calendar-events div.calendar-events'),
        this.$categoryForm = $('#add_new_event form'),
        this.$extEvents = $('#calendar-events'),
        this.$modal = $('#my_event'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$calendarObj = null
    };

    var checkpermision;
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var form = '';
    var today = new Date($.now());
    var defaultEvents
    $.ajax({
        Type:"get",
        url :'https://www.empisee.com/leave_list',
        dataType:'json',
        cache: false,
        data: {},
        success: function(response){
        
            checkpermision=response.permission;
            defaultEvents =$.each(response.event,function(k,v){
                title: v.title
                start: new Date(v.start) 
                end: new Date(v.end) 
                className: v.categoryClass          
            });

            //  defaultEvents =  [{
            //     title: 'Event Name 4',
            //     start: new Date('2021-07-27'),
            //     className: 'bg-purple'
            // },
            // {
            //     title: 'Test Event 1',
            //     start: today,
            //     end: today,
            //     className: 'bg-success'
            // },
            // {
            //     title: 'Test Event 2',
            //     start: new Date($.now() + 168000000),
            //     className: 'bg-info'
            // },
            // {
            //     title: 'Test Event 3',
            //     start: new Date($.now() + 338000000),
            //     className: 'bg-primary'
            // }];
            // toastr.success(response.success);

        }
     });

    /* on drop */
    CalendarApp.prototype.onDrop = function (eventObj, date) { 
        var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];
            // render the event on the calendar
            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }
    },
    /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
        if(checkpermision!=null){
        var $this = this;
            var form = $("<form></form>");
            form.append("<label>Change subject name</label>");
            form.append("<div class='input-group'><input class='form-control' type=hidden name='id' value='" + calEvent.id + "' /><input class='form-control' type=text name='title' value='" + calEvent.title + "' /><span class='input-group-append'><button type='submit' class='btn btn-success'><i class='fa fa-check'></i> Save</button></span></div>");
            form.append("<div class='form-group'><label class='control-label'>Event Email</label><textarea class='form-control' type='text' name='descriptions'  id='editors' placeholder='Description'>'"+calEvent.description+"'</textarea></div>")

            $this.$modal.modal({
                backdrop: 'static'
            });
            $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
               var id =calEvent._id;
                $.ajax({
                    Type:'get',
                    url:'https://www.empisee.com/delete_event',
                    dataType:'json',
                    data:{id:id,},
                    success:function(response){
                         if(response.status==200){
                            $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                                return (ev._id == calEvent._id);
                            });
                            $this.$modal.modal('hide');
                            toastr.success(response.success);
                         }else{
                             toastr.error(response.error)
                         }

                    }

            })

               
            });
            CKEDITOR.replace('descriptions', {
                
                filebrowserUploadUrl: 'https://www.empisee.com/ckeditor/upload?type=Images&_token='+ $('meta[name=csrf-token]').attr('content'),
                filebrowserUploadMethod: 'form'
            });
            $this.$modal.find('form').on('submit', function (e) {
                    e.preventDefault();
                   var id = form.find("input[name=id]").val();
                   var title = form.find("input[name=title]").val();
                   var description = CKEDITOR.instances['editors'].getData();

                  $.ajax({
                          Type:'get',
                          url:'https://www.empisee.com/update_event',
                          dataType:'json',
                          data:{id:id,title:title,description:description},
                          success:function(response){

                            if(response.status==200){
                               calEvent.title = form.find("input[type=text]").val();
                               $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                               $this.$modal.modal('hide');
                               toastr.success(response.success);
                               }else{
                                   toastr.error(response.error)
                               }

                          }

                  })
               
                return false;
            });
        }
    },
    /* on select */
    CalendarApp.prototype.onSelect = function (start, end, allDay) {
        if(checkpermision!=null){
        var $this = this;
            $this.$modal.modal({
                backdrop: 'static'
            });
            var startdate = new Date(start),
             mnth = ("0" + (startdate.getMonth() + 1)).slice(-2),
             day = ("0" + startdate.getDate()).slice(-2);
          start=[startdate.getFullYear(), mnth, day].join("-");
          var enddate = new Date(end),
          mnth = ("0" + (enddate.getMonth() + 1)).slice(-2),
          day = ("0" + enddate.getDate()).slice(-2);
          end=[enddate.getFullYear(), mnth, day].join("-");
         
            var form = $("<form></form>");
            form.append("<div class='event-inputs'></div>");
            form.find(".event-inputs")
                .append("<div class='form-group'><label class='control-label'>Subject</label><input class='form-control' placeholder='Subject Name' type='text' name='title'/></div>")
                .append("<div class='form-group'><label class='control-label'>Event Email</label><textarea class='form-control' type='text' name='description'  id='editor' placeholder='Description'><img src='https://www.besthawk.com/empisee/public/assets/img/signatureimage.png' /></textarea></div>")
                .append("<div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div>")
                .find("select[name='category']")
                .append("<option value='bg-danger'>Danger</option>")
                .append("<option value='bg-success'>Success</option>")
                .append("<option value='bg-purple'>Purple</option>")
                .append("<option value='bg-primary'>Primary</option>")
                .append("<option value='bg-info'>Info</option>")
                .append("<option value='bg-warning'>Warning</option></div></div>");
            $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                form.submit();
            });
            // CKEDITOR.replace('description');
            CKEDITOR.replace('description', {
                colorButton_colors : 'CF5D4E,454545,FFF,DDD,CCEAEE,66AB16',
                filebrowserUploadUrl: 'https://www.empisee.com/ckeditor/upload?type=Images&_token='+ $('meta[name=csrf-token]').attr('content'),
                filebrowserUploadMethod: 'form'
            });
            $this.$modal.find('form').on('submit', function () {
                var title = form.find("input[name='title']").val();
                var description = CKEDITOR.instances['editor'].getData();
                var beginning = form.find("input[name='beginning']").val();
                var ending = form.find("input[name='ending']").val();
                var categoryClass = form.find("select[name='category'] option:checked").val();
                      $.ajax({
                         Type:'GET',
                         url:'https://www.empisee.com/create_event',
                         dataType:'json',
                         data:{title:title,description:description,categoryClass:categoryClass,start:start,end:end},
                         success:function(response){
                             if(response.status==200){
                                $this.$calendarObj.fullCalendar('renderEvent', {
                                    title: title,
                                    start:start,
                                    end: end,
                                    allDay: false,
                                    className: categoryClass
                                }, true); 
                                
                                
                                $this.$modal.modal('hide');
                                toastr.success(response.success);
                             }else{
                                toastr.error(response.error);

                             }

                         }


                      });

                
               
                return false;
                
            });
            $this.$calendarObj.fullCalendar('unselect');
        }
    },
    
    CalendarApp.prototype.enableDrag = function() {
        //init events
        $(this.$event).each(function () {
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    }
    /* Initializing */
    CalendarApp.prototype.init = function() {
        this.enableDrag();
        /*  Initialize the calendar  */
       
       

        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
            minTime: '08:00:00',
            maxTime: '19:00:00',  
            defaultView: 'month',  
            handleWindowResize: true,   
             
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: defaultEvents,
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            drop: function(date) { $this.onDrop($(this), date); },
            select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
            eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }

        });

        //on new event
        this.$saveCategoryBtn.on('click', function(){
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                $this.$extEvents.append('<div class="calendar-events" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fa fa-circle text-' + categoryColor + '"></i>' + categoryName + '</div>')
                $this.enableDrag();
            }

        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),

//initializing CalendarApp
function($) {
    "use strict";
    setTimeout(() => {
        $.CalendarApp.init()
    }, 2000); 
}(window.jQuery);