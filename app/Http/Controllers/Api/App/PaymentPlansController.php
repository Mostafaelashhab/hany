<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\PaymentPlan;
use Exception;
use Illuminate\Http\Request;

class PaymentPlansController extends Controller
{
    public function createPaymentPlan(Request $request)
    {
        try {
            $vaild = validator($request->all(),[
                'image' => 'required',
                'compound_id' => 'required|exists:compounds,id'
            ]);
            if($vaild->fails()){
                return $this->sendResponse($vaild->errors()->all(),400);
            }
            $data = PaymentPlan::create($request->all());
            return $this->sendResponse($data);

            // $validatedData = $request->validate([
            //     'advance' => 'required|float',
            //     'monthly' => 'required|float',
            //     'annual' => 'required|float',
            // ]);

            // PaymentPlan::create([
            //     'advance' => $validatedData['advance'],
            //     'monthly' => $validatedData['monthly'],
            //     'annual' => $validatedData['annual']
            // ]);

            return response()->json([
                'data' => 'payment Plan Created Successfully!',
                'status' => "201"
            ]);

        } catch (Exception $e) {
            return response()->json([
                'data' => $e->getMessage(),
                'status' => "500",
            ]);
        }
    }
    public function allPaymentPlan(Request $request)
    {

    }
    public function modifyPaymentPlan(Request $request)
    {

    }
    public function deletePaymentPlan(Request $request)
    {

    }
}
