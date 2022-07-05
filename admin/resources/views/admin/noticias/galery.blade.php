@extends('layouts.admin')

@section('title')
 Galeria de imagenes   
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"
    integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ=="
    crossorigin="anonymous" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
<style>
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0);
        transition: background 0.5s ease;
    }

    .container {
        position: relative;
        width: 500px;
        height: 300px;
    }

    .imgGallery {
        width: 500px;
        height: 300px;
        left: 0;
        border-radius: 10px;
    }

    .title {
        position: absolute;
        width: 500px;
        left: 0;
        top: 120px;
        font-weight: 700;
        font-size: 30px;
        text-align: center;
        text-transform: uppercase;
        color: white;
        z-index: 1;
        transition: top .5s ease;
    }

    .container:hover .title {
        top: 90px;
    }

    .button {
        position: absolute;
        width: 100%;
        left: 0;
        top: 100px;
        text-align: center;
        opacity: 0;
        transition: opacity .35s ease;
    }

    .button a {
        width: 200px;
        padding: 12px 48px;
        text-align: center;
        color: white;
        border: solid 2px white;
        z-index: 1;
    }

    .button:hover {
        cursor: pointer;
    }

    .container:hover .button {
        opacity: 1;
    }

    .container:hover .overlay {
        display: block;
        background: rgba(0, 0, 0, .3);
    }
</style>

<div class="px-4 md:px-10 mx-auto w-full -m-24">
    <div class="flex flex-wrap mt-4">
        <div class="w-full mb-12 px-4">
            <div class=" relative flex flex-row w-full bg-dark text-lg justify-start " style="height: 40px">
                <a href="{{ route('noticia.index') }}">
                    <x-button class="bg-indigo-500 h-10 w-90 hover:bg-gray-700  text-white font-sans font-bold">
                        Volver</x-button>
                </a>
            </div>
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded bg-white">
                <div class="rounded-t mb-0 px-4 py-3 border-0 bg-gray-400">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-2xl text-white">
                                Galería de noticia [{{ $noticia->not_titulo }}]
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="hidden sm:block" aria-hidden="true">
                    <div>
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>

                <div class="block w-full p-4 overflow-x-auto flex flex-center flex-col">
                    <p>Imágenes actuales de la noticia.</p>
                    <br>
                    <div class="imagenesGaleria flex flex-wrap">
                        @forelse ($noticia->imagenes as $item)
                        <div class="grid grid-cols-1 gap-1 mt-1 mb-1 mr-1 ml-1" data-id="{{$item->id}}">
                            <div class="container" style="width: 222px; height: 222px">
                                <img class="imgGallery" src="{{ $item->gnot_path }}" alt=""
                                    style="width: 100%; height:100%">
                                <div class="overlay"></div>
                                <div class="button">
                                    <a onclick="eliminarFoto({{ $item->id }})"> Eliminar </a>
                                </div>
                                {{-- <p>orden: {{$item->gnot_orden}}</p> --}}
                            </div>
                        </div>
                        @empty
                        <div class="w-full sin-imagenes">
                            <h2 class="text-center text-3xl text-empty">No se han subido imágenes</h2>
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="block w-full p-4  overflow-x-auto">
                    <p>Insertar las fotos correspondientes a la galería de la noticia.</p>
                    <br>
                    <form action="{{ route('noticia.fileStore') }}" class="dropzone" id="myawesome"
                        enctype="multipart/form-data" style="border: 2px dashed #0087F7; border-radius:5px">
                        @csrf
                        <input type="hidden" value="{{ $noticia->id }}" name="idNew">
                        <div class="dz-default dz-message">
                            <span>Sube o arrastra las imagenes para agregar a la galeria.</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
    integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
<script>
    Dropzone.options.myawesome = {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            acceptedFiles: "image/*, .jpg, .jpeg",
            dictInvalidFileType: "Archivo no válido",
            success: function(file, response) {
                $('.sin-imagenes').html('');
                $('.imagenesGaleria').append(`
                        <div class="grid grid-cols-1 gap-1 mt-1 mb-1 mr-1 ml-1" data-id="${response.id}">
                            <div class="container" style="width: 222px; height: 222px">
                                <img class="imgGallery" src="${response.path}" alt="" style="width: 100%; height:100%">
                                <div class="overlay"></div>
                                <div class="button">
                                    <a onclick="eliminarFoto(${response.id})"> Eliminar </a>
                                </div>
                            </div>
                        </div>
                    `);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Imagen o imágenes guardadas exitosamente.'
                })
            },

        }

        function eliminarFoto(id) {
            const id_noticia = @json($noticia->id);
          
            Swal.fire({
                title: '¿Estas seguro?',
                html: "Se borrará la imagen",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#1E3A8A',
                cancelButtonColor: '#9CA3AF',
                confirmButtonText: 'Si, estoy seguro'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('noticia.eliminarFoto') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            "id": id,
                            "id_noticia" : id_noticia,

                        },
                        success: function(respuesta) {
                            
                            $(`*[data-id="${id}"]`).remove();
                            console.log(respuesta);
                            
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter',
                                        Swal.stopTimer)
                                    toast.addEventListener('mouseleave',
                                        Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Imagen borrada correctamente.'
                            });

                            if(respuesta.total_imagenes === 0){
                                $('.imagenesGaleria').append(`
                                <div class="w-full sin-imagenes"  >
                                <h2 class="text-center text-3xl text-empty">No se han subido imágenes</h2>
                                </div>
                                `)
                            }
                            
                         
                           // $(".imagenesGaleria").load(".imagenesGaleria");
                        
                            /* load(".imagenesGaleria"); */
                        }
                    });
                }
            })
        }
</script>
@endsection