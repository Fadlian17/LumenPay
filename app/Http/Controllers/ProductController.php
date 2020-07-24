<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
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
        $products = Product::with(array('orderitem' => function ($query) {
            $query->select();
        }))->get();
        if (!$products) {
            return response()->json([
                'message' => 'Data Not Found'
            ]);
        }

        return response()->json([
            "message" => "Success Retrived Data",
            "status" => true,
            "data" => [
                "attributes" => $products
            ]
        ])
            ->header('author', 'fadlian');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'data.attributes.name' => 'required',
            'data.attributes.price' => 'required',
        ]);

        $products = new Product();
        $products->name = $request->input('data.attributes.name');
        $products->price = $request->input('data.attributes.price');
        $products->save();

        return response()->json([
            "message" => "Success Add Data",
            "status" => true,
            "data" => [
                "attributes" => $products
            ]
        ])
            ->header('author', 'fadlian');
    }

    // public function show($id)
    // {
    //     $products = [
    //         [
    //             'id' => $id,
    //             'full_name' => 'Raditya Dika',
    //             'username' => 'Radit123',
    //             'email' => 1,
    //             'email' => 'radit@mail.com',
    //             'profile' => 'penulis buku'
    //         ]
    //     ];
    //     return response()->json(['message' => 'Success View', 'author' => $products]);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'data.attributes.name' => 'required',
            'data.attributes.price' => 'required',
        ]);

        $products = Product::find($id);
        if ($products) {
            $products->name = $request->input('data.attributes.name');
            $products->price = $request->input('data.attributes.price');
            $products->save();

            return response()->json([
                "message" => "Success Update Data",
                "status" => true,
                "data" => [
                    "attributes" => $products
                ]
            ]);
        }
    }

    public function destroy($id)
    {
        $products = Product::find($id);
        if ($products) {
            $products->delete();

            return response()->json([
                "message" => "Success Add Data",
                "status" => true,
                "data" => [
                    "attributes" => $products
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'not found to deleted'
            ]);
        }
    }
}
