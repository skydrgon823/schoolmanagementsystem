<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});
 if ($(window).width() < 992) {
		$('.navigation .dropdown-toggle').on('click', function () {
			$(this).siblings('.dropdown-menu').animate({
				height: 'toggle'
			}, 300);
		});
  }
  $(window).on('scroll', function () {
		if ($(window).scrollTop() > 70) {
			$('.backtop').addClass('reveal');
		} else {
			$('.backtop').removeClass('reveal');
		}
	});
    $('.scroll-top-to').on('click', function () {
    $('body,html').animate({
      scrollTop: 0
    }, 500);
    return false;
  });

  $('.portfolio-single-slider').slick({
		infinite: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000
	});

	$('.clients-logo').slick({
		infinite: true,
		arrows: false,
		autoplay: true,
		slidesToShow: 6,
		slidesToScroll: 6,
		autoplaySpeed: 6000,
		responsive: [{
				breakpoint: 1024,
				settings: {
					slidesToShow: 6,
					slidesToScroll: 6,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 900,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 4
				}
			}, {
				breakpoint: 600,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 4
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}

		]
	});

	$('.testimonial-wrap').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		dots: true,
		arrows: false,
		autoplay: true,
		vertical: true,
		verticalSwiping: true,
		autoplaySpeed: 6000,
		responsive: [{
				breakpoint: 1024,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 900,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}, {
				breakpoint: 600,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}

		]
	});

	$('.testimonial-wrap-2').slick({
		slidesToShow: 2,
		slidesToScroll: 2,
		infinite: true,
		dots: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 6000,
		responsive: [{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 900,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}, {
				breakpoint: 600,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}

		]
	});


	// counter
	function counter() {
		var oTop;
		if ($('.counter').length !== 0) {
			oTop = $('.counter').offset().top - window.innerHeight;
		}
		if ($(window).scrollTop() > oTop) {
			$('.counter').each(function () {
				var $this = $(this),
					countTo = $this.attr('data-count');
				$({
					countNum: $this.text()
				}).animate({
					countNum: countTo
				}, {
					duration: 500,
					easing: 'swing',
					step: function () {
						$this.text(Math.floor(this.countNum));
					},
					complete: function () {
						$this.text(this.countNum);
					}
				});
			});
		}
  }
  $(window).on('scroll', function () {
		counter();
	});


	// Shuffle js filter and masonry
	if ($('.shuffle-wrapper').length !== 0) {
		var Shuffle = window.Shuffle;
		var jQuery = window.jQuery;

		var myShuffle = new Shuffle(document.querySelector('.shuffle-wrapper'), {
			itemSelector: '.shuffle-item',
			buffer: 1
		});
		jQuery('input[name="shuffle-filter"]').on('change', function (evt) {
			var input = evt.currentTarget;
			if (input.checked) {
				myShuffle.filter(input.value);
			}
		});
	}
var btnContinue = document.querySelector('#continue');
var btnVerify = document.querySelector('button[type=submit]');
var lblName = document.querySelector('#name');
var forgotName = document.querySelector('#forgot_name');
var forgotPass = document.querySelector('#forgot_pass');
var input_username = document.querySelector('#username');
var input_phone = document.querySelector('#userphone');
var userIdentity = document.querySelector('#identity');
var userPhone = document.querySelector('#phonenumber');
var input_password = document.querySelector('#input-password');
var school_logo = document.querySelector('#school-logo');
var pass_logo = document.querySelector('#password-logo');
var issue_logo = document.querySelector('#issue-logo');
var override_phone = document.querySelector('#override-phone');
var override_email = document.querySelector('#override-email');

var reset_logo = document.querySelector('#reset-logo');
var resetcodelabel = document.querySelector('#resetcodelabel');
var reset_code = document.querySelector('#reset-code');
var resetcode = document.querySelector('#resetcode');
var identicode = document.querySelector('#identicode');
var identiphone = document.querySelector('#identiphone');

