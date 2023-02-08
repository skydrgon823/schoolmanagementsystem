<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    // class teacher assign & delete
    function assignSubjectTeacher(classSubjectId, myObj) {
        console.log('=============');
        console.log(myObj);
        let td1 = myObj.parentNode;
        let tr1 = myObj.parentNode.parentNode;
        let tr2 = tr1.children[8]

        var teacher_id = myObj.options[myObj.selectedIndex].value;
        let form = new FormData();
        form.append("classSubjectId", classSubjectId);
        form.append("teacher_id", teacher_id);

        // console.log(classSubjectId);
        // console.log(teacher_id);
        // return;
        var ajaxOptions = {
            url:'/classes/assign_subject_teacher',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){
            console.log('====== ajax result ==========')
            console.log(resp);
            let teacher_name = resp.teacher_name;
            td1.innerHTML = `<div class="d-flex align-items-center justify-content-between">
                                <p style="margin: 0;">` + teacher_name + `</p>
                                <a class="btn" title="Delete this user" onclick="deleteSubjectTeacher(` + classSubjectId + `, this);">
                                    <img src="/global_assets/images/icon/delete.png" width="10" height="10"/>
                                </a>
                            </div>`;


            var url = '{{ route("students_taken_csubject", ":id") }}';
            url = url.replace(':id', classSubjectId);
            tr2.innerHTML = `<a class="btn btn-info" style="line-height: 7px;margin:0;font-size: 10px;height:auto" href="` + url + `" >Manage Subject</a>`;



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

    function deleteSubjectTeacher(classSubjectId, myObj) {

        let div1 = myObj.parentNode.parentNode;
        div1.parentNode.children[6].innerHTML = '';

        let form = new FormData();
        form.append("classSubjectId", classSubjectId);

        var ajaxOptions = {
            url:'/classes/delete_subject_teacher',
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
            div1.innerHTML = `<select required data-placeholder="Assign" class="form-control " onchange="assignSubjectTeacher(`+ classSubjectId +`, this)" data-id="`+ classSubjectId +`">
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

    // delete subject

    // delete class
    $(".delete_subject").on('click', function(e) {
        e.preventDefault();
        if (confirm("Are you sure you want to delete this subject?")) {

            let subjecttr = $(this);
            let myObj = this.parentNode.parentNode;
            let classSubjectId = subjecttr.data("id");
            let form = new FormData();
            form.append("classSubjectId", classSubjectId);
            var ajaxOptions = {
                url:'/classes/delete_subject',
                type:'POST',
                cache:false,
                processData:false,
                dataType:'json',
                contentType:false,
                data: form,
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
