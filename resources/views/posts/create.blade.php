


@extends('layouts.app')
@section('titulo')
    Crea Una nueva Publicacion 
@endsection

@push('js_dropzone')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush


@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 px-10">
            <form action="{{route('imagenes.store')}}" method="POST"  enctype="multipart/form-data" id="mydropzone" class="dropzone border-dashed border-2 w-full h-96 
            rounded flex flex-col justify-center items-center">
            @csrf
            </form>
        </div>
        @push('configuracion_dropzone')
            <script>
                Dropzone.options.mydropzone = {
                    paramName: "file",
                    dictDefaultMessage: "Sube aqui tu imagen",
                    acceptedFiles: ".png,.jpg,.jpeg,.gif",
                    addRemoveLinks: true,
                    dictRemoveFile: "Borrar archivo",
                    maxFiles: 1,
                    uploadMultiple: false,
                    success: function(file, response){
                        console.log(response.imagen);
                        document.querySelector('[name="imagen"]').value  = response.imagen;
                    },
                    removedfile: function(){
                        document.querySelector('[name="imagen"]').value = "";
                    },
                    init:function(){
                        if(document.querySelector('[name="imagen"]').value.trim()){
                            const imagenPublicada= {};
                            imagenPublicada.size = 1234;
                            imagenPublicada.name = document.querySelector('[name="imagen"]').value;
                            this.options.addedfile.call(this, imagenPublicada);
                            this.options.thumbnail.call(this,imagenPublicada,`/laravel_devstagram/devstagram/public/public/uploads/${imagenPublicada.name}`);
                            imagenPublicada.previewElement.classList.add("dz-success","dz-complete");
                        }
                    },
                };
                

            </script>
        @endpush
        
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{route('posts.store')}}" method="POST" novalidate>
                @csrf  
                <div class="mb-5">
                    <label id="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Titulo de la Publicación" class="border p-3 w-full rounded-lg @error('name') border-red-500
                        
                    @enderror"
                    value="{{old('titulo')}}"
                    />

                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label id="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripción</label>
                    <textarea  id="descripcion" name="descripcion" placeholder="Descripcion de la Publicación" class="border p-3 w-full rounded-lg @error('name') border-red-500
                        
                    @enderror"
                    
                    >{{old('descripcion')}}</textarea>

                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input 
                        name="imagen"
                        type="hidden"
                        value="{{old('imagen')}}"
                    />
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                <input type="submit" value="Crear publicación" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg3"/>
            </form>

        </div>
    </div>


@endsection