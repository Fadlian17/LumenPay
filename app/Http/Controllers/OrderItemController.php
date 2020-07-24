<?php

namespace App\Http\Controllers;

use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderItemController extends Controller
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
        $order_items = OrderItem::with(array('product' => function ($query) {
            $query->select();
        }))->get();
        if (!$order_items) {
            return response()->json([
                'message' => 'Data Not Found'
            ]);
        }

        return response()->json([
            "message" => "Success Retrived Data",
            "status" => true,
            "data" => [
                "attributes" => $order_items
            ]
        ])
            ->header('author', 'fadlian');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'data.attributes.order_id' => 'required',
            'data.attributes.product_id' => 'required',
            'data.attributes.quantity' => 'required'
        ]);

        $order_items = new OrderItem();
        $order_items->order_id = $request->input('data.attributes.order_id');
        $order_items->product_id = $request->input('data.attributes.product_id');
        $order_items->quantity = $request->input('data.attributes.quantity');
        $order_items->save();

        return response()->json([
            "message" => "Success Add Data Order Item",
            "status" => true,
            "data" => [
                "attributes" => $order_items
            ]
        ])
            ->header('author', 'fadlian');
    }

    // public function show($id)
    // {
    //     $order_items = [
    //         [
    //             'id' => $id,
    //             'full_order_id' => 'Raditya Dika',
    //             'userorder_id' => 'Radit123',
    //             'email' => 1,
    //             'email' => 'radit@mail.com',
    //             'profile' => 'penulis buku'
    //         ]
    //     ];
    //     return response()->json(['message' => 'Success View', 'author' => $order_items]);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data.attributes.order_id' => 'required',
            'data.attributes.product_id' => 'required',
            'data.attributes.quantity' => 'required'
        ]);

        $order_items = OrderItem::find($id);
        if ($order_items) {
            $order_items->order_id = $request->input('data.attributes.order_id');
            $order_items->product_id = $request->input('data.attributes.product_id');
            $order_items->quantity = $request->input('data.attributes.quantity');
            $order_items->save();

            return response()->json([
                "message" => "Success Update Data Order Item",
                "status" => true,
                "data" => [
                    "attributes" => $order_items
                ]
            ]);
        }
    }

    public function destroy($id)
    {
        $order_items = OrderItem::find($id);
        if ($order_items) {
            $order_items->delete();

            return response()->json([
                "message" => "Success Delete Data Order Item",
                "status" => true,
                "data" => [
                    "attributes" => $order_items
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'not found to deleted'
            ]);
        }
    }
}
