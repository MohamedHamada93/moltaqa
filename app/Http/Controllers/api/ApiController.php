<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientLoginCollection;
use App\Http\Resources\ValidationMessage;
use Illuminate\Http\Request;
use App\Client;
use App\Driver;
use Auth;
use DB;
use Validator;
use RateLimiter;

class ApiController extends Controller
{
    # login
    public function Login(request $request)
    {
		$validator = Validator::make($request->all(), [
			'phone'     => 'required',
			'password'  => 'required',
		]);

		foreach ((array) $validator->errors() as $value)
		{
			if(isset($value['phone']))
			{
				$msg = 'phone is required';
				return response()->json([
					'message'  => null,
					'error'  => $msg,
				],400);
			}elseif(isset($value['password']))
			{
				$msg = 'password is required';
				return response()->json([
					'message'  => null,
					'error'  => $msg,
				],400);
			}
		}

        if(!Auth::guard('client')->attempt(['phone' => $request->phone, 'password' => $request->password]))
        {
            $msg = 'There is an error in the mobile number or password';
            return response()->json([
                'message'  => null,
                'error'  => $msg,
            ],401);
        }

        $drivers = Driver::select(DB::raw('*, 
        ( 6367 * acos( cos( radians('.Auth::guard('client')->user()->lat.') ) 
        * cos( radians( lat ) ) * cos( radians( lng ) - radians('.Auth::guard('client')->user()->lng.') ) + sin( radians('.Auth::guard('client')->user()->lat.') ) 
        * sin( radians( lat ) ) ) ) AS distance'))->orderBy('distance');
        $drivers = $drivers->get();
        return new ClientLoginCollection($drivers);
    }
}
