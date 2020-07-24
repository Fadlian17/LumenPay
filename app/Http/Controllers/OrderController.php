<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
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
        $orders = Order::all();
        if (!$orders) {
            return response()->json([
                'message' => 'Data Not Found'
            ]);
        }

        return response()->json([
            "message" => "Success Retrived Data",
            "status" => true,
            "data" => [
                "attributes" => $orders
            ]
        ])
            ->header('author', 'fadlian');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'data.attributes.user_id' => 'required'
        ]);

        $orders = new Order();
        $orders->user_id = $request->input('data.attributes.user_id');
        $orders->status = "created";
        $orders->save();

        return response()->json([
            "message" => "Success Add Data",
            "status" => true,
            "data" => [
                "attributes" => $orders
            ]
        ])
            ->header('author', 'fadlian');
    }

    // public function show($id)
    // {
    //     $orders = [
    //         [
    //             'id' => $id,
    //             'full_name' => 'Raditya Dika',
    //             'username' => 'Radit123',
    //             'email' => 1,
    //             'email' => 'radit@mail.com',
    //             'profile' => 'penulis buku'
    //         ]
    //     ];
    //     return response()->json(['message' => 'Success View', 'author' => $orders]);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data.attributes.user_id' => 'required',
        ]);

        $orders = Order::find($id);
        if ($orders) {
            $orders->user_id = $request->input('data.attributes.user_id');
            $orders->status = 'created';
            $orders->save();

            return response()->json([
                "message" => "Success Update Data",
                "status" => true,
                "data" => [
                    "attributes" => $orders
                ]
            ]);
        }
    }

    public function destroy($id)
    {
        $orders = Order::find($id);
        if ($orders) {
            $orders->delete();

            return response()->json([
                "message" => "Success Delete Data",
                "status" => true,
                "data" => [
                    "attributes" => $orders
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'not found to deleted'
            ]);
        }
    }
}
