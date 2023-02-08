<script>

    //add headers to all the ajax requests
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var event_name_elem = document.querySelector('#event_name');
    var event_participants_elem = document.querySelector('#event_participants');
    var specific_teacher_elem = document.querySelector('#specific_teacher');
    var specific_form_elem = document.querySelector('#specific_form');

    var event_date_elem = document.querySelector('#event_date');
    var start_date_elem = document.querySelector('#start_date');
    var end_date_elem = document.querySelector('#end_date');

    var calevent_specific_teacher_elem = document.querySelector('.calevent_specific_teacher');
    var calevent_specific_form_elem = document.querySelector('.calevent_specific_form');

    var event_single_elem = document.querySelector('#event_single');
    var event_range_elem = document.querySelector('#event_range');

    var calevent_date_single_elem = document.querySelector('.calevent_date_single');
    var calevent_date_range_elem = document.querySelector('.calevent_date_range');

    var create_calevent_submit_btn = document.querySelector('#create-calevent-btn');

    $("#event_participants").on('change', function(e) {
        e.preventDefault();
        console.log('event_participants_elem' + event_participants_elem.value);
        var event_participants = event_participants_elem.value;
        if (event_participants == '' ||  event_participants == 'all') {

            calevent_specific_teacher_elem.classList.add('hide');
            calevent_specific_form_elem.classList.add('hide');
        } else if ( event_participants == 'teacher') {

            specific_teacher_elem.setAttribute("required", "");
            specific_form_elem.removeAttribute("required");

            calevent_specific_teacher_elem.classList.remove('hide');
            calevent_specific_form_elem.classList.add('hide');
        } else if ( event_participants == 'parent') {

            specific_form_elem.setAttribute("required", "");
            specific_teacher_elem.removeAttribute("required");

            calevent_specific_teacher_elem.classList.add('hide');
            calevent_specific_form_elem.classList.remove('hide');
        }
    });
    event_single_elem.addEventListener("click", () => {

        event_date_elem.setAttribute("required", "");
        start_date_elem.removeAttribute("required");
        end_date_elem.removeAttribute("required");

        calevent_date_single_elem.classList.remove('hide');
        calevent_date_range_elem.classList.add('hide');
    });
    event_range_elem.addEventListener("click", () => {

        event_date_elem.removeAttribute("required");
        start_date_elem.setAttribute("required", "");
        end_date_elem.setAttribute("required", "");

        calevent_date_single_elem.classList.add('hide');
        calevent_date_range_elem.classList.remove('hide');

    });

    $('form.calevent-store').on('submit', function(ev){
        ev.preventDefault();

        var specific_teacher = '', specific_form = '', event_date, start_date, end_date;
        var event_name = event_name_elem.value;

        var event_participants = event_participants_elem.options[event_participants_elem.selectedIndex].value;

        if (event_participants == 'teacher') {

            specific_teacher = specific_teacher_elem.options[specific_teacher_elem.selectedIndex].value;
        } else if (event_participants == 'parent') {

            specific_form = specific_form_elem.options[specific_form_elem.selectedIndex].value;
        }


        let date_type = '';
        var date_type_elem = document.querySelectorAll('input[class="form-control ml-2 create-radio"]');
        console.log(date_type_elem.length);
        for(let entry of date_type_elem) {

            if (entry.checked == true) {
                date_type = entry.value;
                break;
            }
        }
        if (date_type == 'single') {

            event_date = event_date_elem.value;
        } else if(date_type == 'range') {

            start_date = start_date_elem.value;
            end_date = end_date_elem.value;
        }

        var form = $(this);
        disableBtn($(create_calevent_submit_btn));

        let form1 = new FormData();
        form1.append("event_name", event_name);
        form1.append("event_participants", event_participants);
        form1.append("specific_teacher", specific_teacher);
        form1.append("specific_form", specific_form);
        form1.append("date_type", date_type);
        form1.append("event_date", event_date);
        form1.append("start_date", start_date);
        form1.append("end_date", end_date);

        var ajaxOptions = {
            url:form.attr('action'),
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:form1
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log('======= residences ===============');
            console.log(resp);
            resp.ok && resp.msg
            ? flash({msg:resp.msg, type:'success'})
            : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            enableBtn($(create_calevent_submit_btn));
            $('#add_event_modal').modal('hide');
            document.location.reload(true);
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        });
    });

    $('form.sitecomments-store').on('submit', function(ev){
        ev.preventDefault();

        var sitecomment = document.querySelector('#sitecomment').value;
        console.log(sitecomment);

        var form = $(this);

        let form1 = new FormData();
        form1.append("sitecomment", sitecomment);

        var ajaxOptions = {
            url:form.attr('action'),
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:form1
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log('======= residences ===============');
            console.log(resp);
            resp.ok && resp.msg
            ? flash({msg:resp.msg, type:'success'})
            : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            $("#comment_modal").modal('hide');
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        });
    });

    // update calendar event
    var now_editing_calevent_name = '';
    var edit_calevent_specific_teacher_elem = document.querySelector('.edit_calevent_specific_teacher');
    var edit_calevent_specific_form_elem = document.querySelector('.edit_calevent_specific_form');

    var edit_calevent_date_single_elem = document.querySelector('.edit_calevent_date_single');
    var edit_calevent_date_range_elem = document.querySelector('.edit_calevent_date_range');

    var edit_event_single_elem = document.querySelector('#edit_event_single');
    var edit_event_range_elem = document.querySelector('#edit_event_range');

    var edit_specific_teacher_elem = document.querySelector('#edit_specific_teacher');
    var edit_specific_form_elem = document.querySelector('#edit_specific_form');

    var edit_event_single_elem = document.querySelector('#edit_event_single');
    var edit_event_range_elem = document.querySelector('#edit_event_range');

    var edit_event_date_elem = document.querySelector('#edit_event_date');
    var edit_start_date_elem = document.querySelector('#edit_start_date');
    var edit_end_date_elem = document.querySelector('#edit_end_date');

    var edit_calevent_date_single_elem = document.querySelector('.edit_calevent_date_single');
    var edit_calevent_date_range_elem = document.querySelector('.edit_calevent_date_range');

    var edit_event_participants_elem = document.querySelector('#edit_event_participants');
    var update_calevent_submit_btn = document.querySelector('#update-calevent-btn');
    var delete_calevent_btn = document.querySelector('#delete-calevent-btn');

    function viewEditModal() {

        var calevent_name = document.querySelector("#view_event_name").innerHTML;
        now_editing_calevent_name = calevent_name;
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

            var calevent = resp.calevent;
            console.log(calevent);
            $('#edit_event_name').val(calevent.name);
            $('#edit_event_participants').val(calevent.participants);
            if(calevent.participants == 'teacher') {
                edit_calevent_specific_teacher_elem.classList.remove('hide');
                edit_calevent_specific_form_elem.classList.add('hide');

                $("#edit_specific_teacher").val(calevent.specific_teacher);
            } else {
                edit_calevent_specific_form_elem.classList.remove('hide');
                edit_calevent_specific_teacher_elem.classList.add('hide');

                $("#edit_specific_form").val(calevent.specific_form);
            }
            $("#view_event_modal").modal('hide');
            $("#edit_event_modal").modal('show');
            if(calevent.date_type == 'single') {
                edit_calevent_date_single_elem.classList.remove('hide');
                edit_calevent_date_range_elem.classList.add('hide');

                edit_event_single_elem.setAttribute("checked", "");
                edit_event_range_elem.removeAttribute("checked");

                edit_event_date_elem.setAttribute("required", "");
                edit_start_date_elem.removeAttribute("required");
                edit_end_date_elem.removeAttribute("required");

                $('#edit_event_date').val(calevent.event_date);
            } else {
                edit_calevent_date_single_elem.classList.add('hide');
                edit_calevent_date_range_elem.classList.remove('hide');


                edit_event_range_elem.setAttribute("checked", "");
                edit_event_single_elem.removeAttribute("checked");

                edit_event_date_elem.removeAttribute("required");
                edit_start_date_elem.setAttribute("required", "");
                edit_end_date_elem.setAttribute("required", "");

                $('#edit_start_date').val(calevent.start_date);
                $('#edit_end_date').val(calevent.end_date);
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

    $("#edit_event_participants").on('change', function(e) {
        e.preventDefault();

        var event_participants = $("#edit_event_participants").val();

        if (event_participants == '' ||  event_participants == 'all') {

            edit_calevent_specific_teacher_elem.classList.add('hide');
            edit_calevent_specific_form_elem.classList.add('hide');
        } else if ( event_participants == 'teacher') {

            edit_specific_teacher_elem.setAttribute("required", "");
            edit_specific_form_elem.removeAttribute("required");

            edit_calevent_specific_teacher_elem.classList.remove('hide');
            edit_calevent_specific_form_elem.classList.add('hide');
        } else if ( event_participants == 'parent') {

            edit_specific_form_elem.setAttribute("required", "");
            edit_specific_teacher_elem.removeAttribute("required");

            edit_calevent_specific_teacher_elem.classList.add('hide');
            edit_calevent_specific_form_elem.classList.remove('hide');
        }
    });

    edit_event_single_elem.addEventListener("click", () => {

        edit_event_date_elem.setAttribute("required", "");
        edit_start_date_elem.removeAttribute("required");
        edit_end_date_elem.removeAttribute("required");

        edit_calevent_date_single_elem.classList.remove('hide');
        edit_calevent_date_range_elem.classList.add('hide');
    });


    edit_event_range_elem.addEventListener("click", () => {

        edit_event_date_elem.removeAttribute("required");
        edit_start_date_elem.setAttribute("required", "");
        edit_end_date_elem.setAttribute("required", "");

        edit_calevent_date_single_elem.classList.add('hide');
        edit_calevent_date_range_elem.classList.remove('hide');
    });

    $('form.calevent-update').on('submit', function(ev){
        ev.preventDefault();

        var specific_teacher = '', specific_form = '', event_date, start_date, end_date;
        var event_name = now_editing_calevent_name;

        var event_participants = edit_event_participants_elem.options[edit_event_participants_elem.selectedIndex].value;

        if (event_participants == 'teacher') {

            specific_teacher = edit_specific_teacher_elem.options[edit_specific_teacher_elem.selectedIndex].value;
        } else if (event_participants == 'parent') {

            specific_form = edit_specific_form_elem.options[edit_specific_form_elem.selectedIndex].value;
        }


        let date_type = '';
        var edit_date_type_elem = document.querySelectorAll('input[class="form-control ml-2 edit-radio"]');


        for(let entry of edit_date_type_elem) {
            if (entry.checked == true) {
                date_type = entry.value;
                break;
            }
        }
        if (date_type == 'single') {

            event_date = edit_event_date_elem.value;
        } else if(date_type == 'range') {

            start_date = edit_start_date_elem.value;
            end_date = edit_end_date_elem.value;
        }

        var form = $(this);
        disableBtn($(update_calevent_submit_btn));

        let form1 = new FormData();
        form1.append("event_name", event_name);
        form1.append("event_participants", event_participants);
        form1.append("specific_teacher", specific_teacher);
        form1.append("specific_form", specific_form);
        form1.append("date_type", date_type);
        form1.append("event_date", event_date);
        form1.append("start_date", start_date);
        form1.append("end_date", end_date);

        var ajaxOptions = {
            url:form.attr('action'),
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:form1
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log('======= residences ===============');
            console.log(resp);
            resp.ok && resp.msg
            ? flash({msg:resp.msg, type:'success'})
            : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            enableBtn($(update_calevent_submit_btn));
            $('#edit_event_modal').modal('hide');
            document.location.reload(true);
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            enableBtn($(update_calevent_submit_btn));
            return e.status;
        });
    });

    // delete calendar event
    $("#delete-calevent-btn").on('click', function(e) {
        e.preventDefault();

        disableBtn($(delete_calevent_btn));

        let form1 = new FormData();
        form1.append("event_name", now_editing_calevent_name);

        var ajaxOptions = {
            url:'calevents_delete',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:form1
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log('======= residences ===============');
            console.log(resp);
            resp.ok && resp.msg
            ? flash({msg:resp.msg, type:'success'})
            : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            enableBtn($(delete_calevent_btn));
            $('#edit_event_modal').modal('hide');
            document.location.reload(true);
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            enableBtn($(delete_calevent_btn));
            return e.status;
        });
    });
    function showEvents(){
        $('.fullcalendar-event-colors').addClass('active-state');
        $('.event-list').removeClass('active-state');

    }
    function showCalendar(){
        $('.fullcalendar-event-colors').removeClass('active-state');
        $('.event-list').addClass('active-state');
    }
</script>
