<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
  });
  var message_receiver_type_elem = document.querySelectorAll('input[name=receiver_type]');
  var message_type_category_elem = document.querySelectorAll('label[for=message_type_category]');
  var message_type_category_detail_elem = document.querySelectorAll('label[for=message_type_category_detail]');

  var message_receiver_type_setting = document.querySelector('#receiver_type_text');
  var btn_receiver_type_setting = document.querySelector('#set-message-receiver-type-btn');
  var btn_back_message_type_btn = document.querySelector('#back-message-type-btn');
  var btn_next_message_type_btn = document.querySelector('#next-message-type-btn');
  var btn_back_message_content_btn = document.querySelector('#back-message-content-btn');
  var final_message_btn = document.querySelector('#final_message_btn');
  var btn_message_view_sms = document.querySelector('#message-view-sms');

  var chk_all_students = document.querySelector('#All_Students_Message');
  var chk_specific_student = document.querySelector('#Specific_Students_Message');
  var chk_specific_classes_group = document.querySelector('#Specific_Classes_Message');
  var chk_exam_results_message = document.querySelector('#Exam_Results_Message');

  var chk_all_teachers = document.querySelector('#All_Teachers_Message');
  var chk_specific_teacher = document.querySelector('#Specific_Teachers_Message');
  var chk_specific_teacher_group = document.querySelector('#Teachers_Groups_Message');

  var chk_all_bom = document.querySelector('#All_BOM_Message');
  var chk_specific_bom = document.querySelector('#Specific_BOM_Message');
  var chk_bom_group = document.querySelector('#BOM_Groups_Message');

  var chk_all_staff = document.querySelector('#All_Staff_Message');
  var chk_specific_staff = document.querySelector('#Specific_Staff_Message');
  var chk_staff_group = document.querySelector('#Staff_Groups_Message');


  var message_second_body_category = document.querySelector('#message-second-body-category');
  var message_second_body_category_detail = document.querySelector('#message-second-body-category-detail');

  var message_second_badge = document.querySelector('#message-second-badge');
  var message_first_badge = document.querySelector('#message-first-badge');

