@extends('layouts.master')
@section('page_title', 'Manage Classes')
@section('content')

<style>
    .active-state{

    }
    .card{
        margin-top:50px;overflow:hidden;
    }
    .cardpos{
        position:fixed;width:100%;z-index:10;
    }
    .tabpos{
        margin-top: 70px;
    }
    .cardpos>li{
            width:180px;
        }
        .cardpos>li>a{
            text-align: center;
            padding:5px 10px;
        }
</style>


    <div class="card">

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight" style=" transform:translateX(-22px);">
                <li class="nav-item"><a href="#zeraki-shop" class="nav-link active" data-toggle="tab">Zeraki Shop</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="zeraki-shop">

                    <div class="row">
                        <div class="col-md-4">
                            <h3>Hi Nding'uri</h3>
                            <br>
                            <h2>Welcome to Zeraki Shop!</h2>
                            <br>
                            <p>
                                You can order <span class="text-primary">text books, revision, materials</span> and
                                <span class="text-priamry">other school supplies</span> for your child and have them delivered <span class="text-primary">directly</span>
                                to you.
                            </p>
                            <br>
                            <p>
                                We deliver within <span class="text-primary">Nairobi and its environs!</span>
                            </p>
                            <button class="btn btn-success py-2 px-3 btn-lg">Shop Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.js.class_index')
    @include('partials.js.group_index')
@endsection
