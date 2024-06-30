<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propietarios = Propietario::all();
        return view('propietarios.index', compact('propietarios'));
    }

    public function pdf(){
        $propietarios=Propietario::all();
        $pdf = Pdf::loadView('propietarios.pdf', compact('propietarios'));
        return $pdf->stream();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('propietarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'Nombre_Propietario' => 'required|string|max:255',
            'Tel_Cel_Propietario' => 'required|string|max:255',
        ]);

        Propietario::create([
            'ID_Propietario' => $request->input('ID_Propietario', uniqid()), // Proporciona un valor único
            'Nombre_Propietario' => $request->input('Nombre_Propietario'),
            'Tel_Cel_Propietario' => $request->input('Tel_Cel_Propietario'),
            'Foto_Propietario' => $request->input('Foto_Propietario', 'default.jpg'), // Valor predeterminado si no se proporciona
        ]);

        return redirect()->route('propietarios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $propietario = Propietario::findOrFail($id);
        return view('propietarios.edit', compact('propietario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nombre_Propietario' => 'required|string|max:255',
            'Tel_Cel_Propietario' => 'required|string|max:255',
        ]);

        $propietario = Propietario::findOrFail($id);

        // Actualizar los datos del estudiante
        $propietario->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('propietarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
