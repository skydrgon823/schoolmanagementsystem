<?php

Auth::routes();

//Route::get('/test', 'TestController@index')->name('test');
Route::get('/privacy-policy', 'HomeController@privacy_policy')->name('privacy_policy');
Route::get('/terms-of-use', 'HomeController@terms_of_use')->name('terms_of_use');
Route::get('language/{locale}', 'LocalizationController@swp');
Route::post('getUser', 'HomeController@getUser');
Route::post('getForgotUser', 'HomeController@getForgotUser');
Route::post('sendCode', 'HomeController@sendCode');
Route::post('existPhone', 'HomeController@existPhone');
Route::post('setPassword', 'HomeController@setPassword');
Route::post('setAdmin', 'HomeController@setAdmin');
Route::post('passwordRequest', 'HomeController@passwordRequest');
Route::post('contactRequest', 'HomeController@contactRequest');
Route::post('updateMessageState', 'HomeController@updateMessageState');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@dashboard')->name('home');

    // Route::get('/landing', 'HomeController@index')->name('home');
    // Route::post('/login', 'HomeController@login')->name('login');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    Route::group(['prefix' => 'my_account'], function() {
        Route::get('/', 'MyAccountController@edit_profile')->name('my_account');
        Route::put('/', 'MyAccountController@update_profile')->name('my_account.update');
        Route::put('/change_password', 'MyAccountController@change_pass')->name('my_account.change_pass');
        Route::get('/change_password', 'MyAccountController@show_pass')->name('my_account.show_pass');
        Route::get('/change_password_reset', 'MyAccountController@show_pass_reset')->name('my_account.show_pass_reset');
        // Route::get('/change_password_reset', function(){
        //     return view('pages.support_team.my_pass_reset');
        // })->name('my_account.show_pass_reset');
    });

    /*************** Support Team *****************/
    Route::group(['namespace' => 'SupportTeam',], function(){

        /*************** Students *****************/
        Route::group(['prefix' => 'students'], function(){
            Route::get('reset_pass/{st_id}', 'StudentRecordController@reset_pass')->name('st.reset_pass');
            Route::get('graduated', 'StudentRecordController@graduated')->name('students.graduated');
            Route::put('not_graduated/{id}', 'StudentRecordController@not_graduated')->name('st.not_graduated');
            Route::get('list/{class_id}', 'StudentRecordController@listByClass')->name('students.list')->middleware('teamSAT');

            /* Promotions */
            Route::post('promote_selector', 'PromotionController@selector')->name('students.promote_selector');
            Route::get('promotion/manage', 'PromotionController@manage')->name('students.promotion_manage');
            Route::delete('promotion/reset/{pid}', 'PromotionController@reset')->name('students.promotion_reset');
            Route::delete('promotion/reset_all', 'PromotionController@reset_all')->name('students.promotion_reset_all');
            Route::get('promotion/{fc?}/{fs?}/{tc?}/{ts?}', 'PromotionController@promotion')->name('students.promotion');
            Route::post('promote/{fc}/{fs}/{tc}/{ts}', 'PromotionController@promote')->name('students.promote');

        });

        /*************** Users *****************/
        Route::group(['prefix' => 'users'], function(){
            Route::get('reset_pass/{id}', 'UserController@reset_pass')->name('users.reset_pass');
        });

        /*************** TimeTables *****************/
        Route::group(['prefix' => 'timetables'], function(){
            Route::get('/', 'TimeTableController@index')->name('tt.index');

            Route::group(['middleware' => 'teamSA'], function() {
                Route::post('/', 'TimeTableController@store')->name('tt.store');
                Route::put('/{tt}', 'TimeTableController@update')->name('tt.update');
                Route::delete('/{tt}', 'TimeTableController@delete')->name('tt.delete');
            });

            /*************** TimeTable Records *****************/
            Route::group(['prefix' => 'records'], function(){

                Route::group(['middleware' => 'teamSA'], function(){
                    Route::get('manage/{ttr}', 'TimeTableController@manage')->name('ttr.manage');
                    Route::post('/', 'TimeTableController@store_record')->name('ttr.store');
                    Route::get('edit/{ttr}', 'TimeTableController@edit_record')->name('ttr.edit');
                    Route::put('/{ttr}', 'TimeTableController@update_record')->name('ttr.update');
                });

                Route::get('show/{ttr}', 'TimeTableController@show_record')->name('ttr.show');
                Route::get('print/{ttr}', 'TimeTableController@print_record')->name('ttr.print');
                Route::delete('/{ttr}', 'TimeTableController@delete_record')->name('ttr.destroy');

            });

            /*************** Time Slots *****************/
            Route::group(['prefix' => 'time_slots', 'middleware' => 'teamSA'], function(){
                Route::post('/', 'TimeTableController@store_time_slot')->name('ts.store');
                Route::post('/use/{ttr}', 'TimeTableController@use_time_slot')->name('ts.use');
                Route::get('edit/{ts}', 'TimeTableController@edit_time_slot')->name('ts.edit');
                Route::delete('/{ts}', 'TimeTableController@delete_time_slot')->name('ts.destroy');
                Route::put('/{ts}', 'TimeTableController@update_time_slot')->name('ts.update');
            });

        });

        /*************** Payments *****************/
        Route::group(['prefix' => 'payments'], function(){

            Route::get('manage/{class_id?}', 'PaymentController@manage')->name('payments.manage');
            Route::get('invoice/{id}/{year?}', 'PaymentController@invoice')->name('payments.invoice');
            Route::get('receipts/{id}', 'PaymentController@receipts')->name('payments.receipts');
            Route::get('pdf_receipts/{id}', 'PaymentController@pdf_receipts')->name('payments.pdf_receipts');
            Route::post('select_year', 'PaymentController@select_year')->name('payments.select_year');
            Route::post('select_class', 'PaymentController@select_class')->name('payments.select_class');
            Route::delete('reset_record/{id}', 'PaymentController@reset_record')->name('payments.reset_record');
            Route::post('pay_now/{id}', 'PaymentController@pay_now')->name('payments.pay_now');
        });

        /*************** Pins *****************/
        Route::group(['prefix' => 'pins'], function(){
            Route::get('create', 'PinController@create')->name('pins.create');
            Route::get('/', 'PinController@index')->name('pins.index');
            Route::post('/', 'PinController@store')->name('pins.store');
            Route::get('enter/{id}', 'PinController@enter_pin')->name('pins.enter');
            Route::post('verify/{id}', 'PinController@verify')->name('pins.verify');
            Route::delete('/', 'PinController@destroy')->name('pins.destroy');
        });

        /*************** Marks *****************/
        Route::group(['prefix' => 'marks'], function(){

           // FOR teamSA
            Route::group(['middleware' => 'teamSA'], function(){
                Route::get('batch_fix', 'MarkController@batch_fix')->name('marks.batch_fix');
                Route::put('batch_update', 'MarkController@batch_update')->name('marks.batch_update');
                Route::get('tabulation/{exam?}/{class?}/{sec_id?}', 'MarkController@tabulation')->name('marks.tabulation');
                Route::post('tabulation', 'MarkController@tabulation_select')->name('marks.tabulation_select');
                Route::get('tabulation/print/{exam}/{class}/{sec_id}', 'MarkController@print_tabulation')->name('marks.print_tabulation');
            });

            // FOR teamSAT
            Route::group(['middleware' => 'teamSAT'], function(){
                Route::get('/', 'MarkController@index')->name('marks.index');
                Route::get('manage/{exam}/{class}/{section}/{subject}', 'MarkController@manage')->name('marks.manage');
                Route::put('update/{exam}/{class}/{section}/{subject}', 'MarkController@update')->name('marks.update');
                Route::put('comment_update/{exr_id}', 'MarkController@comment_update')->name('marks.comment_update');
                Route::put('skills_update/{skill}/{exr_id}', 'MarkController@skills_update')->name('marks.skills_update');
                Route::post('selector', 'MarkController@selector')->name('marks.selector');
                Route::get('bulk/{class?}/{section?}', 'MarkController@bulk')->name('marks.bulk');
                Route::post('bulk', 'MarkController@bulk_select')->name('marks.bulk_select');
            });

            Route::get('select_year/{id}', 'MarkController@year_selector')->name('marks.year_selector');
            Route::post('select_year/{id}', 'MarkController@year_selected')->name('marks.year_select');
            Route::get('show/{id}/{year}', 'MarkController@show')->name('marks.show');
            Route::get('print/{id}/{exam_id}/{year}', 'MarkController@print_view')->name('marks.print');

        });

        Route::resource('users', 'UserController');
        Route::resource('classes', 'MyClassController');
        Route::resource('teachers', 'TeacherController');

        Route::resource('staffs', 'StaffController');
        Route::resource('bompa', 'BomPaController');
        Route::resource('students', 'StudentRecordController');
        Route::resource('sections', 'SectionController');
        Route::resource('subjects', 'SubjectController');
        Route::resource('grades', 'GradeController');
        Route::resource('exams', 'ExamController');
        Route::resource('messages', 'MessagesController');
        Route::resource('dorms', 'DormController');
        Route::resource('payments', 'PaymentController');
        Route::resource('calevents', 'CaleventsController');
        Route::resource('sitecomments', 'SitecommentsController');

        Route::post('subjects/update_subject', 'SubjectController@update_subject')->name('subjects.update_subject');
        Route::get('teacher_detail/{teacher_id}', 'TeacherController@teacher_detail')->name('teacher_detail');
        Route::post('subjects/update_paper', 'SubjectController@update_paper')->name('subjects.update_paper');
        Route::get('messages/msggroup/{message_id}', 'MessagesController@msggroup')->name('messages.msggroup');
        Route::get('messages/send/{phone}', 'MessagesController@send')->name('messages.send');
        Route::get('main/buy', 'MessagesController@buy')->name('main.buy');
        Route::get('main/{receipt_id}/receipt', 'MessagesController@receipt')->name('main.receipt');

        Route::get('updateMessageAll', 'MessagesController@updateMessageAll')->name('messages.updateMessageAll');

        Route::get('studentGroup', 'StudentRecordController@studentGroup');
        Route::post('specificStudents', 'StudentRecordController@specificStudents');
        Route::post('specificClasses', 'StudentRecordController@specificClasses');
        Route::post('examResults', 'ExamController@examResults');

        Route::get('specificTeachers', 'TeacherController@specificTeachers');
        Route::get('groupTeachers', 'TeacherController@groupTeachers');
        Route::get('specificBomMembers', 'BomPaController@specificBomMembers');
        Route::get('specificStaffMembers', 'StaffController@specificStaffMembers');
        Route::get('groupStaffs', 'StaffController@groupStaffs');

        // calevent
        Route::post('find-calevent', 'CaleventsController@findCalevent');
        Route::post('getCalevent', 'CaleventsController@getCalevent');
        Route::post('calevents_update', 'CaleventsController@updateCalevent')->name('calevents_update');
        Route::post('calevents_delete', 'CaleventsController@deleteCalevent')->name('calevents_delete');

        Route::get('printouts', 'PrintOutsController@index')->name('printouts');
        Route::get('shop', 'ShopController@index')->name('shop');
        Route::get('opportunities', 'OpportunitiesController@index')->name('opportunities');

        // my class controller

        Route::get('class_manage/{form_id}',  'MyClassController@class_manage')->name('class_manage');
        Route::get('class_manage1/{form_id}',  'MyClassController@class_manage1')->name('class_manage1');
        Route::delete('class_manage1/delete_selected_student',  'MyClassController@delete_selected_student');

        Route::get('class_list/{form_id}', 'MyClassController@class_list')->name('class_list');
        Route::get('class_list2/{class_id}', 'MyClassController@class_list2')->name('class_list2');
        Route::get('class_list3/{form_id}', 'MyClassController@class_list3')->name('class_list3');

        //supervisor
        Route::post('/classes/assign_supervisor', 'MyClassController@assign_supervisor');
        Route::post('/classes/delete_supervisor', 'MyClassController@delete_supervisor');
        // class_teacher assign & delete
        Route::post('/classes/assign_class_teacher', 'MyClassController@assign_class_teacher');
        Route::post('/classes/delete_class_teacher', 'MyClassController@delete_class_teacher');
        // update class stream
        Route::post('/classes/update_class_stream', 'MyClassController@update_class_stream');
        // delete class
        Route::post('/classes/delete_class', 'MyClassController@delete_class');
        // get class subject manage page
        Route::get('class_subject_manage/{class_id}', 'MyClassController@class_subject_manage')->name('class_subject_manage');
        // subject teacher assign & delete
        Route::post('/classes/assign_subject_teacher', 'MyClassController@assign_subject_teacher');
        Route::post('/classes/delete_subject_teacher', 'MyClassController@delete_subject_teacher');
        // delete subject
        Route::post('/classes/delete_subject', 'MyClassController@delete_subject');

        // manage students who taken this subject
        Route::get('students_taken_csubject/{classSubjectId}', 'MyClassController@students_taken_csubject')->name('students_taken_csubject');
        Route::delete('students_taken_csubject/delete_selected_subject',  'MyClassController@delete_selected_subject');

        Route::get('students_taken_form/{form_id}',  'MyClassController@students_taken_form')->name('students_taken_form');
        Route::delete('students_taken_form/delete_selected_student',  'MyClassController@delete_selected_student1');
        // for teachers
        // for group
        Route::get('group_index', 'TeacherController@group_index')->name('group_index');
        Route::post('/teachers/update_group_name', 'TeacherController@update_group_name');
        Route::post('/teachers/delete_group', 'TeacherController@delete_group');
        Route::get('new_group', 'TeacherController@new_group')->name('new_group');

        // student search
        Route::post('std_search_adm_num', 'StudentRecordController@std_search_adm_num')->name('std_search_adm_num');
        Route::post('std_search_name', 'StudentRecordController@std_search_name')->name('std_search_name');
        Route::post('std_search_phone', 'StudentRecordController@std_search_phone')->name('std_search_phone');
        Route::post('std_search_upi', 'StudentRecordController@std_search_upi')->name('std_search_upi');
        Route::post('std_search_index_num', 'StudentRecordController@std_search_index_num')->name('std_search_index_num');

        //staff search
        Route::post('staff_search', 'StaffController@staff_search')->name('staff_search');
        //bom/pa search
        Route::post('bompa_search', 'BomPAController@bompa_search')->name('bompa_search');

        // student profile
        Route::get('download_template', 'StudentRecordController@downloadTemplate')->name('download_template');
        Route::post('file-import2', 'StudentRecordController@fileImport2')->name('file-import2');

        // student update photos
        Route::post('save-multiple-files', 'StudentRecordController@updatePhotos');

        //student move
        Route::post('getStream-about-form', 'StudentRecordController@getStreamAboutForm')->name('getStream-about-form');
        Route::post('getStream-about-form2', 'StudentRecordController@getStreamAboutForm2')->name('getStream-about-form2');
        Route::post('getStudent-for-moving', 'StudentRecordController@getStudentForMoving')->name('getStudent-for-moving');
        Route::post('getStudent-for-approving', 'StudentRecordController@getStudentForApproving')->name('getStudent-for-approving');
        Route::post('move-students', 'StudentRecordController@moveStudents')->name('move-students');
        Route::post('cancel-request-for-moving', 'StudentRecordController@cancelMoveStudent')->name('cancel-request-for-moving');
        Route::post('accept-request-for-moving', 'StudentRecordController@acceptMoveStudent')->name('accept-request-for-moving');
        Route::post('reject-all', 'StudentRecordController@rejectApproveStudentsAll')->name('reject-all');
        Route::post('accept-all', 'StudentRecordController@acceptApproveStudentsAll')->name('accept-all');

        // residences
        Route::post('create-residences', 'StudentRecordController@createResidence')->name('create-residences');
        Route::post('update-residence', 'StudentRecordController@updateResidence')->name('update-residence');
        Route::post('get-residences', 'StudentRecordController@getResidences')->name('get-residences');
        Route::post('delete-residence', 'StudentRecordController@deleteResidence')->name('delete-residence');

        // test excel
        Route::resource('testexcel', 'TestExcel');
        Route::get('file-import-export', 'TestExcelController@fileImportExport');
        Route::post('file-import', 'TestExcelController@fileImport')->name('file-import');
        Route::get('file-export', 'TestExcelController@fileExport')->name('file-export');

        // for exam
        // SchoolMgmtSystem-main
        Route::post('exam_index', 'ExamController@exam_index')->name('exam_index');
        Route::post('exam_final_delete', 'ExamController@exam_final_delete')->name('exam_final_delete');
        Route::post('exam_final_recover', 'ExamController@exam_final_recover')->name('exam_final_recover');
        Route::post('class_index', 'ExamController@class_index')->name('class_index');
        Route::post('exam_update', 'ExamController@exam_update')->name('exam_update');
        Route::post('exam_delete', 'ExamController@exam_delete')->name('exam_delete');
        Route::post('grade_delete', 'ExamController@grade_delete')->name('grade_delete');
        Route::post('each_exam_delete', 'ExamController@each_exam_delete')->name('each_exam_delete');
        Route::get('exam_manage/config/{exam_id}/{form_id}', 'ExamController@exam_manage_config')->name('exam_manage_config');
        Route::get('exam_manage/upload/{exam_id}/{form_id}', 'ExamController@exam_manage_upload')->name('exam_manage_upload');
        Route::get('exam_manage/add/{exam_id}', 'ExamController@exam_manage_add')->name('exam_manage_add');
        Route::get('exam_manage/publish', 'ExamController@exam_manage_publish')->name('exam_manage_publish');
        Route::get('exam_manage/analysis', 'ExamController@exam_manage_analysis')->name('exam_manage_analysis');
        Route::get('exam_manage/send', 'ExamController@exam_manage_send')->name('exam_manage_send');
        Route::post('exam_manage/sendMsg', 'ExamController@exam_manage_send_msg')->name('exam_manage_send_msg');
        Route::get('exam_grading/add', 'ExamController@exam_grading_add')->name('exam_grading_add');
        Route::post('grade_store', 'ExamController@grade_store')->name('grade_store');
        Route::get('exam_grading/view/{grade_id}', 'ExamController@exam_grading_view')->name('exam_grading_view');
        Route::get('exam_class/upload/{class_subject_id}/{exam_id}/{teacher_id}/{subject_id}', 'ExamController@exam_class_upload')->name('exam_class_upload');
        Route::get('exam_class_upload/view/{class_subject_id}/{exam_id}/{teacher_id}/{subject_id}', 'ExamController@exam_class_upload_view')->name('exam_class_upload_view');
        Route::post('exam_class/upload/mark', 'ExamController@exam_class_upload_mark')->name('exam_class_upload_mark');
        Route::get('exam_class/download', 'ExamController@exam_class_download')->name('exam_class_download');
        Route::get('exam_class/view/{exam_id}/{teacher_id}', 'ExamController@exam_class_view')->name('exam_class_view');
        Route::get('exam_class/detail_view', 'ExamController@exam_class_detail_view')->name('exam_class_detail_view');
        Route::get('exam_class/grant', 'ExamController@exam_class_grant')->name('exam_class_grant');
        Route::post('exam_class/score', 'ExamController@exam_class_score')->name('exam_class_score');
        Route::post('storeExamForm', 'ExamController@storeExamForm')->name('storeExamForm');
    });

    /************************ AJAX ****************************/
    Route::group(['prefix' => 'ajax'], function() {
        Route::get('get_lga/{state_id}', 'AjaxController@get_lga')->name('get_lga');
        Route::get('get_class_sections/{class_id}', 'AjaxController@get_class_sections')->name('get_class_sections');
        Route::get('get_class_subjects/{class_id}', 'AjaxController@get_class_subjects')->name('get_class_subjects');
    });

});

/************************ SUPER ADMIN ****************************/
Route::group(['namespace' => 'SuperAdmin','middleware' => 'super_admin', 'prefix' => 'super_admin'], function(){

    Route::get('/settings', 'SettingController@index')->name('settings');
    Route::put('/settings', 'SettingController@update')->name('settings.update');

});

/************************ PARENT ****************************/
Route::group(['namespace' => 'MyParent','middleware' => 'my_parent',], function(){

    Route::get('/my_children', 'MyController@children')->name('my_children');

});
