<?php namespace App\Http\Controllers\Billing;

use App\Service\Ipayment;

use App\Http\Controllers\Controller;

class IpaymentController extends Controller
{
    public function show($jastel)
    {
        try {
            $result = Ipayment::request($jastel);
            return view('ipayment.view-bot', ['data' => $result]);
        } catch (\InvalidArgumentException $e) {
            // TODO: error page
        } catch (\RuntimeException $e) {
            // TODO: error page
        }
    }
}
