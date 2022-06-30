<?php

namespace App\Http\Controllers;

use App\Models\ConsolesModel;

class ConsolesController extends Controller
{
    private $ConsolesModel;
    private $defaultImg;

    public function __construct()
    {
        $this->ConsolesModel = new ConsolesModel();
        $this->defaultImg = "default.jpg";
    }

    public function index()
    {
        $data = [
            'consoles' => $this->ConsolesModel->getAllData()
        ];

        return view('admin/consoles/v_consoles', $data);
    }

    public function detailPage($id)
    {
        $targetConsole = $this->ConsolesModel->getSingleData($id);

        if (empty($targetConsole)) {
            abort(404);
        }

        $data = [
            'console' => $targetConsole
        ];

        return view('admin/consoles/v_detail_console', $data);
    }

    public function addPage()
    {
        return view('admin/consoles/v_add_console');
    }

    public function addPageSubmit()
    {
        // Testing public_path() & asset():

        // $test = [
        //     'public_path' => public_path(),
        //     'public_path("console_images"' => public_path('console_images'),
        //     'asset' => asset('/')
        // ];

        // dd($test);

        // Output:
        // - Public Path =
        // D:\Laravel_Project\UAS-Semester-4\Teori\uas_teori_rental_console\public

        // - Public Path (Console Images) =
        // D:\Laravel_Project\UAS-Semester-4\Teori\uas_teori_rental_console\public\console_images

        // - Asset = http://127.0.0.1:8000/

        Request()->validate([
            'name' => 'required|min:2|regex:/^[A-Za-z0-9_!@#$%^&*?,.]+[A-Za-z0-9_!@#$%^&*?,.\s]*[A-Za-z0-9_!@#$%^&*?,.]+$/|max:250',
            'type' => 'required|in:playstation,xbox,nintendo',
            'price_per_day' => 'required|integer|min:0|max:99999999',
            'qty' => 'required|integer|min:0|max:1000',
            'description' => 'required|min:4|regex:/^[A-Za-z0-9_!@#$%^&*?,.;:\-]+[A-Za-z0-9_!@#$%^&*?,.;:\-\s]*[A-Za-z0-9_!@#$%^&*?,.;:\-]+$/|max:500',
            'picture' => 'image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'name.regex'            => 'Accepted Characters: alphanumeric, space, other symbols(_!@#$%^&*?,.)',
            'description.regex'     => 'Accepted Characters: alphanumeric, space, other symbols(_!@#$%^&*?,.;:-)'
        ]);

        // Ambil ID selanjutnya
        $nextID = $this->ConsolesModel->getBiggestID()->id + 1;
        if (empty($nextID)) {
            $nextID = 1;
        }

        $file = Request()->picture;
        if (!empty($file)) {
            $filename = $nextID . '.' . $file->extension();
            $file->move(public_path('console_images'), $filename);
        } else {
            $filename = $this->defaultImg;
        }

        $data = [
            'id' => $nextID,
            'name' => Request()->name,
            'type' => Request()->type,
            'price_per_day' => Request()->price_per_day,
            'qty' => Request()->qty,
            'description' => Request()->description,
            'picture' => $filename
        ];

        $query = $this->ConsolesModel->addData($data);

        // NOTE: ->with() = Flashed Session Data

        if ($query) {
            return redirect()->route('consoles')->with('success', 'Data Added Successfully!!!');
        } else {
            return redirect()->route('consoles')->with('failed', 'Something went wrong');
        }
    }

    public function editPage($id)
    {
        $targetConsole = $this->ConsolesModel->getSingleData($id);

        if (empty($targetConsole)) {
            abort(404);
        }

        $data = [
            'console' => $targetConsole
        ];

        return view('admin/consoles/v_edit_console', $data);
    }

    public function editPageSubmit($id)
    {
        $targetConsole = $this->ConsolesModel->getSingleData($id);

        if (empty($targetConsole)) {
            abort(404);
        }

        Request()->validate([
            'name' => 'required|min:2|regex:/^[A-Za-z0-9_!@#$%^&*?,.]+[A-Za-z0-9_!@#$%^&*?,.\s]*[A-Za-z0-9_!@#$%^&*?,.]+$/|max:250',
            'type' => 'required|in:playstation,xbox,nintendo',
            'price_per_day' => 'required|integer|min:0|max:99999999',
            'qty' => 'required|integer|min:0|max:1000',
            'description' => 'required|min:4|regex:/^[A-Za-z0-9_!@#$%^&*?,.;:\-]+[A-Za-z0-9_!@#$%^&*?,.;:\-\s]*[A-Za-z0-9_!@#$%^&*?,.;:\-]+$/|max:500',
            'picture' => 'image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'name.regex'            => 'Accepted Characters: alphanumeric, space, other symbols(_!@#$%^&*?,.)',
            'description.regex'     => 'Accepted Characters: alphanumeric, space, other symbols(_!@#$%^&*?,.;:\-)'
        ]);

        $file = Request()->picture;
        if (!empty($file)) {
            $filename = $id . '.' . $file->extension();
            $file->move(public_path('console_images'), $filename);

            $data = [
                'name' => Request()->name,
                'type' => Request()->type,
                'price_per_day' => Request()->price_per_day,
                'qty' => Request()->qty,
                'description' => Request()->description,
                'picture' => $filename
            ];
        } else {
            $data = [
                'name' => Request()->name,
                'type' => Request()->type,
                'price_per_day' => Request()->price_per_day,
                'qty' => Request()->qty,
                'description' => Request()->description,
            ];
        }

        $query = $this->ConsolesModel->editData($id, $data);

        $isDataExactlyTheSame = !empty($this->ConsolesModel->getVerySpecificData($data));

        if ($isDataExactlyTheSame) {
            $query = true;
        }

        // NOTE: ->with() = Flashed Session Data

        if ($query) {
            return redirect()->route('consoles')->with('success', 'Data Edited Successfully!!!');
        } else {
            return redirect()->route('consoles')->with('failed', 'Something went wrong');
        }
    }

    public function deleteSubmit($id)
    {
        // Menghapus foto:
        $consoleToDelete = $this->ConsolesModel->getSingleData($id);

        if (empty($consoleToDelete)) {
            return redirect()->route('consoles')->with('failed', 'Data not found');
        }

        if ($consoleToDelete->picture != $this->defaultImg) {
            unlink(public_path('/console_images/') . $consoleToDelete->picture);
        }

        $query = $this->ConsolesModel->deleteData($id);

        if ($query) {
            return redirect()->route('consoles')->with('success', 'Data Deleted Successfully!!!');
        } else {
            return redirect()->route('consoles')->with('failed', 'Something went wrong');
        }
    }
}
