<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Address;
use App\Client;
use Illuminate\Database\Eloquent\Model;

Route::get('clients', 'ClientController@indexView')->name('clients.home');
Route::get('addresses', 'AddressController@indexView')->name('addresses.home');
Route::get(
    'testes',
    function () {
        $client = Client::create
        (
            [
                'name' => 'Kaic',
                'phone' => 'Teste'
            ]
        );

        $address = new Address();
        $address->street = 'Rua';
        $address->number = 11;
        $address->district = 'distrito';
        $address->city = 'cidade';
        $address->uf = 'uf';
        $address->cep = 'cep';
        $client->address()->save($address);

        $clients = Client::all();
        foreach ($clients as $c) {
            echo $c->address->street . PHP_EOL;

        }
    }
);
