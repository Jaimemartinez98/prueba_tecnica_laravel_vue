<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendors;

class VendorsController extends Controller
{
    public function index(){

        $vendors = Vendors::get();

        return response()->json($vendors,200);

    }

    public function store(Request $request){



        $request->validate([
            'name' => 'required',
            'nit' => 'required'

        ],[
            'name.required' => 'El nombre del cliente es requerido',
            'nit.required' => 'El nit es requerido'
        ]

    );

        $vendor = new Vendors;
        $vendor->name = $request->name;
        $vendor->nit = $request->nit;
        $vendor->save();

        return response()->json(['vendor'=>$vendor]);


    }

    public function edit($id){

        $vendor = Vendors::where('id',$id)->first();

        return response()->json($vendor);

    }

    public function update(Request $request, $id){


        $request->validate([
            'name' => 'required',
            'nit' => 'required'

        ],[
            'name.required' => 'El nombre del cliente es requerido',
            'nit.required' => 'El nit es requerido'
        ]

    );

        $vendor = Vendors::where('id',$id)->first();
        $vendor->name = $request->name;
        $vendor->nit = $request->nit;
        $vendor->save();


        return response()->json([ 'vendor'=>$vendor ]);


    }

    public function delete($id){

        Vendors::where('id',$id)->delete();

        return response()->json([
            'mensaje'=>'¡Usuario eliminado correctamente!'
        ]);

    }
}
