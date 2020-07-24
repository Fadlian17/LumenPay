<?php

namespace App\Http\Controllers;

use App\Order;
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
        $orders = Order::with(array('customer' => function ($query) {
            $query->select();
        }))->get();
        if (!$orders) {
            return response()->json([
                'message' => 'Data Not Found'
            ]);
        }

        return response()->json(['message' => 'Success View', 'attributes' => $orders])
            ->header('author', 'fadlian');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'status' => 'required',
        ]);

        $orders = new Order();
        $orders->user_id = $request->input('user_id');
        $orders->status = $request->input('status');
        $orders->save();

        return response()->json(['message' => 'Success Add orders', 'attributes' => $orders])
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
            'user_id' => 'required',
            'status' => 'required',
        ]);

        $orders = Order::find($id);
        if ($orders) {
            $orders->user_id = $request->input('user_id');
            $orders->status = $request->input('status');
            $orders->save();

            return response()->json(['message' => 'Success Update orders', 'attributes' => $orders]);
        }
    }

    public function destroy($id)
    {
        $orders = Order::find($id);
        if ($orders) {
            $orders->delete();

            return response()->json([
                'message' => 'Success Deleted',
                'orders' => [
                    'attributes' => $orders
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'not found to deleted'
            ]);
        }
    }
}
