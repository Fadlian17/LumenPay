<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $customers = Customer::all();
        if (!$customers) {
            return response()->json([
                'message' => 'Data Not Found'
            ]);
        }

        return response()->json([
            "message" => "Success retrieve data",
            "status" => true,
            "data" => $customers
        ])
            ->header('author', 'fadlian');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'data.attributes.full_name' => 'required',
            'data.attributes.username' => 'required',
            'data.attributes.email' => 'required',
            'data.attributes.phone_number' => 'required'
        ]);

        $customers = new Customer();
        $customers->full_name = $request->input('data.attributes.full_name');
        $customers->username = $request->input('data.attributes.username');
        $customers->email = $request->input('data.attributes.email');
        $customers->phone_number = $request->input('data.attributes.phone_number');
        $customers->save();

        return response()->json([
            "message" => "Success Add Customer",
            "status" => true,
            "data" => $customers
        ])
            ->header('author', 'fadlian');
    }

    // public function show($id)
    // {
    //     $customers = [
    //         [
    //             'id' => $id,
    //             'full_name' => 'Raditya Dika',
    //             'username' => 'Radit123',
    //             'email' => 1,
    //             'email' => 'radit@mail.com',
    //             'profile' => 'penulis buku'
    //         ]
    //     ];
    //     return response()->json(['message' => 'Success View', 'author' => $customers]);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data.attributes.full_name' => 'required',
            'data.attributes.username' => 'required',
            'data.attributes.email' => 'required',
            'data.attributes.phone_number' => 'required'
        ]);

        $customers = Customer::find($id);
        if ($customers) {
            $customers->full_name = $request->input('data.attributes.full_name');
            $customers->username = $request->input('data.attributes.username');
            $customers->email = $request->input('data.attributes.email');
            $customers->phone_number = $request->input('data.attributes.phone_number');
            $customers->save();

            return response()->json([
                "message" => "Success Update Customer",
                "status" => true,
                "data" => $customers
            ]);
        }
    }

    public function destroy($id)
    {
        $customers = Customer::find($id);
        if ($customers) {
            $customers->delete();

            return response()->json([
                "message" => "Success Add Customer",
                "status" => true,
                "data" => $customers
            ]);
        } else {
            return response()->json([
                'message' => 'not found to deleted'
            ]);
        }
    }
}
