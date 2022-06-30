<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConsolesModel extends Model
{
    public function getAllData()
    {
        return DB::table('consoles')->get();
    }

    public function getSingleData($id)
    {
        return DB::table('consoles')->where('id', $id)->first();
    }

    public function getBiggestID()
    {
        return DB::table('consoles')
            ->select('id')
            ->orderBy('id', 'desc')
            ->first();
    }

    public function addData($data)
    {
        return DB::table('consoles')->insert($data);
    }

    public function editData($id, $data)
    {
        return DB::table('consoles')
            ->where('id', $id)
            ->update($data);
    }

    public function getVerySpecificData($data)
    {
        return DB::table('consoles')
            ->where('name', $data['name'])
            ->where('type', $data['type'])
            ->where('price_per_day', $data['price_per_day'])
            ->where('qty', $data['qty'])
            ->where('description', $data['description'])
            ->first();
    }

    public function deleteData($id)
    {
        return DB::table('consoles')
            ->where('id', $id)
            ->delete();
    }
}