//   var btn_send_message_content_btn = document.querySelector('#send-message-content-btn');
  var message_second_footer =  document.querySelector('#message-second-footer');

  var message_final_category = document.querySelector('#message-final-category');
  var message_final_phone = document.querySelector('#message-final-phone');
  var Student_Receiver = document.querySelector('#Student_Receiver');


  for (const radioButton of message_receiver_type_elem) {
    radioButton.addEventListener('change', displayReceiverType);
  }

  message_first_badge.addEventListener('click', showReceivents);
  function showReceivents(e){
    var message_final_title = document.querySelector('#message-final-title');
    var message_final_badge = document.querySelector('#message-final-badge');
    var message_final_body = document.querySelector('#message-final-body');
    var message_final_body1 = document.querySelector('#message-final-body1');

    var message_second_body_students = document.querySelector('#message-second-body-students');
    var message_second_body_teachers = document.querySelector('#message-second-body-teachers');
    var message_second_body_bompa = document.querySelector('#message-second-body-bompa');
    var message_second_body_staff = document.querySelector('#message-second-body-staff');
    var message_second_body_alumni = document.querySelector('#message-second-body-alumni');
    var message_first_body = document.querySelector('#message-first-body');

    var message_second_title = document.querySelector('#message-second-title');
    var message_second_badge = document.querySelector('#message-second-badge');

    var message_final_title = document.querySelector('#message-final-title');
    var message_final_badge = document.querySelector('#message-final-badge');

    message_final_title.classList.remove('active-font-state');
    message_final_badge.classList.remove('active-badge-state');
    message_final_badge.classList.add('badge-primary');

    message_final_title.classList.add('active-font-state');
    message_final_badge.classList.add('active-badge-state');
    message_final_badge.classList.remove('badge-primary');
    message_final_body.classList.add('active-state');
    message_final_body1.classList.add('active-state');
    message_second_footer.classList.add('active-state');


    message_second_body_students.classList.add('active-state');
    message_second_body_teachers.classList.add('active-state');
    message_second_body_bompa.classList.add('active-state');
    message_second_body_staff.classList.add('active-state');
    message_second_body_alumni.classList.add('active-state');

    message_second_title.classList.add('active-font-state');
    message_second_badge.classList.add('active-badge-state');
    message_second_badge.classList.remove('badge-primary');
    message_first_body.classList.remove('active-state');
    message_second_body_category.classList.remove('active-state');
    final_message_btn.classList.add('active-state');
  }
  function displayReceiverType(e){
    // console.log(e);
    // console.log('class', message_second_body_category.className);
    // console.log(chk_specific_teacher.checked);
    message_second_body_category.classList.add('active-state');
    message_second_body_category_detail.classList.add('active-state');
    console.log(e.target.value);
    if(e.target.value=="Other"){
        message_final_phone.classList.remove('active-state');
    }else{
        message_final_phone.classList.add('active-state');
    }
    if(message_receiver_type_setting.innerText == "Students"){
        if(chk_all_teachers.checked){
            chk_all_teachers.checked = false;
        }
        if(chk_specific_teacher.checked){
            chk_specific_teacher.checked = false;
        }
        if(chk_specific_teacher_group.checked){
            chk_specific_teacher_group.checked = false;
        }
        if(chk_all_staff.checked){
            chk_all_staff.checked = false;
        }
        if(chk_specific_staff.checked){
            chk_specific_staff.checked = false;
        }
        if(chk_staff_group.checked){
            chk_staff_group.checked = false;
        }
        if(chk_all_bom.checked){
            chk_all_bom.checked = false;
        }
        if(chk_specific_bom.checked){
            chk_specific_bom.checked = false;
        }
        if(chk_bom_group.checked){
            chk_bom_group.checked = false;
        }
        // if (!message_second_body_category.className.includes("active-state")) {
        //     message_second_body_category.classList.add('active-state');
        // }
    }
    if(message_receiver_type_setting.innerText == "Teachers"){
        if(chk_all_students.checked){
            chk_all_students.checked = false;
        }
        if(chk_specific_student.checked){
            chk_specific_student.checked = false;
        }
        if(chk_specific_classes_group.checked){
            chk_specific_classes_group.checked = false;
        }
        if(chk_exam_results_message.checked){
            chk_exam_results_message.checked = false;
        }
        if(chk_all_staff.checked){
            chk_all_staff.checked = false;
        }
        if(chk_specific_staff.checked){
            chk_specific_staff.checked = false;
        }
        if(chk_staff_group.checked){
            chk_staff_group.checked = false;
        }
        if(chk_all_bom.checked){
            chk_all_bom.checked = false;
        }
        if(chk_specific_bom.checked){
            chk_specific_bom.checked = false;
        }
        if(chk_bom_group.checked){
            chk_bom_group.checked = false;
        }
    }
    if(message_receiver_type_setting.innerText == "BOM/PA"){
        if(chk_all_students.checked){
            chk_all_students.checked = false;
        }
        if(chk_specific_student.checked){
            chk_specific_student.checked = false;
        }
        if(chk_specific_classes_group.checked){
            chk_specific_classes_group.checked = false;
        }
        if(chk_exam_results_message.checked){
            chk_exam_results_message.checked = false;
        }
        if(chk_all_staff.checked){
            chk_all_staff.checked = false;
        }
        if(chk_specific_staff.checked){
            chk_specific_staff.checked = false;
        }
        if(chk_staff_group.checked){
            chk_staff_group.checked = false;
        }
        if(chk_all_teachers.checked){
            chk_all_teachers.checked = false;
        }
        if(chk_specific_teacher.checked){
            chk_specific_teacher.checked = false;
        }
        if(chk_specific_teacher_group.checked){
            chk_specific_teacher_group.checked = false;
        }
     }
    if(message_receiver_type_setting.innerText == "Staff"){
        if(chk_all_students.checked){
            chk_all_students.checked = false;
        }
        if(chk_specific_student.checked){
            chk_specific_student.checked = false;
        }
        if(chk_specific_classes_group.checked){
            chk_specific_classes_group.checked = false;
        }
        if(chk_exam_results_message.checked){
            chk_exam_results_message.checked = false;
        }
        if(chk_all_teachers.checked){
            chk_all_teachers.checked = false;
        }
        if(chk_specific_teacher.checked){
            chk_specific_teacher.checked = false;
        }
        if(chk_specific_teacher_group.checked){
            chk_specific_teacher_group.checked = false;
        }
        if(chk_all_bom.checked){
            chk_all_bom.checked = false;
        }
        if(chk_specific_bom.checked){
            chk_specific_bom.checked = false;
        }
        if(chk_bom_group.checked){
            chk_bom_group.checked = false;
        }
    }
    if(message_receiver_type_setting.innerText == "Alumni"){
        if(chk_all_students.checked){
            chk_all_students.checked = false;
        }
        if(chk_specific_student.checked){
            chk_specific_student.checked = false;
        }
        if(chk_specific_classes_group.checked){
            chk_specific_classes_group.checked = false;
        }
        if(chk_exam_results_message.checked){
            chk_exam_results_message.checked = false;
        }
        if(chk_all_teachers.checked){
            chk_all_teachers.checked = false;
        }
        if(chk_specific_teacher.checked){
            chk_specific_teacher.checked = false;
        }
        if(chk_specific_teacher_group.checked){
            chk_specific_teacher_group.checked = false;
        }
        if(chk_all_bom.checked){
            chk_all_bom.checked = false;
        }
        if(chk_specific_bom.checked){
            chk_specific_bom.checked = false;
        }
        if(chk_bom_group.checked){
            chk_bom_group.checked = false;
        }
        if(chk_all_staff.checked){
            chk_all_staff.checked = false;
        }
        if(chk_specific_staff.checked){
            chk_specific_staff.checked = false;
        }
        if(chk_staff_group.checked){
            chk_staff_group.checked = false;
        }
        if (!message_second_body_category.className.includes("active-state")) {
            message_second_body_category.classList.add('active-state');
        }
    }
    if(message_receiver_type_setting.innerText == "Other"){
        console.log('phone');

        if(chk_all_students.checked){
            chk_all_students.checked = false;
        }
        if(chk_specific_student.checked){
            chk_specific_student.checked = false;
        }
        if(chk_specific_classes_group.checked){
            chk_specific_classes_group.checked = false;
        }
        if(chk_exam_results_message.checked){
            chk_exam_results_message.checked = false;
        }
        if(chk_all_teachers.checked){
            chk_all_teachers.checked = false;
        }
        if(chk_specific_teacher.checked){
            chk_specific_teacher.checked = false;
        }
        if(chk_specific_teacher_group.checked){
            chk_specific_teacher_group.checked = false;
        }
        if(chk_all_bom.checked){
            chk_all_bom.checked = false;
        }
        if(chk_specific_bom.checked){
            chk_specific_bom.checked = false;
        }
        if(chk_bom_group.checked){
            chk_bom_group.checked = false;
        }
        if(chk_all_staff.checked){
            chk_all_staff.checked = false;
        }
        if(chk_specific_staff.checked){
            chk_specific_staff.checked = false;
        }
        if(chk_staff_group.checked){
            chk_staff_group.checked = false;
        }
        if (!message_second_body_category.className.includes("active-state")) {
            message_second_body_category.classList.add('active-state');
        }

    }
    if (this.checked) {
        message_receiver_type_setting.innerText = `${this.value}`;
    }
  }

  chk_all_students.addEventListener('change', showMessageTypeCategory);
  chk_specific_student.addEventListener('change', showMessageTypeCategory);
  chk_specific_classes_group.addEventListener('change', showMessageTypeCategory);
  chk_exam_results_message.addEventListener('change', showMessageTypeCategory);

  chk_all_teachers.addEventListener('change', showMessageTypeCategory)
  chk_specific_teacher.addEventListener('change', showMessageTypeCategory);
  chk_specific_teacher_group.addEventListener('change', showMessageTypeCategory);
  chk_all_bom.addEventListener('change', showMessageTypeCategory);
  chk_specific_bom.addEventListener('change', showMessageTypeCategory);
  chk_bom_group.addEventListener('change', showMessageTypeCategory);
  chk_all_staff.addEventListener('change', showMessageTypeCategory);
  chk_specific_staff.addEventListener('change', showMessageTypeCategory);
  chk_staff_group.addEventListener('change', showMessageTypeCategory);

  var selectElem = document.querySelector('#message_type_category');
  var selectElemDetail = document.querySelector('#message_type_category_detail');

  function showMessageTypeCategory(e){
    console.log('specific');
    if(message_second_body_category.classList){
        message_second_body_category.classList.add('active-state');
    }
    var ajaxUrl = '';

    var temp='';
    if (this.checked) {
        // console.log(e.target.classList)
        // message_type_category_elem.innerText = `${this.value}`;
        // console.log(e.target.defaultValue);
        // console.log(message_type_category_elem[0])
        switch (e.target.defaultValue) {
            case "All Students":
                chk_specific_student.checked = false;
                chk_specific_classes_group.checked = false;
                chk_exam_results_message.checked = false;
                ajaxUrl ="all";
                break;
            case "Specific Students":
                chk_all_students.checked = false;
                chk_specific_classes_group.checked = false;
                chk_exam_results_message.checked = false;
                ajaxUrl ="studentGroup";
                message_type_category_elem[0].innerHTML = "Form";
                break;
            case "Specific Classes":
                chk_specific_student.checked = false;
                chk_all_students.checked = false;
                chk_exam_results_message.checked = false;
                ajaxUrl ="studentGroup";
                message_type_category_elem[0].innerHTML = "Form";
                break;
            case "Exam Results":
                chk_specific_student.checked = false;
                chk_specific_classes_group.checked = false;
                chk_all_students.checked = false;
                ajaxUrl ="studentGroup";
                message_type_category_elem[0].innerHTML = "Form";
                break;
            case "All Teachers":
                chk_specific_teacher_group.checked=false;
                chk_specific_teacher.checked = false;
                ajaxUrl ="all";
                break;
            case "Specific Teachers":
                chk_specific_teacher_group.checked=false;
                chk_all_teachers.checked = false;
                message_type_category_elem[0].innerHTML = "Teachers";
                ajaxUrl = 'specificTeachers';
                break;
            case "Teachers Groups":
                chk_specific_teacher.checked=false;
                chk_all_teachers.checked = false;
                message_type_category_elem[0].innerHTML = "Teachers Groups";
                ajaxUrl = 'groupTeachers';
                break;
            case "All BOM/PA members":
                chk_bom_group.checked=false;
                chk_specific_bom.checked=false;
                break;
            case "Specific BOM/PA members":
                chk_bom_group.checked=false;
                chk_all_bom.checked = false;
                message_type_category_elem[0].innerHTML = "BOM/PA Members";
                ajaxUrl = "specificBomMembers";
                break;
            case "BOM/PA Groups":
                chk_specific_bom.checked=false;
                chk_all_bom.checked=false;
                message_type_category_elem[0].innerHTML = "BOM/PA Groups";
                ajaxUrl = 4;
                break;
            case "All Staff members":
                chk_staff_group.checked=false;
                chk_specific_staff.checked=false;
                break;
            case "Specific Staff members":
                chk_all_staff.checked=false;
                chk_staff_group.checked=false;
                message_type_category_elem[0].innerHTML = "Staff Members";
                ajaxUrl = "specificStaffMembers";
                break;
            case "Staff Groups":
                chk_all_staff.checked=false;
                chk_specific_staff.checked=false;
                message_type_category_elem[0].innerHTML = "Staff Groups";
                ajaxUrl = "groupStaffs";
                break;

            default:
                break;
        }
        if(ajaxUrl!="all"){
            if(ajaxUrl!=4){
                var ajaxOptions = {
                url: ajaxUrl,
                type: 'GET',
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                }
                var req = $.ajax(ajaxOptions);
                req.done(function(resp){
                    console.log('response', resp);

                    var length = selectElem.options.length;
                    for (i = length-1; i >= 1; i--) {
                        selectElem.options[i] = null;
                    }
                    resp.forEach(item => {
                        var opt = document.createElement('option');
                        opt.value = item.id;
                        opt.innerHTML = item.name;
                        selectElem.appendChild(opt);
                    });

                    var length1 = selectElemDetail.options.length;
                    for (i = length1-1; i >= 1; i--) {
                        selectElemDetail.options[i] = null;
                    }

                    return resp;
                }).fail(function(e){
                    console.error(e)
                    return e.status;
                });


            }else{

                var length = selectElem.options.length;
                for (i = length-1; i >= 1; i--) {
                    selectElem.options[i] = null;
                }
                var opt = document.createElement('option');
                opt.value = "1";
                opt.innerHTML = "BOM/PA";
                selectElem.appendChild(opt);
                var length1 = selectElemDetail.options.length;
                for (i = length1-1; i >= 1; i--) {
                    selectElemDetail.options[i] = null;
                }
            }
            message_second_body_category.classList.remove('active-state');
            message_second_body_category_detail.classList.add('active-state');

        }else{
            message_second_body_category.classList.add('active-state');
            message_second_body_category_detail.classList.add('active-state');
        }

    }
  }

  message_second_badge.addEventListener('click', settingReceiverTypeOnly);
  function settingReceiverTypeOnly(e){
    e.preventDefault();
    var message_second_title = document.querySelector('#message-second-title');
    var message_second_badge = document.querySelector('#message-second-badge');

    var message_second_body_students = document.querySelector('#message-second-body-students');
    var message_second_body_teachers = document.querySelector('#message-second-body-teachers');
    var message_second_body_bompa = document.querySelector('#message-second-body-bompa');
    var message_second_body_staff = document.querySelector('#message-second-body-staff');
    var message_second_body_alumni = document.querySelector('#message-second-body-alumni');

    var message_first_body = document.querySelector('#message-first-body');
    message_second_title.classList.remove('active-font-state');
    message_second_badge.classList.remove('active-badge-state');
    message_second_badge.classList.add('badge-primary');
    message_first_body.classList.add('active-state');
    message_second_footer.classList.remove('active-state');
    message_second_body_category.classList.add('active-state');
    var message_final_title = document.querySelector('#message-final-title');
    var message_final_badge = document.querySelector('#message-final-badge');
    var message_final_body = document.querySelector('#message-final-body');
    var message_final_body1 = document.querySelector('#message-final-body1');
    message_final_title.classList.add('active-font-state');
    message_final_badge.classList.add('active-badge-state');
    message_final_badge.classList.remove('badge-primary');
    message_final_body.classList.add('active-state');
    message_final_body1.classList.add('active-state');
    switch (message_receiver_type_setting.innerText) {
        case "Students":
            message_second_body_students.classList.remove('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_alumni.classList.add('active-state');
            break;
        case "Teachers":
            message_second_body_teachers.classList.remove('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_alumni.classList.add('active-state');
            break;
        case "BOM/PA":
            message_second_body_bompa.classList.remove('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_alumni.classList.add('active-state');
            break;
        case "Staff":
            message_second_body_staff.classList.remove('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_body_alumni.classList.add('active-state');
            break;
        case "Alumni":
            message_second_body_alumni.classList.remove('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            break;
        case "Other":
            message_second_footer.classList.add('active-state');
            message_first_body.classList.remove('active-state');
            message_second_badge.classList.add('active-badge-state');
            message_second_badge.classList.remove('badge-primary');
            break;
        default:
            break;
    }
  }

  btn_receiver_type_setting.addEventListener('click', settingReceiverType);
  function settingReceiverType(e){
    e.preventDefault();
    var message_second_title = document.querySelector('#message-second-title');
    var message_second_badge = document.querySelector('#message-second-badge');

    var message_second_body_students = document.querySelector('#message-second-body-students');
    var message_second_body_teachers = document.querySelector('#message-second-body-teachers');
    var message_second_body_bompa = document.querySelector('#message-second-body-bompa');
    var message_second_body_staff = document.querySelector('#message-second-body-staff');
    var message_second_body_alumni = document.querySelector('#message-second-body-alumni');

    var message_first_body = document.querySelector('#message-first-body');
    message_second_title.classList.remove('active-font-state');
    message_second_badge.classList.remove('active-badge-state');
    message_second_badge.classList.add('badge-primary');
    message_first_body.classList.add('active-state');
    message_second_footer.classList.remove('active-state');
    message_second_body_category.classList.add('active-state');
    final_message_btn.classList.add('active-state');
    message_final_category.classList.remove('active-state');

    switch (message_receiver_type_setting.innerText) {
        case "Students":
            message_second_body_students.classList.remove('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_alumni.classList.add('active-state');
            break;
        case "Teachers":
            message_second_body_teachers.classList.remove('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_alumni.classList.add('active-state');
            break;
        case "BOM/PA":
            message_second_body_bompa.classList.remove('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_alumni.classList.add('active-state');
            break;
        case "Staff":
            message_second_body_staff.classList.remove('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_body_alumni.classList.add('active-state');
            break;
        case "Alumni":
            message_second_body_alumni.classList.remove('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            break;
        case "Other":
            message_second_body_alumni.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_footer.classList.add('active-state');
            message_second_title.classList.add('active-font-state');
            message_second_badge.classList.add('active-badge-state');
            var message_final_title = document.querySelector('#message-final-title');
            var message_final_badge = document.querySelector('#message-final-badge');
            var message_final_body = document.querySelector('#message-final-body');
            message_final_title.classList.remove('active-font-state');
            message_final_badge.classList.remove('active-badge-state');
            message_final_badge.classList.add('badge-primary');
            message_final_body.classList.remove('active-state');
            final_message_btn.classList.remove('active-state');
            message_final_category.classList.add('active-state');
            break;
        default:
            break;
    }
  }
  btn_back_message_type_btn.addEventListener('click', backMessageType);
  function backMessageType(e){
    e.preventDefault();
    var message_final_title = document.querySelector('#message-final-title');
    var message_final_badge = document.querySelector('#message-final-badge');
    var message_final_body = document.querySelector('#message-final-body');
    var message_final_body1 = document.querySelector('#message-final-body1');
    var message_first_body = document.querySelector('#message-first-body');

    var message_second_body_students = document.querySelector('#message-second-body-students');
    var message_second_body_teachers = document.querySelector('#message-second-body-teachers');
    var message_second_body_bompa = document.querySelector('#message-second-body-bompa');
    var message_second_body_staff = document.querySelector('#message-second-body-staff');
    var message_second_body_alumni = document.querySelector('#message-second-body-alumni');

    var message_second_title = document.querySelector('#message-second-title');
    var message_second_badge = document.querySelector('#message-second-badge');

    message_final_badge.classList.remove('badge-primary');
    message_final_title.classList.add('active-font-state');
    message_final_badge.classList.add('active-badge-state');
    message_second_title.classList.add('active-font-state');
    message_second_badge.classList.add('active-badge-state');
    message_final_body.classList.add('active-state');

    message_final_body1.classList.add('active-state');
    final_message_btn.classList.add('active-state');
    message_first_body.classList.remove('active-state');

    message_second_footer.classList.add('active-state');

    message_second_body_students.classList.add('active-state');
    message_second_body_teachers.classList.add('active-state');
    message_second_body_bompa.classList.add('active-state');
    message_second_body_staff.classList.add('active-state');
    message_second_body_alumni.classList.add('active-state');
    final_message_btn.classList.remove('active-state');
    message_second_body_category.classList.add('active-state');
    chk_all_students.checked = false;
    chk_specific_student.checked = false;
    chk_specific_classes_group.checked = false;
    chk_exam_results_message.checked = false;
    chk_all_bom.checked = false;
    chk_specific_bom.checked = false;
    chk_bom_group.checked = false;
    chk_all_staff.checked = false;
    chk_specific_staff.checked = false;
    chk_staff_group.checked = false;

  }
  btn_next_message_type_btn.addEventListener('click', nextMessageType);
  function nextMessageType(e){
    e.preventDefault();
    var message_final_title = document.querySelector('#message-final-title');
    var message_final_badge = document.querySelector('#message-final-badge');
    var message_final_body = document.querySelector('#message-final-body');
    var message_final_body1 = document.querySelector('#message-final-body1');

    var message_second_body_students = document.querySelector('#message-second-body-students');
    var message_second_body_teachers = document.querySelector('#message-second-body-teachers');
    var message_second_body_bompa = document.querySelector('#message-second-body-bompa');
    var message_second_body_staff = document.querySelector('#message-second-body-staff');
    var message_second_body_alumni = document.querySelector('#message-second-body-alumni');

    final_message_btn.classList.remove('active-state');
    message_final_title.classList.remove('active-font-state');
    message_final_badge.classList.remove('active-badge-state');
    message_final_badge.classList.add('badge-primary');
    message_final_body.classList.add('active-state');
    message_final_body1.classList.add('active-state');
    console.log('specific', chk_specific_student.checked);
    console.log('group', chk_specific_classes_group.checked);
    console.log('exam', chk_exam_results_message.checked);

    if(chk_specific_student.checked || chk_specific_classes_group.checked || chk_exam_results_message.checked){
        console.log('second');
        message_final_body1.classList.remove('active-state');
    }else{
        console.log('first');
        message_final_body.classList.remove('active-state');
    }

    message_second_footer.classList.add('active-state');


    message_second_body_students.classList.add('active-state');
    message_second_body_teachers.classList.add('active-state');
    message_second_body_bompa.classList.add('active-state');
    message_second_body_staff.classList.add('active-state');
    message_second_body_alumni.classList.add('active-state');

    message_second_body_category.classList.add('active-state');
  }
  btn_back_message_content_btn.addEventListener('click', backMessageContent);
  function backMessageContent(e){
    e.preventDefault();
    var message_final_title = document.querySelector('#message-final-title');
    var message_final_badge = document.querySelector('#message-final-badge');
    var message_final_body = document.querySelector('#message-final-body');
    var message_final_body1 = document.querySelector('#message-final-body1');
    var message_first_body = document.querySelector('#message-first-body');

    var message_second_body_students = document.querySelector('#message-second-body-students');
    var message_second_body_teachers = document.querySelector('#message-second-body-teachers');
    var message_second_body_bompa = document.querySelector('#message-second-body-bompa');
    var message_second_body_staff = document.querySelector('#message-second-body-staff');
    var message_second_body_alumni = document.querySelector('#message-second-body-alumni');
    var message_second_title = document.querySelector('#message-second-title');
    var message_second_badge = document.querySelector('#message-second-badge');

    message_final_badge.classList.remove('badge-primary');
    message_final_title.classList.add('active-font-state');
    message_final_badge.classList.add('active-badge-state');
    message_first_body.classList.add('active-state');
    message_second_body_students.classList.remove('active-state');
    message_final_body.classList.add('active-state');
    message_final_body1.classList.add('active-state');
    final_message_btn.classList.add('active-state');
    message_second_footer.classList.remove('active-state');
    message_second_body_category.classList.remove('active-state');
    message_second_body_category_detail.classList.add('active-state');
    switch (message_receiver_type_setting.innerText) {
        case "Students":
            message_second_body_students.classList.remove('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            break;
        case "Teachers":
            message_second_body_teachers.classList.remove('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            if(chk_specific_teacher_group.checked){
                message_second_body_category.classList.remove('active-state');
            }
            if(chk_specific_teacher.checked){
                message_second_body_category.classList.remove('active-state');
            }
            break;
        case "BOM/PA":
            message_second_body_bompa.classList.remove('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            if(chk_bom_group.checked){
               message_second_body_category.classList.remove('active-state');
            }
            if(chk_specific_bom.checked){
               message_second_body_category.classList.remove('active-state');
            }
            break;
        case "Staff":
            message_second_body_staff.classList.remove('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            if(chk_specific_staff.checked){
                message_second_body_category.classList.remove('active-state');
            }
            if(chk_staff_group.checked){
                message_second_body_category.classList.remove('active-state');
            }
            break;
        case "Alumni":
            message_second_body_alumni.classList.remove('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_body_category.classList.add('active-state');
            message_second_body_category_detail.classList.add('active-state');
            break;
        case "Other":
            message_second_body_alumni.classList.add('active-state');
            message_second_body_staff.classList.add('active-state');
            message_second_body_bompa.classList.add('active-state');
            message_second_body_teachers.classList.add('active-state');
            message_second_body_students.classList.add('active-state');
            message_second_footer.classList.add('active-state');
            message_second_title.classList.add('active-font-state');
            message_second_badge.classList.add('active-badge-state');
            message_final_title.classList.add('active-font-state');
            message_final_badge.classList.add('active-badge-state');
            message_final_badge.classList.remove('badge-primary');
            message_final_body.classList.add('active-state');
            message_first_body.classList.remove('active-state');
            message_second_body_category.classList.add('active-state');
            message_second_body_category_detail.classList.add('active-state');
            break;
        default:
            break;
    }

  }
  btn_message_view_sms.addEventListener('click', viewSMSMessage);
  function viewSMSMessage(e){
    console.log('vieSMSMessage');
  }

//   btn_send_message_content_btn.addEventListener('click', sendMessageContent);
//   function sendMessageContent(e){
//     // e.preventDefault();
//     console.log('send');
//     chk_all_students.checked = false;
//     chk_specific_student.checked = false;
//     chk_specific_classes_group.checked = false;
//     chk_exam_results_message.checked = false;
//     chk_all_bom.checked = false;
//     chk_specific_bom.checked = false;
//     chk_bom_group.checked = false;
//     chk_all_staff.checked = false;
//     chk_specific_staff.checked = false;
//     chk_staff_group.checked = false;
//     Student_Receiver.checked = true;
//   }

  function selectChange(){
    console.log('ok');
    var ajaxUrlDetail = ''
    message_type_category_detail_elem[0].innerHTML='';
    if(message_receiver_type_setting.innerText=="Students"){
        if(chk_specific_student.checked){
        ajaxUrlDetail = 'specificStudents';
        // console.log(selectElem.value, ajaxUrlDetail);
        message_type_category_detail_elem[0].innerHTML = "Students";
        // chk_specific_student.checked=false;
        }
        if(chk_specific_classes_group.checked){
            ajaxUrlDetail = 'specificClasses';
            message_type_category_detail_elem[0].innerHTML = "Classes";
            // chk_specific_classes_group.checked =false;
            // console.log(selectElem.value, ajaxUrlDetail);
        }
        if(chk_exam_results_message.checked){
            ajaxUrlDetail = 'examResults';
            message_type_category_detail_elem[0].innerHTML = "Exams";
            // chk_exam_results_message.checked =false;
            // console.log(selectElem.value, ajaxUrlDetail);
        }
        if(ajaxUrlDetail!=""){
            let form = new FormData();
            form.append("form_id", selectElem.value);
            var ajaxOptions = {
                    url: ajaxUrlDetail,
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

                var length = selectElemDetail.options.length;
                for (i = length-1; i >= 1; i--) {
                    selectElemDetail.options[i] = null;
                }
                resp.forEach(item => {
                    var opt = document.createElement('option');
                    opt.value = item.id;
                    opt.innerHTML = item.name;
                    selectElemDetail.appendChild(opt);
                });
                return resp;
            }).fail(function(e){
                console.error(e)
                return e.status;
            });
            message_second_body_category_detail.classList.remove('active-state');
        }
    }
  }
    // $(document).ready(function(){
    //     var multipleCancelButton = new Choices('#message_type_category', {
    //     removeItemButton: true,
    //     maxItemCount:5,
    //     searchResultLimit:5,
    //     renderChoiceLimit:5
    //     });
    // });
</script>
