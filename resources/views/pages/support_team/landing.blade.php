@extends('layouts.landing')
@section('page_title', 'My Landing')
@section('content')
<body id="top">
    <header>
      <nav class="navbar navbar-expand-lg navigation fixed-top" id="navbar">
        <div class="container">
          <a class="navbar-brand" href="index.html">
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
                  href="#"
                  id="dropdown02"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <img
                    src="/global_assets/images/landing/GB.svg"
                    alt=""
                    class="img-fluid"
                    width="15px" />
                  ENGLISH <i class="icofont-thin-down"></i
                ></a>
                <ul class="dropdown-menu" aria-labelledby="dropdown02">
                  <li>
                    <a class="dropdown-item" href="#">
                      <img
                        src="/global_assets/images/landing/GB.svg"
                        alt=""
                        class="img-fluid"
                        width="15px"
                      />
                      ENGLISH</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <img
                        src="/global_assets/images/landing/FR.svg"
                        alt=""
                        class="img-fluid"
                        width="15px"
                      />
                      FRENCH</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <img
                        src="/global_assets/images/landing/TZ.svg"
                        alt=""
                        class="img-fluid"
                        width="15px"
                      />

                      SWAHILI</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <img
                        src="/global_assets/images/landing/RW.svg"
                        alt=""
                        class="img-fluid"
                        width="15px"
                      />
                      KINYARWANDA</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <img
                        src="/global_assets/images/landing/ET.svg"
                        alt=""
                        class="img-fluid"
                        width="15px"
                      />
                      AMHARIC</a
                    >
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#feature">FEATURES</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#testimonial">TESTIMONIAL</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#about">ABOUT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#contact">CONTACT</a>
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
              <h3 class="mb-3 mt-3">More Than Just Grades</h3>

              <p class="mb-4 pr-5">
                Zeraki Analytics provides the insight you need to make decisions
                about your child, your class or your school.
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
                      Login
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
                      Signup
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
                    <div class="form-group d-flex justify-content-between">
                      <span style="color: black; opacity: 60%">Username</span>
                      <a
                        href="{{ route('password.request') }}"
                        class="pull-right text-success"
                        style="cursor: pointer; text-decoration-line: none"
                        >Forgot Username?</a
                      >
                    </div>
                    <div class="input-group mb-2">
                      <span class="input-group-text bg-transparent">
                        <i class="icofont-user"></i>
                      </span>
                      <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="form-control ps-15 bg-transparent ng-untouched ng-pristine ng-invalid"
                        placeholder="admissionnumber@schoolcode"
                      />
                    </div>
                    <div class="form-group mb-0 d-flex justify-content-end">
                      <div class="col-md-6">
                        <button
                          type="submit"
                          class="btn btn-block btn-success text-white"
                        >
                          <span class="ng-star-inserted">Continue</span>
                        </button>
                      </div>
                    </div>
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
                      If your school is not using Zeraki Analytics, please
                      contact us on
                      <strong
                        ><a
                          href="tel:+254798 666 000"
                          target="_blank"
                          style="text-decoration: none"
                        >
                          +254798 666 000
                        </a></strong
                      >
                      or
                      <strong
                        ><a target="_blank" style="text-decoration: none">
                          info@zeraki.co.ke
                        </a></strong
                      >
                      and we shall get back to you soon. You may also opt to
                      <strong
                        ><a
                          data-bs-toggle="tab"
                          data-bs-target="#register"
                          role="tab"
                          class="text-primary"
                        >
                          login
                        </a></strong
                      >
                      if you already have an account
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
              <h2><strong>Why You Should Choose</strong></h2>
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
                  A fast and easily accessible system that can be used on the go
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
                  Intuitive analytics that knows exactly what you are looking
                  for
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
                  Easy to set-up and use no preexisting knowledge of tech
                  required
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
                  On-site training for teachers and administration
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
                  Round the clock access to an expert customer support team
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
                  Hosted on cloud servers ensuring no loss of data
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section appoinment" id="testimonial">
      <div class="container">
        <div class="row justify-content-center">
          <div class="section-title text-center">
            <h2>Testimonials</h2>
            <div class="mx-auto my-4"></div>
            <p>Our customers love us! Read what they have to say below</p>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="testimonial-block style-2" data-bg-text="text">
              One of the main reasons we switched to Zeraki is how easy it is to
              use, and even if you get stuck, their customer care team will get
              you back on track in minutes
            </div>
            <div class="row align-items-center">
              <div class="testimonial-thumb">
                <img
                  src="/global_assets/images/landing/person1.png"
                  class="rounded-circle"
                  alt=""
                  width="80px"
                />
              </div>
              <div class="client-info">
                <h5>James Gichuki</h5>
                <span>Kahuhia Girls</span>
                <div class="rating-stars">
                  <input type="radio" name="rating" id="rs0" checked /><label
                    for="rs0"
                  ></label>
                  <input type="radio" name="rating" id="rs1" /><label
                    for="rs1"
                  ></label>
                  <input type="radio" name="rating" id="rs2" /><label
                    for="rs2"
                  ></label>
                  <input type="radio" name="rating" id="rs3" /><label
                    for="rs3"
                  ></label>
                  <input type="radio" name="rating" id="rs4" /><label
                    for="rs4"
                  ></label>
                  <input type="radio" name="rating" id="rs5" /><label
                    for="rs5"
                  ></label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-block style-2">
              <p>
                Zeraki analytics is very handy for the classroom of tomorrow. It
                is an absolutely valuable tool in the hands of the teacher for
                both examination analysis & student managemnt.
              </p>
            </div>
            <div class="row">
              <div class="testimonial-thumb">
                <img
                  src="/global_assets/images/landing/person2.png"
                  alt=""
                  class="rounded-circle"
                  width="80px"
                />
              </div>
              <div class="client-info">
                <h5>Raphael Otieno</h5>
                <span>Maranda School</span>
                <div class="rating-stars">
                  <input type="radio" name="rating" id="rs0" checked /><label
                    for="rs0"
                  ></label>
                  <input type="radio" name="rating" id="rs1" /><label
                    for="rs1"
                  ></label>
                  <input type="radio" name="rating" id="rs2" /><label
                    for="rs2"
                  ></label>
                  <input type="radio" name="rating" id="rs3" /><label
                    for="rs3"
                  ></label>
                  <input type="radio" name="rating" id="rs4" /><label
                    for="rs4"
                  ></label>
                  <input type="radio" name="rating" id="rs5" /><label
                    for="rs5"
                  ></label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-block style-2">
              <p>
                Zeraki has really helped me save lots of time. I can analyze my
                exam, send texts to parents and enter marks all from one
                platfrom. Thank you Zeraki for your great product.
              </p>
            </div>
            <div class="row">
              <div class="testimonial-thumb">
                <img
                  src="/global_assets/images/landing/person3.png"
                  alt=""
                  class="rounded-circle"
                  width="80px"
                />
              </div>
              <div class="client-info">
                <h5>Petronilla Mugiro</h5>
                <span>Uthiru Girls High School</span>
                <div class="rating-stars">
                  <input type="radio" name="rating" id="rs0" checked /><label
                    for="rs0"
                  ></label>
                  <input type="radio" name="rating" id="rs1" /><label
                    for="rs1"
                  ></label>
                  <input type="radio" name="rating" id="rs2" /><label
                    for="rs2"
                  ></label>
                  <input type="radio" name="rating" id="rs3" /><label
                    for="rs3"
                  ></label>
                  <input type="radio" name="rating" id="rs4" /><label
                    for="rs4"
                  ></label>
                  <input type="radio" name="rating" id="rs5" /><label
                    for="rs5"
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
              <h3>Satisfied Schools</h3>
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
            Zeraki is all about using technology to solve some of the toughest
            challenges encountered in providing quality education in Africa. Our
            cutting edge solutions, provide insights that enable informed
            decision making, provide access to quality instruction and take the
            stress out of everyday administrative tasks. We strive to improve
            the lives of educators and students at every stage and in every
            setting. Our Core product, Zeraki analytics, is transforming the way
            educational data is collected, analyzed and used
          </p>
        </div>
      </div>
    </section>
    <section class="section appoinment">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7">
            <div class="section-title1 text-center">
              <h3><strong>FAQs</strong></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-4">
          <div class="col-lg-3">
            <div class="section-title1 text-center">
              <h3>I'm an Admin</h3>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo1" data-toggle="collapse">
                How do i ask more interesting questions?
              </a>
              <div id="demo1" class="collapse">
                <hr />
                This is the primary content of the panel.
              </div>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo2" data-toggle="collapse">
                How do i ask more interesting questions?
              </a>
              <div id="demo2" class="collapse">
                <hr />
                This is the primary content of the panel.
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="section-title1 text-center">
              <h3>I'm a Parent</h3>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo3" data-toggle="collapse">
                How do i ask more interesting questions?
              </a>
              <div id="demo3" class="collapse">
                <hr />
                This is the primary content of the panel.
              </div>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo4" data-toggle="collapse">
                How do i ask more interesting questions?
              </a>
              <div id="demo4" class="collapse">
                <hr />
                This is the primary content of the panel.
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="section-title1 text-center">
              <h3>I'm New</h3>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo5" data-toggle="collapse">
                How do i ask more interesting questions?
              </a>
              <div id="demo5" class="collapse">
                <hr />
                This is the primary content of the panel.
              </div>
            </div>

            <div class="quest_item px-4 py-2">
              <a href="#demo6" data-toggle="collapse">
                How do i ask more interesting questions?
              </a>
              <div id="demo6" class="collapse">
                <hr />
                This is the primary content of the panel.
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="section-title1 text-center">
              <h3>I'm a Teacher</h3>
            </div>
            <div class="quest_item px-4 py-2">
              <a href="#demo7" data-toggle="collapse">
                How do i ask more interesting questions?
              </a>
              <div id="demo7" class="collapse">
                <hr />
                This is the primary content of the panel.
              </div>
            </div>
            <div class="quest_item pl-4 py-2">
              <a href="#demo8" data-toggle="collapse">
                How do i ask more interesting questions?
              </a>
              <div id="demo8" class="collapse">
                <hr />
                This is the primary content of the panel.
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
              <h3><strong>Get In Touch</strong></h3>
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
                    <i class="icofont-phone"></i> Contact Us
                  </a>
                </li>
              </ul>
              <form id="#" class="appoinment-form" method="post" action="#">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <span class="text-dark">Name</span>
                      <input
                        name="name"
                        id="name"
                        type="text"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <span class="text-dark">Email</span>
                      <input
                        name="email"
                        id="email"
                        type="email"
                        class="form-control"
                        placeholder="Example@gmail.com"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <span class="text-dark">Mobile</span>
                      <input
                        name="phone"
                        id="phone"
                        type="Number"
                        class="form-control"
                        placeholder="07## ### ###"
                      />
                    </div>
                  </div>
                </div>
                <div class="form-group-2 mb-4">
                  <span class="text-dark">Message</span>
                  <textarea
                    name="message"
                    id="message"
                    class="form-control"
                    rows="3"
                    placeholder="Your Message here"
                  ></textarea>
                </div>

                <a class="btn btn-success btn-round-3" href="appoinment.html"
                  >Send Message <i class="icofont-telegram ml-2"></i
                ></a>
              </form>
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
              <p>Litemore Ltd.</p>
              <p>P.O. Box 51235 - 00100</p>
              <p>Nairobi, Kenya</p>
              <p>+254 790 493 495</p>
            </div>
          </div>

          <div class="col-md-3 col-sm-6">
            <div class="widget mb-5 mb-lg-0">
              <h4 class="text-capitalize mb-3">Products</h4>

              <ul class="list-unstyled footer-menu lh-35">
                <li><a href="#!">Zeraki Analytics</a></li>
                <li><a href="#!">Zeraki Shop</a></li>
                <li><a href="#!">Zeraki Finance</a></li>
                <li><a href="#!">Zeraki Learning</a></li>
                <li><a href="#!">Zeraki Timetable</a></li>
                <li><a href="#!">Zeraki Touch</a></li>
              </ul>
            </div>
          </div>

          <div class="col-md-6 col-sm-6 text-center">
            <div class="widget mb-5 mb-lg-0">
              <h4 class="text-capitalize mb-3">About Zeraki</h4>

              <p>
                Zeraki is all about using technology to solve some of the
                toughest challenges encountered in providing quality education
                in Africa.
              </p>
              <p>
                Our cutting edge solutions, provide insights that enable
                informed decision making, provide access to quality instruction
                and take the stress out of everyday administrative tasks.
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
                &copy;2022 All rights reserved. Litemore Limited. Made With
                <i class="icofont-heart"></i> By Litemore.
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
