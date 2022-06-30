@extends('layouts.v_adminlte')
@section('title', 'Order Detail')
@section('content')

<div class="container">
    <div class="row">
        <table class="table">
            <tr>
                <th width="150px"> Order ID </th>
                <th width="30px">:</th>
                <th style="word-break: break-all" colspan="3">
                  {{ $orderdetail->order_id }}
                </th>
            </tr>

            <tr>
                <th width="150px"> Total Price Per Day </th>
                <th width="30px">:</th>
                <th style="word-break: break-all" colspan="3">
                    @php
                        echo 'Rp' . number_format($orderdetail->total_price_per_day) . ' / day'
                    @endphp
                </th>
            </tr>
            <tr>
                <th width="150px"> Duration (day) </th>
                <th width="30px">:</th>
                <th style="word-break: break-all" colspan="3">
                    @php
                        if($orderdetail->duration_day > 1)
                        {
                            echo $orderdetail->duration_day . ' days';
                        }
                        else
                        {
                            echo $orderdetail->duration_day . ' day';
                        }
                    @endphp
                </th>
            </tr>
            <tr>
                <th width="150px"> Grand Total </th>
                <th width="30px">:</th>
                <th style="word-break: break-all" colspan="3">
                  @php
                      echo 'Rp' . number_format($orderdetail->total_price_per_day * $orderdetail->duration_day);
                  @endphp
                </th>
            </tr>
            <tr>
                <th width="150px"> Status </th>
                <th width="30px">:</th>
                <th style="word-break: break-all" colspan="3">
                    {{ $orderdetail->status }}
                </th>
            </tr>

            <tr>
              {{-- Empty <th> for newline in table --}}
              <th></th>
              <th></th>
              <th></th>
            </tr>

            <tr>
                <th width="150px"> User ID </th>
                <th width="30px">:</th>
                <th style="word-break: break-all" colspan="3">
                    {{ $orderdetail->user_id }}
                </th>
            </tr>
            <tr>
                <th width="150px"> User Email </th>
                <th width="30px">:</th>
                <th style="word-break: break-all" colspan="3">
                    {{ $user->email }}
                </th>
            </tr>
            <tr>
                <th width="150px"> Address </th>
                <th width="30px">:</th>
                <th style="word-break: break-all" colspan="3">
                    {{ $user->address }} 
                </th>
            </tr>
            <tr>
                <th width="150px"> Phone Number </th>
                <th width="30px">:</th>
                <th style="word-break: break-all" colspan="3">
                    {{ $user->phone_number }}
                </th>
            </tr>

            <tr>
              {{-- Empty <th> for newline in table --}}
              <th></th>
              <th></th>
              <th></th>
            </tr>

            <tr>
                <th width="150px"> Consoles </th>
                <th width="30px">:</th>
                <th style="word-break: break-all" colspan="3"></th>
            </tr>

            @foreach ($consoles as $console)    
              <tr>
                  <th width="150px"></th>
                  <th width="30px"></th>
                  <th style="word-break: break-all">
                    ID: {{ $console->id }}
                  </th>
                  <th style="word-break: break-all">
                    {{ $console->name }}
                  </th>
                  <th style="word-break: break-all">
                    @php
                        echo 'Rp' . number_format($console->price_per_day) . ' / day';
                    @endphp 
                  </th>
              </tr>
            @endforeach

            <tr>
                <th colspan="5"><a href="/orders" class="btn btn-secondary btn-md px-4 py-2">Back</a></th>
              </tr>
        </table>
    </div>
</div>

@endsection