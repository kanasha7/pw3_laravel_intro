<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Exibe o formuçário de cadastro de usuario
     */
    public function create(){
        return view('users.create');
    }

    /**
     * Salvar o novo usuario no banco de dados com validação
     */
    public function store(Request $request){
        //Validação dos campos do formulário
        $dadosValidos = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);


        //Persistencia no banco de dados usando orm eloquente
        User::create($dadosValidos);


        //Redirecionar para o painel administrativo com mensagem de sucesso
        return redirect('/admin')->with('sucesso','Usuario cadastrado com sucesso');

    }
}
