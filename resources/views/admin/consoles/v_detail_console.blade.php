@extends('layouts.v_adminlte')
@section('title', 'Console Detail')
@section('content')

<div class="container">
    <div class="row">
        <table class="table">
            <tr>
                <th width="150px"> Console Id </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $console->id }}</th>
            </tr>
            <tr>
                <th width="150px"> Console Name </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $console->name }}</th>
            </tr>
            <tr>
                <th width="150px"> Type </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $console->type }}</th>
            </tr>
            <tr>
                <th width="150px"> Price Per Day </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $console->price_per_day }}</th>
            </tr>
            <tr>
                <th width="150px"> Quantity </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $console->qty }}</th>
            </tr>
            <tr>
                <th width="150px"> Description </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $console->description }}</th>
            </tr>
            <tr>
                <th width="150px"> Picture </th>
                <th width="30px">:</th>
                <th><img src="{{ asset('console_images/' . $console->picture) }}" width="400px"></th>
            </tr>
        
            <tr>
                <th colspan="3"><a href="/consoles" class="btn btn-secondary btn-md px-4 py-2">Back</a></th>
            </tr>
        </table>
    </div>
</div>

@endsection