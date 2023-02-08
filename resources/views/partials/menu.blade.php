<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md side-on" style="border-right:2px solid red;font-size: 15px; ">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content" style="position:fixed;margin-top:50px;">

        <!-- User menu -->
        <div class="sidebar-user d-none">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="{{ route('dashboard') }}">
                            <img class="mr-2" src="/global_assets/images/logo.png" width="38" height="38" class="rounded-circle" alt="photo"/>
                        </a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-user font-size-sm"></i> &nbsp;{{ ucwords(str_replace('_', ' ', Auth::user()->user_type->title)) }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="{{ route('my_account') }}" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile" style="position: relative;margin-top:0px;">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('calevents.index') }}"
                        class="nav-link {{ in_array(Route::currentRouteName(), ['calevents.index', 'calevents.create']) ? 'active' : '' }}">
                        <i class="icon-calendar"></i> <span> Calendar</span>
                    </a>
                </li>

                {{-- @if(Qs::userIsTeamSA()) --}}

                    {{--Manage Classes--}}
                    <li class="nav-item">
                        <a href="{{ route('classes.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['classes.index', 'class_manage', 'class_subject_manage', 'subject_students_manage', 'classes.edit']) ? 'active' : '' }}">
                            <i class="icon-windows2"></i> <span> Classes</span>
                        </a>
                    </li>
                    {{--Manage Students--}}
                    <li class="nav-item">
                        <a href="{{ route('students.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['students.index']) ? 'active' : '' }} ">
                            <i class="icon-users"></i> <span> Students</span>
                        </a>
                    </li>
                    {{--Manage Teachers--}}

                    <li class="nav-item">
                        <a href="{{ route('teachers.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['teachers.index', 'teachers.edit']) ? 'active' : '' }} ">
                            <i class="icon-users"></i> <span> Teachers</span>
                        </a>
                    </li>

                    {{-- BOM PA --}}
                    <li class="nav-item">
                        <a href="{{ route('bompa.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['bompa.index', 'bompa.edit']) ? 'active' : '' }} ">
                            <i class="icon-users"></i> <span> BOM/PA</span>
                        </a>
                    </li>
                    {{--Manage Stuff--}}
                    <li class="nav-item">
                        <a href="{{ route('staffs.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['staffs.index', 'staffs.edit']) ? 'active' : '' }} ">
                            <i class="icon-certificate"></i> <span> Staffs</span>
                        </a>
                    </li>

                {{-- @endif --}}


                {{-- @if(Qs::userIsTeamSAT()) --}}



                    {{--Exam--}}
                    <li class="nav-item">
                        <a href="{{ route('exams.index') }}"
                            class="nav-link  {{ in_array(Route::currentRouteName(), ['exams.index']) ? 'active' : '' }}  ">
                            <i class="icon-books"></i>
                            <span> Exams</span>
                        </a>
                    </li>
                    {{--Message--}}
                    <li class="nav-item">
                        <a href="{{ route('messages.index') }}"
                            class="nav-link  {{ in_array(Route::currentRouteName(), ['messagess.index']) ? 'active' : '' }}  ">
                            <i class="icofont-chat"></i>
                            <span> Messages</span>
                        </a>
                    </li>
                    @if(Qs::userIsTeamSAT())
                    {{--Print--}}
                    <li class="nav-item">
                        <a href="{{ route('printouts') }}"
                            class="nav-link  {{ in_array(Route::currentRouteName(), ['printouts.index']) ? 'active' : '' }}  ">
                            <i class="icofont-printer"></i>
                            <span> PrintsOuts</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item text-secondary"><a class="nav-link"><span>ZERAKI PRODUCTS</span></a></li>
                    {{--Learning--}}
                    <li class="nav-item mt-2">
                        <a href="https://learning.zeraki.co.ke" class="nav-link" target="_blank">
                            <i class="icofont-book"></i>
                            <span>Learning</span>
                        </a>
                    </li>
                     {{--Shop--}}
                     <li class="nav-item">
                        <a href="{{ route('shop') }}"
                            class="nav-link  {{ in_array(Route::currentRouteName(), ['shop.index']) ? 'active' : '' }}  ">
                            <i class="icofont-shopping-cart"></i>
                            <span> Shop</span>
                        </a>
                    </li>

                    <li class="nav-item text-secondary"><a class="nav-link"><span>OTHERS</span></a></li>
                    {{--Opportunities--}}
                    <li class="nav-item" style="width:202px;background-color:#263238;transform:translateY(-5px);border-right:2px solid red;">
                        <a href="{{ route('opportunities') }}"
                            class="nav-link  {{ in_array(Route::currentRouteName(), ['opportunities.index']) ? 'active' : '' }}  ">
                            <i class="icon-ladder"></i>
                            <span> Opportunities</span>
                        </a>
                    </li>


                    <li class="nav-item d-none">
                        <a href="{{ route('testexcel.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['testexcel.index']) ? 'active' : '' }} ">
                            <i class="icon-users"></i> <span>  Excel</span>
                        </a>
                    </li>
                {{-- @endif --}}




                @if(Qs::userIsTeamSA())

                    {{--Manage Users--}}
                    <li class="nav-item d-none">
                        <a href="{{ route('users.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.show', 'users.edit']) ? 'active' : '' }}"><i class="icon-users4"></i> <span> Users</span></a>
                    </li>



                    {{--Manage Dorms--}}
                    <li class="nav-item d-none">
                        <a href="{{ route('dorms.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['dorms.index','dorms.edit']) ? 'active' : '' }}"><i class="icon-home9"></i> <span> Dormitories</span></a>
                    </li>

                    {{--Manage Sections--}}
                    <li class="nav-item d-none">
                        <a href="{{ route('sections.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['sections.index','sections.edit',]) ? 'active' : '' }}"><i class="icon-fence"></i> <span>Sections</span></a>
                    </li>

                    {{--Manage Subjects--}}
                    <li class="nav-item d-none">
                        <a href="{{ route('subjects.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['subjects.index','subjects.edit',]) ? 'active' : '' }}"><i class="icon-pin"></i> <span>Subjects</span></a>
                    </li>
                @endif

                {{--Academics--}}
                @if(Qs::userIsAcademic())
                    <li class="d-none nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['tt.index', 'ttr.edit', 'ttr.show', 'ttr.manage']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-graduation2"></i> <span> Academics</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Manage Academics">

                        {{--Timetables--}}
                            <li class="nav-item"><a href="{{ route('tt.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['tt.index']) ? 'active' : '' }}">Timetables</a></li>
                        </ul>
                    </li>
                    @endif

                {{--Administrative--}}
                @if(Qs::userIsAdministrative())
                    <li class="d-none nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.invoice', 'payments.receipts', 'payments.edit', 'payments.manage', 'payments.show',]) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-office"></i> <span> Administrative</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Administrative">

                            {{--Payments--}}
                            @if(Qs::userIsTeamAccount())
                            <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.edit', 'payments.manage', 'payments.show', 'payments.invoice']) ? 'nav-item-expanded' : '' }}">

                                <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.create', 'payments.manage', 'payments.show', 'payments.invoice']) ? 'active' : '' }}">Payments</a>

                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="{{ route('payments.create') }}" class="nav-link {{ Route::is('payments.create') ? 'active' : '' }}">Create Payment</a></li>
                                    <li class="nav-item"><a href="{{ route('payments.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.show']) ? 'active' : '' }}">Manage Payments</a></li>
                                    <li class="nav-item"><a href="{{ route('payments.manage') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.manage', 'payments.invoice', 'payments.receipts']) ? 'active' : '' }}">Student Payments</a></li>

                                </ul>

                            </li>
                            @endif
                        </ul>
                    </li>
                @endif







                {{--End Exam--}}

                @include('pages.'.Qs::getUserType().'.menu')

                {{--Manage Account--}}
                <li class="nav-item d-none">
                    <a href="{{ route('my_account') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['my_account']) ? 'active' : '' }}"><i class="icon-user"></i> <span>My Account</span></a>
                </li>

                </ul>
            </div>
        </div>
</div>
