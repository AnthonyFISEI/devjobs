<?php

namespace App\Http\Controllers;

use App\Candidato;
use App\Vacante;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //validadcion
        $data = $request->validate([
            'nombre'=>'required',
            'email'=>'required|email',
            'cv'=> 'required|mimes:pdf|max:1000',
            'vacante_id' => 'required'
        ]);

        //Una forma

        // $candidato = new Candidato();
        // $candidato->nombre=$data['nombre'];
        // $candidato->email= $data['email'];
        // $candidato->vacante_id= $data['vacante_id'];
        // $candidato->cv="123.pdf";

        // $candidato->save();

        // Otra forma cuando hay muchos pararmetros sirve pero debo definir en el modelo que campos voy a pasar

        // $candidato = new Candidato($data);
        // $candidato->cv="213.pdf";

        // Tercera Forma pero debo definir en el modelo que campos voy a pasar

        // $candidato = new Candidato();
        // $candidato->fill($data);
        // $candidato->cv="213.pdf";
        // $candidato->save();

        // Cuarto metodo creando relaciones en el modelo de Vacante


        //Almacernar archivo pdf

        if($request->file('cv')){
            $archivo=$request->file('cv');
            $nombreArchivo = time() . "." . $request->file('cv')->extension();
            $ubicacion = public_path('/storage/cv');
            $archivo->move($ubicacion, $nombreArchivo);
            // return $nombreArchivo;
        }
        // Primero obtenemos el id de la vacante

        $vacante = Vacante::find($data['vacante_id']);
        // dd($vacante);
        $vacante->candidatos()->create([
            'nombre'=>$data['nombre'],
            'email'=>$data['email'],
            'cv'=> $nombreArchivo
        ]);

        return back()->with('estado','Tus datos se enviaron Correctamente! Suerte!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }
}
