<?php

namespace App\Http\Controllers;

use App\Models\ConsolesModel;
use App\Models\OrdersModel;
use App\Models\UsersModel;
use GuzzleHttp\Psr7\Request;

class HomeController extends Controller
{
    private $ConsolesModel;
    private $UsersModel;
    private $OrdersModel;

    public function __construct()
    {
        $this->ConsolesModel = new ConsolesModel();
        $this->UsersModel = new UsersModel();
        $this->OrdersModel = new OrdersModel();
    }

    public function index()
    {
        $data = [
            'consoles' => $this->ConsolesModel->getAllData()
        ];

        return view('home/v_home', $data);
    }

    public function loginPage()
    {
        return view('home/v_login');
    }

    public function loginSubmit()
    {
        // NOTE: Password diberi nama input_password karena old('password') tidak mau jalan.

        Request()->validate([
            'email'     => 'required|email|max:100',
            'input_password'  => 'required|min:8|max:100|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/'
        ]);

        if (isset($_POST['g-recaptcha-response'])) {
            $captcha = $_POST['g-recaptcha-response'];
            $str = "https://www.google.com/recaptcha/api/siteverify?"
                . "secret=6Le-Lx0bAAAAANfJHQ3hRC-ID2i8y8-KLbsCSwWR"
                . "&response=" . $captcha . "&remoteip" . $_SERVER['REMOTE_ADDR'];
            $response = file_get_contents($str);
            $response_arr = (array) json_decode($response);
            if ($response_arr['success'] == false) {
                return back()->with('failed', 'Recaptcha failed');
            }
        } else {
            return back()->with('failed', 'Recaptcha failed');
        }

        $userData = $this->UsersModel->getByEmail(Request()->email);
        if ($userData) {
            $checkResult = password_verify(Request()->input_password, $userData->password);

            if ($checkResult) {
                if ($userData->role == 'admin') {
                    session(['role' => 'admin']);
                    session(['user_id' => $userData->id]);
                    session(['email' => $userData->email]);

                    return redirect('/consoles');
                } else if ($userData->role == 'user') {
                    session(['role' => 'user']);
                    session(['user_id' => $userData->id]);
                    session(['email' => $userData->email]);

                    return redirect('/');
                }
            } else {
                return back()->with('failed', 'Incorrect username / password');
            }
        } else {
            return back()->with('failed', 'Incorrect username / password');
        }
    }

    public function registerPage()
    {
        return view('home/v_register');
    }

    public function registerSubmit()
    {
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
            return redirect()->route('loginPage');
        } else {
            return redirect()->route('registerPage')->with('failed', 'Something went wrong');
        }
    }

    public function logout()
    {
        session()->pull('role');
        session()->pull('user_id');
        session()->pull('email');
        session()->pull('shopping_cart');

        return redirect('/');
    }

    public function shoppingCartPage()
    {
        $data = [
            'consoles' => $this->ConsolesModel->getAllData()
        ];

        return view('home/v_orders', $data);
    }

    public function addShoppingCart()
    {
        // dd(Request()->addedConsole);

        if (empty(session('role')) || session('role') != 'user') {
            return redirect()->route('home');
        }

        Request()->validate([
            'addedConsole' => 'required|numeric'
        ]);

        $targetID = Request()->addedConsole;
        $targetConsole = $this->ConsolesModel->getSingleData($targetID);

        if (empty($targetConsole)) {
            return redirect()->route('home');
        }

        if ($targetConsole->qty < 1) {
            return redirect()->route('home');
        }

        $shoppingCart = session('shopping_cart');

        if (empty($shoppingCart)) {
            $shoppingCart = [];
        }

        if (in_array($targetID, $shoppingCart)) {
            return redirect()->route('home');
        }

        array_push($shoppingCart, $targetID);

        session()->pull('shopping_cart');
        session(['shopping_cart' => $shoppingCart]);

        return redirect()->route('home');
    }

    public function deleteShoppingCart($id)
    {
        $shoppingCart = session('shopping_cart');

        if (empty($shoppingCart)) {
            $shoppingCart = [];
        }

        if (!in_array($id, $shoppingCart)) {
            return redirect()->route('shoppingCart');
        } else {
            $arrayKey = array_search($id, $shoppingCart);

            unset($shoppingCart[$arrayKey]);
            session()->pull('shopping_cart');
            session(['shopping_cart' => $shoppingCart]);

            return redirect()->route('shoppingCart');
        }
    }

    public function submitShoppingCart()
    {
        Request()->validate([
            'duration' => 'required|numeric|integer'
        ]);

        $durationDay = Request()->duration;

        $status = "(1) en route";

        $totalPricePerDay = 0;

        $nextOrderID = $this->OrdersModel->getBiggestID()->order_id + 1;
        if (empty($nextOrderID)) {
            $nextOrderID = 1;
        }

        $consoleIDs = session('shopping_cart');
        $userID = session('user_id');
        if (empty($consoleIDs) || empty($userID)) {
            return redirect()->route('shoppingCart');
        }

        foreach ($consoleIDs as $cid) {
            $currConsole = $this->ConsolesModel->getSingleData($cid);

            if (!empty($currConsole)) {
                $totalPricePerDay += $currConsole->price_per_day;

                $data = [
                    'order_id'      => $nextOrderID,
                    'console_id'    => $cid
                ];

                $this->OrdersModel->addOrder($data);

                $data = [
                    'qty' => $currConsole->qty - 1
                ];

                $this->ConsolesModel->editData($cid, $data);
            }
        }

        $data = [
            'order_id'  => $nextOrderID,
            'user_id'   => $userID,
            'total_price_per_day' => $totalPricePerDay,
            'duration_day' => $durationDay,
            'status' => $status
        ];

        $this->OrdersModel->addOrderDetail($data);

        session()->pull('shopping_cart');

        return redirect()->route('history');
    }

    public function historyPage()
    {
        $data = [
            'consoles'      => $this->ConsolesModel->getAllData(),
            'orders'        => $this->OrdersModel->getAllOrderData(),
            'orderdetails'  => $this->OrdersModel->getAllOrderDetailData()
        ];

        return view('home/v_history', $data);
    }

    public function setOrderReadyToPickUp()
    {
        Request()->validate([
            'order_id' => 'required|numeric|exists:orderdetails,order_id'
        ]);

        $id = Request()->order_id;

        $targetOrder = $this->OrdersModel->getOrderBasedOnId($id);

        if (empty($targetOrder)) {
            abort(404);
        }

        $this->OrdersModel->setOrderReadyToPickUp($id);


        return redirect()->route('history');
    }
}
