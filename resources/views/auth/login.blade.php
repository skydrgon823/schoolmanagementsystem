@extends('layouts.landing')
@section('page_title', 'My Landing')
@section('content')
<style>
     .active-state {
        display: none;
    }
    #login-tab, #register-tab{
        cursor: pointer;
    }
</style>
<body id="top">
    <header>
      <nav class="navbar navbar-expand-lg navigation fixed-top" id="navbar">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="/global_assets/images/landing/logo.png" alt="" class="img-fluid" />
          </a>

          <button
            class="navbar-toggler collapsed"
            type="button"
            data-toggle="collapse"
            data-target="#navbarmain"
            aria-controls="navbarmain"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="icofont-navigation-menu"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarmain">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="{{ url('language/en') }}"
                  id="dropdown02"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                  data-language="en"
                >
                  @if (session('file'))
                    <img
                        src={{ session('file') }}
                        alt=""
                        class="img-fluid"
                        width="15px" />
                  @else
                    <img
                        src='/global_assets/images/landing/GB.svg'
                        alt=""
                        class="img-fluid"
                        width="15px" />
                  @endif

                  <span id="lang-title">
                    {{-- ENGLISH --}}
                    @if (session('ln'))
                        {{ session('ln') }}
                    @else
                        {{-- ENGLISH --}}
                        {{trans("local.english")}}
                    @endif

                  <span> <i class="icofont-thin-down"></i
                ></a>
                <ul class="dropdown-menu" id="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="{{ url('language/en') }}" data-language="en">
                      <img
                        src="/global_assets/images/landing/GB.svg"
                        alt=""
                        class="img-fluid"
                        width="15px"
                      />
                      {{-- {{ session('ln') }} --}}
                      {{-- ENGLISH --}}
                      {{trans("local.english")}}
                      </a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ url('language/fr') }}" data-language="fr" >
                      <img
                        src="/global_assets/images/landing/FR.svg"
                        alt=""
                        class="img-fluid"
                        width="15px"
                      />
                      {{-- FRENCH --}}
                      {{trans("local.french")}}
                      </a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{url('language/sw')}}" data-language="sw" >
                      <img
                        src="/global_assets/images/landing/TZ.svg"
                        alt=""
                        class="img-fluid"
                        width="15px"
                      />
                      {{trans("local.swahili")}}
                      {{-- SWAHILI --}}
                      </a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{url('language/rw')}}" data-language="rw" >
                      <img
                        src="/global_assets/images/landing/RW.svg"
                        alt=""
                        class="img-fluid"
                        width="15px"
                      />
                      {{-- KINYARWANDA --}}
                      {{trans("local.kiny")}}
                      </a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{url('language/et')}}" data-language="et" >
                      <img
                        src="/global_assets/images/landing/ET.svg"
                        alt=""
                        class="img-fluid"
                        width="15px"
                      />
                      {{-- AMHARIC --}}
                      {{trans("local.amharic")}}
                      </a
                    >
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#feature">{{trans("local.feature")}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#testimonial">{{trans("local.testi")}}</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#about">{{trans("local.about")}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#contact">{{trans("local.contact")}}</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Slider Start -->
    <section class="banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-xl-4">
            <div class="block">
              <h3 class="mb-3 mt-3">{{ trans("local.more") }}</h3>

              <p class="mb-4 pr-5">
                {{trans("local.analysis")}}
              </p>
              <img
                src="/global_assets/images/landing/google-play-badge.svg"
                alt=""
                class="img-fluid"
                width="120px"
              />
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sl-4"></div>
          <div class="col-lg-4 col-md-4 col-xl-4">
            <div
              class="card border-success text-start"
              style="width: 30rem; border-radius: 10px"
            >
              <div class="card-header">
                <ul class="nav nav-pills card-header-tabs mb-1">
                  <li class="nav-item">
                    <button
                      id="login-tab"
                      data-toggle="tab"
                      data-target="#login"
                      role="tab"
                      class="nav-link action-tabs active"
                      style="margin-right: 4px"
                      aria-selected="true"
                    >
                    {{ trans("local.login") }}
                    </button>
                  </li>
                  <li class="nav-item">
                    <button
                      id="register-tab"
                      data-toggle="tab"
                      data-target="#register"
                      role="tab"
                      class="nav-link action-tabs"
                      aria-selected="false"
                    >
                    {{ trans("local.signup") }}
                    </button>
                  </li>
                </ul>
              </div>
              <div class="card-body tab-content pt-0">
                <div
                  id="login"
                  role="tabpanel"
                  aria-labelledby="login-tab"
                  class="tab-pane fade mt-2 active show"
                >

                  <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" id="userid"/>
                    <span class="text-primary" id="identicode"></span>
                    <span class="text-primary" id="identiphone"></span>

                    <div style="margin: 15px 0; background:#F2DEDE; padding: 10px;" id="password-issue"  @if(!$errors->has('password')) class="active-state" @endif>
                        <h6 style="color: #E0B0B0;"><strong>Authentication Failed</strong></h6>
                        <h6 style="color:#E0B0B0;">{{$errors->first()}} click <strong>Forgotten Password</strong> below</h6>
                    </div>

                    <div @if ($errors->has('password'))
                        class="form-group"
                    @else
                        class="form-group active-state"
                    @endif  id="school-logo">
                        <div class="col-8">
                            <div class="row align-items-center">
                                <img src="/assets/images/school.png" id="logo" alt="" class="rounded-circle" width="50" height="50"/>
                                <div class="col-9 ml-2">
                                    <div class="row">
                                        <span style="color:grey" id="school_name"><strong>{{ $errors->first('identity') }}</strong></span>
                                    </div>
                                    <div class="row">
                                        <span style="color: grey;font-size:12px" id="school_title">{{ trans("local.bibironi") }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group" id="password-logo">
                        <div class="row align-items-center py-2 px-2" style="border:1px solid green;border-radius:10px;">
                            <span style="color:grey"><strong>Passowrd Reset</strong></span>
                            <span style="color: grey">You're yet to set a password for your account, please enter below your phone number that ends with
                                <span style="color:green" id="code"></span>
                            </span>

                        </div>
                    </div>
                    <div class="form-group active-state" id="issue-logo">
                        <div class="row align-items-center py-2 px-2" style="border:1px solid chocolate;border-radius:10px;">
                            <span style="color:chocolate"><strong>There was a problem</strong></span>
                            <span style="color: chocolate">
                                The number <span style="color:grey" id="override-phone">0</span> is not linked to <span style="color:chocolate" id="override-email"></span>
                            </span>
                            <span style="color:chocolate">
                                Please contact the shcool's D.O.S / H.O.D Academics and request them to add  your correct phone number to this account
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center py-2 px-2" style="border:1px solid chocolate;border-radius:10px;"  id="issue-password">
                            <span style="color:chocolate" class="active-state" id="issue">
                                The password is incorrect.
                            </span>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row col-12 align-items-center py-2 px-2" style="border:1px solid green;border-radius:10px;" id="reset-logo">
                            <span style="color:green">
                                Reset Code sent to your phone number
                            </span>

                        </div>
                    </div>

                    <div class="form-group d-flex justify-content-between">
                      <span style="color: black; opacity: 60%" id="name">
                        @if ($errors->has('password'))
                            {{ trans("local.password") }}
                        @else
                            {{ trans("local.name") }}
                        @endif
                      </span>
                      {{-- href="{{ route('password.request') }}" --}}
                      <a
                        onclick="usernameRequest();"
                        @if (!$errors->has('password'))
                            class="pull-right text-success"
                        @else
                            class="pull-right text-success active-state"
                        @endif
                        style="cursor: pointer; text-decoration-line: none"
                        id="forgot_name"
                        >{{ trans("local.forgot_username") }}</a
                      >
                      <a
                        onclick="passwordRequest();"
                        @if ($errors->has('password'))
                            class="pull-right text-success"
                        @else
                            class="pull-right text-success active-state"
                        @endif
                        style="cursor: pointer; text-decoration-line: none"
                        id="forgot_pass"
                        >{{ trans("local.forgot_password") }}</a
                      >
                    </div>
                    <span style="color: grey" for="resetcode" id="resetcodelabel">Reset Code</span>
                    <div class="input-group mb-2" id="reset-code">
                        <input
                          type="text"
                          id="resetcode"
                          name="resetcode"
                          class="form-control ps-15 bg-transparent ng-untouched ng-pristine ng-invalid"
                          placeholder="*****"
                        />
                    </div>
                    <span for="newpassword" style="color: grey" id="newpasswordlabel">New Password</span>
                    <div class="input-group mb-2" id="new-password">
                        <input
                          type="password"
                          id="newpassword"
                          name="newpassword"
                          {{-- required --}}
                          class="form-control ps-15 bg-transparent ng-untouched ng-pristine ng-invalid"
                          placeholder="******"
                        />
                        <span class="input-group-text bg-transparent">
                          <i class="newpass icofont-eye-blocked"  onclick="showPassword(this)"></i>
                        </span>
                      </div>
                      <span for="confirmpassword" style="color: grey" id="confirmpasswordlabel">Re-Type New Password</span>
                      <div class="input-group mb-2" id="confirm-password">
                        <input
                          type="password"
                          id="confirmpassword"
                          name="confirmpassword"
                          {{-- required --}}
                          class="form-control ps-15 bg-transparent ng-untouched ng-pristine ng-invalid"
                          placeholder="******"
                        />
                        <span class="input-group-text bg-transparent">
                           <i class="repass icofont-eye-blocked" onclick="showPassword(this)"></i>
                        </span>
                      </div>
                    <div class="input-group mb-2" id="userphone">
                        <span class="input-group-text bg-transparent">
                          <i class="icofont-phone"></i>
                        </span>
                        <input
                          type="text"
                          id="phonenumber"
                          name="phonenumber"
                          {{-- required --}}
                          class="form-control ps-15 bg-transparent ng-untouched ng-pristine ng-invalid"
                          placeholder="0700000000"
                        />
                    </div>

                    <div id="username" @if($errors->has('password'))
                        class="input-group mb-2 active-state"
                    @else
                        class="input-group mb-2"
                    @endif>
                      <input
                        type="text"
                        id="identity"
                        name="identity"
                        required
                        class="form-control ps-15 bg-transparent ng-untouched ng-pristine ng-invalid"
                        placeholder="admissionnumber@schoolcode"
                      />
                      <span class="input-group-text bg-transparent">
                        <i class="icofont-user"></i>
                      </span>
                    </div>
                    <div @if ($errors->has('password'))
                        class="input-group mb-2"
                    @else
                        class="input-group mb-2 active-state"
                    @endif  id="input-password">
                        <input
                          type="password"
                          id="password"
                          name="password"
                          required
                          class="form-control ps-15 bg-transparent ng-untouched ng-pristine ng-invalid"
                          placeholder="{{ __('Password') }}"
                        />
                        <span class="input-group-text bg-transparent">
                            <i class="newpass icofont-eye-blocked" onclick="showPassword(this)"></i>
                        </span>
                    </div>

                    <div class="form-group mb-0 d-flex justify-content-end">
                      <div class="col-md-12">
                        <button
                          type="button"
                          id="continue"
                          @if ($errors->has('password'))
                            class="btn btn-block btn-success text-white active-state"
                          @else
                            class="btn btn-block btn-success text-white"
                          @endif

                        >
                          <span class="ng-star-inserted">{{ trans("local.continue") }}</span>
                        </button>
                      </div>
                    </div>
                    <div class="form-group mb-0 d-flex justify-content-end">
                      <div class="col-md-12">
                        <div
                          id="verify"
                          class="btn btn-block btn-success text-white active-state"
                        >
                          <span class="ng-star-inserted">Verify</span>
                          <img src="{{ asset('assets/gif/spinner.gif') }}" alt="Loading">
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-0 d-flex justify-content-end">
                      <div class="col-md-12">
                        <div
                          id="signing"
                          class="btn btn-block btn-success text-white active-state"
                        >
                          <span class="ng-star-inserted">Signing in</span>
                          <img src="{{ asset('assets/gif/spinner.gif') }}" alt="Loading">
                        </div>
                      </div>
                    </div>

                    <div class="form-group mb-0 d-flex justify-content-end">
                        <div class="col-md-12">
                          <button
                            type="submit"
                            onclick="sendDashboard();"
                            @if ($errors->has('password'))
                                class="btn btn-block btn-success text-white"
                            @else
                                class="btn btn-block btn-success text-white active-state"
                            @endif

                          >
                            <span class="ng-star-inserted">{{ trans("local.sign") }}</span>
                          </button>
                        </div>
                      </div>
                      <div class="form-group mb-0 d-flex justify-content-center">
                        <div  id="change-user" @if ($errors->has('password'))
                            class="col-md-12 text-center"
                        @else
                            class="col-md-12 text-center"
                        @endif>
                            <a
                                class="text-primary"
                                href="{{ route('login') }}"
                            >
                                <span id="formlogin">Change User</span>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="form-group mb-0 d-flex justify-content-center">
                        <div @if (!$errors->has('password'))
                            class="col-md-12 text-center active-state"
                        @else
                            class="col-md-12 text-center"
                        @endif>
                            <a
                                class="text-primary"
                                href="{{ route('login') }}"
                            >
                                <span id="formlogin1">Change User</span>
                            </a>
                        </div>
                    </div> --}}
                  </form>
                </div>
                <div
                  id="register"
                  role="tabpanel"
                  aria-labelledby="register-tab"
                  class="tab-pane fade text-back text-opacity-75"
                >
                  <div
                    class="col-md-12 col-xs-12 mb-0 p-3 text-wrap"
                    style="color: #3c763d; background-color: #dff0d8"
                  >
                    <span>
                        {{ trans("local.if_contact") }}
                      <strong
                        ><span class="text-info"
                        >
                          +254 798 666 000
                        </span></strong
                      >
                      {{ trans("local.or") }}
                      <strong
                        ><a target="_blank" style="text-decoration: none">
                          info@zeraki.co.ke
                        </a></strong
                      >
                      {{ trans("local.soon") }}
                      <strong
                        ><a
                          data-bs-toggle="tab"
                          data-bs-target="#register"
                          role="tab"
                          class="text-primary"
                          href="{{ route('login') }}"
                        >
                        {{ trans("local.login") }}
                        </a></strong
                      >
                      {{ trans("local.already") }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section service" id="feature">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7 text-center">
            <div class="section-title">
              <h2><strong>{{ trans("local.why") }}</strong></h2>
              <div class="mx-auto my-4">
                <img
                  src="/global_assets/images/landing/center-logo.png"
                  alt=""
                  class="img-fluid"
                  width="120px"
                />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="service-item mb-4">
              <div class="d-flex align-items-center">
                <div class="mx-auto my-4">
                  <img
                    src="/global_assets/images/landing/clock.png"
                    alt=""
                    class="img-fluid"
                    width="60px"
                  />
                </div>
              </div>

              <div class="content">
                <p class="mb-4">
                    {{ trans("local.fast") }}
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="service-item mb-4">
              <div class="d-flex align-items-center">
                <div class="mx-auto my-4">
                  <img
                    src="/global_assets/images/landing/intuitive.png"
                    alt=""
                    class="img-fluid"
                    width="60px"
                  />
                </div>
              </div>
              <div class="content">
                <p class="mb-4">
                    {{ trans("local.intuitive") }}
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="service-item mb-4">
              <div class="d-flex align-items-center">
                <div class="mx-auto my-4">
                  <img
                    src="/global_assets/images/landing/setting.png"
                    alt=""
                    class="img-fluid"
                    width="60px"
                  />
                </div>
              </div>
              <div class="content">
                <p class="mb-4">
                    {{ trans("local.easy") }}
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="service-item mb-4">
              <div class="d-flex align-items-center">
                <div class="mx-auto my-4">
                  <img
                    src="/global_assets/images/landing/training.png"
                    alt=""
                    class="img-fluid"
                    width="60px"
                  />
                </div>
              </div>

              <div class="content">
                <p class="mb-4">
                    {{ trans("local.onsite") }}
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="service-item mb-4">
              <div class="d-flex align-items-center">
                <div class="mx-auto my-4">
                  <img
                    src="/global_assets/images/landing/round-clock.png"
                    alt=""
                    class="img-fluid"
                    width="60px"
                  />
                </div>
              </div>
              <div class="content">
                <p class="mb-4">
                    {{ trans("local.round") }}
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="service-item mb-4">
              <div class="d-flex align-items-center">
                <div class="mx-auto my-4">
                  <img
                    src="/global_assets/images/landing/hosted.png"
                    alt=""
                    class="img-fluid"
                    width="60px"
                  />
                </div>
              </div>
              <div class="content">
                <p class="mb-4">
                    {{ trans("local.hosted") }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section appoinment" id="testimonial">
      <div class="container mt-4">
        <div class="row justify-content-center">
          <div class="section-title text-center">
            <h2>{{ trans("local.Testimonials") }}</h2>
            <div class="mx-auto my-4"></div>
            <p>{{ trans("local.customer") }}</p>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="testimonial-block style-2" data-bg-text="text">
                {{ trans("local.reason") }}
            </div>
            <div class="row align-items-center">
              <div class="testimonial-thumb">
                <img
                  src="/global_assets/images/landing/person1.png"
                  class="rounded-circle"
                  alt=""
                  width="70px"
                />
              </div>
              <div class="client-info col-8">
                <h5>{{ trans("local.james") }}</h5>
                <span>{{ trans("local.kahuhia") }}</span>
                <div class="rating-stars" style="width: 100%;">
                  <input type="radio" name="rating" id="rs0" checked /><label
                    for="rs0" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs1" /><label
                    for="rs1" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs2" /><label
                    for="rs2" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs3" /><label
                    for="rs3" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs4" /><label
                    for="rs4" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs5" /><label
                    for="rs5" style="width:20px;height:20px;"
                  ></label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-block style-2">
              <p>
                {{ trans("local.zeraki") }}
              </p>
            </div>
            <div class="row align-items-center">
              <div class="testimonial-thumb">
                <img
                  src="/global_assets/images/landing/person2.png"
                  alt=""
                  class="rounded-circle"
                  width="80px"
                />
              </div>
              <div class="client-info col-8">
                <h5>{{ trans("local.raphael") }}</h5>
                <span>{{ trans("local.maranda") }}</span>
                <div class="rating-stars" style="width: 100%;">
                  <input type="radio" name="rating" id="rs0" checked /><label
                    for="rs0" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs1" /><label
                    for="rs1" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs2" /><label
                    for="rs2" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs3" /><label
                    for="rs3" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs4" /><label
                    for="rs4" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs5" /><label
                    for="rs5" style="width:20px;height:20px;"
                  ></label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-block style-2">
              <p>
                {{ trans("local.really") }}
              </p>
            </div>
            <div class="row align-items-center">
              <div class="testimonial-thumb">
                <img
                  src="/global_assets/images/landing/person3.png"
                  alt=""
                  class="rounded-circle"
                  width="80px"
                />
              </div>
              <div class="client-info col-8">
                <h5>{{ trans("local.petronilla") }}</h5>
                <span>{{ trans("local.uthiru") }}</span>
                <div class="rating-stars" style="width: 100%;">
                  <input type="radio" name="rating" id="rs0" checked /><label
                    for="rs0" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs1" /><label
                    for="rs1" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs2" /><label
                    for="rs2" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs3" /><label
                    for="rs3" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs4" /><label
                    for="rs4" style="width:20px;height:20px;"
                  ></label>
                  <input type="radio" name="rating" id="rs5" /><label
                    for="rs5" style="width:20px;height:20px;"
                  ></label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section clients">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7">
            <div class="section-title1 text-center">
              <h3>{{ trans("local.satisfied") }}</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row clients-logo py-3">
          <div class="col-lg-2">
            <div class="client-thumb justify-content-center d-flex">
              <img src="/global_assets/images/landing/buru-school.png" alt="" class="img-fluid" />
            </div>
          </div>
          <div class="col-lg-2">
            <div class="client-thumb justify-content-center d-flex">
              <img src="/global_assets/images/landing/butular-school.png" alt="" class="img-fluid" />
            </div>
          </div>
          <div class="col-lg-2">
            <div class="client-thumb justify-content-center d-flex">
              <img src="/global_assets/images/landing/angego-school.png" alt="" class="img-fluid" />
            </div>
          </div>
          <div class="col-lg-2">
            <div class="client-thumb justify-content-center d-flex">
              <img src="/global_assets/images/landing/asumubi-school.png" alt="" class="img-fluid" />
            </div>
          </div>
          <div class="col-lg-2">
            <div class="client-thumb justify-content-center d-flex">
              <img src="/global_assets/images/landing/barani-school.png" alt="" class="img-fluid" />
            </div>
          </div>
          <div class="col-lg-2">
            <div class="client-thumb justify-content-center d-flex">
              <img src="/global_assets/images/landing/beth-school.png" alt="" class="img-fluid" />
            </div>
          </div>
          <div class="col-lg-2">
            <div class="client-thumb justify-content-center d-flex">
              <img src="/global_assets/images/landing/bungoma-school.png" alt="" class="img-fluid" />
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section testimonial-2 weare d-flex align-items-center" id="about">
      <div class="container">
        <div class="row justify-content-center section-new-title">
          <h3><strong>Who We Are</strong></h3>
        </div>
        <div class="row text-center">
          <p>
            {{ trans("local.all") }}
          </p>
        </div>
      </div>
    </section>
    <section class="section appoinment">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7">
            <div class="section-title1 text-center">
              <h3><strong>{{ trans("local.FAQs") }}</strong></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-4">
          <div class="col-lg-3">
            <div class="section-title1 text-center">
              <h3>{{ trans("local.admin") }}</h3>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo1" data-toggle="collapse">
                {{ trans("local.how") }}
              </a>
              <div id="demo1" class="collapse">
                <hr />
                {{ trans("local.this") }}
              </div>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo2" data-toggle="collapse">
                {{ trans("local.how") }}
              </a>
              <div id="demo2" class="collapse">
                <hr />
                {{ trans("local.this") }}
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="section-title1 text-center">
              <h3>{{ trans("local.parent") }}</h3>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo3" data-toggle="collapse">
                {{ trans("local.how") }}
              </a>
              <div id="demo3" class="collapse">
                <hr />
                {{ trans("local.this") }}
              </div>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo4" data-toggle="collapse">
                {{ trans("local.how") }}
              </a>
              <div id="demo4" class="collapse">
                <hr />
                {{ trans("local.this") }}
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="section-title1 text-center">
              <h3>{{ trans("local.new") }}</h3>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo5" data-toggle="collapse">
                {{ trans("local.how") }}
              </a>
              <div id="demo5" class="collapse">
                <hr />
                {{ trans("local.this") }}
              </div>
            </div>

            <div class="quest_item px-4 py-2">
              <a href="#demo6" data-toggle="collapse">
                {{ trans("local.how") }}
              </a>
              <div id="demo6" class="collapse">
                <hr />
                {{ trans("local.this") }}
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="section-title1 text-center">
              <h3>{{ trans("local.teacher") }}</h3>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo7" data-toggle="collapse">
                {{ trans("local.how") }}
              </a>
              <div id="demo7" class="collapse">
                <hr />
                {{ trans("local.this") }}
              </div>
            </div>
            <div class="quest_item pl-4 py-2">
              <a href="#demo8" data-toggle="collapse">
                {{ trans("local.how") }}
              </a>
              <div id="demo8" class="collapse">
                <hr />
                {{ trans("local.this") }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section appoinment" id="contact">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7">
            <div class="section-title1 text-center">
              <h3><strong>{{ trans("local.touch") }}</strong></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-4">
          <div class="col-lg-6">
            <div class="appoinment-wrap">
              <ul class="nav nav-tabs nav-fill">
                <li class="nav-item">
                  <a
                    href="#!"
                    data-toggle="tab"
                    class="nav-link"
                    style="cursor: pointer"
                  >
                    <i class="icofont-phone"></i> {{ trans("local.us") }}
                  </a>
                </li>
              </ul>
              <div id="#" class="appoinment-form" method="post" action="#">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <span class="text-dark">{{ trans("local.Name") }}</span>
                      <input
                        name="contact_name"
                        id="contact_name"
                        type="text"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <span class="text-dark">{{ trans("local.Email") }}</span>
                      <input
                        name="contact_email"
                        id="contact_email"
                        type="email"
                        class="form-control"
                        placeholder="Example@gmail.com"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <span class="text-dark">{{ trans("local.Mobile") }}</span>
                      <input
                        name="contact_phone"
                        id="contact_phone"
                        type="text"
                        class="form-control"
                        placeholder="07## ### ###"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group-2 mb-4">
                  <span class="text-dark">{{ trans("local.Message") }}</span>
                  <textarea
                    name="contact_message"
                    id="contact_message"
                    class="form-control"
                    rows="3"
                    placeholder="Your Message here"
                  ></textarea>
                </div>

                <a class="btn btn-success btn-round-3" onclick="contactSupport();"
                  > {{ trans("local.send") }}<i class="icofont-telegram ml-2"></i
                ></a>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="appoinment-content">
              <img src="/global_assets/images/landing/conn.png" alt="" class="img-fluid" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- footer Start -->
    <footer class="footer section gray-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-3 mr-auto col-sm-6">
            <div class="widget mb-5 mb-lg-0">
              <div class="logo mb-4">
                <img
                  src="/global_assets/images/landing/footer-logo.png"
                  alt=""
                  class="img-fluid"
                  width="103px;"
                />
              </div>
              <p>{{ trans("local.ltd") }}</p>
              <p>{{ trans("local.po") }}</p>
              <p>{{ trans("local.nairobi") }}</p>
              <p>+254 790 493 495</p>
            </div>
          </div>

          <div class="col-md-3 col-sm-6">
            <div class="widget mb-5 mb-lg-0">
              <h4 class="text-capitalize mb-3">{{ trans("local.products") }}</h4>

              <ul class="list-unstyled footer-menu lh-35">
                <li><a href="#!">{{ trans("local.zeraki_analytics") }}</a></li>
                <li><a href="#!">{{ trans("local.zeraki_shop") }}</a></li>
                <li><a href="#!">{{ trans("local.zeraki_finance") }}</a></li>
                <li><a href="#!">{{ trans("local.zeraki_learning") }}</a></li>
                <li><a href="#!">{{ trans("local.zeraki_time") }}</a></li>
                <li><a href="#!">{{ trans("local.zeraki_touch") }}</a></li>
              </ul>
            </div>
          </div>

          <div class="col-md-6 col-sm-6 text-center">
            <div class="widget mb-5 mb-lg-0">
              <h4 class="text-capitalize mb-3">{{ trans("local.about_zeraki") }}</h4>

              <p>
                {{ trans("local.tech") }}
              </p>
              <p>
                {{ trans("local.solution") }}
              </p>
            </div>
          </div>
          <div class="col-md-12 col-sm-6 text-center">
            <ul class="list-inline footer-socials mt-4">
              <li class="list-inline-item">
                <a href="https://www.facebook.com/themefisher"
                  ><i class="icofont-facebook"></i
                ></a>
              </li>
              <li class="list-inline-item">
                <a href="https://twitter.com/themefisher"
                  ><i class="icofont-twitter"></i
                ></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><i class="icofont-youtube-play"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#"><i class="icofont-instagram"></i></a>
              </li>
            </ul>
          </div>
        </div>

        <div class="footer-btm py-4 mt-5">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-6">
              <div class="copyright">
                &copy; {{ now()->year }}  {{ trans("local.rights") }}
                <i class="icofont-heart"></i> {{ trans("local.by") }}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-4">
              <a class="backtop scroll-top-to" href="#top">
                <i class="icofont-long-arrow-up"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>

  </body>
@include('partials.js.landing_js')
@endsection
