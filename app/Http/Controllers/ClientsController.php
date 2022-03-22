<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Session;

class ClientsController extends Controller
{
    # index 
    public function Index()
    {
        $data = Client::latest()->get();
       return view('clients.clients',compact('data'));
    }

    # store
    public function Store(Request $request)
    {
        $this->validate($request,[
            'name'       => 'required|max:190',
            'email'      => 'required|max:190|unique:clients',
            'phone'      => 'required|max:190|unique:clients',
            'lat'        => 'required|max:190',
            'lng'        => 'required|max:190',
            'address'    => 'required|max:190',
        ]);

        $data = new Client;
        $data->name    = $request->name;
        $data->email   = $request->email;
        $data->phone   = $request->phone;
        $data->lat     = $request->lat;
        $data->lng     = $request->lng;
        $data->address = $request->address;

        $data->save();
        Session::flash('success','تم الحفظ');
        MakeReport('بإضافة عميل جديد'.$data->name);
        return back();
    }

    # update
    public function Update(Request $request)
    {
        $this->validate($request,[
            'edit_id'         => 'required',
            'edit_name'       => 'required|max:190',
            'edit_email'      => 'required|max:190|unique:clients,email,'.$request->edit_id,
            'edit_phone'      => 'required|max:190|unique:clients,phone,'.$request->edit_id,
            'edit_lat'        => 'required|max:190',
            'edit_lng'        => 'required|max:190',
            'edit_address'    => 'required|max:190',
        ]);

        $data = Client::where('id',$request->edit_id)->first();
        $data->name    = $request->edit_name;
        $data->email   = $request->edit_email;
        $data->phone   = $request->edit_phone;
        $data->lat     = $request->edit_lat;
        $data->lng     = $request->edit_lng;
        $data->address = $request->edit_address;

        $data->save();
        Session::flash('success','تم الحفظ');
        MakeReport('بتحديث عميل '.$data->name);
        return back();
    }

    # delete
    public function Delete($id)
    {
        $data = Client::where('id',$id)->first();
        MakeReport('بحذف عميل '.$data->name);
        $data->delete();
        Session::flash('success','تم الحذف');
        return back();
    }
}
