<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\ParkingModel;
use App\Models\BicycleModel;
use CodeIgniter\Controller;

class OrderController extends Controller
{
    public function create($parking_id)
    {
        $parkingModel = new ParkingModel();
        $orderModel = new OrderModel();
        $bicycleModel = new BicycleModel();

        // Find the parking record associated with the bicycle_id.
        // The $parking_id passed from ParkingController::stop is actually the bicycle_id.
        // We need to find the parking record for this bicycle_id that has been stopped,
        // meaning its end_time is NOT NULL.
        $parkingData = $parkingModel->where('bicycle_id', $parking_id)
                                        ->where('end_time IS NOT NULL')
                                        ->first();

        if ($parkingData) {
            $startTime = strtotime($parkingData['start_time']);
            $endTime = time();
            $durationInMinutes = ($endTime - $startTime) / 60;
            // Calculate total amount, ensuring a minimum charge of 1500 pesos.
            $calculatedAmount = $durationInMinutes * 100;
            $totalAmount = ($calculatedAmount < 1500) ? 1500 : $calculatedAmount;

            $bicycle = $bicycleModel->find($parkingData['bicycle_id']);

            $orderData = [
                'date'      => date('Y-m-d H:i:s', $endTime),
                'bicycle'   => $bicycle,
            ];

            $data = [
                'user_id'      => session()->get('user_id'),
                'parking_id'   => $parkingData['id'], // Use the actual parking record ID
                'order_data'   => json_encode($orderData),
                'total_amount' => $totalAmount,
            ];

            $orderModel->save($data);
            $orderId = $orderModel->getInsertID();

            $order = $orderModel->find($orderId);

            // Wompi data
            $publicKey = 'pub_test_gRDKIZQNJEWoiI9so4W3LAIRrZ1YVQ0J';
            $integritySecret = 'test_integrity_Hd0QwodTmp22AJTGg62U0Zj3yUG6vqGC';
            $reference = 'order-' . $order['id'];
            $amountInCents = $order['total_amount'] * 100;
            $currency = 'COP';

            $concatenated = $reference . $amountInCents . $currency . $integritySecret;
            $signature = hash('sha256', $concatenated);

            $viewData = [
                'order' => $order,
                'wompi' => [
                    'publicKey' => $publicKey,
                    'reference' => $reference,
                    'amountInCents' => $amountInCents,
                    'currency' => $currency,
                    'signature' => $signature,
                    // Ensure the redirectUrl is correctly formed to match the route
                    'redirectUrl' => site_url('payment/response')
                ]
            ];

            return view('orders/show', $viewData);
        }

        return redirect()->to('/dashboard')->with('error', 'Parking record not found.');
    }
}
