<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{


    public function index(){

        $products = Products::get();

        return response()->json($products,200);

    }

    public function store(Request $request){



        $request->validate([
            'name' => 'required',
            'unit_value' => 'required'

        ],[
            'name.required' => 'El nombre del producto es requerido',
            'unit_value.required' => 'El valor del producto es requerido'
        ]

    );

        $product = new Products;
        $product->name = $request->name;
        $product->unit_value = $request->unit_value;
        $product->save();

        return response()->json(['product'=>$product]);


    }

    public function edit($id){

        $product = Products::where('id',$id)->first();

        return response()->json($product);

    }

    public function update(Request $request, $id){


        $request->validate([
            'name' => 'required',
            'unit_value' => 'required'

        ],[
            'name.required' => 'El nombre del producto es requerido',
            'unit_value.required' => 'El valor unitario es requerido'
        ]

    );

        $product = Products::where('id',$id)->first();
        $product->name = $request->name;
        $product->unit_value = $request->unit_value;
        $product->save();


        return response()->json([ 'product'=>$product ]);


    }

    public function delete($id){

        Products::where('id',$id)->delete();

        return response()->json([
            'mensaje'=>'Producto eliminado correctamente!'
        ]);

    }
}
