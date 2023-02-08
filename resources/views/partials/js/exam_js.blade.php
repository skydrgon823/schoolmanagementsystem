
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    var exam_index_tbody = document.getElementById('exam_index_tbody');
    var tableDiv = document.getElementById('exam_index_body');
    // getInitExam();
    selectExam();
    var exam_type_elem = document.querySelectorAll('input[name=exam_type]');
    for (const radioButton of exam_type_elem) {
        radioButton.addEventListener('change', displayExamType);
    }
    var ordinary_body = document.querySelector('#ordinary_body');
    var consolidated_body = document.querySelector('#consolidated_body');
    var year_body = document.querySelector('#year_body');
    var ksce_body = document.querySelector('#ksce_body');
    function displayExamType(e){
        if(e.target.value=="KCSE"){
            ordinary_body.classList.add('active-state');
            consolidated_body.classList.add('active-state');
            year_body.classList.add('active-state');
            ksce_body.classList.remove('active-state');
        }else if(e.target.value == "Consolidated_Exam"){
            ordinary_body.classList.add('active-state');
            consolidated_body.classList.remove('active-state');
            year_body.classList.add('active-state');
            ksce_body.classList.add('active-state');
        }else if(e.target.value == "Year_Average"){
            ordinary_body.classList.add('active-state');
            consolidated_body.classList.add('active-state');
            year_body.classList.remove('active-state');
            ksce_body.classList.add('active-state');
        }else{
        // if(e.target.value == "KCSE"){
            ordinary_body.classList.remove('active-state');
            consolidated_body.classList.add('active-state');
            year_body.classList.add('active-state');
            ksce_body.classList.add('active-state');
        }
    }
    // for manage exam tab
    function createHeadings(item_no) {
        const headings =[
            {
                label: "Name",
                for: "name"
            },
            {
                label: "Class",
                for: "class"
            },
            {
                label: "Status",
                for: "status"
            },
            {
                label: "Action",
                for: "action"
            },
        ];
        let thead = document.createElement("thead"),
        trHeading = document.createElement("tr");
        thead.classList.add("text-center");
        headings.forEach(heading => {
        const th = document.createElement("th"),
            thContent = document.createTextNode(heading.label);
        th.appendChild(thContent);
        trHeading.appendChild(th);
        });
        var tableClass = "."+"table"+item_no
        let table = document.querySelector(tableClass);
        table.appendChild(thead);
        thead.appendChild(trHeading);
    }
    function getInitExam(year = 1) {

        let formData = new FormData();
        formData.append("year", year);
        var ajaxOptions = {
            url:'exam_index',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:formData
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log('======= residences ===============', resp.terms);
            tableDiv.innerHTML = '';
            for(let item of resp.terms){
                let bb = '';
                let i = 0;
                let label = document.createElement("label");
                let table = document.createElement("table");
                let tbody = document.createElement("tbody");

                for(let entry of resp.exams) {
                    if(item.term == entry.term){
                        i++;
                        if(i == 1){
                            console.log('term', item.term);
                            label.textContent = "Term" + item.term;
                            tableDiv.appendChild(label);
                            table.classList.add("table");
                            table.classList.add("table-bordered");
                            table.classList.add("table" + item.term);
                            tableDiv.appendChild(table);
                            createHeadings(item.term);
                            table.appendChild(tbody);
                        }
                        bb += `<tr>
                                <td class="d-none">`+ i +`</td>
                                <td class="d-none">`+ entry.type +`</td>
                                <td>`+ entry.name +`</td><td><ul>`;
                        for(let ef of resp.examforms) {
                            if(entry.id == ef.exam_id) {
                                for(let f of resp.forms) {
                                    if (f.id == ef.form_id) bb += `<li>Form `+ f.name +`</li>`;
                                }
                            }
                        }
                        bb +=   `</ul></td><td><ul>`;
                        for(let ef of resp.examforms) {
                            if(entry.id == ef.exam_id) {
                                let num = 0;
                                for(let m of resp.marks) {
                                    if (m.id == ef.exam_id) {
                                        num =1;
                                        bb += `<li>Pending Publishing</li>`;
                                        break;
                                    }
                                }
                                if(num == 0){
                                    bb += `<li>Results Not Uploaded</li>`;
                                }
                            }
                        }
                        bb +=   `</ul></td><td class="d-none">Term`+ entry.term +`</td>

                                <td class="d-none">`+ entry.year +`</td>
                                <td class="text-center">
                                    <div class="row  align-items-center justify-content-start">
                                    <div class="col-2">
                                    <a class="btn" href='/exams/`+ entry.id + `' style="background: white;">
                                        <img src="global_assets/images/icon/edit.png" width=25 height=25 />Edit Exam
                                    </a></div><div class="col-4"><ul>`;
                                        for(let ef of resp.examforms) {
                                            if(entry.id == ef.exam_id) {
                                                for(let f of resp.forms) {
                                                    if (f.id == ef.form_id) bb += `<li class=action`+ef.exam_id+ef.form_id+`>
                                                        <a class="btn" href="/exam_manage/config/`+ef.exam_id + `/` + ef.form_id +`" style="background: white;">
                                                            <img src="global_assets/images/icon/edit.png" width=25 height=25 />Subject Papers
                                                        </a>
                                                    </li>`;
                                                }
                                            }
                                        }
                                    bb+= `</ul></div><div class="col-4"><ul>`;
                                        for(let ef of resp.examforms) {
                                            if(entry.id == ef.exam_id) {
                                                let num = 0;
                                                for(let m of resp.marks) {
                                                    if (m.id == ef.exam_id){
                                                        num = 1;
                                                        bb += `<li class=action`+ef.exam_id+ef.form_id+`>
                                                            <a class="btn" href="/exam_manage/publish/`+ef.exam_id + `/` + ef.form_id +`" style="background: white;">
                                                                <img src="global_assets/images/icon/edit.png" width=25 height=25 /> Analysis Results
                                                            </a>
                                                        </li>`;
                                                        break;
                                                    }
                                                }
                                                if(num == 0){
                                                    bb += `<li class=action`+ef.exam_id+ef.form_id+`>
                                                            <a class="btn" href="/exam_manage/upload/`+ ef.exam_id + `/` + ef.form_id + `" style="background: white;">
                                                                <img src="global_assets/images/icon/edit.png" width=25 height=25 /> Upload Results
                                                            </a>
                                                        </li>`;
                                                }
                                            }
                                        }
                                    bb+= `</ul></div><div class="col-2"><ul>`;
                                        for(let ef of resp.examforms) {
                                            if(entry.id == ef.exam_id) {
                                                for(let f of resp.forms) {
                                                    if (f.id == ef.form_id) bb += `<li class=action`+ef.exam_id+ef.form_id+`>
                                                        <button type="button" class="btn" onclick="onDeleteEachExam(`+ ef.exam_id +`, `+ef.form_id+`, this);" style="background: white;" >
                                                            <img src="global_assets/images/icon/delete.png" width=25 height=25 /> Delete
                                                        </button>
                                                    </li>`;
                                                }
                                            }
                                        }
                                    bb+= `</ul></div>
                                    </div>
                                </td>
                            </tr>`;

                    }
                }
                tbody.innerHTML = bb;
                let br = document.createElement("br");
                tableDiv.appendChild(br);

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
    let origin_type, origin_name, origin_term, origin_year, origin_i, origin_id, edit_status = false;
    let post_type, post_name, post_term, post_year, post_id;
    function onEditExam(i, id, type, name, term, year, myObj) {

        if (edit_status == true) {

            let origin_ss = exam_index_tbody.children[origin_i - 1].children;
            origin_ss[1].innerHTML= origin_type;
            origin_ss[2].innerHTML = origin_name;
            origin_ss[3].innerHTML = 'Term ' + origin_term;
            origin_ss[4].innerHTML = origin_year;
            origin_ss[5].innerHTML = `<button type="button" class="btn" onclick="onEditExam('`+ origin_i +`', '`+ origin_id +`', '`+ origin_type +`', '`+ origin_name +`', '`+ origin_term +`', '`+ origin_year +`', this);" style="background: white;">
                                <img src="global_assets/images/icon/edit.png" width=25 height=25 />
                            </button>
                            <button type="button" class="btn" onclick="onDeleteExam('`+ origin_id +`', this);" style="background: white;" >
                                <img src="global_assets/images/icon/delete.png" width=25 height=25 />
                            </button>`;
            edit_status = false;
        }
        origin_i = i;
        origin_id = id; post_id = id;
        origin_name = name; post_name = name;
        origin_term = term; post_term = term;
        origin_type = type; post_type = type;
        origin_year = year; post_year = year;

        let ss = myObj.parentNode.parentNode.children;
        ss[1].innerHTML=`<select data-placeholder="Select Type" class="form-control" onchange="buffExamType(this);">
                            <option `+ (type == 'Ordinary_Exam' ? 'selected' : '') +` value="Ordinary_Exam">Ordinary_Exam</option>
                            <option  `+ (type == 'Consolidated_Exam' ? 'selected' : '') +` value="Consolidated_Exam">Consolidated_Exam</option>
                            <option  `+ (type == 'Year_Average' ? 'selected' : '') +` value="Year_Average">Year_Average</option>
                            <option  `+ (type == 'KCSE' ? 'selected' : '') +` value="KCSE">KCSE</option>
                        </select>`;
        ss[2].innerHTML = `<input type="text" value="`+ name +`"  onchange="buffExamName(this);" />`;
        ss[3].innerHTML = `<select data-placeholder="Select Teacher" class="form-control" onchange="buffExamTerm(this);">
                                <option `+ (term == 1 ? 'selected' : '') +` value="1">First Term</option>
                                <option `+ (term == 2 ? 'selected' : '') +` value="2">Second Term</option>
                                <option `+ (term == 3 ? 'selected' : '') +` value="3">Third Term</option>
                            </select>`;
        ss[4].innerHTML = `<select data-placeholder="Select Teacher" class="form-control" onchange="buffExamYear(this);">
                            <option `+ (year == 2022 ? 'selected' : '') +` value="2022">2022</option>
                            <option `+ (year == 2021 ? 'selected' : '') +` value="2021">2021</option>
                            <option `+ (year == 2020 ? 'selected' : '') +` value="2020">2020</option>
                            <option `+ (year == 2019 ? 'selected' : '') +` value="2019">2019</option>
                            <option `+ (year == 2018 ? 'selected' : '') +` value="2018">2018</option>
                        </select>`;
        ss[5].innerHTML = `<button type="button" class="btn" onclick="onUpdate(this);" style="background: white;">
                            <img src="global_assets/images/icon/save.png" width=25 height=25 />
                        </button>
                        <button type="button" class="btn" onclick="onCancel(this);" style="background: white;" >
                            <img src="global_assets/images/icon/cancel.png" width=25 height=25 />
                        </button>`;
        edit_status = true;

    }

    function onCancel(myObj) {

        let ss = myObj.parentNode.parentNode.children;
        ss[1].innerHTML= origin_type;
        ss[2].innerHTML = origin_name;
        ss[3].innerHTML = 'Term ' + origin_term;
        ss[4].innerHTML = origin_year;
        ss[5].innerHTML = `<button type="button" class="btn" onclick="onEditExam('`+ origin_i +`', '`+ origin_id +`', '`+ origin_type +`', '`+ origin_name +`', '`+ origin_term +`', '`+ origin_year +`', this);" style="background: white;">
                            <img src="global_assets/images/icon/edit.png" width=25 height=25 />
                        </button>
                        <button type="button" class="btn" onclick="onDeleteExam('`+ origin_id +`', this);" style="background: white;" >
                            <img src="global_assets/images/icon/delete.png" width=25 height=25 />
                        </button>`;
        edit_status = false;
    }

    function buffExamType(myObj) {
        console.log(myObj);
        post_type = myObj.options[myObj.selectedIndex].value;
        console.log('post_type ' + post_type);
    }

    function buffExamTerm(myObj) {
        console.log(myObj);
        post_term = myObj.options[myObj.selectedIndex].value;
        console.log('post_term ' + post_term);
    }

    function buffExamYear(myObj) {
        console.log(myObj);
        post_year = myObj.options[myObj.selectedIndex].value;
        console.log('post_year ' + post_year);
    }

    function buffExamName(myObj) {
        console.log(myObj);
        post_name = myObj.value;
        console.log('post_name ' + post_name);
    }

    function onUpdate(myObj) {
        let form1 = new FormData();
        form1.append("type", post_type);
        form1.append("name", post_name);
        form1.append("term", post_term);
        form1.append("year", post_year);
        form1.append("id", post_id);

        var ajaxOptions = {
            url:'exam_update',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:form1
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log('======= response data ===============');
            console.log(resp);
            resp.ok && resp.msg
            ? flash({msg:resp.msg, type:'success'})
            : flash({msg:resp.msg, type:'danger'});
            let ss = myObj.parentNode.parentNode.children;

            ss[1].innerHTML= post_type;
            ss[2].innerHTML = post_name;
            ss[3].innerHTML = 'Term ' + post_term;
            ss[4].innerHTML = post_year;
            ss[5].innerHTML = `<button type="button" class="btn" onclick="onEditExam('`+ origin_i +`', '`+ post_id +`', '`+ post_type +`', '`+ post_name +`', '`+ post_term +`', '`+ post_year +`', this);" style="background: white;">
                                <img src="global_assets/images/icon/edit.png" width=25 height=25 />
                            </button>
                            <button type="button" class="btn" onclick="onDeleteExam('`+ post_id +`', this);" style="background: white;" >
                                <img src="global_assets/images/icon/delete.png" width=25 height=25 />
                            </button>`;
            edit_status = false;

            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        });
    }
    function onDeleteEachExam(exam_id, form_id, myObj){
        console.log(myObj);

        Swal.fire({
            title: "Delete Exam",
            text: "Are You sure you'd like to delete EXAM ",
            confirmButtonColor: 'green',
            confirmButtonText: "Okay",
            showCancelButton: true,
        }).then((res)=>{
            if(res.isConfirmed){
                let form1 = new FormData();
                form1.append("exam_id", exam_id);
                form1.append("form_id", form_id);
                var ajaxOptions = {
                    url:'each_exam_delete',
                    type:'POST',
                    cache:false,
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    data:form1
                };
                var req = $.ajax(ajaxOptions);
                req.done(function(resp){
                    // console.log('======= response data ===============');
                    // console.log(resp);
                    resp.ok && resp.msg
                    ? flash({msg:resp.msg, type:'success'})
                    : flash({msg:resp.msg, type:'danger'});
                    if(resp.ok == true){
                        // myObj.parentNode.remove();
                        $('.action'+exam_id+form_id).remove();
                        // let ele =myObj.parentNode.parentNode.parentNode.parentNode.children;
                        // console.log(ele[1].children[0], ele[2].children[0], ele[3].children[0]);
                        // ele[1].deleteRow(exam_id);
                        // ele[2].deleteRow(exam_id);
                        // ele[3].deleteRow(exam_id);

                    }
                    // location.reload();
                    // return resp;
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
    function examNameInvalid(e){
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
            e.target.setCustomValidity("Exam name is required");
        }
    }
    function examTermInvalid(e){
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
            e.target.setCustomValidity("Term is reqiuired");
        }
    }
    function checkState(id, myObj, e){
        var subjectCountStr = "#min_subject_cnt"+id;
        var subjectErrorStr = "#min_subject_helper"+id;
        // console.log(myObj.checked);
        if(myObj.checked){
            $(subjectCountStr).prop('required',true);
            $(subjectErrorStr).text("Enter minimum number of exam for form" + id)
        }else{
            $(subjectCountStr).prop('required',false);
            $(subjectErrorStr).text('')
        }
    }
    function examSubject(id, e){
        e.target.setCustomValidity("");
        var subjectEleStr = "#min_subject_id"+id;
        var subjectCountStr = "#min_subject_cnt"+id;

        // console.log($(subjectEleStr).prop('checked'));

        if ($(subjectEleStr).prop('checked') && !e.target.validity.valid) {

            if($(subjectCountStr).val()==''){
                e.target.setCustomValidity('Enter minimum number of exams for form' + id);

            }
        }
    }
    function hideSubject(id, e){
        var subjectEleStr = "#min_subject_id"+id;
        var subjectCountStr = "#min_subject_cnt"+id;
        var subjectErrorStr = "#min_subject_helper"+id;
        if ($(subjectEleStr).prop('checked')) {
            if($(subjectCountStr).val()==''){
                e.target.setCustomValidity('Enter minimum number of exams for form' + id);
                $(subjectErrorStr).text('Enter minimum number of exams for form' + id);
            }else{
                $(subjectErrorStr).text('')
            }
        }


    }
    function onDeleteExam(id, myObj) {
        console.log('id ' + id);
        console.log('myObj ' + myObj);
        Swal.fire({
            title: "Delete Exam",
            text: "Are You sure you'd like to delete TEST EXAM 2A",
            confirmButtonColor: 'green',
            confirmButtonText: "Okay",
            showCancelButton: true,
        }).then((res)=>{
            let form1 = new FormData();
            form1.append("id", id);

            var ajaxOptions = {
                url:'exam_delete',
                type:'POST',
                cache:false,
                processData:false,
                dataType:'json',
                contentType:false,
                data:form1
            };
            var req = $.ajax(ajaxOptions);
            req.done(function(resp){
                console.log('======= response data ===============');
                console.log(resp);
                resp.ok && resp.msg
                ? flash({msg:resp.msg, type:'success'})
                : flash({msg:resp.msg, type:'danger'});
                if(resp.ok == true) myObj.parentNode.parentNode.remove();
                location.reload();
                // return resp;
            });
            req.fail(function(e){
                if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
                if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
                return e.status;
            });
        });
    }

    // for creating new exam
    var form = $(this);
    var exam_type_rad_elem = document.querySelectorAll('input[type=radio]');
    var exam_name_input_elem = document.querySelector('#exam_name');
    var exam_term_select_elem = document.querySelector('#exam_term');
    var exam_year_select_elem = document.querySelector('#exam_year');
    var exam_form = document.querySelectorAll('input[class="exam_form my-2 mx-3"]');
    var create_exam_submit_btn = document.querySelector('#create-exam-btn');
    $('#create_exam_form').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Create Exam Success",
            text: "Exam has been successfully created",
            confirmButtonColor: 'green',
            confirmButtonText: "Okay",
            showCancelButton: true,
        }).then((res)=>{
        if(res.isConfirmed){
            let exam_type = '';
            for(let entry of exam_type_rad_elem) {
                if (entry.checked == true) {
                    exam_type = entry.value;
                    break;
                }
            }
            var exam_name = exam_name_input_elem.value;
            var exam_term = exam_term_select_elem.options[exam_term_select_elem.selectedIndex].value;
            var exam_year = exam_year_select_elem.options[exam_year_select_elem.selectedIndex].value;

            var exam_forms = [];

            for(let entry of exam_form) {
                if(entry.checked == true) {
                    console.log('entry', entry.id);
                    var str = entry.id;
                    eleID = str.substring(str.length-1, str.length);
                    let min_subject_cnt_id = 'min_subject_cnt' + eleID;
                    let min_subject_cnt_elem = document.getElementById(min_subject_cnt_id);
                    exam_forms.push({'form_id': eleID, 'min_subject_cnt': parseInt(min_subject_cnt_elem.value)});
                }
            }
            disableBtn($(create_exam_submit_btn));

            let form1 = new FormData();
            form1.append("exam_type", exam_type);
            form1.append("exam_name", exam_name);
            form1.append("exam_term", exam_term);
            form1.append("exam_year", exam_year);
            form1.append("exam_forms", JSON.stringify(exam_forms));
            // console.log($('#create_exam_form').attr('action'))
            var ajaxOptions = {
                url:$('#create_exam_form').attr('action'),
                type:'POST',
                cache:false,
                processData:false,
                dataType:'json',
                contentType:false,
                data:form1,
            };
            var req = $.ajax(ajaxOptions);
            req.done(function(resp){
                console.log('======= residences ===============');
                console.log(resp);
                resp.ok && resp.msg
                ? flash({msg:resp.msg, type:'success'})
                : flash({msg:resp.msg, type:'danger'});
                hideAjaxAlert();
                enableBtn($(create_exam_submit_btn));
                // window.location.href="/exams";
                // return resp;
                $('#exam_name_helper').text('');
                $('#exam_year_helper').text('');
                $('#exam_term_helper').text('');
                for (let index = 1; index < 5; index++) {
                    $('#min_subject_helper'+index).text('')
                }

            })
            .fail(function(e){
                if (e.status == 422){
                    var errors = e.responseJSON.errors;
                    console.log(errors)
                    errors.forEach(error => {
                        if (error == "The exam name field is required.") {
                            $('#exam_name_helper').text(error);
                        }
                        if (error == "The exam year field is required.") {
                            $('#exam_year_helper').text(error);
                        }
                        if (error == "The exam term field is required.") {
                            $('#exam_term_helper').text(error);
                        }
                    })
                }
                if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
                if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
                enableBtn($(create_exam_submit_btn));
            });
          }
        });
    });
    function addSelected(id){
        var chkExams = document.querySelectorAll('input[type=checkbox]');
        var examData = {
            id: '',
            cnt: ''
        }
        var arrForm = [];
        for (const chkExam of chkExams) {
            if(chkExam.checked){
                console.log('id', chkExam.id.substr(3, chkExam.id.length));
                var formvalue = document.getElementById('form' + chkExam.id.substr(3, chkExam.id.length));
                console.log('val', formvalue.value);
                examData.id = chkExam.id.substr(3, chkExam.id.length);
                examData.cnt = formvalue.value;
                arrForm.push(examData);
            }
        }

        let form = new FormData();
        form.append("forms", JSON.stringify(arrForm));
        form.append("exam_id", id);
        var ajaxOptions = {
                url: "/storeExamForm",
                type: 'POST',
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                data: form,
            }
        var req = $.ajax(ajaxOptions);
        req.done(function(resp){
            console.log('response', resp);
            window.location.href = '/exams/'+id;
        }).fail(function(e){
            console.error(e)
            return e.status;
        });
    }
    function showSample(){
        alert('show sample')
    }

    var edit_ratio_status = false;
    var edit_tr_no = 0;
    var origin_ratio_id = 0;
    function editSubjectRatio(id, myObj){
        // if(edit_ratio_status == true){
        //     let tbody = myObj.parentNode.parentNode.parentNode.parentNode.children;
        //         let tr2 = tbody[edit_tr_no];
        //         let td2 = tr2.children[1];
        //         td2.innerHTML =
        //             `<div class="d-flex align-items-center justify-content-start">
        //                 <button class="btn btn-secondary px-4" onclick="editSubjectRatio('`+ origin_ratio_id +`', this);">
        //                     <img src="/global_assets/images/icon/edit.png" width="20" height="20"/>Edit
        //                 </button>
        //             </div>`;
        // }
        let td1 = myObj.parentNode.parentNode;
        let tr1 = myObj.parentNode.parentNode.parentNode;
        let tchild = tr1.children;

        edit_tr_no = parseInt(tchild[0].innerHTML) - 1;
        edit_status = true;
        origin_ratio_id = id;

        // let classId = parseInt(tchild[8].innerHTML);

        td1.innerHTML = `<div class="d-flex">
                            <button class="btn mx-2 cancel-class-stream" style="padding: 6px;" onclick="cancelSubjectRatio(this);">
                                <img src="/global_assets/images/icon/cancel.png" width="20" height="20"/>Cancel
                            </button>
                            <button class="btn mx-2 save-class-stream" style="padding: 6px;" onclick="updateSubjectRatio(` + id + `, this);">
                                <img src="/global_assets/images/icon/save.png" width="20" height="20"/>Save
                            </button>
                        </div>`;

    }
    function cancelSubjectRatio(myObj) {

        myObj.parentNode.parentNode.innerHTML =
            `<div class="d-flex align-items-center justify-content-start">
                <button class="btn btn-secondary px-4"  onclick="editSubjectRatio('`+ origin_ratio_id +`', this);">
                    Edit
                </button>
            </div>`;
        edit_status = false;
    }
    function updateSubjectRatio(id, myObj) {

        let ele = myObj.parentNode.parentNode.parentNode.children
        console.log(ele[2].children[0].value);

        let updated_subject_id = id;

        let form2 = new FormData();
        form2.append("id", updated_subject_id);
        form2.append("out_x", ele[2].children[0].value ? ele[2].children[0].value: 0);
        form2.append("out_y", ele[3].children[0].value ? ele[3].children[0].value: 0);
        form2.append("out_z", ele[4].children[0].value ? ele[4].children[0].value: 0);
        form2.append("con_x", ele[5].children[0].value ? ele[5].children[0].value: 0);
        form2.append("con_y", ele[6].children[0].value ? ele[6].children[0].value: 0);
        form2.append("con_z", ele[7].children[0].value ? ele[7].children[0].value: 0);
        var ajaxOptions = {
            url:'/subjects/update_subject',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data: form2,
        };

        var req = $.ajax(ajaxOptions);

        req.done(function(resp){
            console.log('resp', resp);

            resp.ok && resp.msg ? flash({msg:resp.msg, type:'success'}) : flash({msg:resp.msg, type:'danger'});
            hideAjaxAlert();
            myObj.parentNode.parentNode.innerHTML =
                `<div class="d-flex align-items-center justify-content-start">
                    <button class="btn btn-secondary px-4"  onclick="editSubjectRatio('`+ updated_subject_id +`', this);">
                        Edit
                    </button>
                </div>`;
            edit_status = false;
            origin_ratio_id = updated_subject_id;

            return resp;
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if(e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if(e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        });
    }
    var edit_paper_status = false;
    var edit_paper_tr_no = 0;
    var origin_paper_ratio_id = 0;
    function editPaperRatio(id, myObj){
        // if(edit_paper_status == true){
        //     let tbody = myObj.parentNode.parentNode.parentNode.parentNode.children;
        //         let tr2 = tbody[edit_paper_tr_no];
        //         let td2 = tr2.children[3];
        //         td2.innerHTML =
        //             `<div class="d-flex align-items-center justify-content-start">
        //                 <button class="btn btn-secondary px-4" onclick="editPaperRatio('`+ origin_paper_ratio_id +`', this);">
        //                     Edit
        //                 </button>
        //             </div>`;
        // }
        let td1 = myObj.parentNode.parentNode;
        let tr1 = myObj.parentNode.parentNode.parentNode;
        let tchild = tr1.children;

        edit_paper_tr_no = parseInt(tchild[0].innerHTML) - 1;
        edit_paper_status = true;
        origin_paper_ratio_id = id;
        // $('.out_x_disable'+id).addClass('active-state');
        $('.out_x_chk'+id).removeClass('active-state');
        $('.out_y_chk'+id).removeClass('active-state');
        $('.out_z_chk'+id).removeClass('active-state');
        // let classId = parseInt(tchild[8].innerHTML);
        td1.innerHTML = `<div class="d-flex">
                            <button class="btn mx-2 cancel-class-stream" style="padding: 6px;" onclick="cancelPaperRatio(` + id + `,this);">
                                <img src="/global_assets/images/icon/cancel.png" width="20" height="20"/>Close
                            </button>
                            <button class="btn mx-2 save-class-stream" style="padding: 6px;" onclick="updatePaperRatio(` + id + `, this);">
                                <img src="/global_assets/images/icon/save.png" width="20" height="20"/>Save
                            </button>
                        </div>`;



    }
function cancelPaperRatio(id, myObj) {
    $('.out_x_chk'+id).addClass('active-state');
    $('.out_y_chk'+id).addClass('active-state');
    $('.out_z_chk'+id).addClass('active-state');
    myObj.parentNode.parentNode.innerHTML =
        `<div class="d-flex align-items-center justify-content-start">
            <button class="btn btn-secondary"  onclick="editPaperRatio('`+ origin_paper_ratio_id +`', this);">
                Edit/Add Paper
            </button>
        </div>`;
    edit_status = false;
}
function updatePaperRatio(id, myObj) {

    let ele = myObj.parentNode.parentNode.parentNode.children
    let updated_paper_id = id;
    // console.log($('.out_x_val'+id)[0]?$('.out_x_val'+id)[0].innerText:'',' ',$('.out_y_val'+id)[0]? $('.out_y_val'+id)[0].innerText:'',' ', $('.out_z_val'+id)[0]?$('.out_z_val'+id)[0].innerText:'');
    // console.log($('.out_x_chk'+id)[0]?$('.out_x_chk'+id)[0].value:'',' ', $('.out_y_chk'+id)[0]?$('.out_y_chk'+id)[0].value:'',' ', $('.out_z_chk'+id)[0]?$('.out_z_chk'+id)[0].value:'');

    Swal.fire({
            title: "Confirm Action",
            text: "Would you like to save this new ratio to be the new default?",
            confirmButtonColor: 'green',
            confirmButtonText: "Only for this exam",
            showCancelButton: true,
        }).then((res)=>{
               if(res.isConfirmed){
                    let form2 = new FormData();
                    console.log($('.out_x_chk'+id)[0]?$('.out_x_chk'+id)[0].checked:0);

                    form2.append("id", updated_paper_id);
                    form2.append("status_x", $('.out_x_chk'+id)[0]?$('.out_x_chk'+id)[0].checked:0)
                    form2.append("status_y", $('.out_y_chk'+id)[0]?$('.out_y_chk'+id)[0].checked:0)
                    form2.append("status_z", $('.out_z_chk'+id)[0]?$('.out_z_chk'+id)[0].checked:0)
                    var ajaxOptions = {
                        url:'/subjects/update_paper',
                        type:'POST',
                        cache:false,
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        data: form2,
                    };

                    var req = $.ajax(ajaxOptions);

                    req.done(function(resp){
                        console.log('resp', resp);

                        resp.ok && resp.msg ? flash({msg:resp.msg, type:'success'}) : flash({msg:resp.msg, type:'danger'});
                        hideAjaxAlert();
                        myObj.parentNode.parentNode.innerHTML =
                            `<div class="d-flex align-items-center justify-content-start">
                                <button class="btn btn-secondary px-4"  onclick="editPaperRatio('`+ updated_paper_id +`', this);">
                                    Edit
                                </button>
                            </div>`;
                        edit_status = false;
                        origin_paper_ratio_id = updated_paper_id;
                        $('.out_x_disable'+id).addClass('active-state');
                        $('.out_x_active'+id).removeClass('active-state');
                        $('.out_x_chk'+id).addClass('active-state');
                        window.location.reload(true);
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
    $('#activeExam').on('click', function(e){
        onActiveExam(e);
    });
    function onActiveExam(e){



         Swal.fire({
                title: "Confirm Action",
                text: "You are able to de-active all subject paper ratios. Proceed with action?",
                confirmButtonColor: 'green',
                confirmButtonText: "Proceed",
                showCancelButton: true,
            }).then((res)=>{
                var txt_active_all = document.querySelector('#txt-active-all');
                // var table = $('#table_config');
                var table = document.getElementById("table_config");
                var tbodyRowCount = table.tBodies[0].rows.length;
                var str = ""; var item = ""
                var currentStr = txt_active_all.textContent;
                currentStr = currentStr.replace(/\s/g, '');
                if(res.isConfirmed == true){
                    if(currentStr == "Disableall"){
                        txt_active_all.innerHTML = "Enable all";
                        for (let index = 0; index < tbodyRowCount; index++)
                        {
                            str="";
                            str = "id" + index
                            var item = document.getElementById(str)
                            // console.log(item.innerHTML);
                            var id = item.innerHTML;
                            // if($('.out_x_chk'+id).hasClass('active-state')){
                            //     $('.out_x_chk'+id).removeClass('active-state');
                            // }
                            // if(!$('.out_x_active'+id).hasClass('active-state')){
                                $('.out_x_active'+id).addClass('active-state');
                            // }
                            // if($('.out_x_disable'+id).hasClass('active-state'))
                            // {
                                $('.out_x_disable'+id).removeClass('active-state');
                            // }
                            // if($('.out_x_chk'+id).is(":checked")==true){
                                $('.out_x_chk'+id).prop('checked', false);
                            // }
                            // if($('.out_y_chk'+id).hasClass('active-state')){
                            //     $('.out_y_chk'+id).removeClass('active-state');
                            // }
                            // if(!$('.out_y_active'+id).addClass('active-state')){
                                $('.out_y_active'+id).addClass('active-state');
                            // }
                            // if($('.out_y_disable'+id).hasClass('active-state')){
                                $('.out_y_disable'+id).removeClass('active-state');
                            // }
                            // if($('.out_y_chk'+id).is(":checked")==true){
                                $('.out_y_chk'+id).prop('checked', false);
                            // }
                            // if($('.out_z_chk'+id).hasClass('active-state')){
                            //     $('.out_z_chk'+id).removeClass('active-state');
                            // }
                            // if(!$('.out_z_active'+id).hasClass('active-state')){
                                $('.out_z_active'+id).addClass('active-state');
                            // }
                            // if($('.out_z_disable'+id).removeClass('active-state')){
                                $('.out_z_disable'+id).removeClass('active-state');
                            // }
                            // if($('.out_z_chk'+id).is(":checked")==true){
                                $('.out_z_chk'+id).prop('checked', false);
                            // }
                            let form2 = new FormData();
                            form2.append("id", id);
                            // form2.append("status_x", 0)
                            // form2.append("status_y", 0)
                            // form2.append("status_z", 0)
                            form2.append("status_x", $('.out_x_chk'+id)[0]?$('.out_x_chk'+id)[0].checked:0)
                            form2.append("status_y", $('.out_y_chk'+id)[0]?$('.out_y_chk'+id)[0].checked:0)
                            form2.append("status_z", $('.out_z_chk'+id)[0]?$('.out_z_chk'+id)[0].checked:0)
                            var ajaxOptions = {
                                url:'/subjects/update_paper',
                                type:'POST',
                                cache:false,
                                processData:false,
                                dataType:'json',
                                contentType:false,
                                data: form2,
                            };

                            var req = $.ajax(ajaxOptions);
                            req.done(function(resp){
                                // console.log('resp', resp);
                                return resp;
                            });
                        }
                    }else{
                        txt_active_all.innerHTML = "Disable all";
                        for (let index = 0; index < tbodyRowCount; index++)
                        {
                            str="";
                            str = "id" + index
                            var item = document.getElementById(str)
                            // console.log(item.innerHTML);
                            var id = item.innerHTML;
                            // if($('.out_x_chk'+id).hasClass('active-state')){
                            //     $('.out_x_chk'+id).removeClass('active-state');
                            // }
                            // if($('.out_x_active'+id).hasClass('active-state')){
                                $('.out_x_active'+id).removeClass('active-state');
                            // }
                            // if(!$('.out_x_disable'+id).hasClass('active-state')){
                                $('.out_x_disable'+id).addClass('active-state');
                            // }
                            // if($('.out_x_chk'+id).is(":checked")==false){
                                $('.out_x_chk'+id).prop('checked', true);
                            // }
                            // if($('.out_y_chk'+id).hasClass('active-state')){
                            //     $('.out_y_chk'+id).removeClass('active-state');
                            // }
                            // if($('.out_y_active'+id).hasClass('active-state')){
                                $('.out_y_active'+id).removeClass('active-state');
                            // }
                            // if(!$('.out_y_disable'+id).hasClass('active-state')){
                                $('.out_y_disable'+id).addClass('active-state');
                            // }
                            // if($('.out_y_chk'+id).is(":checked")==false){
                                $('.out_y_chk'+id).prop('checked', true);
                            // }
                            // if($('.out_z_chk'+id).hasClass('active-state')){
                            //     $('.out_z_chk'+id).removeClass('active-state');
                            // }
                            // if($('.out_z_active'+id).hasClass('active-state')){
                                $('.out_z_active'+id).removeClass('active-state');
                            // }
                            // if(!$('.out_z_disable'+id).addClass('active-state')){
                                $('.out_z_disable'+id).addClass('active-state');
                            // }

                            // if($('.out_z_chk'+id).is(":checked")==false){
                                $('.out_z_chk'+id).prop('checked', true);
                            // }
                            let form2 = new FormData();
                            form2.append("id", id);
                            // form2.append("status_x", 1)
                            // form2.append("status_y", 1)
                            // form2.append("status_z", 1)
                            form2.append("status_x", $('.out_x_chk'+id)[0]?$('.out_x_chk'+id)[0].checked:0)
                            form2.append("status_y", $('.out_y_chk'+id)[0]?$('.out_y_chk'+id)[0].checked:0)
                            form2.append("status_z", $('.out_z_chk'+id)[0]?$('.out_z_chk'+id)[0].checked:0)
                            var ajaxOptions = {
                                url:'/subjects/update_paper',
                                type:'POST',
                                cache:false,
                                processData:false,
                                dataType:'json',
                                contentType:false,
                                data: form2,
                            };

                            var req = $.ajax(ajaxOptions);
                            req.done(function(resp){
                                // console.log('resp', resp);
                                return resp;
                            });
                        }
                    }

                }else{
                    return;
                }
            });
    }
    function selectYear(){
        var currentYearEle = document.getElementById('exam_manage_academic');
        getInitExam(currentYearEle.value)
    }
    function selectExam(){
        var exam_class_tbody = document.getElementById('exam_class_tbody');
        var exam_class_tbody_stream = document.getElementById('exam_class_tbody_stream');
        var exam = document.getElementById('exam_class_select');
        let formData = new FormData();
        if(exam==null){
            formData.append("exam", 0);
        }else{
            formData.append("exam", exam.value);
        }
        var ajaxOptions = {
            url:'class_index',
            type:'POST',
            cache:false,
            processData:false,
            dataType:'json',
            contentType:false,
            data:formData
        };
        var req = $.ajax(ajaxOptions);
        req.done(function(res){
            let k =0, cc='';let flag = 0;


            if(exam.value == ''){
                let myclass = res.myclasses[0];
                console.log('last', res.last);
                for(let myclass of res.myclasses){
                    // console.log("myclass", myclass);
                    for(let myClasses of myclass.form.my_classes){
                    for(let class_subject of myClasses.class_subject){

                        flag = 0;
                        if((res.types=="student" || res.types == "staff" || res.types == "teacher" || res.types == "admin") &&(myclass.exam != null)&&(res.teacher.id ==class_subject.teacher_id) && (myClasses.id == class_subject.my_class_id)){//
                            // console.log(myclass.exam, 'subject', class_subject.subject, class_subject.teacher_id, res.teacher.id);
                            k++;
                            cc += `
                            <tr>
                                <td>` + k + `</td>
                                <td>Form` + myclass.form.name + " " + myClasses.stream + " - " + class_subject.subject.title + " - " + myclass.exam.name + ` </td>`;

                            for (let myClasses1 of res.myclasses1) {
                                if(myClasses1.my_class_id == myClasses.id && myclass.exam_id == myClasses1.exam_id && myClasses1.af == class_subject.subject.id){
                                    flag = 1;
                                    cc += `<td class="text-success">Pending publishing by class `+res.teacher_name+`</td>`;
                                    break;
                                }
                            }
                            if (flag==0) {
                                cc +=`<td class="text-danger">Upload Results</td>`;
                            }
                            cc +=`<td class="text-right">`;

                            if (flag == 1) {
                                cc+=`<a href="exam_class_upload/view/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-success">View</a>`
                                // if(myclass.form.teacher_id==res.teacher.id){
                                //     cc+=`<a href="exam_class_upload/view/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-success">View</a>`
                                // }
                                // else{
                                //     cc+=`<a href="exam_class_upload/view/`+class_subject.id+`/`+myclass.exam_id+`/`+0+`/`+class_subject.subject.id+`" class="btn btn-success">View</a>`
                                // }
                            }else{
                                cc+=`<a href="exam_class/upload/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-info">Upload</a>`
                                // if(myclass.form.teacher_id==res.teacher.id){
                                //     cc+=`<a href="exam_class/upload/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-info">Upload</a>`
                                // }
                                // else{
                                //     cc+=`<a href="exam_class/upload/`+class_subject.id+`/`+myclass.exam_id+`/`+0+`/`+class_subject.subject.id+`" class="btn btn-info">Upload</a>`
                                // }

                            };
                            cc+="</td><td class='d-none'>"+class_subject.id+"</td><td class='d-none'>"+myclass.exam_id+"</td><td class='d-none'>"+myclass.form.teacher_id+"</td><td class='d-none'>"+class_subject.subject.id+"</td></tr>"
                        }
                    }

                }

                }
                // for(let myClasses of myclass.form.my_classes){
                //     for(let class_subject of myClasses.class_subject){

                //         flag = 0;
                //         if((res.types=="student" || res.types == "staff" || res.types == "teacher" || res.types == "admin") &&(myclass.exam != null)&&(res.teacher.id ==class_subject.teacher_id) && (myClasses.id == class_subject.my_class_id)){//
                //             // console.log(myclass.exam, 'subject', class_subject.subject, class_subject.teacher_id, res.teacher.id);
                //             k++;
                //             cc += `
                //             <tr>
                //                 <td>` + k + `</td>
                //                 <td>Form` + myclass.form.name + " " + myClasses.stream + " - " + class_subject.subject.title + " - " + myclass.exam.name + ` </td>`;

                //             for (let myClasses1 of res.myclasses1) {
                //                 if(myClasses1.my_class_id == myClasses.id && myclass.exam_id == myClasses1.exam_id && myClasses1.af == class_subject.subject.id){
                //                     flag = 1;
                //                     cc += `<td class="text-success">Pending publishing by class `+res.teacher_name+`</td>`;
                //                     break;
                //                 }
                //             }
                //             if (flag==0) {
                //                 cc +=`<td class="text-danger">Upload Results</td>`;
                //             }
                //             cc +=`<td class="text-right">`;

                //             if (flag == 1) {
                //                 cc+=`<a href="exam_class_upload/view/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-success">View</a>`
                //                 // if(myclass.form.teacher_id==res.teacher.id){
                //                 //     cc+=`<a href="exam_class_upload/view/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-success">View</a>`
                //                 // }
                //                 // else{
                //                 //     cc+=`<a href="exam_class_upload/view/`+class_subject.id+`/`+myclass.exam_id+`/`+0+`/`+class_subject.subject.id+`" class="btn btn-success">View</a>`
                //                 // }
                //             }else{
                //                 cc+=`<a href="exam_class/upload/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-info">Upload</a>`
                //                 // if(myclass.form.teacher_id==res.teacher.id){
                //                 //     cc+=`<a href="exam_class/upload/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-info">Upload</a>`
                //                 // }
                //                 // else{
                //                 //     cc+=`<a href="exam_class/upload/`+class_subject.id+`/`+myclass.exam_id+`/`+0+`/`+class_subject.subject.id+`" class="btn btn-info">Upload</a>`
                //                 // }

                //             };
                //             cc+="</td><td class='d-none'>"+class_subject.id+"</td><td class='d-none'>"+myclass.exam_id+"</td><td class='d-none'>"+myclass.form.teacher_id+"</td><td class='d-none'>"+class_subject.subject.id+"</td></tr>"
                //         }
                //     }

                // }
            }else{
                for(let myclass of res.myclasses){
                    // console.log("myclass", myclass);
                    for(let myClasses of myclass.form.my_classes){
                    for(let class_subject of myClasses.class_subject){

                        flag = 0;
                        if((res.types=="student" || res.types == "staff" || res.types == "teacher" || res.types == "admin") &&(myclass.exam != null)&&(res.teacher.id ==class_subject.teacher_id) && (myClasses.id == class_subject.my_class_id)){//
                            // console.log(myclass.exam, 'subject', class_subject.subject, class_subject.teacher_id, res.teacher.id);
                            k++;
                            cc += `
                            <tr>
                                <td>` + k + `</td>
                                <td>Form` + myclass.form.name + " " + myClasses.stream + " - " + class_subject.subject.title + " - " + myclass.exam.name + ` </td>`;

                            for (let myClasses1 of res.myclasses1) {
                                if(myClasses1.my_class_id == myClasses.id && myclass.exam_id == myClasses1.exam_id && myClasses1.af == class_subject.subject.id){
                                    flag = 1;
                                    cc += `<td class="text-success">Pending publishing by class `+res.teacher_name+`</td>`;
                                    break;
                                }
                            }
                            if (flag==0) {
                                cc +=`<td class="text-danger">Upload Results</td>`;
                            }
                            cc +=`<td class="text-right">`;

                            if (flag == 1) {
                                cc+=`<a href="exam_class_upload/view/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-success">View</a>`
                                // if(myclass.form.teacher_id==res.teacher.id){
                                //     cc+=`<a href="exam_class_upload/view/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-success">View</a>`
                                // }
                                // else{
                                //     cc+=`<a href="exam_class_upload/view/`+class_subject.id+`/`+myclass.exam_id+`/`+0+`/`+class_subject.subject.id+`" class="btn btn-success">View</a>`
                                // }
                            }else{
                                cc+=`<a href="exam_class/upload/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-info">Upload</a>`
                                // if(myclass.form.teacher_id==res.teacher.id){
                                //     cc+=`<a href="exam_class/upload/`+class_subject.id+`/`+myclass.exam_id+`/`+myclass.form.teacher_id+`/`+class_subject.subject.id+`" class="btn btn-info">Upload</a>`
                                // }
                                // else{
                                //     cc+=`<a href="exam_class/upload/`+class_subject.id+`/`+myclass.exam_id+`/`+0+`/`+class_subject.subject.id+`" class="btn btn-info">Upload</a>`
                                // }

                            };
                            cc+="</td><td class='d-none'>"+class_subject.id+"</td><td class='d-none'>"+myclass.exam_id+"</td><td class='d-none'>"+myclass.form.teacher_id+"</td><td class='d-none'>"+class_subject.subject.id+"</td></tr>"
                        }
                    }

                }

                }
            }

            exam_class_tbody.innerHTML = cc;
            k= 0;cc =''; flag = 0;
            // console.log('stream', res.streams, ' ', res.myclasses1);
            for (let stream of res.streams) {
                for(let myStream of stream.form.my_classes){
                    if (stream.exam == null) {
                        continue;
                    }
                    flag = 0;
                    k++;
                    cc+=`
                    <tr>
                        <td>`+k+`</td>
                        <td>Form`+stream.form.name+` `+myStream.stream+` - `+stream.exam.name+`</td>
                    `;
                    for (let myClasses1 of res.myclasses1) {
                        if(myClasses1.my_class_id == myStream.id && stream.exam_id == myClasses1.exam_id){
                            flag = 1;
                            cc +=`<td>Upload Results</td>`;
                            break;
                        }
                    }
                    if (flag==0) {
                        cc += `<td>Pending publishing by class teacher</td>`;
                    }
                    cc +=`<td class="text-right">`;

                if (flag == 1) {
                    if(stream.form.teacher_id!=''){
                        // cc+=`<a href="exam_class/view/`+stream.exam_id+`/`+stream.form.teacher_id+`" class="btn btn-success">View</a>`
                        cc+=`<span class="text-success">View</span>`
                    }else{
                        // cc+=`<a href="exam_class/view/`+stream.exam_id+`/`+0+`" class="btn btn-success">View</a>`
                        cc+=`<span class="text-success">View</span>`
                    }
                }else{
                    if(stream.form.teacher_id!=''){
                        // cc+=`<a href="exam_class/view/`+stream.exam_id+`/`+stream.form.teacher_id+`" class="btn btn-info">Upload</a>`
                        cc+=`<span class="text-info">Upload</span>`
                    }else{
                        // cc+=`<a href="exam_class/view/`+steam.exam_id+`/`+0+`" class="btn btn-info">Upload</a>`
                        cc+=`<span class="text-info">Upload</span>`
                    }

                };
                cc+="</td><td class='d-none'>"+stream.exam_id+"</td><td class='d-none'>"+stream.form.teacher_id+"</td></tr>"
                }
            }
            exam_class_tbody_stream.innerHTML = cc;

        }).fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        })

    }

    function deleteGrade(class_type_id){
        let formData = new FormData();
        formData.append("class_type_id", class_type_id);
        var ajaxOptions = {
            url:'grade_delete',
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
            window.location.reload();
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        })
        // alert(class_type_id);
        // Swal.fire({
        //     title: "Delete Grade",
        //     text: "Are You sure you'd like to delete Grade ",
        //     confirmButtonColor: 'green',
        //     confirmButtonText: "Okay",
        //     showCancelButton: true,
        // }).then((res)=>{

        // }
    }
    function showStream(myObj){
        if($('.table-stream').hasClass('active-state')){
            console.log(myObj);
            myObj.innerHTML = "Hide Stream";
            $('.table-stream').removeClass('active-state');
        }else{
            console.log(myObj);
            myObj.innerHTML = "Show Stream";
            $('.table-stream').addClass('active-state');
        }
    }
    function recoverFinal(exam_id, form_id, myObj){
        console.log(exam_id, form_id);

        let formData = new FormData();
        formData.append("exam_id", exam_id);
        formData.append("form_id", form_id);
        var ajaxOptions = {
            url:'exam_final_recover',
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
            window.location.reload();
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        })
        // Swal.fire({
        //     title: "Recover Exam",
        //     text: "Are You sure you'd like to recover Exam ",
        //     confirmButtonColor: 'green',
        //     confirmButtonText: "Okay",
        //     showCancelButton: true,
        // }).then((res)=>{
        //     if(res.isConfirmed){

        //     }

        // }

    }
    function deleteFinal(exam_id, form_id, myObj){
        console.log(exam_id, form_id);
        let formData = new FormData();
        formData.append("exam_id", exam_id);
        formData.append("form_id", form_id);
        var ajaxOptions = {
            url:'exam_final_delete',
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
            window.location.reload();
        });
        req.fail(function(e){
            if (e.status == 422){var errors = e.responseJSON.errors; displayAjaxErr(errors);}
            if (e.status == 500){displayAjaxErr([e.status + ' ' + e.statusText + ' Please Check for Duplicate entry or Contact School Administrator/IT Personnel'])}
            if (e.status == 404){displayAjaxErr([e.status + ' ' + e.statusText + ' - Requested Resource or Record Not Found'])}
            return e.status;
        })
        // Swal.fire({
        //     title: "Delete Exam Finally",
        //     text: "Are You sure you'd like to delete Exam ",
        //     confirmButtonColor: 'green',
        //     confirmButtonText: "Okay",
        //     showCancelButton: true,
        // }).then((res)=>{
        //     if(res.isConfirmed){

        //     }

        // }
    }
    function validate(id, myObj){
        const mark = document.getElementById('exam_class_upload_max').value
        const selectedEle = document.getElementsByName('mark'+id)[0];
        if(Number(mark)<Number(selectedEle.value)){
            // alert('fail');
            Swal.fire({
                title: "Higer Value Warning",
                text: "Maximumvalue should be " + mark,
                confirmButtonColor: 'green',
                confirmButtonText: "Okay",
                showCancelButton: true,
            }).then((res)=>{
                if(res.isConfirmed){
                    selectedEle.value = "";
                    selectedEle.focus();
                }
            });
        }

    }
</script>
