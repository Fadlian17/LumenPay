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
        $customers = Customer::with(array('order' => function ($query) {
            $query->select();
        }))->get();
        if (!$customers) {
            return response()->json([
                'message' => 'Data Not Found'
            ]);
        }

        return response()->json(['message' => 'Success View', 'attributes' => $customers])
            ->header('author', 'fadlian');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_number' => 'required'
        ]);

        $customers = new Customer();
        $customers->full_name = $request->input('full_name');
        $customers->username = $request->input('username');
        $customers->email = $request->input('email');
        $customers->phone_number = $request->input('phone_number');
        $customers->save();

        return response()->json(['message' => 'Success Add Customers', 'attributes' => $customers])
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
            'full_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_number' => 'required'
        ]);

        $customers = Customer::find($id);
        if ($customers) {
            $customers->full_name = $request->input('full_name');
            $customers->username = $request->input('username');
            $customers->email = $request->input('email');
            $customers->phone_number = $request->input('phone_number');
            $customers->save();

            return response()->json(['message' => 'Success Update Customers', 'attributes' => $customers]);
        }
    }

    public function destroy($id)
    {
        $customers = Customer::find($id);
        if ($customers) {
            $customers->delete();

            return response()->json([
                'message' => 'Success Deleted',
                'customers' => [
                    'attributes' => $customers
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'not found to deleted'
            ]);
        }
    }
}
