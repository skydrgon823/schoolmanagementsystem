<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="CJ Inspired">

    <title> @yield('page_title') | {{ config('app.name') }} </title>

    @include('partials.inc_top')
</head>

<body class="{{ in_array(Route::currentRouteName(), ['payments.invoice', 'marks.tabulation', 'marks.show', 'ttr.manage', 'ttr.show']) ? 'sidebar-xs' : '' }}">

@include('partials.top_menu')
<div class="page-content">
    @include('partials.menu')
    <div class="content-wrapper">

        <div class="content pl-0 py-2 mt-2 mr-1" style="font-size:1rem;text-align:center;font-style:normal">
            {{--Error Alert Area--}}
            {{-- @if($errors->any())
                <div class="alert alert-danger border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                        @foreach($errors->all() as $er)
                            <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                        @endforeach

                </div>
            @endif --}}
            <div id="ajax-alert" style="display: none"></div>

            @yield('content')
        </div>

        <div class="content pl-0 py-2 mt-2 mr-1 ml-2" style="font-size:1rem;text-align:left;font-style:normal">
            &copy; <?php echo date("Y"); ?><span style="color:#87CEEB"> Zeraki.</span> <span> All Rights Reserved</span>
        </div>
    </div>
</div>
@include('partials.inc_bottom')
@yield('scripts')
</body>
</html>