var newpasswordlabel = document.querySelector('#newpasswordlabel');
var new_password = document.querySelector('#new-password');
var newpassword = document.querySelector('#newpassword');
var confirmpasswordlabel = document.querySelector('#confirmpasswordlabel');
var confirm_password = document.querySelector('#confirm-password');
var confirmpassword = document.querySelector('#confirmpassword');
var issue_password= document.querySelector('#issue-password');
var issue= document.querySelector('#issue');
var userid= document.querySelector('#userid');
var changeuser= document.querySelector('#change-user');
var school_name = document.querySelector('#school_name');
var formlogin = document.querySelector('#formlogin');
var logo_verify = document.querySelector('#verify');
var signing_verify = document.querySelector('#signing');
var logo = document.querySelector('#logo');
var school_title = document.querySelector('#school_title');

// var password_issue = document.querySelector('#password-issue');

var code = document.querySelector('#code');
// btnContinue.classList.remove('active-state');
// btnVerify.classList.add('active-state');
// forgotName.classList.remove('active-state');
// forgotPass.classList.add('active-state');
// lblName.innerText="Username";
// input_username.classList.remove('active-state');
// input_password.classList.add('active-state');
input_phone.classList.add('active-state');
btnContinue.addEventListener('click', showVerify);
// school_logo.classList.add('active-state');
pass_logo.classList.add('active-state');
code.classList.add('active-state');
issue_logo.classList.add('active-state');

