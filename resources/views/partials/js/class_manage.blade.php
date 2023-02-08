<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    // class teacher assign & delete
    function assignClassTeacher(classId, myObj) {

        let td1 = myObj.parentNode;

        var teacher_id = myObj.options[myObj.selectedIndex].value;

        let form1 = new FormData();
        form1.append("classId", classId);
        form1.append("teacher_id", teacher_id);

        console.log(classId);
        console.log(teacher_id);

        var ajaxOptions = {
            url:'/classes/assign_class_teacher',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form1,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){

            let teacher_name = resp.teacher_name;
            td1.innerHTML = `<div class="d-flex align-items-center justify-content-between">
                                <p style="margin: 0;">` + teacher_name + `</p>
                                <button class="btn" style="background:transparent;line-height: 7px;margin:0;font-size: 10px;height:auto" title="Delete this user" onclick="deleteClassTeacher(` + classId + `, this);">
                                    <img src="/global_assets/images/icon/delete.png" width="10" height="10"/>
                                </button>
                            </div>`;

            resp.ok && resp.msg
               ? flash({msg:resp.msg, type:'success'})
               : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();

            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        });
    }

    function deleteClassTeacher(classId, myObj) {

        let div1 = myObj.parentNode.parentNode;
        let form = new FormData();
        form.append("classId", classId);

        var ajaxOptions = {
            url:'/classes/delete_class_teacher',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){

            let all_teachers = resp.all_teachers;
            let div2 = '';
            for(let i = 0; i < all_teachers.length; i++) {
                div2 += `<option value="` + all_teachers[i].id + `">` + all_teachers[i].name + `</option>`;
            }
            div1.innerHTML = `<select required data-placeholder="Assign" class="form-control " onchange="assignClassTeacher(`+ classId +`, this)" data-id="`+ classId +`">
                                                     <option value="">Assign</option>
                                                     ` + div2 + `
                                                  </select>`;
            resp.ok && resp.msg
               ? flash({msg:resp.msg, type:'success'})
               : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        });
    }

    // edit class stream
    var edit_status = false;
    var edit_tr_no = 0;
    var origin_class_stream = '';
    $(".edit_class_stream").on('click', function(e) {
        e.preventDefault();
        if (edit_status == true) {

            let tbody = this.parentNode.parentNode.parentNode;  // tbody

            var tchild = tbody.children;

            var editing_tr = tchild[edit_tr_no];
            var editing_td = editing_tr.children;   //td

            editing_td[2].innerHTML = origin_class_stream;
            edit_status = false;

        }


        let tr_ele = this.parentNode.parentNode;  // tr

        var div = tr_ele.children;

        origin_class_stream = div[2].innerHTML;


        let currentTD = $(div[0]);
        let classId = currentTD.data("id");

        div[2].innerHTML = `<div class="d-flex">
                                <input type="text" placeholder="Stream Name" style="width: 110px;" id="editing_class_stream" value="`+ origin_class_stream +`">
                                <button class="btn save-class-stream" style="padding: 6px;" onclick="updateClassStream(` + classId + `, this);">
                                    <img src="/global_assets/images/icon/save.png" width="20" height="20"/>Save
                                </button>
                                <button class="btn cancel-class-stream" style="padding: 6px;" onclick="cancelClassStream(` + classId + `, this);">
                                    <img src="/global_assets/images/icon/cancel.png" width="20" height="20"/>Cancel
                                </button>
                            </div>`;
        edit_status = true;
        edit_tr_no = div[0].innerHTML;

    });

    function updateClassStream(classId, myObj) {

        let updated_class_stream = $("#editing_class_stream").val();

        let form2 = new FormData();
        form2.append("classId", classId);
        form2.append("updated_class_stream", updated_class_stream);
        var ajaxOptions = {
            url:'/classes/update_class_stream',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form2,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){

            resp.ok && resp.msg ? flash({msg:resp.msg, type:'success'}) : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            myObj.parentNode.parentNode.innerHTML = updated_class_stream;
            origin_class_stream = updated_class_stream;
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        });
    }

    function cancelClassStream(classId, myObj) {

        myObj.parentNode.parentNode.innerHTML = origin_class_stream;
        edit_status = false;
    }

    // delete class
    $(".delete_class").on('click', function(e) {
        e.preventDefault();
        if (confirm("Are you sure you want to delete this class?")) {

            let classtr = $(this);
            let myObj = this.parentNode.parentNode;
            let classId = classtr.data("id");

            let form2 = new FormData();
            form2.append("classId", classId);
            var ajaxOptions = {
                url:'/classes/delete_class',
                type:'POST',
                cache:false,
                processData:false,
                dataType:'json',
                contentType:false,
                data: form2,
            };

            var req = $.ajax(ajaxOptions);

            req.done(function(resp){

                resp.ok && resp.msg ? flash({msg:resp.msg, type:'success'}) : flash({msg:resp.msg, type:'danger'});
                hideAjaxAlert();
                myObj.remove()
                return resp;
            });
            req.fail(function(e){
                if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
                return e.status;
            });
        }
    });

</script>
