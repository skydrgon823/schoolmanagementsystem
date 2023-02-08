<script>

//add headers to all the ajax requests
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
    function getLGA(state_id){
        var url = '{{ route('get_lga', [':id']) }}';
        url = url.replace(':id', state_id);
        var lga = $('#lga_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                //console.log(resp);
                lga.empty();
                $.each(resp, function (i, data) {
                    lga.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }

    function getClassSections(class_id, destination){
        var url = '{{ route('get_class_sections', [':id']) }}';
        url = url.replace(':id', class_id);
        var section = destination ? $(destination) : $('#section_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                //console.log(resp);
                section.empty();
                $.each(resp, function (i, data) {
                    section.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }

    function getClassSubjects(class_id){
        var url = '{{ route('get_class_subjects', [':id']) }}';
        url = url.replace(':id', class_id);
        var section = $('#section_id');
        var subject = $('#subject_id');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                console.log(resp);
                section.empty();
                subject.empty();
                $.each(resp.sections, function (i, data) {
                    section.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });
                $.each(resp.subjects, function (i, data) {
                    subject.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });

            }
        })
    }


    {{--Notifications--}}

    @if (session('pop_error'))
    pop({msg : '{{ session('pop_error') }}', type : 'error'});
    @endif

    @if (session('pop_warning'))
    pop({msg : '{{ session('pop_warning') }}', type : 'warning'});
    @endif

 @if (session('pop_success'))
    pop({msg : '{{ session('pop_success') }}', type : 'success', title: 'GREAT!!'});
    @endif

    @if (session('flash_info'))
      flash({msg : '{{ session('flash_info') }}', type : 'info'});
    @endif

    @if (session('flash_success'))
      flash({msg : '{{ session('flash_success') }}', type : 'success'});
    @endif

    @if (session('flash_warning'))
      flash({msg : '{{ session('flash_warning') }}', type : 'warning'});
    @endif

     @if (session('flash_error') || session('flash_danger'))
      flash({msg : '{{ session('flash_error') ?: session('flash_danger') }}', type : 'danger'});
    @endif

    {{--End Notifications--}}

    function pop(data){
        swal({
            title: data.title ? data.title : 'Oops...',
            text: data.msg,
            icon: data.type
        });
    }

    function flash(data){
        new PNotify({
            text: data.msg,
            type: data.type,
            hide : data.type !== "danger"
        });
    }

    function confirmDelete(id) {

        Swal.fire({
            title: "Warning",
            text: "Once deleted, you will not be able to recover this item!",
            showCancelButton: false,
            confirmButtonColor: 'blue',
            confirmButtonText: "Okay",
        }).then((result) => {
            if (result.isConfirmed) {
                $('form#item-delete-'+id).submit();
            }
        });
    }
    function confirmCreate(id, name, type, old) {
        // alert(name);
        // $('#circle'+id).css('border-color', 'red');
        $('#circle'+id).css('border-color', 'green');
        Swal.fire({
            title: type!=4? "Make Admin Rights!" : "Revoke Admin Rights!",
            text: type!=4? `Are you you'd like to make ` + name +  ` a admin?` : old==3 ? `Are you sure you'd like to remove admin rights from teacher ` + name : old==1 ?`Are you sure you'd like to remove admin rights from staff ` + name : `Are you sure you'd like to remove admin rights from student ` + name,
            confirmButtonColor: 'green',
            confirmButtonText: "Okay",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // $('form#item-create-'+id).submit();
                let form = new FormData();
                form.append("form_id", id);
                if(type !=4){
                    form.append("user_type_id", 4);
                }else{
                    form.append("user_type_id", old);
                }
                var ajaxOptions = {
                    url: 'setAdmin',
                    type: 'POST',
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    data: form,
                }
                var req = $.ajax(ajaxOptions);
                req.done(function(res){
                    window.location.reload();

                    return res;
                }).fail(function(e){
                    return e.status;
                })
            }
        });
    }
    function confirmReset(id) {
        swal({
            title: "Are you sure?",
            text: "This will reset this item to default state",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(function(willDelete){
            if (willDelete) {
             $('form#item-reset-'+id).submit();
            }
        });
    }

    $('form#ajax-reg').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');
        $('#ajax-reg-t-0').get(0).click();
    });

    $('form.ajax-pay').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');

//        Retrieve IDS
        var form_id = $(this).attr('id');
        var td_amt = $('td#amt-'+form_id);
        var td_amt_paid = $('td#amt_paid-'+form_id);
        var td_bal = $('td#bal-'+form_id);
        var input = $('#val-'+form_id);

        // Get Values
        var amt = parseInt(td_amt.data('amount'));
        var amt_paid = parseInt(td_amt_paid.data('amount'));
        var amt_input = parseInt(input.val());

//        Update Values
        amt_paid = amt_paid + amt_input;
        var bal = amt - amt_paid;

        td_bal.text(''+bal);
        td_amt_paid.text(''+amt_paid).data('amount', ''+amt_paid);
        input.attr('max', bal);
        bal < 1 ? $('#'+form_id).fadeOut('slow').remove() : '';
    });

    $('form.ajax-store').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this), 'store');
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    $('form.ajax-update').on('submit', function(ev){
        ev.preventDefault();
        submitForm($(this));
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    $('form.ajax-update-class-subject').on('submit', function(ev){
        ev.preventDefault();
        submitForm_update($(this));
        var div = $(this).data('reload');
        div ? reloadDiv(div) : '';
    });

    $('.download-receipt').on('click', function(ev){
        ev.preventDefault();
        $.get($(this).attr('href'));
        flash({msg : '{{ 'Download in Progress' }}', type : 'info'});
    });

    function reloadDiv(div){
        var url = window.location.href;
        url = url + ' '+ div;
        $(div).load( url );
    }

    function submitForm_update(form, formType){

        var btn = form.find('button[type=submit]');
        disableBtn(btn);

        var inputs = form.find('input[type=checkbox]');
        var subject_list = [];
        for(var i = 0; i < inputs.length; i++) {

            subject_list.push({'id': inputs[i].value, 'check_status': inputs[i].checked});
        }

        let formd = new FormData(form[0]);
        formd.append("subject_list", JSON.stringify(subject_list));

        var ajaxOptions = {
            url:form.attr('action'),
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:formd
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log(resp);
            resp.ok && resp.msg
               ? flash({msg:resp.msg, type:'success'})
               : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            enableBtn(btn);
            formType == 'store' ? clearForm(form) : '';
            scrollTo('body');
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){
                var errors = e.responseJSON.errors;
                displayAjaxErr(errors);
            }
           if(e.status == 500){
               displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])
           }
            if(e.status == 404){
               displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])
           }
            enableBtn(btn);
            return e.status;
        });
    }

    function submitForm(form, formType){

        var btn = form.find('button[type=submit]');
        disableBtn(btn);

        var form_id = document.getElementById('form_id');
        var value = form_id.options[form_id.selectedIndex].value;

        var stream = document.getElementById('stream');
        var value1 = stream.value;

        var inputs = form.find('input[type=checkbox]');
        var subject_list = [];
        for(var i = 0; i < inputs.length; i++) {

            subject_list.push({'id': inputs[i].value, 'check_status': inputs[i].checked});

        }
        let form1 = new FormData();
        form1.append("form_id", value);
        form1.append("stream", value1);
        form1.append("subject_list", JSON.stringify(subject_list));
        var ajaxOptions = {
            url:form.attr('action'),
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
            resp.ok && resp.msg
               ? flash({msg:resp.msg, type:'success'})
               : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            enableBtn(btn);
            formType == 'store' ? clearForm(form) : '';
            scrollTo('body');
            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){
                var errors = e.responseJSON.errors;
                displayAjaxErr(errors);
            }
           if(e.status == 500){
               displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])
           }
            if(e.status == 404){
               displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])
           }
            enableBtn(btn);
            return e.status;
        });
    }

    function showErrorAlert(message) {
        Swal.fire({
            icon: "error",
            text: message || "An error occurred, please try again.",
            showConfirmButton: false,
            timer: 1500,
        });
    }

    function disableBtn(btn){
        var btnText = btn.data('text') ? btn.data('text') : 'Submitting';
        btn.prop('disabled', true).html('<i class="icon-spinner mr-2 spinner"></i>' + btnText);
    }

    function enableBtn(btn){
        var btnText = btn.data('text') ? btn.data('text') : 'Submit Form';
        btn.prop('disabled', false).html(btnText + '<i class="icon-paperplane ml-2"></i>');
    }

    function displayAjaxErr(errors){
        $('#ajax-alert').show().html(' <div class="alert alert-danger border-0 alert-dismissible" id="ajax-msg"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>');
        $.each(errors, function(k, v){
            $('#ajax-msg').append('<span><i class="icon-arrow-right5"></i> '+ v +'</span><br/>');
        });
        scrollTo('body');
    }

    function scrollTo(el){
        // $('html, body').animate({
        //     scrollTop:$(el).offset();
        // }, 2000);
    }

    function hideAjaxAlert(){
        $('#ajax-alert').hide();
    }

    function clearForm(form){
        form.find('.select, .select-search').val([]).select2({ placeholder: 'Select...'});
        form[0].reset();
    }
    // $("#removeMessage").on('click', function(e) {
    //     e.preventDefault();
    //     let form = new FormData();
    //     form.append("formId", 1);
    //     var ajaxOptions = {
    //         url: "updateMessageAll",
    //         type: 'GET',
    //         cache: false,
    //         processData: false,
    //         dataType: 'json',
    //         contentType: false,
    //         data: form,
    //     }
    //     var req = $.ajax(ajaxOptions);
    //     req.done(function(resp){
    //         console.log(resp, 'ok');
    //         window.location.reload();
    //     }).fail(function(e){
    //         return e.status;
    //     })

    // });
    // function removeMessageAll(e){

    // }
</script>
