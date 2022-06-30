@extends('layouts.v_adminlte')
@section('title', 'User Detail')
@section('content')

<div class="container">
    <div class="row">
        <table class="table">
            <tr>
                <th width="150px"> User Id </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $user->id }}</th>
            </tr>
            <tr>
                <th width="150px"> Email </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $user->email }}</th>
            </tr>
            <tr>
                <th width="150px"> Password (Hashed) </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $user->password }}</th>
            </tr>
            <tr>
                <th width="150px"> Address </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $user->address }}</th>
            </tr>
            <tr>
                <th width="150px"> Phone Number </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $user->phone_number }}</th>
            </tr>
            <tr>
                <th width="150px"> Role </th>
                <th width="30px">:</th>
                <th style="word-break: break-all">{{ $user->role }}</th>
            </tr>
        
            <tr>
                <th colspan="3"><a href="/users" class="btn btn-secondary btn-md px-4 py-2">Back</a></th>
            </tr>
        </table>
    </div>
</div>

@endsection