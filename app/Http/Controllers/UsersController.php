<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;

class UsersController extends Controller
{
    private $UsersModel;

    public function __construct()
    {
        $this->UsersModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'users' => $this->UsersModel->getAllData()
        ];

        return view('admin/users/v_users', $data);
    }

    public function detailPage($id)
    {
        $targetUser = $this->UsersModel->getSingleData($id);

        if (empty($targetUser)) {
            abort(404);
        }

        $data = [
            'user' => $targetUser
        ];

        return view('admin/users/v_detail_user', $data);
    }

    public function addPage()
    {
        return view('admin/users/v_add_user');
    }

    public function addPageSubmit()
    {
        // dd(Request());

        // NOTE: Password diberi nama input_password karena old('password') tidak mau jalan.

        Request()->validate([
            'email' => 'required|email|max:100|unique:users,email',
            'input_password' => 'required|min:8|max:100|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/',
            'confirm_password' => 'required|min:8|max:100|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/|same:input_password',
            'address' => 'required|min:4|max:250|regex:/^[A-Za-z0-9_!@#$%^&*?,.]+[A-Za-z0-9_!@#$%^&*?,.\s]*[A-Za-z0-9_!@#$%^&*?,.]+$/',
            'phone_number' => 'required|numeric|digits:12|regex:/^[0-9]+$/'
        ], [
            'phone_number.regex' => 'The phone number must be an integer number'
        ], [
            'input_password.regex'      => 'Accepted Characters: alphanumeric, other symbols(_!@#$%^&*?)',
            'confirm_password.regex'    => 'Accepted Characters: alphanumeric, other symbols(_!@#$%^&*?)',
            'address.regex'             => 'Accepted Characters: alphanumeric, space, other symbols(_!@#$%^&*?,.)'
        ]);

        // Ambil ID selanjutnya
        $nextID = $this->UsersModel->getBiggestID()->id + 1;
        if (empty($nextID)) {
            $nextID = 1;
        }

        $password = Request()->input_password;
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'id' => $nextID,
            'email' => Request()->email,
            'password' => $hashedPassword,
            'address' => Request()->address,
            'phone_number' => Request()->phone_number,
            'role' => 'user'
        ];

        $query = $this->UsersModel->addData($data);

        // NOTE: ->with() = Flashed Session Data

        if ($query) {
            return redirect()->route('users')->with('success', 'Data Added Successfully!!!');
        } else {
            return redirect()->route('users')->with('failed', 'Something went wrong');
        }
    }

    public function editPage($id)
    {
        $targetUser = $this->UsersModel->getSingleData($id);

        if (empty($targetUser)) {
            abort(404);
        }

        $data = [
            'user' => $targetUser
        ];

        return view('admin/users/v_edit_user', $data);
    }

    public function editPageSubmit($id)
    {
        // dd(Request());

        $targetUser = $this->UsersModel->getSingleData($id);

        if (empty($targetUser)) {
            abort(404);
        }

        if (Request()->email == $targetUser->email) {
            $emailRule = 'required|email|max:100';
        } else {
            $emailRule = 'required|email|max:100|unique:users,email';
        }

        Request()->validate([
            'email' => $emailRule,
            'input_password' => 'required|min:8|max:100|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/',
            'confirm_password' => 'required|min:8|max:100|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/|same:input_password',
            'address' => 'required|min:4|max:250|regex:/^[A-Za-z0-9_!@#$%^&*?,.]+[A-Za-z0-9_!@#$%^&*?,.\s]*[A-Za-z0-9_!@#$%^&*?,.]+$/',
            'phone_number' => 'required|numeric|digits:12|regex:/^[0-9]+$/'
        ], [
            'input_password.regex'      => 'Accepted Characters: alphanumeric, other symbols(_!@#$%^&*?)',
            'confirm_password.regex'    => 'Accepted Characters: alphanumeric, other symbols(_!@#$%^&*?)',
            'address.regex'             => 'Accepted Characters: alphanumeric, space, other symbols(_!@#$%^&*?,.)',
            'phone_number.regex'        => 'The phone number must be an integer number'
        ]);

        $password = Request()->input_password;
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'email' => Request()->email,
            'password' => $hashedPassword,
            'address' => Request()->address,
            'phone_number' => Request()->phone_number,
            'role' => 'user'
        ];

        $targetUser = $this->UsersModel->getSingleData($id);

        if ($targetUser->role == 'admin') {
            return redirect()->route('users')->with('failed', 'Something went wrong');
        }

        $query = $this->UsersModel->editData($id, $data);

        $isDataExactlyTheSame = !empty($this->UsersModel->getVerySpecificData($data));

        if ($isDataExactlyTheSame) {
            $query = true;
        }

        // NOTE: ->with() = Flashed Session Data

        if ($query) {
            return redirect()->route('users')->with('success', 'Data Edited Successfully!!!');
        } else {
            return redirect()->route('users')->with('failed', 'Something went wrong');
        }
    }

    public function deleteSubmit($id)
    {
        // Menghapus foto:
        $userToDelete = $this->UsersModel->getSingleData($id);

        if (empty($userToDelete)) {
            return redirect()->route('users')->with('failed', 'Data not found');
        }

        if ($userToDelete->role == 'admin') {
            return redirect()->route('users')->with('failed', 'Something went wrong');
        }

        $query = $this->UsersModel->deleteData($id);

        if ($query) {
            return redirect()->route('users')->with('success', 'Data Deleted Successfully!!!');
        } else {
            return redirect()->route('users')->with('failed', 'Something went wrong');
        }
    }
}
