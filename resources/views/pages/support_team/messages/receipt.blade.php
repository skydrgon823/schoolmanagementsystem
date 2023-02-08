@extends('layouts.master')
@section('page_title', 'Manage Message')
@section('content')
<style>
    .card{
        margin-top:90px;overflow:hidden;
    }
</style>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h3>Receipt No. 21997</h3>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-primary"><i class="icon-printer printer"></i> Print</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p>Receipt No. 21997</p>
                <br>
                <p>Litmore Ltd</p>
                <p>P.O. Box 51235</p>
                <p>Nairobi</p>
                <p>Phone: +254790493495</p>
            </div>
            <div class="col-md-6 text-right">
                <p>To: <strong>BIBIRIONI HIGH SCHOOL-LIMURU</strong></p>
                <p>Phone: 00</p>
                <p><Strong>Receipt Date:</Strong>18-07-2022</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Purchaser</th>
                            <th>MPesa Code</th>
                            <th>Date</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Purchase of SMS Credits</td>
                            <td>254722119676</td>
                            <td>QGI6NWQJRE</td>
                            <td>18-07-2022</td>
                            <td>Ksh.163</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12 text-right mt-3">
                <p class="mr-3">Total:Ksh.163</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <p><strong>Comments:</strong> SMS Charges are KSH.1/-per SMS</p>
            </div>
            <div class="col-md text-right mr-3">
                <a href="{{ route('main.buy') }}"> <span class="badge badge-primary">Back</span></a>
            </div>

        </div>
    </div>
</div>
{{-- @include('partials.js.message_js') --}}
@endsection