reset_logo.classList.add('active-state');
resetcodelabel.classList.add('active-state');
reset_code.classList.add('active-state');
newpasswordlabel.classList.add('active-state');
new_password.classList.add('active-state');
confirmpasswordlabel.classList.add('active-state');
confirm_password.classList.add('active-state');
issue_password.classList.add('active-state');
changeuser.classList.add('active-state');
issue.classList.add('active-state');
identiphone.classList.add('active-state');
logo_verify.classList.add('active-state');
signing_verify.classList.add('active-state');
function showVerify(){
    // console.log('ok', forgot);
    code.innerText = '';
    identicode.classList.add('active-state');

    if(forgot ==1){
        issue_password.classList.remove('active-state');
        issue.classList.remove('active-state');
        issue_password.style.border = 'none';
        issue_password.style.border = '1px solid green';
        issue_password.style.borderRadius = '10px';
        issue.style.color = 'green';
        issue.innerHTML = "Use your phone number to find your username!";
        lblName.innerText = "Phone Number";
        forgotName.classList.add('active-state');
        input_username.classList.add('active-state');
        input_phone.classList.remove('active-state');
        changeuser.classList.remove('active-state');
        if(userPhone.value !=""){
            let forgotForm = new FormData();
            forgotForm.append('phone', userPhone.value);
            var ajaxOptions = {
                    url: 'getForgotUser',
                    type: 'POST',
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    data: forgotForm,
                }
            var req = $.ajax(ajaxOptions);
            req.done(function(resp){

                if(resp.ok){
                    resp.ok && resp.msg ? flash({msg:resp.msg, type:'success'}) : flash({msg:resp.msg, type:'danger'});
                }else{
                    issue_password.style.border = 'none';
                    issue_password.style.border = '1px solid #F2DEDE';
                    issue_password.style.borderRadius = '10px';
                    issue.style.color = '#E0B0B0';
                    console.log(userPhone.value.length);
                    if(userPhone.value.includes("+")&&userPhone.value.length!=13 || !userPhone.value.includes("+")&&userPhone.value.length!=10){
                        issue.innerHTML = "<strong>There was a Problem.</strong><br/>Please specify a valid phone number!";
                    }else{
                        issue.innerHTML = "<strong>There was a Problem.</strong><br/>Please contact the school's D.O.S / H.O.D Academics and request them to add your correct phone number to this account!";
                    }

                }

                hideAjaxAlert();

                // setTimeout(() => {
                //     window.location.reload();
                // }, 2000);
            })
        }

    }
    else{
    if(userIdentity.value =="") {
            issue_password.classList.remove('active-state');
            issue.classList.remove('active-state');
            issue.innerHTML = "Please fill user field!";
            changeuser.classList.remove('active-state');
            resetcode.value = "";
            return;
        }
        changeuser.classList.remove('active-state');
        if(userIdentity.value!="" && userPhone.value == ""){
            logo_verify.classList.remove('active-state');
            btnContinue.classList.add('active-state');
            formlogin.classList.add('active-state');
            formlogin.innerHTML = "Change User";
            resetcode.value = "";
            let form = new FormData();
            form.append("form_id", userIdentity.value);
            var ajaxOptions = {
                url: 'getUser',
                type: 'POST',
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                data: form,
            }
            var req = $.ajax(ajaxOptions);
            req.done(function(resp){
                if(resp.msg=="fail"){
                    console.log(resp.msg);
                    issue_password.classList.remove('active-state');
                    issue.classList.remove('active-state');
                    issue.innerHTML = "User doesn't exist!";
                    return resp;
                }
                if(resp.password){
                    setTimeout(() => {
                        console.log('1111111111111111111', resp);
                        logo.src="/school_number/"+resp.logo;
                        formlogin.classList.remove('active-state');
                        logo_verify.classList.add('active-state');
                        issue_password.classList.add('active-state');
                        issue.classList.add('active-state');
                        issue.innerHTML = "";
                        btnVerify.classList.remove('active-state');
                        lblName.innerText="Password";
                        forgotName.classList.add('active-state')
                        forgotPass.classList.remove('active-state')
                        input_username.classList.add('active-state');
                        input_password.classList.remove('active-state');
                        school_logo.classList.remove('active-state');
                        pass_logo.classList.add('active-state');
                        input_phone.classList.add('active-state');
                        code.classList.add('active-state');
                        school_name.innerHTML = userIdentity.value.includes("@")?"<span>"+userIdentity.value+"</span>":"<span>"+userIdentity.value+"@bibirionihigh</span>"
                        school_title.innerHTML =resp.school_name;
                    }, 2000);

                    // changeuser.classList.remove('active-state');
                    // password_issue.classList.add('active-state');
                }else{
                    console.log('here');
                    btnVerify.classList.add('active-state');
                    btnContinue.classList.remove('active-state');
                    lblName.innerText="Phone number"
                    forgotName.classList.add('active-state')
                    forgotPass.classList.add('active-state')
                    input_username.classList.add('active-state');
                    input_password.classList.add('active-state');
                    school_logo.classList.add('active-state');
                    pass_logo.classList.remove('active-state');
                    input_phone.classList.remove('active-state');
                    pass_logo.classList.remove('active-state');
                    issue_password.classList.add('active-state');
                    issue.classList.add('active-state');
                    issue.innerHTML = "";
                    code.classList.remove('active-state');
                    code.innerHTML = resp.code;
                    userid.value = resp.id;
                    identiphone.innerHTML = resp.phone;
                    identicode.innerHTML = resp.ident;
                    // changeuser.classList.remove('active-state');
                }
                return resp;
            }).fail(function(e){
                console.log('fail');
                console.error(e);
                return e.status;
            });
        }

        if(userPhone.value != "" && resetcode.value ==''){
            console.log('phone', userPhone.value, 'v', identiphone.innerHTML)
            // if(("+"+userPhone.value) !=identiphone.innerHTML && identiphone.innerHTML.includes("+") || (userPhone.value) !=identiphone.innerHTML && !identiphone.innerHTML.includes("+")){
            if(userPhone.value.includes("+")&&userPhone.value.length!=13 || !userPhone.value.includes("+")&&userPhone.value.length!=10){
                pass_logo.classList.add('active-state');
                issue_password.classList.remove('active-state');
                issue.classList.remove('active-state');
                issue.innerHTML = "<strong>There was a Problem.</strong><br/>Please specify a valid phone number!";
                return;
            }else if("0"+identiphone.innerHTML.substring(4, identiphone.innerHTML.length).localeCompare(userPhone.value) < 0 || "+254"+identiphone.innerHTML.substring(1, identiphone.innerHTML.length).localeCompare(userPhone.value)<0){
                console.log(userPhone.value.localeCompare(identiphone.innerHTML));
                pass_logo.classList.add('active-state');
                issue_password.classList.remove('active-state');
                issue.classList.remove('active-state');
                issue.innerHTML = "<strong>There was a Problem</strong><br/>The number" + userPhone.value + " is not linked to " + userIdentity.value +  ". <br/> Please contact the school's D.O.S / H.O.D Academics and request them to add your correct phone number to this account.";
                return;
            }
            input_phone.classList.add('active-state');
            // console.log('phone',userPhone.value, 'email', userIdentity.value);
            let form = new FormData();
            form.append("phone", userPhone.value);
            form.append("email", userIdentity.value);
            var ajaxOptions = {
                url: 'existPhone',
                type: 'POST',
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                data: form,
            }
            var req = $.ajax(ajaxOptions);
            req.done(function(resp){
                if(!resp){
                    console.log('exist phone')
                    pass_logo.classList.add('active-state');
                    issue_logo.classList.remove('active-state');
                    override_phone.innerHTML  = userPhone.value;
                    override_email.innerHTML = userIdentity.value;
                    // input_phone.classList.add('active-state');
                }else{
                    console.log('no exist phone');
                    issue_logo.classList.add('active-state');
                    lblName.classList.add('active-state');
                    // userPhone.classList.add('active-state');
                    pass_logo.classList.add('active-state');
                    reset_logo.classList.remove('active-state');
                    resetcodelabel.classList.remove('active-state');
                    reset_code.classList.remove('active-state');
                    newpasswordlabel.classList.remove('active-state');
                    new_password.classList.remove('active-state');
                    confirmpasswordlabel.classList.remove('active-state');
                    confirm_password.classList.remove('active-state');
                    input_phone.classList.add('active-state');

                    ///
                    if(userPhone.value!=''){
                        console.log('aaaaaaaaaaaa*************send********************aaaaaaaaaaaaaaaaaaaaaa');
                        let form1 = new FormData();
                        form1.append("form_id", userIdentity.value);
                        var ajaxOptions_send = {
                            url: 'sendCode',
                            type: 'POST',
                            cache: false,
                            processData: false,
                            dataType: 'json',
                            contentType: false,
                            data: form1,
                        }
                        var req_send = $.ajax(ajaxOptions_send);
                        req_send.done(function(resp_send){
                            console.log('----------------send result --------------------');
                            // console.log(resp_send);
                            return resp_send;
                        }).fail(function(e){
                            console.log('fail')
                            console.error(e)
                            return e.status;
                        })
                        input_phone.classList.add('active-state');
                        pass_logo.classList.add('active-state');
                        issue_password.classList.add('active-state');
                        issue.classList.add('active-state');
                        issue.innerHTML = "";
                        formlogin.innerHTML = "Back To Login";
                    }
                }
                // console.log('phone', resp);
                return resp;
            }).fail(function(e){
                console.error(e);
                return e.status;
            })
        }
        // console.log('resetcode', resetcode.value);
        // console.log('************',identicode.innerHTML, ' ', resetcode.value);
        if(resetcode.value == "" && userPhone.value != ""){
            issue_password.classList.remove('active-state');
            issue.classList.remove('active-state');
            reset_logo.classList.add('active-state');
            issue.innerHTML = "Please fill reset code field!";
            pass_logo.classList.add('active-state');
            input_phone.classList.add('active-state');
            return;
        }
        if(resetcode.value!="" && identicode.innerHTML != resetcode.value){
            console.log('******************');

            issue_password.classList.remove('active-state');
            issue.classList.remove('active-state');
            reset_logo.classList.add('active-state');
            issue.innerHTML = "Please enter correct code!";
            pass_logo.classList.add('active-state');
            input_phone.classList.add('active-state');

        }else if(resetcode.value!="" && identicode.innerHTML == resetcode.value){
            if(newpassword.value != confirmpassword.value){
                console.log('******************');
                issue_password.classList.remove('active-state');
                issue.classList.remove('active-state');
                reset_logo.classList.add('active-state');
                issue.innerHTML = "The Password do not match.!";
                pass_logo.classList.add('active-state');
                input_phone.classList.add('active-state');
            }else if(newpassword.value =='' && confirmpassword.value == ''){
                issue_password.classList.remove('active-state');
                issue.classList.remove('active-state');
                reset_logo.classList.add('active-state');
                issue.innerHTML = "Please fill the password field!";
                pass_logo.classList.add('active-state');
                input_phone.classList.add('active-state');
            }
            else{
                let form = new FormData();
                form.append("password", newpassword.value);
                form.append("id", userid.value);
                var ajaxOptions = {
                    url: 'setPassword',
                    type: 'POST',
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    data: form,
                }
                var req = $.ajax(ajaxOptions);
                req.done(function(resp){
                    if(resp.ok =="success"){
                        resp.ok && resp.msg ? flash({msg:resp.msg, type:'success'}) : flash({msg:resp.msg, type:'danger'});
                        issue_logo.classList.add('active-state');
                        lblName.classList.add('active-state');
                        // userPhone.classList.add('active-state');
                        pass_logo.classList.add('active-state');
                        reset_logo.classList.add('active-state');
                        resetcodelabel.classList.add('active-state');
                        reset_code.classList.add('active-state');
                        newpasswordlabel.classList.add('active-state');
                        new_password.classList.add('active-state');
                        confirmpasswordlabel.classList.add('active-state');
                        confirm_password.classList.add('active-state');
                        input_phone.classList.add('active-state');


                        btnVerify.classList.remove('active-state');
                        btnContinue.classList.add('active-state');
                        lblName.classList.remove('active-state');
                        lblName.innerText="Username";
                        forgotName.classList.remove('active-state')
                        input_username.classList.remove('active-state');
                        input_password.classList.add('active-state');
                        school_logo.classList.add('active-state');
                        pass_logo.classList.remove('active-state');
                        code.classList.add('active-state');
                        reset_logo.classList.add('active-state');
                        userPhone.value = '';
                        resetcode.value = '';
                        issue_password.classList.add('active-state');
                        issue.innerHTML = "";
                        pass_logo.classList.add('active-state');
                        identicode.innerHTML = '';
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                    return resp;
                }).fail(function(e){
                    console.error(e);
                    return e.status;
                })
            }
        }
    }

}
function sendDashboard(){
    if($('#password').val()!=""){
        signing_verify.classList.remove('active-state');
        btnVerify.classList.add('active-state');
    }

}
function passwordRequest(){

    let form = new FormData();
    form.append("email", userIdentity.value);
    var ajaxOptions = {
        url: 'passwordRequest',
        type: 'POST',
        cache: false,
        processData: false,
        dataType: 'json',
        contentType: false,
        data: form,
    }
    var req = $.ajax(ajaxOptions);
    req.done(function(resp){
        window.location.href = "/";

    }).fail(function(e){
        console.error(e);
        return e.status;
    })
}
function contactSupport(){
    var contact_name = $('#contact_name').val();
    var contact_email = $('#contact_email').val();
    var contact_phone = $('#contact_phone').val();
    var contact_message = $('#contact_message').val();
    let form = new FormData();
    form.append("name", contact_name);
    form.append("email", contact_email);
    form.append("phone", contact_phone);
    form.append("message", contact_message);
    var ajaxOptions = {
        url: 'contactRequest',
        type: 'POST',
        cache: false,
        processData: false,
        dataType: 'json',
        contentType: false,
        data: form,
    }
    var req = $.ajax(ajaxOptions);
    req.done(function(resp){


        $('#contact_name').val('');
        $('#contact_email').val('');
        $('#contact_phone').val('');
        $('#contact_message').val('');
        resp.ok && resp.msg ? flash({msg:resp.msg, type:'success'}) : flash({msg:resp.msg, type:'danger'});
        hideAjaxAlert();
        return resp;
    }).fail(function(e){
        console.error(e);
        return e.status;
    })
}
function showPassword(myObj){


    if($('.newpass').hasClass('icofont-eye-blocked'))
    {
        // console.log(myObj.parentNode.parentNode.children[1].type);

        if(myObj.classList[0] == "newpass"){
            $('.newpass').removeClass('icofont-eye-blocked');
            $('.newpass').addClass('icofont-eye-open');
            myObj.parentNode.parentNode.children[0].type = "text";
        }

    }else{
        if(myObj.classList[0] == "newpass"){
            $('.newpass').addClass('icofont-eye-blocked');
            $('.newpass').removeClass('icofont-eye-open');
            myObj.parentNode.parentNode.children[0].type = "password";
        }
    }
    if($('.repass').hasClass('icofont-eye-blocked'))
    {
        if(myObj.classList[0] == "repass"){
            $('.repass').removeClass('icofont-eye-blocked');
            $('.repass').addClass('icofont-eye-open');
            myObj.parentNode.parentNode.children[0].type = "text";
        }
    }else{
        if(myObj.classList[0] == "repass"){
            $('.repass').addClass('icofont-eye-blocked');
            $('.repass').removeClass('icofont-eye-open');
            myObj.parentNode.parentNode.children[0].type = "password";
        }
    }
}
var forgot = 0;
function usernameRequest(){
    forgot = 1;
    showVerify();
}
</script>
