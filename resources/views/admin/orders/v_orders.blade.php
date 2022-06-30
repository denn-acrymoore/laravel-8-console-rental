@extends('layouts.v_adminlte')
@section('title', 'Orders')

@section('content')
    
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Success!!!</h4>
        {{ session('success') }}
    </div>
    @endif

    @if (session('failed'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-close"></i> Error!!!</h4>
        {{ session('failed') }}
    </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th> Order ID </th>
                <th> User ID </th>
                <th> Console ID </th>
                <th> Duration (day) </th>
                <th> Grand Total </th>
                <th> Status </th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderdetails as $od)
                <tr>
                    <td>{{ $od->order_id }}</td>
                    <td>{{ $od->user_id }}</td>
                    <td>
                        @php
                            $consoleCount = 0;

                            foreach($orders as $o)
                            {
                                if($o->order_id == $od->order_id)
                                {
                                    $consoleCount++;
                                }
                            }

                            foreach($orders as $o)
                            {
                                if($o->order_id == $od->order_id)
                                {
                                    if($consoleCount > 1)
                                    {
                                        echo $o->console_id . ', ';
                                        $consoleCount--;
                                    }
                                    else{
                                        echo $o->console_id;
                                    }
                                }
                            }
                        @endphp
                    </td>
                    <td>{{ $od->duration_day }}</td>
                    <td>
                        @php
                            echo 'Rp' . number_format($od->duration_day * $od->total_price_per_day);
                        @endphp
                    </td>
                    <td>{{ $od->status }}</td>
                    <td>
                        <a href="/orders/detail/{{ $od->order_id }}" class="btn btn-sm btn-success mb-1">Detail</a>

                        @if ($od->status == '(1) en route')
                            <a type="button" class="btn btn-sm btn-warning mb-1"
                            data-toggle="modal" 
                            data-target="#delivered-confirm-{{ $od->order_id }}">
                                Delivered
                            </a>
                        @endif

                        @if ($od->status == '(3) ready to pick up')
                            <a type="button" class="btn btn-sm btn-danger mb-1"
                            data-toggle="modal" 
                            data-target="#done-confirm-{{ $od->order_id }}">
                                Done
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <thead class="thead-dark">
            <tr>
                <th> Order ID </th>
                <th> User ID </th>
                <th> Console ID </th>
                <th> Duration (day) </th>
                <th> Grand Total </th>
                <th> Status </th>
                <th> Action </th>
            </tr>
        </thead>
    </table>

    @foreach ($orderdetails as $od)
        @if ($od->status == '(1) en route')
            <div class="modal fade" id="delivered-confirm-{{ $od->order_id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ 'Order ID: ' . $od->order_id }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Change order status to "delivered"?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">No</button>

                            <form action="/orders/delivered/{{ $od->order_id }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger px-4">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        @endif
        
        @if ($od->status == '(3) ready to pick up')
            <div class="modal fade" id="done-confirm-{{ $od->order_id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ 'Order ID: ' . $od->order_id }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Change order status to "done"?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">No</button>

                            <form action="/orders/done/{{ $od->order_id }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger px-4">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        
    @endforeach

@endsection