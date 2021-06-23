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

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos', 'ProdutoControlador@index');


Route::get('/negado', function() {
    
    return "Acesso Negado!";

})->name('negado');



Route::post('/login', function(Request $req) {

    $login_ok = false;
    $admin = false;

        switch($req->input('user')){
        case 'joao':
            $login_ok = $req->input('password') === "senhajoao";
            $admin = true;
            break;
        case 'marcos':
            $login_ok = $req->input('password') === "senhamarcos";
            break;
        case 'default':
            $login_ok = false;
    }

    if($login_ok){
        $login = ['user' => $req->input('user'), 'admin' => $admin];
        $req->session()->put('login', $login);
        return response ("Login Ok", 200);
    }else{
        $req->session()->flush();
        return response ("Erro no login", 404);
    }

});


Route::get('/logout', function(Request $request) {

    $request->session()->flush();
    return response('deslogado com suceesso!', 200);
});
