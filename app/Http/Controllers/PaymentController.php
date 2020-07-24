<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
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
        $payments = Payment::with(array('order' => function ($query) {
            $query->select();
        }))->get();
        if (!$payments) {
            return response()->json([
                'message' => 'Data Not Found'
            ]);
        }

        return response()->json([
            "message" => "Success Retrived Data",
            "status" => true,
            "data" => [
                "attributes" => $payments
            ]
        ])
            ->header('author', 'fadlian');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'data.attributes.order_id' => 'required',
            'data.attributes.transaction_id' => 'required',
            'data.attributes.payment_type' => 'required',
            'data.attributes.gross_amount' => 'required',
            'data.attributes.transaction_time' => 'required',
            'data.attributes.transaction_status' => 'required'
        ]);

        $payments = new Payment();
        $payments->order_id = $request->input('data.attributes.order_id');
        $payments->transaction_id = $request->input('data.attributes.transaction_id');
        $payments->payment_type = $request->input('data.attributes.payment_type');
        $payments->gross_amount = $request->input('data.attributes.gross_amount');
        $payments->transaction_time = $request->input('data.attributes.transaction_time');
        $payments->transaction_status = $request->input('data.attributes.transaction_status');
        $payments->save();

        return response()->json(['message' => 'Success Add payme$payments', 'attributes' => $payments])
            ->header('author', 'fadlian');
    }

    // public function show($id)
    // {
    //     $payments = [
    //         [
    //             'id' => $id,
    //             'order_id' => 'Raditya Dika',
    //             'payment_type' => 'Radit123',
    //             'gross_amount' => 1,
    //             'gross_amount' => 'radit@mail.com',
    //             'profile' => 'penulis buku'
    //         ]
    //     ];
    //     return response()->json(['message' => 'Success View', 'author' => $payments]);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data.attributes.order_id' => 'required',
            'data.attributes.transaction_id' => 'required',
            'data.attributes.payment_type' => 'required',
            'data.attributes.gross_amount' => 'required',
            'data.attributes.transaction_time' => 'required',
            'data.attributes.transaction_status' => 'required'
        ]);

        $payments = Payment::find($id);
        if ($payments) {
            $payments->order_id = $request->input('data.attributes.order_id');
            $payments->transaction_id = $request->input('data.attributes.transaction_id');
            $payments->payment_type = $request->input('data.attributes.payment_type');
            $payments->gross_amount = $request->input('data.attributes.gross_amount');
            $payments->transaction_time = $request->input('data.attributes.transaction_time');
            $payments->transaction_status = $request->input('data.attributes.transaction_status');
            $payments->save();

            return response()->json(['message' => 'Success Update payme$payments', 'attributes' => $payments]);
        }
    }

    public function destroy($id)
    {
        $payments = Payment::find($id);
        if ($payments) {
            $payments->delete();

            return response()->json([
                'message' => 'Success Deleted',
                'payme$payments' => [
                    'attributes' => $payments
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'not found to deleted'
            ]);
        }
    }
}
