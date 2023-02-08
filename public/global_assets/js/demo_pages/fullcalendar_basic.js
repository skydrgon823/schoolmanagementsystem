
var FullCalendarBasic = function() {

    // Basic calendar
    var _componentFullCalendarBasic = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });

        if (!$().fullCalendar) {
            console.warn('Warning - fullcalendar.min.js is not loaded.');
            return;
        }


        var eventColors = [];
        var sdqwer = 0;
        var nowstatus = 'month';

        renderMonth();
        function renderMonth() {
            eventColors = [];
            nowstatus = 'month';
            $("#now_calendar_status").val(nowstatus);
            var ajaxOptions = {
                url:'getCalevent',
                type:'POST',
                cache:false,
                processData:false,
                dataType:'json',
                contentType:false,
            };

            var req = $.ajax(ajaxOptions);

            req.done(function(resp){

                for(let entry of resp.all_calevents) {

                    if(entry.date_type == 'single') {
                        eventColors.push({
                            'id' : entry.id,
                            'title' : entry.name,
                            'start' : entry.event_date,
                            'color' : '#EF5350'
                        });
                    } else if(entry.date_type == 'range') {
                        eventColors.push({
                            'id' : entry.id,
                            'title' : entry.name,
                            'start' : entry.start_date,
                            'end' : entry.end_date,
                            'color' : '#26A69A'
                        });
                    }
                }
                // console.log(eventColors);
                // renderting calendar event
                $('.fullcalendar-event-colors').fullCalendar({
                    header: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    // defaultDate: '2022-07-12',
                    editable: true,
                    events: eventColors,
                    isRTL: $('html').attr('dir') == 'rtl' ? true : false
                });
                // add onclick event
                var qerw = document.querySelectorAll("tbody a");
                for(let entry of qerw) {

                    entry.onclick = function(event) {

                        var calevent_name = this.children[0].children[1].innerHTML;
                        document.querySelector('#view_event_name').innerHTML = calevent_name;

                        let form1 = new FormData();
                        form1.append("calevent_name", calevent_name);

                        var ajaxOptions = {
                            url:'find-calevent',
                            type:'POST',
                            cache:false,
                            processData:false,
                            dataType:'json',
                            contentType:false,
                            data: form1,
                        };

                        var req = $.ajax(ajaxOptions);

                        req.done(function(resp){

                            console.log('view calevent modal');
                            console.log(resp.calevent);
                            var calevent = resp.calevent;
                            if(calevent.date_type == 'single') {
                                document.querySelector('#view_event_date').innerHTML = '<strong>at</strong> ' + calevent.event_date;
                            } else {
                                document.querySelector('#view_event_date').innerHTML = '<strong>from</strong> ' + calevent.start_date + ' <strong>to</strong> ' + calevent.end_date;
                            }
                            console.log('participants' + calevent.participants);
                            if(calevent.participants == 'teacher') {

                                document.querySelector('#view_event_participants').innerHTML = 'Teacher';
                                document.querySelector('#view_event_group').innerHTML = calevent.specific_teacher;

                            } else {

                                document.querySelector('#view_event_participants').innerHTML = 'Parent';
                                document.querySelector('#view_event_group').innerHTML = 'Form ' + calevent.specific_form;
                            }
                            $("#view_event_modal").modal('show');
                            return;

                        });
                        req.fail(function(e){
                            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
                            return e.status;
                        });

                    }
                }
                if (sdqwer == 0) {
                    // console.log('called this function');
                    eventColors = [];

                    $(".fc-month-button").on('click', function(e) {
                        e.preventDefault();
                        renderMonth();
                    });

                    $(".fc-agendaWeek-button").on('click', function(e) {
                        e.preventDefault();

                        renderWeek();
                    });

                    $(".fc-agendaDay-button").on('click', function(e) {
                        e.preventDefault();

                        renderDay();
                    });

                    $('.fc-prev-button').on('click', function(e) {
                        e.preventDefault();
                        if(nowstatus == 'month') {
                            renderMonth();
                        } else if(nowstatus == 'week') {
                            renderWeek();
                        } else {
                            renderDay();
                        }
                        console.log('fc-prev-button');
                    });
                    $('.fc-next-button').on('click', function(e) {
                        e.preventDefault();
                        if(nowstatus == 'month') {
                            renderMonth();
                        } else if(nowstatus == 'week') {
                            renderWeek();
                        } else {
                            renderDay();
                        }
                        console.log('fc-next-button');
                    });


                    sdqwer ++;
                }
                return;

            });
            req.fail(function(e){
                if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
                return e.status;
            });


        }

        function renderWeek() {
            eventColors = [];
            nowstatus = 'week';
            $("#now_calendar_status").val(nowstatus);
            var ajaxOptions = {
                url:'getCalevent',
                type:'POST',
                cache:false,
                processData:false,
                dataType:'json',
                contentType:false,
            };

            var req = $.ajax(ajaxOptions);

            req.done(function(resp){

                for(let entry of resp.all_calevents) {

                    if(entry.date_type == 'single') {
                        eventColors.push({
                            'id' : entry.id,
                            'title' : entry.name,
                            'start' : entry.event_date,
                            'color' : '#EF5350'
                        });
                    } else if(entry.date_type == 'range') {
                        eventColors.push({
                            'id' : entry.id,
                            'title' : entry.name,
                            'start' : entry.start_date,
                            'end' : entry.end_date,
                            'color' : '#26A69A'
                        });
                    }
                }
                // console.log(eventColors);
                // renderting calendar event
                $('.fullcalendar-event-colors').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    // defaultDate: '2022-07-12',
                    editable: true,
                    events: eventColors,
                    isRTL: $('html').attr('dir') == 'rtl' ? true : false
                });
                // add onclick event
                var qerw = document.querySelectorAll("tbody a");
                console.log('in renderweek function')
                for(let entry of qerw) {
                    console.log(entry);
                    entry.onclick = function(event) {
                        console.log(this.children[0].children[1])
                        if(this.children[0].children[1] != undefined) {
                            var calevent_name = this.children[0].children[1].innerHTML;
                        } else {
                            var calevent_name = this.children[0].children[0].innerHTML;
                        }

                        document.querySelector('#view_event_name').innerHTML = calevent_name;


                        let form1 = new FormData();
                        form1.append("calevent_name", calevent_name);

                        var ajaxOptions = {
                            url:'find-calevent',
                            type:'POST',
                            cache:false,
                            processData:false,
                            dataType:'json',
                            contentType:false,
                            data: form1,
                        };

                        var req = $.ajax(ajaxOptions);

                        req.done(function(resp){

                            console.log('view calevent modal');
                            console.log(resp.calevent);
                            var calevent = resp.calevent;
                            if(calevent.date_type == 'single') {
                                document.querySelector('#view_event_date').innerHTML = '<strong>at</strong> ' + calevent.event_date;
                            } else {
                                document.querySelector('#view_event_date').innerHTML = '<strong>from</strong> ' + calevent.start_date + ' <strong>to</strong> ' + calevent.end_date;
                            }
                            console.log('participants' + calevent.participants);
                            if(calevent.participants == 'teacher') {

                                document.querySelector('#view_event_participants').innerHTML = 'Teacher';
                                document.querySelector('#view_event_group').innerHTML = calevent.specific_teacher;

                            } else {

                                document.querySelector('#view_event_participants').innerHTML = 'Parent';
                                document.querySelector('#view_event_group').innerHTML = 'Form ' + calevent.specific_form;
                            }
                            $("#view_event_modal").modal('show');
                            return;

                        });
                        req.fail(function(e){
                            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
                            return e.status;
                        });

                    }
                }
                return;

            });
            req.fail(function(e){
                if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
                return e.status;
            });


        }


        function renderDay() {
            eventColors = [];
            nowstatus = 'day';
            $("#now_calendar_status").val(nowstatus);
            var ajaxOptions = {
                url:'getCalevent',
                type:'POST',
                cache:false,
                processData:false,
                dataType:'json',
                contentType:false,
            };

            var req = $.ajax(ajaxOptions);

            req.done(function(resp){

                for(let entry of resp.all_calevents) {

                    if(entry.date_type == 'single') {
                        eventColors.push({
                            'id' : entry.id,
                            'title' : entry.name,
                            'start' : entry.event_date,
                            'color' : '#EF5350'
                        });
                    } else if(entry.date_type == 'range') {
                        eventColors.push({
                            'id' : entry.id,
                            'title' : entry.name,
                            'start' : entry.start_date,
                            'end' : entry.end_date,
                            'color' : '#26A69A'
                        });
                    }
                }
                // console.log(eventColors);
                // renderting calendar event
                $('.fullcalendar-event-colors').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    // defaultDate: '2022-07-12',
                    editable: true,
                    events: eventColors,
                    isRTL: $('html').attr('dir') == 'rtl' ? true : false
                });
                // add onclick event
                var qerw = document.querySelectorAll("tbody a");
                for(let entry of qerw) {

                    entry.onclick = function(event) {

                        var calevent_name = this.children[0].children[1].innerHTML;
                        document.querySelector('#view_event_name').innerHTML = calevent_name;


                        let form1 = new FormData();
                        form1.append("calevent_name", calevent_name);

                        var ajaxOptions = {
                            url:'find-calevent',
                            type:'POST',
                            cache:false,
                            processData:false,
                            dataType:'json',
                            contentType:false,
                            data: form1,
                        };

                        var req = $.ajax(ajaxOptions);

                        req.done(function(resp){

                            console.log('view calevent modal');
                            console.log(resp.calevent);
                            var calevent = resp.calevent;
                            if(calevent.date_type == 'single') {
                                document.querySelector('#view_event_date').innerHTML = '<strong>at</strong> ' + calevent.event_date;
                            } else {
                                document.querySelector('#view_event_date').innerHTML = '<strong>from</strong> ' + calevent.start_date + ' <strong>to</strong> ' + calevent.end_date;
                            }
                            console.log('participants' + calevent.participants);
                            if(calevent.participants == 'teacher') {

                                document.querySelector('#view_event_participants').innerHTML = 'Teacher';
                                document.querySelector('#view_event_group').innerHTML = calevent.specific_teacher;

                            } else {

                                document.querySelector('#view_event_participants').innerHTML = 'Parent';
                                document.querySelector('#view_event_group').innerHTML = 'Form ' + calevent.specific_form;
                            }
                            $("#view_event_modal").modal('show');
                            return;

                        });
                        req.fail(function(e){
                            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
                            return e.status;
                        });

                    }
                }
                return;

            });
            req.fail(function(e){
                if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
                return e.status;
            });


        }

    };

    return {
        init: function() {
            _componentFullCalendarBasic();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    FullCalendarBasic.init();
});
