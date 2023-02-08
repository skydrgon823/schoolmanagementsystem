<script>
    var flag = 0;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });
    $('.show-container').on('click', function(e){
        e.preventDefault();

        var sampleContainer = $('.sample-container');
        if(sampleContainer.hasClass('active-state')){
            $('.icofont-arrow-up').removeClass('active-state');
            $('.icofont-arrow-down').addClass('active-state');
            sampleContainer.removeClass('active-state');
            this.innerText = "Hide Sample";

        }else{
            $('.icofont-arrow-up').addClass('active-state');
            $('.icofont-arrow-down').removeClass('active-state');
            sampleContainer.addClass('active-state');
            this.innerText = "Show Sample";

        }
    })

    $('.auto-fill').on('click', function(e){
        e.preventDefault();
        $('input[type=number]').css('border-color', '');
        Swal.fire({
                title: "Notice",
                text: "This will overwrite change made in the form above. Are you sure you want to continue?",
                confirmButtonColor: 'green',
                confirmButtonText: "Ok",
                showCancelButton: true,
            }).then((res)=>{
                let sampleCount = Number($('.sample')[0].innerText);
                for (let index = 1; index < sampleCount + 1; index++) {
                    console.log($('.exam-grade-high1')[0].innerText);
                    console.log(index);

                    $('#exam-grade-table-low'+index).val($('.exam-grade-low'+index)[0]?$('.exam-grade-low'+index)[0].innerText: 0);
                    $('#exam-grade-table-high'+index).val($('.exam-grade-high'+index)[0]?$('.exam-grade-high'+index)[0].innerText: 0);
                    $('#exam-grade-table-name'+index).val($('.exam-grade-name'+index)[0]?$('.exam-grade-name'+index)[0].innerText: '');
                    $('#exam-grade-table-mark'+index).val($('.exam-grade-mark'+index)[0]?$('.exam-grade-mark'+index)[0].innerText: '');

                }
                $('.sample-container').addClass('active-state');
                this.innerText = "Show Sample";
        });

    });
    $('.save-container').on('click', function(e){
        if(Number(flag)>0){
            console.log("flag=", flag);

            return;
        }
        e.preventDefault();
        let gradeName = $('#exam-grading-name').val();
        if(gradeName == ''){
            $('#exam-grade-name-error').text('This field is required');
            $('#exam-grade-name-error').removeClass('d-none');
            return;
        }else{
            $('#exam-grade-name-error').text('');
            $('#exam-grade-name-error').addClass('d-none');
        }
        Swal.fire({
                title: "Grading System Created successfully",
                text: "Grading system New grading system created successfully?",
                confirmButtonColor: 'green',
                confirmButtonText: "Ok",
                showCancelButton: true,
            }).then((res)=>{
                // let sampleCount = $('.sample')[0].innerText;
                let sampleCount = $('#grade-tbody tr').length;


                let formData = new FormData();
                let tags = [];

                for (let index = 1; index <= sampleCount; index++) {
                    if($('#exam-grade-table-low'+index).val()=='' && $('#exam-grade-table-high'+index).val() == '')
                    {
                        continue;
                    }else{
                        tags.push({
                            id: $('.exam-grade'+index)[0].innerText,
                            name: $('#exam-grade-table-name'+index).val(),
                            remark: $('#exam-grade-table-mark'+index).val(),
                            low: $('#exam-grade-table-low'+index).val(),
                            high: $('#exam-grade-table-high'+index).val()
                        });
                    }

                }
                // console.log('data', tags);

                formData.append("formData", JSON.stringify(tags));
                formData.append("gradeName", gradeName);
                var ajaxOptions = {
                    url:'/grade_store',
                    type:'POST',
                    cache:false,
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    data:formData
                };
                var req = $.ajax(ajaxOptions);
                req.done(function(resp){
                    console.log(resp);
                    $('#exam-grading-name').val('')
                    window.location.href = "/exams"
                })
                req.fail(function(e){
                    if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                    if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                    if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
                    return e.status;
                })
        });
    })
    function validateMark(index, e){
        $('#exam-grade-table-mark-error'+index).addClass('d-none');
        // var markText = $('#exam-grade-table-mark'+index).val();
        var markText = e.target.value;
        if(markText == ''){
            $('#exam-grade-table-mark-error'+index).removeClass('d-none');
            $('#exam-grade-table-mark-error'+index).text('This field is required');
            // $('#exam-grade-table-mark'+index).focus();
            return;
        }else{
            console.log('index', index);

           if(index>1){
                // if(Number($('#exam-grade-table-mark'+index).val())<Number($('#exam-grade-table-mark'+Number(index-1)).val())){
                if(Number(Number(markText)-1)<Number($('#exam-grade-table-mark'+Number(index-1)).val()) && Number(Number(markText)-1) != Number($('#exam-grade-table-mark'+Number(index-1)).val())){
                    // var beforeValue = Number($('#exam-grade-table-mark'+index).val()) - 1
                    var beforeValue = Number(markText) - 1
                    var compareValue = Number($('#exam-grade-table-mark'+Number(index-1)).val()) + 1
                    str = "Minimum value is " + compareValue
                    $('#exam-grade-table-mark-error'+index).text(str);
                    $('#exam-grade-table-mark-error'+index).removeClass('d-none');
                    str = "Maximum value is " + beforeValue
                    $('#exam-grade-table-mark-error'+Number(index-1)).text(str);
                    $('#exam-grade-table-mark-error'+Number(index-1)).removeClass('d-none');
                    console.log('1');

                }else if(Number(Number(markText)+1)>Number($('#exam-grade-table-mark'+Number(index+1)).val()) && Number(Number(markText)+1) != Number($('#exam-grade-table-mark'+Number(index+1)).val())){
                    var compareValue = Number($('#exam-grade-table-mark'+Number(index-1)).val()) + 1
                    // var afterValue = Number($('#exam-grade-table-mark'+index).val()) + 1
                    var afterValue = Number(markText) + 1
                    str = "Maximum value is " + compareValue
                    $('#exam-grade-table-mark-error'+index).text(str);
                    $('#exam-grade-table-mark-error'+index).removeClass('d-none');
                    str = "Minimum value is " + afterValue
                    $('#exam-grade-table-mark-error'+Number(index+1)).text(str);
                    $('#exam-grade-table-mark-error'+Number(index+1)).removeClass('d-none');
                }
                else{
                    console.log('11');
                    $('#exam-grade-table-mark-error'+Number(index-1)).text('');
                    $('#exam-grade-table-mark-error'+Number(index-1)).addClass('d-none');
                    $('#exam-grade-table-mark-error'+Number(index+1)).text('');
                    $('#exam-grade-table-mark-error'+Number(index+1)).addClass('d-none');
                }
                // if(Number($('#exam-grade-table-mark'+index).val())>Number($('#exam-grade-table-mark'+Number(index+1)).val())){
                // if(Number(markText)>Number($('#exam-grade-table-mark'+Number(index+1)).val())){
                //     var compareValue = Number($('#exam-grade-table-mark'+Number(index-1)).val()) + 1
                //     // var afterValue = Number($('#exam-grade-table-mark'+index).val()) + 1
                //     var afterValue = Number(markText) + 1
                //     str = "Maximum value is " + compareValue
                //     $('#exam-grade-table-mark-error'+index).text(str);
                //     $('#exam-grade-table-mark-error'+index).removeClass('d-none');
                //     str = "Minimum value is " + afterValue
                //     $('#exam-grade-table-mark-error'+Number(index+1)).text(str);
                //     $('#exam-grade-table-mark-error'+Number(index+1)).removeClass('d-none');
                //     console.log('2');
                // }else{
                //     console.log('22');
                //     $('#exam-grade-table-mark-error'+Number(index+1)).text('');
                //     $('#exam-grade-table-mark-error'+Number(index+1)).addClass('d-none');
                // }
                // if(Number($('#exam-grade-table-mark'+index).val())<Number($('#exam-grade-table-mark'+Number(index+1)).val()) &&
                // Number($('#exam-grade-table-mark'+index).val())>Number($('#exam-grade-table-mark'+Number(index-1)).val()))
                if(Number(markText)<Number($('#exam-grade-table-mark'+Number(index+1)).val()) &&
                Number(markText)>Number($('#exam-grade-table-mark'+Number(index-1)).val()))
                {
                    $('#exam-grade-table-mark-error'+Number(index-1)).text('');
                    $('#exam-grade-table-mark-error'+Number(index-1)).addClass('d-none');
                    $('#exam-grade-table-mark-error'+Number(index+1)).text('');
                    $('#exam-grade-table-mark-error'+Number(index+1)).addClass('d-none');
                    $('#exam-grade-table-mark-error'+Number(index)).text('');
                    $('#exam-grade-table-mark-error'+Number(index)).addClass('d-none');
                }

            }
        }

    }
    function validateGrade(index, e){
        $('#exam-grade-table-name-error'+index).addClass('d-none');
        // var gradeText = $('#exam-grade-table-name'+index).val();
        var gradeText = e.target.value;
        // console.log(gradeText.charCodeAt(0));

        if(gradeText.length == 2){
            if(gradeText.charCodeAt(0)>64 && gradeText.charCodeAt(0)<123){
                if((gradeText.charCodeAt(1)==43 || gradeText.charCodeAt(1)==45 || gradeText.charCodeAt(1)==43)){
                    return;
                }else{
                    $('#exam-grade-table-name-error'+index).removeClass('d-none');
                    $('#exam-grade-table-name-error'+index).text('Invalid grade');
                    $('#exam-grade-table-name'+index).focus();
                }
            }else{
                $('#exam-grade-table-name-error'+index).removeClass('d-none');
                $('#exam-grade-table-name-error'+index).text('Invalid grade');
                $('#exam-grade-table-name'+index).focus();
            }
        }
        else if(gradeText.length == 1){
            if(gradeText.charCodeAt(0)>64 && gradeText.charCodeAt(0)<123){
                return;
            }else{
                $('#exam-grade-table-name-error'+index).removeClass('d-none');
                $('#exam-grade-table-name-error'+index).text('Invalid grade');
                $('#exam-grade-table-name'+index).focus();
            }
        }else if(gradeText.length == 0){
            $('#exam-grade-table-name-error'+index).removeClass('d-none');
            $('#exam-grade-table-name-error'+index).text('This field is required');
            $('#exam-grade-table-name'+index).focus();
        }
        else{
            $('#exam-grade-table-name-error'+index).removeClass('d-none');
            $('#exam-grade-table-name-error'+index).text('Invalid grade');
            $('#exam-grade-table-name'+index).focus();
        }



    }
    // validateName();
    function validateName(){
        let gradeName = $('#exam-grading-name').val();
        let sampleCount = $('#grade-tbody tr').length;
        if(gradeName == ''){
            $('#exam-grade-name-error').text('This field is required');
            $('#exam-grade-name-error').removeClass('d-none');

            for (let index = 1; index <= sampleCount; index++) {
                $('#exam-grade-table-low'+index).prop('disabled', true);
                $('#exam-grade-table-high'+index).prop('disabled', true);
                $('#exam-grade-table-name'+ index).prop('disabled', true);
                $('#exam-grade-table-mark'+ index).prop('disabled', true);
            }
            return;
        }else{
            $('#exam-grade-name-error').text('');
            $('#exam-grade-name-error').addClass('d-none');
            for (let index = 1; index <= sampleCount; index++) {
                $('#exam-grade-table-low'+index).prop('disabled', false);
                $('#exam-grade-table-high'+index).prop('disabled', false);
                $('#exam-grade-table-name'+ index).prop('disabled', false);
                $('#exam-grade-table-mark'+ index).prop('disabled', false);
            }
        }



    }
    function validateMin(index, e){
        // console.log($('#exam-grade-table-high'+index).val());
        // console.log(obj.value, $('#exam-grade-table-high'+index).val());
        let gradeName = $('#exam-grading-name').val();
        if(gradeName == ''){
            $('#exam-grade-table-low'+index).prop('disabled');
            return;
        }

        $('#exam-grade-table-low-error'+index).text('');
        $('#exam-grade-table-low-error'+index).addClass('d-none');


        if($('#exam-grade-table-low'+index).val() == ''){
            $('#exam-grade-table-low-error'+index).text('This field is required');
            $('#exam-grade-table-low-error'+index).removeClass('d-none');
            return;
        }

        console.log(Number($('#exam-grade-table-high'+Number(index-1)).val()), e.target.value, Number($('#exam-grade-table-high'+index).val()));
        if(index >1){
            if(Number(Number(e.target.value)-1) < Number($('#exam-grade-table-high'+Number(index-1)).val()) && Number(Number(e.target.value)-1) != Number($('#exam-grade-table-high'+Number(index-1)).val())){

                console.log('1');

                $('#exam-grade-table-low'+index).css('border-color', 'red');
                var compareValue = Number($('#exam-grade-table-high'+Number(index-1)).val()) + 1;
                var str = "Minimun value is " + compareValue;
                $('#exam-grade-table-low-error'+index).text(str);
                $('#exam-grade-table-low-error'+index).removeClass('d-none');;
                console.log('fail');
            }else if(Number(e.target.value)>Number($('#exam-grade-table-high'+Number(index-1)).val()) + 1){
                $('#exam-grade-table-low'+index).css('border-color', 'red');
                var compareValue = Number($('#exam-grade-table-high'+Number(index-1)).val()) + 1;
                var str = "Maximum value is " + compareValue;
                $('#exam-grade-table-low-error'+index).text(str);
                $('#exam-grade-table-low-error'+index).removeClass('d-none');;
                console.log('fail');
            }
            else if(Number($('#exam-grade-table-low'+(index)).val())>100){
                console.log('2');

                var str = "Maximum value is " + 100;
                $('#exam-grade-table-low-error'+index).text(str);
                $('#exam-grade-table-low-error'+index).removeClass('d-none');
                flag = 1;
            }
            else{
                flag = 0;
                $('#exam-grade-table-low-error'+index).addClass('d-none');
                $('#exam-grade-table-low-error'+index).text('');
                $('#exam-grade-table-low'+index).css('border-color', '');

            }
        }else{
            console.log(Number($('#exam-grade-table-high'+index).val()));

            if(Number($('#exam-grade-table-low'+index).val()) > 0){
                $('#exam-grade-table-low'+index).css('border-color', 'red');
                console.log($('#exam-grade-table-high'+index).val());
                var compareValue = $('#exam-grade-table-high'+index).val();
                var str = "This value is " + 0;
                // var str = "Maximum value is " + compareValue;
                $('#exam-grade-table-low-error'+index).text(str);
                $('#exam-grade-table-low-error'+index).removeClass('d-none');
                flag = 1;
                console.log('flag='+ flag);
            } else{
                flag = 0;
                console.log('ok');
                $('#exam-grade-table-low-error'+index).addClass('d-none');
                $('#exam-grade-table-low-error'+index).text('');
                $('#exam-grade-table-low'+index).css('border-color', '');
            }
        }

    }
    function validateMax(index, e){
        $('#exam-grade-table-high-error'+index).text('');
        $('#exam-grade-table-high-error'+index).addClass('d-none');
        if($('#exam-grade-table-high'+index).val() == ''){
            $('#exam-grade-table-high-error'+index).text('This field is required');
            $('#exam-grade-table-high-error'+index).removeClass('d-none');;
            return;
        }

        if($('#exam-grade-table-low'+Number(index+1)).val() == null)return;
        // if(Number($('#exam-grade-table-high'+(index)).val())>100){
        //     var str = "Maximum value is " + 100;
        //     $('#exam-grade-table-high-error'+index).text(str);
        //     $('#exam-grade-table-high-error'+index).removeClass('d-none');
        //     return;
        // }
        // console.log($('#exam-grade-table-high'+(index)).val(), $('#exam-grade-table-low'+Number(index)).val(), e.target.value);
        if(Number(e.target.value) <= Number($('#exam-grade-table-low'+Number(index)).val()) && Number(Number(e.target.value)+1)!=Number($('#exam-grade-table-low'+Number(index+1)).val())){
            // console.log('1');

            $('#exam-grade-table-high'+index).css('border-color', 'red');
            var compareValue = Number($('#exam-grade-table-low'+Number(index)).val()) + 1
            var str = "Minimum value is " + compareValue;
            $('#exam-grade-table-high-error'+index).text(str);
            $('#exam-grade-table-high-error'+index).removeClass('d-none');
            str = "Maximum value is " + Number(Number(e.target.value) + 1);
            $('#exam-grade-table-low-error'+Number(index+1)).text(str);
            $('#exam-grade-table-low-error'+Number(index+1)).removeClass('d-none');
            flag = 1;
        }else if(Number(e.target.value)<=Number($('#exam-grade-table-low'+Number(index+1)).val()) && Number(Number(e.target.value)+1)!=Number($('#exam-grade-table-low'+Number(index+1)).val())){
            // console.log('2');

            var str = "Maximum value is " + Number(Number(e.target.value) + 1);
            $('#exam-grade-table-low-error'+Number(index+1)).text(str);
            $('#exam-grade-table-low-error'+Number(index+1)).removeClass('d-none');
            flag = 1;
        }
        else if(Number($('#exam-grade-table-high'+(index)).val())>100){
            var str = "Maximum value is " + 100;
            $('#exam-grade-table-high-error'+index).text(str);
            $('#exam-grade-table-high-error'+index).removeClass('d-none');
            $('#exam-grade-table-low-error'+Number(index+1)).text('');
            $('#exam-grade-table-low-error'+Number(index+1)).addClass('d-none');
            flag = 1;
        }else{
            flag = 0;
            console.log('ok');
            $('#exam-grade-table-high-error'+index).addClass('d-none');
            $('#exam-grade-table-high-error'+index).text('');
            $('#exam-grade-table-high'+index).css('border-color', '');
            $('#exam-grade-table-low-error'+Number(index+1)).text('');
            $('#exam-grade-table-low-error'+Number(index+1)).addClass('d-none');
        }
    }
    function gradeAdd(index, maxgrade){
        // var num = Number($('.sample')[0].innerText) + 1;
        var num = $('#grade-tbody tr').length + 1;
        var maxnum = $('#grade-tbody tr').length + maxgrade -5;
        var row =`<tr class="exam-row` + num + `"><td class="d-none exam-grade` + num + `">`+maxnum+`</td>
            <td>
                <input type="number" onchange="validateMin(`+num+`)" id="exam-grade-table-low`+num+`"></td>
            </td>
            <td>
                <input type="number" onchange="validateMax(`+num+`)" id="exam-grade-table-high`+num+`"></td>
            </td>
            <td>
                <input id="exam-grade-table-name`+num+`" class="exam-grade-table-name`+num+`">
            </td>
            <td>
                <input id="exam-grade-table-mark`+num+`" class="exam-grade-table-mark`+num+`">
            </td>
            <td>
                <div class="row text-center">
                    <div class="col-6 border-right">
                        <button class="btn btn-secondary" onclick="gradeAdd(`+num+`)">+ Add</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-danger" onclick="gradeRemove(`+num+`)"> Remove</button>
                    </div>
                </div>
            </td>
            </tr>`;
        $('#grade-tbody').append(row);
    }
    function gradeRemove(index){
        $('.exam-row'+index).remove();
    }
</script>
