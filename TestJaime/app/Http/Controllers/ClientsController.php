<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

class ClientsController extends Controller
{


    public function index(){

        $clients = Clients::get();

        return response()->json($clients,200);

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

        $client = new Clients;
        $client->name = $request->name;
        $client->nit = $request->nit;
        $client->save();

        return response()->json(['client'=>$client]);


    }

    public function edit($id){

        $client = Clients::where('id',$id)->first();

        return response()->json($client);

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

        $client = Clients::where('id',$id)->first();
        $client->name = $request->name;
        $client->nit = $request->nit;
        $client->save();


        return response()->json([ 'client'=>$client ]);


    }

    public function delete($id){

        Clients::where('id',$id)->delete();

        return response()->json([
            'mensaje'=>'¡Usuario eliminado correctamente!'
        ]);

    }
}
