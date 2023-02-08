@extends('layouts.master')
@section('page_title', 'Manage Message')
@section('content')
<style>
    .card{
        margin-top:90px;overflow:hidden;
    }
</style>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <p class="text-secondary">Remaining <br> SMS Credits</p>
                <h3 class="text-success">{{ $balance }} Texts</h3>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        SMS Purchases
                    </div>
                    <div class="col-md-6">
                        <div class="text-right p-3">
                            <a href="{{ route('messages.index') }}"> <span class="badge badge-primary">Back</span></a>
                        </div>
                    </div>
                </div>

                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Phone Number</th>
                            <th>MPESA Code</th>
                            <th>Amount</th>
                            <th>View Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>18-07-2022</td>
                            <td>254722119676</td>
                            <td>QGI6NWQJRE</td>
                            <td>163</td>
                            <td><a href="{{ route('main.receipt', 1) }}" class="dropdown-item"><i class="icon-eye"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


{{-- @include('partials.js.message_js') --}}
@endsection
