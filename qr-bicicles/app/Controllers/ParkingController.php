<?php

namespace App\Controllers;

use App\Models\ParkingModel;
use App\Models\BicycleModel;
use CodeIgniter\Controller;

class ParkingController extends Controller
{
    public function start()
    {
        $bicycleModel = new BicycleModel();
        $bicycles = $bicycleModel->where('user_id', session()->get('user_id'))->findAll();

        return view('parking/start', ['bicycles' => $bicycles]);
    }

    public function store()
    {
        $parkingModel = new ParkingModel();

        $data = [
            'bicycle_id' => $this->request->getVar('bicycle_id'),
            'start_time' => date('Y-m-d H:i:s'),
        ];

        $parkingModel->save($data);

        return redirect()->to('/dashboard');
    }

    public function stop($bicycle_id)
    {
        $parkingModel = new ParkingModel();
        // Find the parking record for this bicycle_id where end_time is null
        $parkingRecord = $parkingModel->where('bicycle_id', $bicycle_id)
                                        ->where('end_time', null)
                                        ->first(); // Use first() to get a single record

        // Check if a record was found and update its end_time
        if ($parkingRecord) {
            // The update method expects the primary key, which is 'id' in ParkingModel
            $parkingModel->update($parkingRecord['id'], ['end_time' => date('Y-m-d H:i:s')]);
        }

        // Redirect using the bicycle_id as per the original logic, assuming it's relevant for orders
        return redirect()->to("/orders/create/{$bicycle_id}");
    }

    /**
     * Displays the dashboard with active and past parking sessions.
     * Moves data fetching logic from the view to the controller.
     */
    public function dashboard()
    {
        
        $parkingModel = new \App\Models\ParkingModel();
        $bicycleModel = new \App\Models\BicycleModel(); // Needed for user_id check

        // Fetch active parking sessions
        $activeParkings = $parkingModel
            ->join('bicycles', 'bicycles.id = parking.bicycle_id')
            ->where('bicycles.user_id', session()->get('user_id'))
            ->where('parking.end_time', null)
            ->findAll();

        
        // Fetch past parking sessions, including order status and total_paid for payment logic
        $pastParkings = $parkingModel
            ->select('parking.*, bicycles.brand, bicycles.serial, orders.status, parking.total_paid')
            ->join('bicycles', 'bicycles.id = parking.bicycle_id')
            ->join('orders', 'orders.parking_id = parking.id', 'left') // Assuming 'parking_id' is the FK in orders
            ->where('bicycles.user_id', session()->get('user_id'))
            ->where('parking.end_time IS NOT NULL')
            ->orderBy('parking.start_time', 'DESC')
            ->findAll();

        // Format start_time for JavaScript compatibility
        foreach ($activeParkings as &$parking) {
            if (isset($parking['start_time'])) {
                try {
                    // Assuming start_time is a string like 'YYYY-MM-DD HH:MM:SS'
                    // Convert to DateTime object to use toISOString()
                    $dateTime = new \DateTime($parking['start_time']);
                    // Use ATOM format which is ISO 8601 compliant (e.g., 2025-08-12T07:00:00+00:00)
                    $parking['start_time_iso'] = $dateTime->format(\DateTime::ATOM); 
                } catch (\Exception $e) {
                    // Log the error or handle it as appropriate
                    // For now, set to null if parsing fails
                    $parking['start_time_iso'] = null; 
                }
            }
        }
        unset($parking); // Unset the reference to avoid potential issues

        // Pass the fetched data to the dashboard view
        return view('dashboard', [
            'activeParkings' => $activeParkings,
            'pastParkings' => $pastParkings
        ]);
    }
}
