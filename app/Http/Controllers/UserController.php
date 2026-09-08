<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Exibe a listagem de usuarios com superte a filtro de busca
     */
    public function index(Request $request){
        // Captura o termo de busca enviado pelo GET
        $busca = $request->input('busca');
        
        // Se houver busca, filtra pro nome; caso contrario, busca todos ordenados por nome
        if ($busca){
            $usuarios = User::where('name', 'like', "%($busca)%", 'and')->orderBy('name', 'ASC')->get();
        } else{
            $usuarios = User::orderBy('name', 'ASC')->get();
        }

        //Retorna a view do painel passando a coleção de usuarios e o termo de pesquisa
        return view('admin.dashboard', compact('usuarios', 'busca'));
    }
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
