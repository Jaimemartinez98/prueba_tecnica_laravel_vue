<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bills;
use Illuminate\Support\Facades\DB;

class BillsController extends Controller
{


    public function index(){

        $bills = DB::table('bills as b')
        ->select('b.id', 'c.name as client_name', 'v.name as vendor_name',
        DB::raw('(SELECT SUM(total_sub_bill) FROM bill_products WHERE bill_id = b.id) AS total_bill'))
        ->join('clients AS c', 'b.client_id', '=', 'c.id')
        ->join('vendors AS v', 'b.vendor_id', '=', 'v.id')
        ->get();

        // $bills = Bills::get();

        return response()->json($bills,200);

    }

    public function store(Request $request){



        $request->validate([
            'client_id' => 'required',
            'vendor_id' => 'required'

        ],[
            'client_id.required' => 'El nombre del cliente es requerido',
            'vendor_id.required' => 'El nombre del vendedor es requerido'
        ]

    );

        $bill = new Bills;
        $bill->client_id = $request->client_id;
        $bill->vendor_id = $request->vendor_id;
        $bill->save();

        return response()->json(['bill'=>$bill]);


    }

    public function edit($id){

        $bill = DB::table('bills as b')
        ->select('b.id', 'c.name as client_name', 'v.name as vendor_name')
        ->join('clients AS c', 'b.client_id', '=', 'c.id')
        ->join('vendors AS v', 'b.vendor_id', '=', 'v.id')
        ->where('b.id', '=', $id)
        ->first();

        // $bill = Bills::where('id',$id)->first();

        return response()->json($bill);

    }

    public function update(Request $request, $id){


        $request->validate([
            'client_id' => 'required',
            'vendor_id' => 'required'

        ],[
            'client_id.required' => 'El nombre del cliente es requerido',
            'vendor_id.required' => 'El nombre del vendedor es requerido'
        ]

    );

        $bill = Bills::where('id',$id)->first();
        $bill->client_id = $request->client_id;
        $bill->vendor_id = $request->vendor_id;
        $bill->save();


        return response()->json([ 'bill'=>$bill ]);


    }

    public function delete($id){

        Bills::where('id',$id)->delete();

        return response()->json([
            'mensaje'=>'Factura eliminada correctamente!'
        ]);

    }
}

