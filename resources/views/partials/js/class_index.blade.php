<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });
    function deleteSupervisor(formId, myObj) {

        var div1 = myObj.parentNode.parentNode;

        let form1 = new FormData();
        form1.append("formId", formId);

        var ajaxOptions = {
            url:'/classes/delete_supervisor',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form1,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){

            let all_teachers = resp.all_teachers;
            let div2 = '';
            for(let i = 0; i < all_teachers.length; i++) {
                div2 += `<option value="` + all_teachers[i].id + `">` + all_teachers[i].name + `</option>`;
            }
            div1.innerHTML = `<select required data-placeholder="Assign" class="form-control " onchange="assignSupervisor(`+ formId +`, this)" data-id="`+ formId +`">
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
    function assignSupervisor(formId, myObj) {

        let td1 = myObj.parentNode;
        var teacher_id = myObj.options[myObj.selectedIndex].value;

        let form1 = new FormData();
        form1.append("formId", formId);
        form1.append("teacher_id", teacher_id);
        var ajaxOptions = {
            url:'/classes/assign_supervisor',
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
                                <button class="btn" style="background:transparent;line-height: 7px;margin:0;font-size: 10px;height:auto" title="Delete this user" onclick="deleteSupervisor(` + formId + `, this);">
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
    function showMyClass(){
        // alert('ok');
        // history.go('/classes');
    }
    function showRadio(myObj){
        var detail = document.querySelector('#detail');
        var detailContent = document.querySelector('#detail-content');
        var detailPrint = document.querySelector('#detail-print');
        if(myObj.value == "Custom"){
            detail.classList.remove('active-state');
            detailContent.classList.add('active-state');
            detailPrint.classList.add('active-state');
        }else{
            detail.classList.add('active-state');
            detailContent.classList.remove('active-state');
            detailPrint.classList.remove('active-state');
        }
    }
    function showPrint(){
        $('.basic').addClass('active-state');
        $('.print').removeClass('active-state');
    }
    function showManageTeacher(){
        $('.basic').removeClass('active-state');
        $('.print').addClass('active-state');
    }
    $("#example-search-input").on("keyup", function() {
        var count = $('.teacher_count').text();
        var value = $(this).val().toLowerCase();
        for (let index = 0; index < 18; index++) {
            var label = $('#item'+index).attr('aria-label')
            console.log(label.toLowerCase(), label.toLowerCase().indexOf(value) > -1)
            if(label.toLowerCase().indexOf(value) < 0){
                if(!$('#item'+index).hasClass('active-state')){
                    $('#item'+index).addClass('active-state')
                }
                // console.log($('#item'+index).hasClass('active-state'))
            }else{
                if($('#item'+index).hasClass('active-state')){
                    $('#item'+index).removeClass('active-state')
                }
            }

        }
    });
    function phoneCheck(){
        if ($('#phone').is(":checked"))
        {
            $('#phone').prop('checked', true);
            $('.phone').removeClass('active-state');
        }else{
            $('#phone').prop('checked', false);
            $('.phone').addClass('active-state');
        }

    }
    function emailCheck(){
        if ($('#username').is(":checked"))
        {
            $('#username').prop('checked', true);
            $('.email').removeClass('active-state');
        }else{
            $('#username').prop('checked', false);
            $('.email').addClass('active-state');
        }

    }
    function nationCheck(){
        if ($('#national').is(":checked"))
        {
            $('#national').prop('checked', true);
            $('.nation').removeClass('active-state');
        }else{
            $('#national').prop('checked', false);
            $('.nation').addClass('active-state');
        }

    }
    function genderCheck(){
        if ($('#gender').is(":checked"))
        {
            $('#gender').prop('checked', true);
            $('.gender').removeClass('active-state');
        }else{
            $('#gender').prop('checked', false);
            $('.gender').addClass('active-state');
        }

    }
    function tscCheck(){
        if ($('#tsc').is(":checked"))
        {
            $('#tsc').prop('checked', true);
            $('.tsc').removeClass('active-state');
        }else{
            $('#tsc').prop('checked', false);
            $('.tsc').addClass('active-state');
        }

    }
    function groupCheck(){
        if ($('#group').is(":checked"))
        {
            $('#group').prop('checked', true);
            $('.group').removeClass('active-state');
        }else{
            $('#group').prop('checked', false);
            $('.group').addClass('active-state');
        }

    }
    function fnExcelReport(){
        var tab_text = document.getElementById('printView').innerHTML;
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
        window.focus();
    }
    function fnPrintReport(e){
        e.preventDefault();
        var mywindow = window.open('', 'PRINT', 'height=800,width=1024');
        mywindow.document.write('<html><head><title>' + " "  + '</title>');
        // mywindow.document.write('<html><head><title>' + document.title  + '</title>');
        mywindow.document.write('</head><body >');
        // mywindow.document.write('<h1>' + document.title  + '</h1>');
        mywindow.document.write(document.getElementById('printView').innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        // mywindow.close();
        return true;
    }
    function checkListType(){
        if($('#listType').hasClass('active-state')){
            $('#listType').removeClass('active-state');
        }else{
            $('#listType').addClass('active-state');
        }

    }
    function checkClassType(){
        if($('#classType').hasClass('active-state')){
            $('#classType').removeClass('active-state');
        }else{
            $('#classType').addClass('active-state');
        }

    }
</script>
