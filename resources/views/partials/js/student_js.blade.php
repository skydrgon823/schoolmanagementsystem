<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    }); 

    const radioButtons = document.querySelectorAll('input[name="student_search"]');


    let adm_numRadio = document.querySelector('#admission_number');
    let nameRadio = document.querySelector('#name');
    let phone_numRadio = document.querySelector('#phone_number');
    let upiRadio = document.querySelector('#upi');
    let index_numRadio = document.querySelector('#index_number');

    let here1 = document.querySelector('#here1');
    let here2 = document.querySelector('#here2');
    let here3 = document.querySelector('#here3');
    let here4 = document.querySelector('#here4');
    let here5 = document.querySelector('#here5');

    adm_numRadio.addEventListener("click", () => {  
        clearAll();
        here1.classList.add("active");
    });
    nameRadio.addEventListener("click", () => {  
        clearAll();
        here2.classList.add("active");
    });
    phone_numRadio.addEventListener("click", () => {  
        clearAll();
        here3.classList.add("active");
    });
    upiRadio.addEventListener("click", () => {  
        clearAll();
        here4.classList.add("active");
    });
    index_numRadio.addEventListener("click", () => {  
        clearAll();
        here5.classList.add("active");
    });    

    const search_items = document.querySelectorAll('.search-items');
    function clearAll() {

        for (let search_item of search_items) {
            search_item.classList.remove('active');
        }
    }

    
    $('form.std_search_adm_num, form.std_search_name, form.std_search_phone, form.std_search_upi, form.std_search_index_num').on('submit', function(e){
        e.preventDefault();
        submitSearchForm($(this));
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });
    
    $("#form").on('change', function(e) {
        e.preventDefault();
        
        var formId = this.options[this.selectedIndex].value;

        let form1 = new FormData();    
        form1.append("formId", formId);

        var ajaxOptions = {
            url:'getStream-about-form',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form1,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){
            let classes = resp.classes;
            
            // assign corresponding class stream
            let div3 = '';
            for(let i = 0; i < classes.length; i++) {
                
                div3 += `<option value="`+ classes[i]['stream'] +`">` + classes[i]['stream'] + `</option>`;
            }            
            let stream = document.getElementById('stream');
            stream.innerHTML = '<option value="">Select Stream</option>' + div3;
            return;
            
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
        
    });

    const search_condition = document.querySelector('.search_condition');
    const search_result = document.querySelector('.search_result');
            
    function submitSearchForm(form){
        
        var btn = form.find('button[type=submit]');
        disableBtn(btn);
        
        var ajaxOptions = {
            url:form.attr('action'),
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: new FormData(form[0]),
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){
            
            let students = resp.students;
            resp.ok && resp.msg
               ? flash({msg:resp.msg, type:'success'})
               : flash({msg:resp.msg, type:'danger'});
            
            search_condition.classList.add('hide');      
            search_result.classList.remove('hide');
            var res_body = '', sr = '';
            if (students.length > 0) {
                for (var i = 0; i < students.length; i++) {
                    var url = '{{ route('students.show', [':id']) }}';
                    url = url.replace(':id', students[i]['id']);
                    res_body += 
                        `<tr>
                            <td>`+ (i+1) +`</td>
                            <td>`+ students[i]['adm_no'] +`</td>
                            <td>`+ students[i]['name'] +`</td>
                            <td>`+ students[i]['classname'] +`</td>
                            <td><a class="btn btn-primary" href="`+ url +`">Profile</a></td>                            
                            <td><a class="btn btn-primary">Analytics</a></td>
                        </tr>`;
                }
            
            
                sr = 
                    `<h6>Search Result</h6>
                    <table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Admno</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Profile</th>
                            <th>Analytics</th>
                        </tr>
                        </thead>
                        <tbody>
                            `+ res_body +`
                        </tbody>
                    </table>
                    <button class="btn btn-warning" style="float: right;" onclick="backSearch();">Back</button>`;
            } else {
                sr = 
                    `<h6>Search Result</h6><h3>No Student Matched</h3><button class="btn btn-warning" style="float: right;" onclick="backSearch();">Back</button>`;
            }

            search_result.innerHTML = sr;
            hideAjaxAlert();
            enableBtn(btn);            
            scrollTo('body');
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
    } 

    function backSearch() {
        search_result.classList.add('hide');
        search_condition.classList.remove('hide');

    }
// MOVE STUDENT ACTION
    const students_list = document.querySelector('.students-list');
    const pending_student_list = document.querySelector('.pending-students-list');
    const approve_student_list = document.querySelector('.approve-students-list');
    const origin_form = document.getElementById('origin-form');
    const destination_stream = document.getElementById('destination-stream');
    const moveSubmitBtn = document.querySelector('#move-submit-btn');
    const destination_class_pane = document.querySelector('.destination_class_pane');

    var check_one_btns, check_all_btns, buttons1, buttons2, button3, origin_form_id = 1, origin_stream;
    $("#origin-form").on('change', function(e) {
        e.preventDefault();
        
        var formId = this.options[this.selectedIndex].value;

        let form1 = new FormData();    
        form1.append("formId", formId);
        //store backup value
        origin_form_id = formId;
        var ajaxOptions = {
            url:'getStream-about-form',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form1,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){
            let classes = resp.classes;
            
            // disappear student list & destination class pane & submit button
            students_list.innerHTML = '';
            destination_class_pane.classList.add('hide');
            moveSubmitBtn.classList.add('hide');
            // assign corresponding class stream
            let div3 = '';
            for(let i = 0; i < classes.length; i++) {
                
                div3 += `<option value="`+ classes[i]['stream'] +`">` + classes[i]['stream'] + `</option>`;
            }            
            let origin_stream = document.getElementById('origin-stream');
            origin_stream.innerHTML = '<option value="">Select Stream</option>' + div3;
            return;
            
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
        
    });

    $("#origin-stream").on('change', function(e) {
        e.preventDefault();
        
        var formId = origin_form.options[origin_form.selectedIndex].value;
        
        var stream = this.options[this.selectedIndex].value;

        if (stream == '') {
            // disappear student list & destination class pane & submit button
            students_list.innerHTML = '';
            moveSubmitBtn.classList.add('hide');
            return;
        }
        //store backup value
        origin_stream = stream;

        let form1 = new FormData();    
        form1.append("formId", formId);
        form1.append("stream", stream);

        var ajaxOptions = {
            url:'getStudent-for-moving',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form1,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){
            
            let students_moving = resp.students_moving;            
            // show student list & pending student list
            students_list.classList.remove('hide');
            pending_student_list.classList.remove('hide');
            // hide approve student list
            approve_student_list.classList.add('hide');
            // append student list
            var res_body = '', sr = '';
            if (students_moving.length > 0) {
                for (var i = 0; i < students_moving.length; i++) {
                    
                    res_body += 
                        `<tr>
                            <td>`+ (i+1) +`</td>
                            <td>`+ students_moving[i]['adm_no'] +`</td>
                            <td>`+ students_moving[i]['name'] +`</td>                         
                            <td class="check-btn hide"><input type="checkbox" value="`+ students_moving[i]['id'] +`" class="check-one lg-check" /></td>
                        </tr>`;
                }
            
                sr = 
                    `<div class="buttons1">
                        <button type="button" class="btn btn-info ml-2" onclick="startMoving();" style="float: right;">Select Student To Move</button>
                        <button type="button" class="btn btn-success" onclick="showApproving();" style="float: right;">Students Awaiting Approval</button>
                    </div>
                    <button type="button" class="btn btn-info buttons2 hide" style="float: right;" onclick="cancelMoving();">Cancel Move</button>                    
                    <table class="table datatable-button-html5-columns">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Admno</th>
                                <th>Name</th>
                                <th class="check-btn hide"><input class="lg-check" type="checkbox" value="0" onclick="checkAll(this);" id="check-all" /></th>
                            </tr>
                        </thead>
                        <tbody>                            
                            `+ res_body +`
                        </tbody>
                    </table>`;
            } else {
                sr = 
                    `<h6>Search Result</h6>
                    <h3>No Student Matched</h3>
                    <div class="buttons1">
                        <button type="button" class="btn btn-success" onclick="showApproving();" style="float: right;">Students Awaiting Approval</button>
                    </div>`;
            }

            students_list.innerHTML = sr;

            // append pending student list
            res_body = '', sr = '';
            if (students_moving.length > 0) {
                let m = 0;
                for (var i = 0; i < students_moving.length; i++) {
                    console.log(students_moving[i]['destination_id']);

                    if (students_moving[i]['destination_id'] != 0) {
                        m ++;
                        res_body += 
                            `<tr>
                                <td>`+ (m + 1) +`</td>
                                <td>`+ students_moving[i]['adm_no'] +`</td>
                                <td>`+ students_moving[i]['name'] +`</td>
                                <td>`+ students_moving[i]['destination_form_id'] +`</td>
                                <td>`+ students_moving[i]['destination_stream'] +`</td>
                                <td><button class="btn btn-success" type="button" onclick="cancelRequest(`+ students_moving[i]['id'] +`, this);">Cancel Request</button></td>
                            </tr>`;
                    }
                    
                }
                if (m > 0) {
                    sr = 
                    `<div class="row"><h5 class="ml-2">Pending Transfer Request</h6></div>
                    <table class="table datatable-button-html5-columns">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Admno</th>
                                <th>Name</th>
                                <th>Destination Form</th>
                                <th>Destination Stream</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>                            
                            `+ res_body +`
                        </tbody>
                    </table>`;
                    pending_student_list.innerHTML = sr;
                } else {
                    pending_student_list.classList.add('hide');
                }
            }
            // set destination stream
            setDestinationStream();
            return;
            
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
        
    });
    
    function startMoving() {        

        // replace buttons
        document.querySelector('.buttons1').classList.add('hide');
        document.querySelector('.buttons2').classList.remove('hide');

        // show all check button 
        check_all_btns = document.querySelectorAll('.check-btn');
        
        for(i = 0; i < check_all_btns.length; i++) {
            check_all_btns[i].classList.remove('hide');
        }
        // show destination pane
        destination_class_pane.classList.remove('hide');
        // show submit button
        moveSubmitBtn.classList.remove('hide');

        // set destination stream
        setDestinationStream();
    }

    function setDestinationStream() {
        console.log('setDestinationStream function called');

        let destination_form = document.querySelector('#destination-form');
        var destination_form_id = destination_form.options[destination_form.selectedIndex].value;
        console.log('origin_form_id = ' + origin_form_id)
        console.log('origin_stream = ' + origin_stream);
        console.log('destination_form_id = ' + destination_form_id);
        let form1 = new FormData();   
         
        form1.append("destination_form_id", destination_form_id);
        form1.append("origin_form_id", origin_form_id);
        form1.append("origin_stream", origin_stream);
        
        var ajaxOptions = {
            url:'getStream-about-form2',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form1,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){
            console.log(resp);
            let classes = resp.classes;            

            let div3 = '';
            for(let i = 0; i < classes.length; i++) {
                
                div3 += `<option value="`+ classes[i]['stream'] +`">` + classes[i]['stream'] + `</option>`;
                
            }
            
            destination_stream.innerHTML = '<option value="">Select Stream</option>' + div3;
            return;
            
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
    }

    function cancelMoving() {
        // replace buttons
        document.querySelector('.buttons2').classList.add('hide');
        document.querySelector('.buttons1').classList.remove('hide');

        // hide all check button 
        check_all_btns = document.querySelectorAll('.check-btn');
        
        for(i = 0; i < check_all_btns.length; i++) {
            check_all_btns[i].classList.add('hide');
        }
        // hide destination pane
        destination_class_pane.classList.add('hide');
        // hide submit button
        moveSubmitBtn.classList.add('hide');
    }
    function checkAll(myObj) {

        check_one_btns = document.querySelectorAll('.check-one');
        if (myObj.checked) {
            for(let i = 0; i < check_one_btns.length; i++) {
                check_one_btns[i].checked = true;
            }
        } else {            
            for(let i = 0; i < check_one_btns.length; i++) {
                check_one_btns[i].checked = false;
            }
        }        
    }


    $("#destination-form").on('change', function(e) {
        e.preventDefault();

        setDestinationStream();
    });

    
    $('form.ajax-move-student').on('submit', function(e) {
        e.preventDefault();

        let form = $(this);
        let origin_form = document.querySelector('#origin-form');
        let origin_stream = document.querySelector('#origin-stream');
        let destination_form = document.querySelector('#destination-form');
        let destination_stream = document.querySelector('#destination-stream');
        
        var origin_form_value = origin_form.options[origin_form.selectedIndex].value;
        var origin_stream_value = origin_stream.options[origin_stream.selectedIndex].value;
        var destination_form_value = destination_form.options[destination_form.selectedIndex].value;
        var destination_stream_value = destination_stream.options[destination_stream.selectedIndex].value;

        Swal.fire({
            title: "Move Students!",
            text: "Are you sure you'd to transfer the selected students to Form " + origin_form_value + " " + origin_stream_value,
            showCancelButton: false,
            confirmButtonColor: 'blue',
            confirmButtonText: "Okay",
        }).then((result) => {
            if (result.isConfirmed) {
                
                var btn = form.find('button[type=submit]');
                disableBtn(btn);

                var inputs = $(this).find('input[type=checkbox]');    
                var students_to_move = [];
                for(var i = 0; i < inputs.length; i++) {

                    students_to_move.push({'id': inputs[i].value, 'check_status': inputs[i].checked});
                }

                let form1 = new FormData();    
                form1.append("origin_form_value", origin_form_value);
                form1.append("origin_stream_value", origin_stream_value);
                form1.append("destination_form_value", destination_form_value);
                form1.append("destination_stream_value", destination_stream_value);
                form1.append("students_to_move", JSON.stringify(students_to_move));

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
                    console.log('======================');
                    console.log(resp);
                    // replace buttons
                    // hide all check button & destination pane  & submit button
                    cancelMoving();
                    let students_pending = resp.students_pending;

                    // checkbox set uncheck
                    
                    check_one_btns = document.querySelectorAll('.check-one');
                
                    for(let i = 0; i < check_one_btns.length; i++) {
                        check_one_btns[i].checked = false;
                    }
        
                    // append pending student list
                    pending_student_list.classList.remove('hide');
                    let res_body = '', sr = '';
                    if (students_pending.length > 0) {
                        let m = 0;
                        for (var i = 0; i < students_pending.length; i++) {
                            console.log(students_pending[i]['destination_id']);

                            if (students_pending[i]['destination_id'] != 0) {
                                m ++;
                                res_body += 
                                    `<tr>
                                        <td>`+ (m + 1) +`</td>
                                        <td>`+ students_pending[i]['adm_no'] +`</td>
                                        <td>`+ students_pending[i]['name'] +`</td>
                                        <td>`+ students_pending[i]['destination_form_id'] +`</td>
                                        <td>`+ students_pending[i]['destination_stream'] +`</td>
                                        <td><button class="btn btn-success" type="button" onclick="cancelRequest(`+ students_pending[i]['id'] +`, this);">Cancel Request</button></td>
                                    </tr>`;
                            }
                            
                        }
                        if (m > 0) {
                            sr = 
                            `<div class="row"><h5 class="ml-2">Pending Transfer Request</h6></div>
                            <table class="table datatable-button-html5-columns">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Admno</th>
                                        <th>Name</th>
                                        <th>Destination Form</th>
                                        <th>Destination Stream</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>                            
                                    `+ res_body +`
                                </tbody>
                            </table>`;
                        }
                        
                        pending_student_list.innerHTML = sr;
                    }

                    resp.ok && resp.msg
                    ? flash({msg:resp.msg, type:'success'})
                    : flash({msg:resp.msg, type:'danger'});
                    hideAjaxAlert();
                    enableBtn(btn);
                    return resp;
                });
                req.fail(function(e){
                    if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                    if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                    if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
                    return e.status;
                });
            }
        });
    });

    function cancelRequest(id, myObj) {
        console.log(myObj)
        console.log(myObj.parentNode)
        let hide_bool = false;
        if (myObj.parentNode.parentNode.parentNode.children.length == 1) {
            hide_bool = true;
        }
        Swal.fire({
            title: "Move Students!",
            text: "Are you sure you'd like to cancel this transfer request",
            showCancelButton: false,
            confirmButtonColor: 'blue',
            confirmButtonText: "Okay",
        }).then((result) => {
            if (result.isConfirmed) {

                var tr2 = myObj.parentNode.parentNode;
                let form1 = new FormData();    
                form1.append("id", id);

                var ajaxOptions = {
                    url:'cancel-request-for-moving',
                    type:'POST',
                    cache:false,
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    data:form1
                };
                var req = $.ajax(ajaxOptions);
                req.done(function(resp){
                    console.log(resp); 
                    tr2.remove();
                    if (hide_bool == true){
                        pending_student_list.classList.add('hide');                        
                        document.querySelector('.approving-table').classList.add('hide');
                    } 
                    resp.ok && resp.msg
                    ? flash({msg:resp.msg, type:'success'})
                    : flash({msg:resp.msg, type:'danger'});
                    hideAjaxAlert();
                    return resp;
                });
                req.fail(function(e){
                    if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                    if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                    if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
                    return e.status;
                });
            }
        });
    }

    function showApproving() {
        console.log('=========== showApproving ============')
        students_list.classList.add('hide');
        pending_student_list.classList.add('hide');
        approve_student_list.classList.remove('hide');
        console.log(origin_form_id);
        console.log(origin_stream);

        let form1 = new FormData();    
        form1.append("origin_form_id", origin_form_id);
        form1.append("origin_stream", origin_stream);
        var ajaxOptions = {
            url:'getStudent-for-approving',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form1,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){
            console.log(resp);
            let approving_students = resp.approving_students;
            console.log(approving_students);

            let res_body = '', sr = '';
            if (approving_students.length > 0) {
                
                for (var i = 0; i < approving_students.length; i++) {
                    
                    res_body += 
                        `<tr>
                            <td>`+ (i+1) +`</td>
                            <td>`+ approving_students[i]['adm_no'] +`</td>
                            <td>`+ approving_students[i]['name'] +`</td>
                            <td>`+ approving_students[i]['current_form_id'] +`</td>
                            <td>`+ approving_students[i]['current_stream'] +`</td>
                            <td><button class="btn btn-info" type="button" onclick="cancelRequest(`+ approving_students[i]['id'] +`, this);">Reject</button></td>
                            <td><button class="btn btn-success" type="button" onclick="acceptRequest(`+ approving_students[i]['id'] +`, this);">Accept</button></td>
                        </tr>`;
                }
            
                sr = 
                `<div class="row justify-content-between">
                    <h5 class="ml-2">Students Awaiting Approval</h5>
                    <button type="button" class="btn btn-info buttons3" style="float: right;" onclick="hideApproving();">Back</button>
                </div>
                <table class="table datatable-button-html5-columns approving-table" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Admno</th>
                            <th>Name</th>
                            <th>Current Form</th>
                            <th>Current Stream</th>
                            <th>Reject</th>
                            <th>Accept</th>
                        </tr>
                    </thead>
                    <tbody>                            
                        `+ res_body +`
                    </tbody>
                </table>
                <div class="row justify-content-between reject-accept-all">                    
                    <button type="button" class="btn btn-info" style="float: right;" onclick="RejectAll();">Reject All</button>
                    <button type="button" class="btn btn-success" style="float: right;" onclick="AcceptAll();">Accept All</button>
                </div>`;
                
            } else {
                sr = `<div class="row justify-content-between">
                        <h5 class="ml-2">Students Awaiting Approval</h5>
                        <button type="button" class="btn btn-info buttons3" style="float: right;" onclick="hideApproving();">Back</button>
                    </div>
                    <h3>No students are awaiting your approval</h3>`;
            }
            approve_student_list.innerHTML = sr;
            return;
            
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
        

        console.log('=========== showApproving ============')
        
    }

    function hideApproving() {
        console.log('=========== hideApproving ============')
        console.log(origin_form_id);
        console.log(origin_stream);

        if (origin_stream == '') {
            // disappear student list & destination class pane & submit button
            students_list.innerHTML = '';
            moveSubmitBtn.classList.add('hide');
            return;
        }

        let form1 = new FormData();    
        form1.append("formId", origin_form_id);
        form1.append("stream", origin_stream);

        var ajaxOptions = {
            url:'getStudent-for-moving',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form1,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){

            let students_moving = resp.students_moving;            
            // show student list & pending student list
            students_list.classList.remove('hide');
            pending_student_list.classList.remove('hide');
            // hide approve student list
            approve_student_list.classList.add('hide');
            // append student list
            var res_body = '', sr = '';
            if (students_moving.length > 0) {
                for (var i = 0; i < students_moving.length; i++) {
                    
                    res_body += 
                        `<tr>
                            <td>`+ (i+1) +`</td>
                            <td>`+ students_moving[i]['adm_no'] +`</td>
                            <td>`+ students_moving[i]['name'] +`</td>                         
                            <td class="check-btn hide"><input type="checkbox" value="`+ students_moving[i]['id'] +`" class="check-one lg-check" /></td>
                        </tr>`;
                }
            
                sr = 
                    `<div class="buttons1">
                        <button type="button" class="btn btn-info ml-2" onclick="startMoving();" style="float: right;">Select Student To Move</button>
                        <button type="button" class="btn btn-success" onclick="showApproving();" style="float: right;">Students Awaiting Approval</button>
                    </div>
                    <button type="button" class="btn btn-info buttons2 hide" style="float: right;" onclick="cancelMoving();">Cancel Move</button>                    
                    <table class="table datatable-button-html5-columns">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Admno</th>
                                <th>Name</th>
                                <th class="check-btn hide"><input class="lg-check" type="checkbox" value="0" onclick="checkAll(this);" id="check-all" /></th>
                            </tr>
                        </thead>
                        <tbody>                            
                            `+ res_body +`
                        </tbody>
                    </table>`;
            } else {
                sr = 
                    `<h6>Search Result</h6>
                    <h3>No Student Matched</h3>
                    <div class="buttons1">
                        <button type="button" class="btn btn-success" onclick="showApproving();" style="float: right;">Students Awaiting Approval</button>
                    </div>`;
            }

            students_list.innerHTML = sr;

            // append pending student list
            res_body = '', sr = '';
            if (students_moving.length > 0) {
                let m = 0;
                for (var i = 0; i < students_moving.length; i++) {
                    console.log(students_moving[i]['destination_id']);

                    if (students_moving[i]['destination_id'] != 0) {
                        m ++;
                        res_body += 
                            `<tr>
                                <td>`+ (m + 1) +`</td>
                                <td>`+ students_moving[i]['adm_no'] +`</td>
                                <td>`+ students_moving[i]['name'] +`</td>
                                <td>`+ students_moving[i]['destination_form_id'] +`</td>
                                <td>`+ students_moving[i]['destination_stream'] +`</td>
                                <td><button class="btn btn-success" type="button" onclick="cancelRequest(`+ students_moving[i]['id'] +`, this);">Cancel Request</button></td>
                            </tr>`;
                    }
                    
                }
                if (m > 0) {
                    sr = 
                    `<div class="row"><h5 class="ml-2">Pending Transfer Request</h6></div>
                    <table class="table datatable-button-html5-columns">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Admno</th>
                                <th>Name</th>
                                <th>Destination Form</th>
                                <th>Destination Stream</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>                            
                            `+ res_body +`
                        </tbody>
                    </table>`;
                    pending_student_list.innerHTML = sr;
                } else {
                    pending_student_list.classList.add('hide');
                }
            }
            // set destination stream
            setDestinationStream();
            return;
            
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });

        console.log('=========== hideApproving ============')
    }

    function acceptRequest(id, myObj) {
        console.log(myObj)
        console.log(myObj.parentNode)
        let hide_bool = false;
        if (myObj.parentNode.parentNode.parentNode.children.length == 1) {
            hide_bool = true;
        }
        Swal.fire({
            title: "Move Students!",
            text: "Are you sure you'd like to cancel this transfer request",
            showCancelButton: false,
            confirmButtonColor: 'blue',
            confirmButtonText: "Okay",
        }).then((result) => {
            if (result.isConfirmed) {

                var tr2 = myObj.parentNode.parentNode;
                let form1 = new FormData();    
                form1.append("id", id);

                var ajaxOptions = {
                    url:'accept-request-for-moving',
                    type:'POST',
                    cache:false,
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    data:form1
                };
                var req = $.ajax(ajaxOptions);
                req.done(function(resp){
                    console.log(resp); 
                    tr2.remove();

                    if (hide_bool == true) {
                        document.querySelector('.approving-table').classList.add('hide');
                    }
                    resp.ok && resp.msg
                    ? flash({msg:resp.msg, type:'success'})
                    : flash({msg:resp.msg, type:'danger'});
                    hideAjaxAlert();
                    return resp;
                });
                req.fail(function(e){
                    if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                    if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                    if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
                    return e.status;
                });
            }
        });
    }

    function RejectAll() {
        console.log('Reject All');
        console.log(origin_form_id);
        console.log(origin_stream);

        let form1 = new FormData();    
        form1.append("origin_form_id", origin_form_id);   
        form1.append("origin_stream", origin_stream);

        var ajaxOptions = {
            url:'reject-all',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:form1
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log(resp);             
            document.querySelector('.approving-table').classList.add('hide');
            document.querySelector('.reject-accept-all').classList.add('hide');
            resp.ok && resp.msg
            ? flash({msg:resp.msg, type:'success'})
            : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
    }

    function AcceptAll() {
        console.log('Accept All');
        console.log(origin_form_id);
        console.log(origin_stream);

        let form1 = new FormData();    
        form1.append("origin_form_id", origin_form_id);   
        form1.append("origin_stream", origin_stream);

        var ajaxOptions = {
            url:'accept-all',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:form1
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log(resp); 
            document.querySelector('.approving-table').classList.add('hide');
            document.querySelector('.reject-accept-all').classList.add('hide');
            resp.ok && resp.msg
            ? flash({msg:resp.msg, type:'success'})
            : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
    }

    // Residences of Students
    const residences_list = document.querySelector('.residences-list');
    const residence_table = document.querySelector('.residence_table');
    const table_residences_list = document.querySelector('.table-residences-list');
    const residences_empty = document.querySelector('.residences-empty');
    
    const residences_editing = document.querySelector('.residences-editing');
    const table_residences_editing  = document.querySelector('.table-residences-editing');

    let tbody_len = 0;
    function editingResidences() {
        
        console.log('======   editingResidences =================')
        residences_editing.classList.remove('hide');
        residences_list.classList.add('hide');
        var ajaxOptions = {
            url:'get-residences',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:'',
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log('======= residences ===============');
            console.log(resp);
            let residences = resp.residences;
            tbody_len = residences.length;

            let j, tbody = '';
            for(j = 0; j < residences.length; j++) {
                tbody += `<tr>
                            <td> `+ (j+1) +`</td>
                            <td>
                                `+ residences[j]['name'] +`
                            </td>
                            <td>
                            </td>
                        </tr>`;
            }

            tbody += `<tr>
                        <td>`+ (j+1) +`</td>
                        <td>
                            <input class="editing_input" type="text" id="residence-name" name="residence-name" />
                        </td>
                        <td>
                            <a class="btn" title="Plus" onclick="addRow(this);">
                                <p class="plus">+</p>
                            </a>
                        </td>
                    </tr>`;
            table_residences_editing.innerHTML = tbody;
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
        
        
    }

    function showResidences() {
        residences_editing.classList.add('hide');
        residences_list.classList.remove('hide');
        var ajaxOptions = {
            url:'get-residences',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:'',
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log('======= residences ===============');
            console.log(resp);
            let residences = resp.residences;
            tbody_len = residences.length;             

            if (residences.length > 0) {

                let j, tbody = '', plus_div = '';
                residence_table.classList.remove('hide');
                residences_empty.classList.add('hide');   

                for(j = 0; j < residences.length; j++) {
                    if (j == (residences.length - 1)) {
                        plus_div = `<a class="btn" title="Edit" onclick="editingResidences();">
                                        <p class="plus">+</p>
                                    </a>`;
                    }
                    tbody += `<tr>
                                <td> `+ (j+1) +`</td>
                                <td>`+ residences[j]['name'] +`</td>
                                <td>
                                    <a class="btn" title="Delete" onclick="editRow('`+ residences[j]['id'] +`', this)">
                                        <img src="/global_assets/images/icon/edit.png" width="20" height="20"/>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn" title="Delete" onclick="deleteRow('`+ residences[j]['id'] +`', this)">
                                        <img src="/global_assets/images/icon/delete.png" width="20" height="20"/>
                                    </a>
                                    `+ plus_div +`
                                </td>
                                <td style="display: none;">`+ residences[j]['id'] +`</td>
                            </tr>`;
            

                    table_residences_list.innerHTML = tbody;
                }
            } else {
                
                residence_table.classList.add('hide');
                residences_empty.classList.remove('hide');
            }
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
    }


    function addRow(myObj) {
        myObj.parentNode.innerHTML = `<a class="btn" title="Delete" onclick="removeRow(this);">
                                        <img src="/global_assets/images/icon/delete.png" width="20" height="20"/>
                                    </a>`;
                                                
        tbody_len ++;
        let table_residences_editing = $('.table-residences-editing');
        table_residences_editing.append(`<tr>
                                            <td>`+ (tbody_len + 1) +`</td>
                                            <td>
                                                <input class="editing_input" type="text" id="residence-name" name="residence-name" />
                                            </td>
                                            <td>
                                                <a class="btn" title="Add" onclick="addRow(this);">
                                                    <p class="plus">+</p>
                                                </a>
                                            </td>
                                        </tr>`);
        
    }

    function removeRow(myObj) {
        tbody_len --;
        myObj.parentNode.parentNode.remove();
        // resort No
        let trs = table_residences_editing.children;
        for(let k = 0; k < trs.length; k++) {
            
            trs[k].children[0].innerHTML = k + 1;
        }
    }

    var origin_name, editing_status = false, editing_id, editing_rid;

    function editRow(id, myObj) {

        if (editing_status == true) {

            table_residences_list.children[editing_id].children[1].innerHTML = origin_name;
            table_residences_list.children[editing_id].children[2].innerHTML = `<a class="btn" title="Edit" onclick="editRow(`+ editing_rid +` ,this)">
                                                                                    <img src="/global_assets/images/icon/edit.png" width="20" height="20"/>
                                                                                </a>`
            editing_status = false;
        }


        let div3 = myObj.parentNode;
        div3.innerHTML =`<a class="btn" title="Delete" onclick="saveEditing(`+ id +` ,this)">
                            <img src="/global_assets/images/icon/save.png" width="20" height="20"/>
                        </a>
                        <a class="btn" title="Delete" onclick="cancelEditing(`+ id +` ,this)">
                            <img src="/global_assets/images/icon/cancel.png" width="20" height="20"/>
                        </a>`;
        let div4 = div3.parentNode;        
        let inputdiv = div4.children[1];
        origin_name = inputdiv.innerHTML;
        inputdiv.innerHTML = `<input type="text" class="editing-input" value="`+ origin_name +`" />`;
        editing_status = true;
        editing_id = parseInt(div4.children[0].innerHTML) - 1;
        editing_rid = id;
    }

    function cancelEditing(id, myObj) {
        
        let div3 = myObj.parentNode;
        div3.innerHTML =`<a class="btn" title="Edit" onclick="editRow(`+ id +` ,this)">
                            <img src="/global_assets/images/icon/edit.png" width="20" height="20"/>
                        </a>`;
        let div4 = div3.parentNode;
        let inputdiv = div4.children[1];
        inputdiv.innerHTML = origin_name;
        editing_status = false;
    }

    function saveEditing(id, myObj) {
        console.log(id)
        console.log(myObj)
        let tra = myObj.parentNode.parentNode;
        let updated_name = tra.children[1].children[0].value;
        let form1 = new FormData();    
        form1.append("id", id);    
        form1.append("updated_name", updated_name);  

        var ajaxOptions = {
            url:'update-residence',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:form1
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log(resp); 

            let div3 = myObj.parentNode;
            div3.innerHTML =`<a class="btn" title="Edit" onclick="editRow(`+ id +` ,this)">
                                <img src="/global_assets/images/icon/edit.png" width="20" height="20"/>
                            </a>`;
            let div4 = div3.parentNode;
            let inputdiv = div4.children[1];
            inputdiv.innerHTML = updated_name;
            editing_status = false;

            
            resp.ok && resp.msg
            ? flash({msg:resp.msg, type:'success'})
            : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
    }
    
    function deleteRow(id, myObj) {
        
        Swal.fire({
            title: "Delete Residence!",
            text: "Are you sure you'd like to delete this residence",
            showCancelButton: false,
            confirmButtonColor: 'blue',
            confirmButtonText: "Okay",
        }).then((result) => {
            if (result.isConfirmed) { 
                
                let form1 = new FormData();    
                form1.append("id", id);  

                var ajaxOptions = {
                    url:'delete-residence',
                    type:'POST',
                    cache:false,
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    data:form1
                };
                var req = $.ajax(ajaxOptions);
                req.done(function(resp){
                    console.log(resp); 
                    showResidences();
                    resp.ok && resp.msg
                    ? flash({msg:resp.msg, type:'success'})
                    : flash({msg:resp.msg, type:'danger'});
                    hideAjaxAlert();
                    return resp;
                });
                req.fail(function(e){
                    if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                    if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                    if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
                    return e.status;
                });
            }
        });
    }

    $('form.ajax-create-residences').on('submit', function(e) {
        e.preventDefault(); 
        let form = $(this);
        var btn = form.find('button[type=submit]');
        disableBtn(btn);

        var inputs = $(this).find('input[class=editing_input]');    
        console.log(inputs);
        
        var residences = [];
        for(var i = 0; i < inputs.length; i++) {
            console.log(inputs[i].value);
            residences.push({'id': (i + 1),  'value': inputs[i].value});
        }
        let form1 = new FormData();    
        form1.append("residences", JSON.stringify(residences));

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
            showResidences();
            resp.ok && resp.msg
            ? flash({msg:resp.msg, type:'success'})
            : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            enableBtn(btn);
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
    });

    function submitFileImport(myObj) {
        
        console.log('submitFileImport');
        document.getElementById('profile-form').submit();return;
        let form1 = new FormData();    
        form1.append("profile", $(myObj).prop("files")[0]);
        
        var ajaxOptions = {
            url:'file-import2',
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
            
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}            
            return e.status;
        });
    }

    // Profile Photo(Avatar) multi upload
    
    var profile_photos_form_submit = document.querySelector('#submit-profile-photo');       // submit button
    var prepaired_files_show_pane = document.querySelector('#prepaired_files_show_pane');   //append element pane
    var photo_name_after = document.querySelector('#photo_name_after');  // select       
    var profile_photos = document.querySelector('#profile-photos');     // multi input

    function multiPhotoPrepaired() {
        console.log('multiPhotoPrepaired function called');


        let prepared_files = profile_photos.files;
        let res_body = '';
        for(let i = 0; i < prepared_files.length; i++) {
            // console.log(prepared_files[i]['name']);
            // console.log(prepared_files[i]['size']);
            // console.log(prepared_files[i]['type']);
            res_body += `<tr><td>` + (i + 1) + `</td><td>` + prepared_files[i]['name'] + `</td><td>` +  (prepared_files[i]['size'] /1024) + ` KB</td><td>`    +    prepared_files[i]['type'] + `</td></tr>`;
        }
        let buff_element = `<table class="table datatable-button-html5-columns">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Type</th>
                        </tr>
                        </thead>
                        <tbody>
                            `+ res_body +`
                        </tbody>
                    </table>`;
        prepaired_files_show_pane.innerHTML = buff_element;
        profile_photos_form_submit.classList.remove('hide');
    }
    
</script>