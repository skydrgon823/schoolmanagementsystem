@extends('layouts.master')
@section('page_title', 'Manage Teacher')
@section('content')
<style>
    .card{
        margin-top:90px;overflow:hidden;
    }
</style>
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4>Message To Specific Studets <span class="badge badge-success">SMS Msg</span></h4>
                </div>
                <div class="col-md-4 row justify-content-end">
                    <button onclick="console.log('ok')" style="cursor: pointer" class="btn-primary m-3 px-2 py-1 border-0 rounded">
                        <-&nbsp; Back</i>
                    </button>
                </div>
            </div>
            <hr>
            <div class="row whitesmoke">
                <div class="col-md-9">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Subject</td>
                                <td>Information</td>
                            </tr>
                            <tr>
                                <td>Sender</td>
                                <td>Secretary</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>Tue, Jul 19, 2022</td>
                            </tr>
                            <tr>
                                <td>Message</td>
                                <td>
                                    FROM BIBIRONI HIGH SCHOOL- LUMURU Dear parent, You are kindly invited for parent meeting on Tuesday 21/07/22 at 9:00am.
                                    Venu: Our Lady of Mt Carmel Ngarariga Parish Sociai Hall. PRINCIPAL
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Intented Recipients</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>Delivered</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>Failed</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>SMS Credits</td>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row whitesmoke">
                <table class="table table-striped" style="cursor: pointer">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Adam No</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>SMS Credits</th>
                            <th>Delivery Info</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>1237</td>
                            <td><a href="{{ route('students.edit', Qs::hash(12)) }}" class="dropdown-item"> Njonge Micheal</a></td>
                            <td><span class="badge badge-success">Delivered</span></td>
                            <td>2 Credits</td>
                            <td>+254113410240(Success) The message has been successfully delivered to the recipient's handset</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
