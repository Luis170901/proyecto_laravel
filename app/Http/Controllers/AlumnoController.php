<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlumnoRequest;
use App\Http\Requests\UpdateAlumnoRequest;
use App\Models\Alumno;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campos = Schema::getColumnListing("alumnos");
        $exclude = ["created_at", "updated_at"];
        $campos = array_diff($campos, $exclude);
        $filas = Alumno::select($campos)->get();

        return view('alumnos.index', compact('filas', "campos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlumnoRequest $request)
    {
        $datos = request()->input();
        $alumno = new Alumno($datos);
        $alumno->save();

        // No se puede usar destroy() en una relación HasMany
        // $alumno->idiomas()->destroy();

        // Solución: Usar delete() para eliminar registros relacionados
        $alumno->idiomas()->delete();

        // Si hay idiomas en la petición, los añadimos nuevamente
        if (request()->has("idiomas")) {
            $idiomas = collect(request()->input('idiomas'));
            $idiomas->each(fn($idioma) => $alumno->idiomas()->create([
                "idioma" => $idioma,
                "nivel" => request()->input("nivel")[$idioma],
                "titulo" => request()->input("titulo")[$idioma],
            ]));
        }

        session()->flash('mensaje', 'Alumno creado');
        return redirect()->route('alumnos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        return view('alumnos.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumno $alumno)
    {
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlumnoRequest $request, Alumno $alumno)
    {
        $datos = $request->only("nombre", "email", "edad");
        $alumno->update($datos);

        // ❌ ERROR: Se estaba intentando llamar destroy() sobre cada idioma, lo cual no existe
        // collect($idiomas)->each(fn($idiomas) => $idioma->destroy());

        // ✅ SOLUCIÓN: Usar delete() para eliminar idiomas antes de añadir los nuevos
        $alumno->idiomas()->delete();

        // Si hay idiomas, los añadimos nuevamente
        if ($request->has("idiomas")) {
            $idiomas = $request->input("idiomas");
            $niveles = $request->input("niveles");
            $titulos = $request->input("titulos");

            collect($idiomas)->each(fn($idioma) =>
                $alumno->idiomas()->create([
                    "idioma" => $idioma,
                    "nivel" => $niveles[$idioma] ?? null,
                    "titulo" => $titulos[$idioma] ?? null
                ])
            );
        }

        session()->flash("mensaje", "Alumno actualizado");
        return redirect()->route('alumnos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        session()->flash('mensaje', 'Alumno eliminado');
        return redirect()->route('alumnos.index');
    }
}
