<?php

namespace App\Controllers;

use App\Models\BicycleModel;
use CodeIgniter\Controller;

class BicycleController extends Controller
{
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $bicycleModel = new BicycleModel();

            $data = [
                'user_id' => session()->get('user_id'),
                'brand'   => $this->request->getVar('brand'),
                'color'   => $this->request->getVar('color'),
                'serial'  => $this->request->getVar('serial'),
            ];

            $bicycleModel->save($data);

            return redirect()->to('/dashboard');
        }

        return view('bicycles/create');
    }
}
