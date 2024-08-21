<?php

namespace App\Http\Controllers\Api\App;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\BaseController;
use App\Models\PaymentPlan;
use Exception;
use Illuminate\Http\Request;

class PaymentPlansController extends BaseController
{
    public function createPaymentPlan(Request $request)
    {
        try {

            $vaild = validator($request->all(), [
                'advance' => 'required',
                'monthly' => 'required',
                'annual' => 'required'
            ]);
            if ($vaild->fails()) {
                return $this->sendResponse($vaild->errors()->all(), 400);
            }
            $data = PaymentPlan::create($request->all());
            return $this->sendResponse($data);

        } catch (Exception $e) {
            Log::error('Error fetching payment plans: ' . $e->getMessage());
            return $this->sendResponse($e->getMessage(), 500);
        }
    }
    public function allPaymentPlan()
    {
        try {

            $plan = PaymentPlan::select('advance', 'monthly', 'annual')
                ->get();

            return $this->sendResponse($plan, 200);

        } catch (Exception $e) {
            // Log the error for further analysis
            Log::error('Error fetching payment plans: ' . $e->getMessage());
            return $this->sendResponse($e->getMessage(), 500);
        }
    }
    public function modifyPaymentPlan(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'advance' => 'required',
                'monthly' => 'required',
                'annual' => 'required'
            ]);
            $plan = PaymentPlan::findOrFail($id);
            $plan->update($validatedData);

            return $this->sendResponse($plan, 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sendResponse('Payment plan not found.', 404);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails
            return $this->sendResponse('Validation error.', 400);

        } catch (Exception $e) {
            Log::error('Error updating payment plan: ' . $e->getMessage());
            return $this->sendResponse('Unable to update payment plan' . $e->getMessage(), 500);       }
    }
    public function deletePaymentPlan(Request $request ,$id)
    {
        $plan = PaymentPlan::find($id);
        $plan->delete();
        return $this->sendResponse($plan);
    }
}
