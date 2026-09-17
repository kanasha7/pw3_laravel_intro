<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $query = Evento::query();

        if ($busca) {
            $query->where('titulo', 'like', '%' . $busca . '%');
        }

        $eventos = $query
            ->orderBy('titulo')
            ->get();

        return view('eventos.index', compact('eventos', 'busca'));
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'titulo' => 'required|string|min:3',
            'local' => 'required|string|min:2',
            'vagas' => 'required|integer|min:1',
            'preco_inscricao' => 'required|numeric|min:0',
        ]);

        Evento::create($dadosValidados);

        return redirect('/eventos')
            ->with('sucesso', 'Evento cadastrado com sucesso!');
    }
}