@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css" integrity="sha512-zYqhQjtcNMt8/h4RJallhYRev/et7+k/HDyry20li5fWSJYSExP9O07Ung28MUuXDneIFg0f2/U3HJZWsTNAiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css" integrity="sha512-0ns35ZLjozd6e3fJtuze7XJCQXMWmb4kPRbb+H/hacbqu6XfIX0ZRGt6SrmNmv5btrBpbzfdISSd8BAsXJ4t1Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('navegacion')
    @include('ui.adminnav')

@endsection

@section('content')

    <h1 class="text-2xl text-center mt-10">Nueva Vacante</h1>

    <form action="" class="max-w-lg mx-auto my-10">
        <div class="mb-5">
            <label for="titulo" class="block text-gray-700 text-sm mb-2">Título Vacante:</label>
            
            <input id="titulo" type="text"
            class="p-3 bg-gray-100 rounded form-input w-full @error('email') is-invalid @enderror"
            name="titulo">

        </div>


        <div class="mb-5">
            <label for="categoria" class="block text-gray-700 text-sm mb-2">Categoría:</label>

            <select name="categoria" id="categoria"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded 
                    leading-tight focus:outline-none
                    focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                <option value="" disabled selected>- Selecciona -</option>

                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">
                    {{$categoria->nombre}}</option>
                    
                @endforeach
            </select>
        </div>


        <div class="mb-5">
            <label for="experiencia" class="block text-gray-700 text-sm mb-2">Experiencia:</label>

            <select name="experiencia" id="experiencia"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded 
                    leading-tight focus:outline-none
                    focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                <option value="" disabled selected>- Selecciona -</option>

                @foreach($experiencias as $experiencia)
                    <option value="{{$experiencia->id}}">
                    {{$experiencia->nombre}}</option>
                    
                @endforeach
            </select>
        </div>


        
        <div class="mb-5">
            <label for="ubicacion" class="block text-gray-700 text-sm mb-2">Ubicacion:</label>

            <select name="ubicacion" id="ubicacion"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded 
                    leading-tight focus:outline-none
                    focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                <option value="" disabled selected>- Selecciona -</option>

                @foreach($ubicaciones as $ubicacion)
                    <option value="{{$ubicacion->id}}">
                    {{$ubicacion->nombre}}</option>
                    
                @endforeach
            </select>
        </div>


        <div class="mb-5">
            <label for="salario" class="block text-gray-700 text-sm mb-2">Salario:</label>

            <select name="salario" id="salario"
            class="block appearance-none w-full border border-gray-200 text-gray-700 rounded 
                    leading-tight focus:outline-none
                    focus:bg-white focus:border-gray-500 p-3 bg-gray-100">
                <option value="" disabled selected>- Selecciona -</option>

                @foreach($salarios as $salario)
                    <option value="{{$salario->id}}">
                    {{$salario->nombre}}</option>
                    
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label for="descripcion" class="block text-gray-700 text-sm mb-2">Descripción del Puesto:</label>

            <div class="editable p-3 bg-gray-100 rounded form-input w-full text-gray-700"></div>
            <input type="hidden" name="descripcion" id="descripcion">
        </div>

        <div class="mb-5">
            <label for="descripcion" class="block text-gray-700 text-sm mb-2">Imagen Vacante:</label>

            <div class="dropzone rounded bg-gray-100" id="dropzoneDevJobs"></div>

            <div id="error"></div>
        </div>

        <button type="submit"
        class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline focus:shadow-outline uppercase"
        >Publicar Vacante</button>
    </form>
    
@endsection


@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js" integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js" integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        Dropzone.autoDiscover=false;
        document.addEventListener('DOMContentLoaded', ()=>{
            // Medium Editor
            const editor = new MediumEditor('.editable',{
                toolbar:{
                    buttons:['bold','italic','underline','quote','anchor','justifyLeft','justifyCenter','justifyRight','justifyFull','orderedList','unorderedList','h2','h3'],
                    static: true,
                    sticky:true
                },
                placeholder:{
                    text: 'Información de la vacante'
                }
            });

            editor.subscribe('editableInput', function(eventObj, editable){
                const contenido = editor.getContent();
                document.querySelector('#descripcion').value = contenido;
            })


            // Editor Dropzone

            const dropzoneDevJobs = new Dropzone('#dropzoneDevJobs',{
                url:"/vacantes/imagen",
                dictDefaultMessage: 'Sube aquí tu archivo',
                acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp",
                addRemoveLinks: true,
                dictRemoveFile: 'Borrar archivo',
                maxFiles:1,
                headers:{
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                success: function(file,response){
                    // console.log(response);
                    // console.log(file)
                    document.querySelector('#error').textContent = '';
                },
                error: function(file,response){
                    // console.log(response);
                    // console.log(file);
                    document.querySelector('#error').textContent = 'Formato no válido';
                },
                maxfilesexceeded: function(file){
                    //  console.log(this.files);

                     if(this.files[1] != null){
                         this.removeFile(this.files[0]); //Eliminar el archivo anterior
                         this.addFile(file) //Agrega el nuevo archivo
                     }

                },
                removedfile: function(file,response){    
                    console.log('El archivo borrado fue',file);
                }
            });
        });
    </script>
@endsection