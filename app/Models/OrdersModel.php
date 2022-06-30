<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdersModel extends Model
{
    public function getAllOrderData()
    {
        return DB::table('orders')->get();
    }

    public function getAllOrderDetailData()
    {
        return DB::table('orderdetails')->get();
    }

    public function getOrderBasedOnId($id)
    {
        return DB::table('orders')->where('order_id', $id)->get();
    }

    public function getOrderDetailBasedOnId($id)
    {
        return DB::table('orderdetails')->where('order_id', $id)->first();
    }

    public function getBiggestID()
    {
        return DB::table('orders')
            ->select('order_id')
            ->orderBy('order_id', 'desc')
            ->first();
    }

    public function addOrder($data)
    {
        return DB::table('orders')->insert($data);
    }

    public function addOrderDetail($data)
    {
        return DB::table('orderdetails')->insert($data);
    }

    public function setOrderDelivered($id)
    {
        $data = [
            'status' => '(2) delivered'
        ];

        return DB::table('orderdetails')
            ->where('order_id', $id)
            ->update($data);
    }

    public function setOrderReadyToPickUp($id)
    {
        $data = [
            'status' => '(3) ready to pick up'
        ];

        return DB::table('orderdetails')
            ->where('order_id', $id)
            ->update($data);
    }

    public function setOrderDone($id)
    {
        $data = [
            'status' => '(4) done'
        ];

        return DB::table('orderdetails')
            ->where('order_id', $id)
            ->update($data);
    }
}
