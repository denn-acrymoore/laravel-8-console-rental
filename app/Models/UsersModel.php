<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersModel extends Model
{
    public function getAllData()
    {
        return DB::table('users')->get();
    }

    public function getSingleData($id)
    {
        return DB::table('users')->where('id', $id)->first();
    }

    public function getByEmail($email)
    {
        return DB::table('users')->where('email', $email)->first();
    }

    public function getBiggestID()
    {
        return DB::table('users')
            ->select('id')
            ->orderBy('id', 'desc')
            ->first();
    }

    public function addData($data)
    {
        return DB::table('users')->insert($data);
    }

    public function editData($id, $data)
    {
        return DB::table('users')
            ->where('id', $id)
            ->update($data);
    }

    public function getVerySpecificData($data)
    {
        return DB::table('users')
            ->where('email', $data['email'])
            ->where('password', $data['password'])
            ->where('address', $data['address'])
            ->where('phone_number', $data['phone_number'])
            ->where('role', $data['role'])
            ->first();
    }

    public function deleteData($id)
    {
        return DB::table('users')
            ->where('id', $id)
            ->delete();
    }
}
