<div class="navbar navbar-expand-md navbar-dark" style="position: fixed;z-index:100;width:100%">

    <div class="navbar-brand" style="min-width: 200px;background-color:#263238;padding:20px;transform:translateX(-20px)">
        <a href="{{ route('dashboard') }}" class="d-inline-block">
            <img src="{{ asset('assets/images/zeraki_analytics_logo.svg') }}" style="left:0;top:0;width:10rem;height:50px;" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>

    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        {{-- <ul class="navbar-nav">
            <li class="nav-item mt-1 active-state">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul> --}}
        <div class="mr-5">
            <a href="{{ route('dashboard') }}" class="d-inline-block">
            {{-- <h4 class="text-bold text-white">{{ Qs::getSystemName() }}</h4> --}}
            <h4 class="text-bold text-success">{{ Auth::user()->school_name }}</h4>
            {{-- <h4 class="text-bold text-success">BIBIRIONI HIGH SCHOOL - LIMURU</h4> --}}
        </a>
        </div>
        <span class="navbar-text ml-md-3 mr-md-auto"></span>
        <div class="text-grey ml-md-3" style="background-color: white;border-radius:5px;">
           <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="dropdown03"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                  style="padding: 5px 10px !important"
                >
                  <img
                    src="/global_assets/images/landing/GB.svg"
                    alt=""
                    class="img-fluid"
                    width="15px" />
                  ENGLISH</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown03">
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
           </ul>
        </div>
        &nbsp;
        <div class="input-group" style="width: 50px;">
            {{-- <input type="text" class="form-control" placeholder="Search Student"> --}}
            <div class="input-group-append" style="background-color:#324148;border-radius:5px;">
                <a href="/students" class="text-white" style="padding:5px 10px;"><i class="icon-search4" style="color:white"></i></a>
            </div>
        </div>
        {{-- <div class="input-group" style="width: 250px;">
            <input type="text" class="form-control" placeholder="Search Student">
            <div class="input-group-append" style="background-color:white;border-top-right-radius:5px;border-bottom-right-radius:5px;">
                <a href="/students" class="text-white" style="padding:5px 10px;"><i class="icon-search4" style="color:grey"></i></a>
            </div>
        </div> --}}
        &nbsp;
        {{-- <div class="input-group" style="width: 250px;">
            <input type="text" class="form-control" placeholder="Search Student">
            <div class="input-group-append" style="background-color:white;border-top-right-radius:5px;border-bottom-right-radius:5px;">
                <a href="/students" class="text-white" style="padding:5px 10px;"><i class="icon-search4" style="color:grey"></i></a>
            </div>
        </div> --}}
        <div style="background-color:white;padding:5px;border-radius:5px;">
            <ul class="navbar-nav">
                <li class="nav-item dropdown dropdown-message">
                    <a href="#" class="text-white m-md-1" data-toggle="dropdown">
                        <i class="icofont-envelope" style="color: grey;font-size:20px;"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-left" style="color: grey">
                        {{-- <li class="dropdown-item"><button style="border-color: transparent;cursor: pointer;" id="removeMessage"> Messages &nbsp; <span class="text-danger"> Clear All</span></button></li> --}}
                        <li class="dropdown-item"><a href="/updateMessageAll"> Messages &nbsp; <span class="text-danger"> Clear All</span></a></li>
                        @isset($messages)
                            @foreach ($messages as $message)
                                <li class="dropdown-item"><a href="/messages/{{ $message->id }}"> <span class="text-danger"> {{ $message->subject }}</span></a></li>
                            @endforeach
                        @endisset

                        <li class="dropdown-item"><a href="/messages"> <span class="text-success"> View All</span></a></li>
                    </ul>
                </li>

            </ul>
        </div>
        @isset($messages)
            @if (count($messages)>0)
            <span class="badge badge-pill badge-danger" style="margin-left: -10px;margin-top:-30px" id="msgCount">
                    {{ count($messages) }}
            </span>
            @endif
        @endisset
        <ul class="navbar-nav ml-1">

            <li class="nav-item dropdown dropdown-user">
                <div class="d-flex flex-row">
                    <div class="d-flex flex-column align-items-end">
                        <span>{{ Auth::user()->name }}</span>
                        <span>{{ Auth::user()->email }} </span>
                    </div>
                    <a class="pl-2" style="cursor: pointer" data-toggle="dropdown">
                        <img style="width: 38px; height:38px;" src="/sign_number/{{Auth::user()->sign}}" class="rounded-circle" alt="photo">
                        {{-- <img style="width: 38px; height:38px;" src="/{{Auth::user()->photo_by}}/{{Auth::user()->photo}}" class="rounded-circle" alt="photo"> --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ Qs::userIsStudent() ? route('students.show', Qs::hash(Qs::findStudentRecord(Auth::user()->id))) : route('users.show', Qs::hash(Auth::user()->id)) }}" class="dropdown-item"><i class="icon-user-plus"></i>Profile</a>
                        <a href="{{ route('my_account') }}" class="dropdown-item"><i class="icon-cog5"></i>Settings</a>
                        <a href="{{ route('my_account.show_pass_reset') }}" class="dropdown-item"><i class="icon-key"></i>Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

            </li>
        </ul>
    </div>
</div>
