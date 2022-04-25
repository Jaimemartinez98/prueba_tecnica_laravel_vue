<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillProducts;
use Illuminate\Support\Facades\DB;

class BillProductsController extends Controller
{

    public function getBuysByID($id){

         $buy_products_bill = DB::table('bill_products as bp')
        ->select('bp.id','bp.quantity','bp.total_sub_bill','p.name')
        ->join('products AS p', 'bp.product_id', '=', 'p.id')
        ->where('bp.bill_id', '=', $id)
        ->get();
        $total_buy = 0;
        foreach($buy_products_bill as $value){
            $total_buy+= $value->total_sub_bill;
        }
        return response()->json([
            'buy_products_bill'=>$buy_products_bill,
            'total_buy'=>$total_buy
        ]);


    }

    public function store(Request $request){



        $request->validate([
            'bill_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'total_sub_bill' => 'required'

        ],[
            'bill_id.required' => 'El nombre del cliente es requerido',
            'product_id.required' => 'El product_id es requerido',
            'quantity.required' => 'El quantity es requerido',
            'total_sub_bill.required' => 'El total_sub_bill es requerido',
        ]

    );

        $bill_product = new BillProducts;
        $bill_product->bill_id = $request->bill_id;
        $bill_product->product_id = $request->product_id;
        $bill_product->quantity = $request->quantity;
        $bill_product->total_sub_bill = $request->total_sub_bill;
        $bill_product->save();

        return response()->json(['bill_product'=>$bill_product]);


    }




    public function delete($id){

        BillProducts::where('id',$id)->delete();

        return response()->json([
            'mensaje'=>'¡Compra eliminada correctamente!'
        ]);

    }
}
