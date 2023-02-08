<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });


    var edit_status = false;
    var edit_tr_no = 0;
    var origin_group_name = '';

    function editingGroupName(groupName, myObj) {

        if (edit_status == true) {
            let tbody = myObj.parentNode.parentNode.parentNode.parentNode.children;
                let tr2 = tbody[edit_tr_no];
                let td2 = tr2.children[1];

                td2.innerHTML =
                    `<div class="d-flex align-items-center justify-content-start">
                        <p style="margin: 0;">`+ origin_group_name +`</p>
                        <a class="btn" title="Edit this user" onclick="editingGroupName('`+ origin_group_name +`', this);">
                            <img src="/global_assets/images/icon/edit.png" width="20" height="20"/>
                        </a>
                    </div>`;

        }

        let td1 = myObj.parentNode.parentNode;
        let tr1 = myObj.parentNode.parentNode.parentNode;
        let tchild = tr1.children;
        edit_tr_no = parseInt(tchild[0].innerHTML) - 1;

        edit_status = true;
        origin_group_name = groupName;

        let classId = parseInt(tchild[3].innerHTML);

        td1.innerHTML = `<div class="d-flex">
                            <input type="text" placeholder="Stream Name" style="width: 200px;" id="editing_class_stream" value="`+ groupName +`">
                            <button class="btn save-class-stream" style="padding: 6px;" onclick="updateGroupName(` + classId + `, this);">
                                <img src="/global_assets/images/icon/save.png" width="20" height="20"/>
                            </button>
                            <button class="btn cancel-class-stream" style="padding: 6px;" onclick="cancelGroupName(this);">
                                <img src="/global_assets/images/icon/cancel.png" width="20" height="20"/>
                            </button>
                        </div>`;

    }
    function updateGroupName(classId, myObj) {

        let ele = myObj.parentNode.children
        let updated_group_name = ele[0].value;

        let form2 = new FormData();
        form2.append("classId", classId);
        form2.append("updated_group_name", updated_group_name);
        var ajaxOptions = {
            url:'/teachers/update_group_name',
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
            myObj.parentNode.parentNode.innerHTML =
                `<div class="d-flex align-items-center justify-content-start">
                    <p style="margin: 0;">`+ updated_group_name +`</p>
                    <button class="btn btn-primary"  onclick="editingGroupName('`+ updated_group_name +`', this);">
                        <img src="/global_assets/images/icon/edit.png" width="20" height="20"/> &nbsp; Edit
                    </button>
                </div>`;
            edit_status = false;
            origin_group_name = updated_group_name;

            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        });
    }

    function cancelGroupName(myObj) {

        myObj.parentNode.parentNode.innerHTML =
            `<div class="d-flex align-items-center justify-content-start">
                <p style="margin: 0;">`+ origin_group_name +`</p>
                <a class="btn btn-primary" title="Edit this user" onclick="editingGroupName('`+ origin_group_name +`', this);">
                    <img src="/global_assets/images/icon/edit.png" width="20" height="20"/> Edit
                </a>
            </div>`;
        edit_status = false;
    }

    function deleteGroup(groupId, myObj) {

        Swal.fire({
            title: "Warning",
            text: "Once deleted, you will not be able to recover this item!",
            showCancelButton: false,
            confirmButtonColor: 'blue',
            confirmButtonText: "Okay",
        }).then((result) => {
            if (result.isConfirmed) {

                let tr3 = myObj.parentNode.parentNode.parentNode.parentNode;
                let form2 = new FormData();
                form2.append("groupId", groupId);
                var ajaxOptions = {
                    url:'/teachers/delete_group',
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
                    tr3.remove();
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
    }
</script>
