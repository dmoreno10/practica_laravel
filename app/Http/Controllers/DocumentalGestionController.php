<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentalGestionDataTable;
use App\Models\DocumentalGestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentalGestionController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(DocumentalGestionDataTable $dataTable)
    {
        return $dataTable->render('documents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Verificar si el usuario está autenticado

            // Verificar si el usuario está autenticado
            if (Auth::check()) {
                $userId = Auth::id(); // Obtener el ID del usuario autenticado
            } else {
                // Si no está autenticado, redirigir a la página de inicio de sesión
                return redirect()->route('login')->with('error', 'Debes iniciar sesión');
            }

            // Validar los datos de entrada
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'document' => 'required|file|mimes:jpg,jpeg,png,pdf,docx',
            ]);

            // Guardar el archivo en el sistema
            $file = $request->file('document');
            $filePath = $file->store('documents');  // Esto guardará el archivo en la carpeta 'documents'

            // Crear el registro en la base de datos
            $document = new DocumentalGestion();
            $document->title = $validated['title'];
            $document->description = $validated['description'];
            $document->file_name = $file->getClientOriginalName();
            $document->file_path = $filePath;
            $document->file_size = $file->getSize();
            $document->mime_type = $file->getMimeType();
            $document->user_id = $userId;  // Asignar el ID del usuario autenticado
            $document->save();

            return redirect()->route('documents.index')->with('success', 'Documento guardado exitosamente');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}