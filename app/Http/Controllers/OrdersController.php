<?php

namespace App\Http\Controllers;

use App\Models\ConsolesModel;
use App\Models\OrdersModel;
use App\Models\UsersModel;

class OrdersController extends Controller
{
    private $OrdersModel;
    private $ConsolesModel;
    private $UsersModel;

    public function __construct()
    {
        $this->OrdersModel      = new OrdersModel();
        $this->ConsolesModel    = new ConsolesModel();
        $this->UsersModel       = new UsersModel();
    }

    public function index()
    {
        $data = [
            'orders'        => $this->OrdersModel->getAllOrderData(),
            'orderdetails'  => $this->OrdersModel->getAllOrderDetailData()
        ];

        return view('admin/orders/v_orders', $data);
    }

    public function detailPage($id)
    {
        $targetOrder = $this->OrdersModel->getOrderBasedOnId($id);
        $targetOrderDetail = $this->OrdersModel->getOrderDetailBasedOnId($id);

        if (empty($targetOrder) || empty($targetOrderDetail)) {
            abort(404);
        }

        $user_id = $targetOrderDetail->user_id;

        $console_id = [];
        foreach ($targetOrder as $o) {
            array_push($console_id, $o->console_id);
        }

        if (empty($user_id) || empty($console_id)) {
            abort(404);
        }

        $targetUser = $this->UsersModel->getSingleData($user_id);

        $targetConsole = [];
        foreach ($console_id as $id) {
            $consoleData = $this->ConsolesModel->getSingleData($id);
            array_push($targetConsole, $consoleData);
        }

        if (empty($targetUser) || empty($targetConsole)) {
            abort(404);
        }

        $data = [
            'order'         => $targetOrder,
            'orderdetail'   => $targetOrderDetail,
            'user'          => $targetUser,
            'consoles'      => $targetConsole
        ];

        return view('admin/orders/v_detail_order', $data);
    }

    public function setOrderDelivered($id)
    {
        $targetOrder = $this->OrdersModel->getOrderBasedOnId($id);

        if (empty($targetOrder)) {
            abort(404);
        }

        $query = $this->OrdersModel->setOrderDelivered($id);

        if ($query) {
            return redirect()->route('orders')->with('success', 'Order Status Successfully Changed to (2) delivered!!!');
        } else {
            return redirect()->route('orders')->with('failed', 'Something went wrong');
        }
    }

    public function setOrderDone($id)
    {
        $targetOrder = $this->OrdersModel->getOrderBasedOnId($id);

        if (empty($targetOrder)) {
            abort(404);
        }

        $query = $this->OrdersModel->setOrderDone($id);

        foreach ($targetOrder as $to) {
            $targetConsole = $this->ConsolesModel->getSingleData($to->console_id);

            if (!empty($targetConsole)) {
                $data = [
                    'qty' => $targetConsole->qty + 1
                ];

                $this->ConsolesModel->editData($to->console_id, $data);
            }
        }


        if ($query) {
            return redirect()->route('orders')->with('success', 'Order Status Successfully Changed to (4) done!!!');
        } else {
            return redirect()->route('orders')->with('failed', 'Something went wrong');
        }
    }
}
