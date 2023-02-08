@extends('layouts.master')
@section('page_title', 'Manage Message')
@section('content')
<style>
    .card{
        margin-top:180px;overflow:hidden;
    }
</style>
<div class="card ml-4 p-4" style="text-align: left;">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <p><strong> Subject:</strong> <span>{{ $message->subject }}</span></p>
                <p><strong>From:</strong> <span>{{ $message->sender->name }}</span></p>
                <p><strong>Date:</strong> <span>{{ $message->created_at }}</span></p>
            </div>
        </div>
        <hr><br><br>
        <div class="row">
            <div class="col-md">
                <p>
                    {{ $message->content }}
                </p>
            </div>
        </div>
        <hr><br>
        <div class="row justify-content-end">
            <a href="{{ route('messages.index') }}"> <span class="p-2" style="border-radius: 5px;background-color:darkblue;color:white">Back</span></a>
        </div>

    </div>
</div>
@include('partials.js.message_js')
@endsection
