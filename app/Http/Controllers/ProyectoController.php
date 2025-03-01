<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $proyectos = Proyecto::all();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('proyectos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'horas_previstas' => 'required|integer|min:1',
            'fecha_comienzo' => 'required|date',
        ]);

        Proyecto::create($request->all());

        session()->flash('mensaje', 'Proyecto creado');

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente');
    }

    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'horas_previstas' => 'required|integer|min:1',
            'fecha_comienzo' => 'required|date',
        ]);

        $proyecto->update($request->all());

        session()->flash('mensaje', 'Proyecto actualizado');

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente');
    }

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        session()->flash('mensaje', 'Proyecto eliminado');

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado correctamente');
        
    }
}
