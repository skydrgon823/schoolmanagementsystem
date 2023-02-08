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
        <div class="row align-items-center">
            <div class="col-md-6">
                Message To {{ $message[0]['receiver_type'] }}
                @switch($message[0]['message_type'])
                    @case(1)
                        <span class="badge badge-info">
                            SMS Msg
                        </span>
                        @break
                    @case(2)
                        <span class="badge badge-primary">
                            SMS Msg
                        </span>
                        @break
                    @case(3)
                        <span class="badge badge-secondary">
                            SMS Msg
                        </span>
                        @break
                    @default

                @endswitch
            </div>
            <div class="col-md-6 text-right pr-3">
                <a href="{{ route('messages.index') }}"> <span class="badge badge-primary"><- Back</span></a>
            </div>
        </div>
        <hr><br><br>
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Subject</strong></td>
                            <td>{{ $message[0]['subject'] }}</td>

                        </tr>
                        <tr>
                            <td><strong>Sender</strong></td>
                            <td>{{ $message[0]['sender'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Date</strong></td>
                            <td>{{ $message[0]['date'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Message</strong></td>
                            <td>{{ $message[0]['content'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Intended Recipients</strong></td>
                            <td>{{ $message[0]['recipients'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Delivered</strong></td>
                            <td>{{ $message[0]['delivered'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Failed</strong></td>
                            <td>{{ $message[0]['failed'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>SMS Credits</strong></td>
                            <td>{{ $message[0]['credits'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        {{-- <th>Adm No</th> --}}
                        <th>Name</th>
                        <th>Status</th>
                        <th>SMS Credits</th>
                        <th>Delivery Info</th>
                        <th>Resend</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($phones as $key=>$phone)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            {{-- <td>{{ $key + 1 }}</td> --}}
                            <td>{{ $phone->name }}</td>
                            <td>
                                @switch($message[0]['failed'])
                                    @case(0)
                                        <span class="badge badge-info">
                                            Delivered
                                        </span>
                                        @break
                                    @case(1)
                                        <span class="badge badge-warning">
                                            Failed
                                        </span>
                                    @break
                                    @default

                                @endswitch
                            </td>
                            <td>
                                @switch($message[0]['failed'])
                                @case(0)
                                    2 Credits
                                    @break
                                @default

                            @endswitch
                            </td>
                            <td>
                                {{ $phone->phone }}
                                @switch($message[0]['failed'])
                                    @case(0)
                                        (Success)The message has been successfully delivered to the recipient's handset
                                        @break
                                    @case(1)
                                        No phone number(s) found
                                    @break
                                    @default

                                @endswitch

                            </td>
                            <td>
                                @switch($message[0]['failed'])
                                    @case(1)
                                        <a href="{{ route('messages.send', $phone->phone) }}" class="dropdown">
                                            <i class="icon-paperplane ml-2"></i>ReSend
                                        </a>
                                        @break
                                    @default
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
{{-- @include('partials.js.message_js') --}}
@endsection
