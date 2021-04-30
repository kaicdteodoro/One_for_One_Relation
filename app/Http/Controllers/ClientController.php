<?php

namespace App\Http\Controllers;

use App\Address;
use App\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        return view('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return json_encode(Client::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::create
        (
            [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
            ]
        );

        if ($client) {
            $address = new Address();
            $address->street = $request->input('street');
            $address->number = $request->input('number');
            $address->district = $request->input('district');
            $address->city = $request->input('city');
            $address->uf = $request->input('uf');
            $address->cep = $request->input('cep');
            $client->address()->save($address);
            return $client == true? json_encode($client) : response('Erro', 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teste = new Client();
        $teste->name = "teste";
        $teste->save();

        $client = Client::find($id);
        return $client == null ? response('Error', 404) : json_encode($client);
    }

    public function showAddress($id)
    {
        $teste = new Client();
        $teste->address();

        $client = Client::find($id)->address;
        return $client == null ? response('Error', 404) : json_encode($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
