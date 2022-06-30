@extends('layouts.v_adminlte')
@section('title', 'Consoles')

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

    <div class="float-right" style="margin-bottom: 10px;">
        <a href="/consoles/add" class="btn btn-primary btn-md">
        <span class="fas fa-plus-circle" style="margin-right: 4px;"></span>
        Add Consoles
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th> Console ID </th>
                <th> Console Name </th>
                <th> Type </th>
                <th> Price Per Day </th>
                <th> Quantity </th>
                <th> Picture </th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consoles as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->type }}</td>
                    <td>{{ $data->price_per_day }}</td>
                    <td>{{ $data->qty }}</td>
                    <td><img src="{{ asset('console_images/' . $data->picture) }}" width="150px"></td>
                    <td>
                        <a href="/consoles/detail/{{ $data->id }}" class="btn btn-sm btn-success mb-1">Detail</a>
                        <a href="/consoles/edit/{{ $data->id }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                        <a type="button" class="btn btn-sm btn-danger mb-1" data-toggle="modal" 
                        data-target="#del-confirm-{{ $data->id }}">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <thead class="thead-dark">
            <tr>
                <th> Console ID </th>
                <th> Console Name </th>
                <th> Type </th>
                <th> Price Per Day </th>
                <th> Quantity </th>
                <th> Picture </th>
                <th> Action </th>
            </tr>
        </thead>
    </table>

    @foreach ($consoles as $data)

        <div class="modal fade" id="del-confirm-{{ $data->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $data->name }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this data?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">No</button>

                        <form action="/consoles/delete/{{ $data->id }}" method="post">
                          @csrf
                          <button type="submit" class="btn btn-danger px-4">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@endsection