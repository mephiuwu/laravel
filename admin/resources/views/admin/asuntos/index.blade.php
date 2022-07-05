@extends('layouts.admin')

@section('title')
 Asuntos   
@endsection
@section('content')



<style>
    .modal .modal-edit {
        transition: opacity 0.25s ease;
    }

    body.modal-active .modal-active-edit {
        overflow-x: hidden;
        overflow-y: visible !important;
    }
</style>
<div class="px-4 md:px-10 mx-auto w-full -m-24">
    <div class="flex flex-wrap mt-4">

        <div class="w-full mb-12 px-4">
            <div class="flex flex-row w-full text-lg justify-between" style="height: 40px">

                <x-button id="btn-image"
                    class="modal-open btn-aeurus bg-blue-500 w-100 ml-3 mt-2 relative  px-4 p-3 rounded-lg text-white font-sans font-bold float-right">
                    Crear asunto
                </x-button>
                <div id="reportrange" class="relative text-right flex justify-end items-center bg-white rounded-lg  "
                    style="cursor: pointer; width: 200px;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span class="text-black"></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>



            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded bg-white" style="min-height: 60vh">
                <div class="rounded-t mb-0 px-4 py-3 border-0 bg-gray-400">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-2xl text-white">
                                Asuntos
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="hidden sm:block" aria-hidden="true">
                    <div>
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>
                <div class="block w-full p-4  overflow-x-auto">
                    <!-- Projects table -->
                    <table class="cell-border " style="width:100%" id="table-asuntos">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Nombre
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Estado
                                </th>
                                <th
                                    class="noExport px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer class="block py-4 bottom-0">
        <div class="container mx-auto px-4">
            <hr class="mb-4 border-b-1 border-blueGray-200" />
            <div class="flex flex-wrap items-center md:justify-between justify-center">
                <div class="w-full md:w-4/12 px-4">
                    <div class="text-sm text-blueGray-500 font-semibold py-1 text-center md:text-left">
                        Copyright © <span id="get-current-year"></span>
                        <a href="https://www.creative-tim.com?ref=njs-settings"
                            class="text-blueGray-500 hover:text-blueGray-700 text-sm font-semibold py-1">
                            Creative Tim
                        </a>
                    </div>
                </div>
                <div class="w-full md:w-8/12 px-4">
                    <ul class="flex flex-wrap list-none md:justify-end justify-center">
                        <li>
                            <a href="https://www.creative-tim.com?ref=njs-settings"
                                class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="https://www.creative-tim.com/presentation?ref=njs-settings"
                                class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com?ref=njs-settings"
                                class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/creativetimofficial/notus-js/blob/main/LICENSE.md?ref=njs-settings"
                                class="text-blueGray-600 hover:text-blueGray-800 text-sm font-semibold block py-1 px-3">
                                MIT License
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</div>

<!--Modal crear-->
<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Crear nuevo asunto</p>
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <hr>
            <!--Body-->
            <form action="{{ route('asuntos.create') }}" method="POST" class="w-full max-w-lg">
                @csrf
                <br>
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Nombre:
                </label>
                <input style="width: 100%; margin:auto;" name="nombre"
                    class="appearance-none block w-full bg-gray-200 my-10 text-gray-700 border  rounded py-3 px-8 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="grid-first-name" type="text" placeholder="Nombre">
                @error('nombre')
                <b class="text-red-500">{{ $message }}</b>
                @enderror
                <br>
                <br>
                <hr>
                <br>
                <!--Footer-->
                {{-- <button class="cerrar-modal px-4 bg-red-700 p-3 font-bold text-white rounded-lg hover:bg-gray-200 mr-2"></button> --}}
                <x-button type="button"
                    class="cerrar-modal  px-4 p-3 rounded-lg  bg-red-500  w-90 hover:bg-gray-700  text-white font-sans font-bold">
                    Cancelar
                </x-button>
                <x-button id="btn-image" type="submit"
                    class="ml-3 px-4 p-3 bg-indigo-500 rounded-lg  text-white font-sans font-bold float-right">
                    Crear
                </x-button>
            </form>
        </div>
    </div>

</div>

<!--Modal editar-->
<div class="modal-edit opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay-edit absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container-edit bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content-edit py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Editar asunto</p>
                <div class="modal-close-edit cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <hr>
            <!--Body-->
            <form>
                @csrf
                <br>
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Nombre:
                </label>
                <input style="width: 100%; margin:auto;" name="nombre"
                    class="appearance-none block w-full bg-gray-200 my-10 text-gray-700 border  rounded py-3 px-8 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="editName" type="text" required>
                <br>
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Estado:
                </label>
                <select style="width: 100%; margin:auto;" name=""
                    class="appearance-none block w-full bg-gray-200 my-10 text-gray-700 border  rounded py-3 px-8 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="estadoSelect">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
                <input type="hidden" id="idModalEditar">
                <br>
                <hr>
                <br>
                <!--Footer-->
                <button
                    class="modal-close-edit px-4 bg-red-700 p-3 font-bold text-white rounded-lg hover:bg-gray-200 mr-2">Cancelar</button>
                <button type="submit"
                    class="px-4 bg-teal-500 font-bold p-3 rounded-lg text-white hover:bg-gray-200 float-right"
                    id="botonEditar">Editar</button>
            </form>
        </div>

    </div>
</div>
@endsection

@section('scripts')




@if (session('asunto_created'))
<script>
    var message = @json(session('asunto_created'));
            console.log(message);

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
                title: message
            })
           
</script>
@php Session::forget('asunto_created') @endphp
@endif

@if ($errors->any())
<script>
    var message = @json($errors->first());
            console.log(message);

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
                icon: 'error',
                title: message
            });
</script>
@php Session::forget('errors') @endphp

@endif





<script>
        $(document).ready(function() {
            var date = new Date();
            var dateStr = date.getFullYear() + "/" + ("00" + (date.getMonth() )).slice(-2) + "/" + ("00" + date
                .getDate()).slice(-2);
            var dateStr2 = date.getFullYear() + "/" + ("00" + (date.getMonth() + 1)).slice(-2) + "/" + ("00" + date
            .getDate()).slice(-2);

            var inicio = dateStr;
            var fin = dateStr2;
            listadoAsuntos(inicio, fin);


            const dateStr2_inicio = ("00" + date
                .getDate()).slice(-2) + "-" + ("00" + (date.getMonth() )).slice(-2) + "-"  + date.getFullYear();

            const dateStr2_fin = ("00" + date
            .getDate() ).slice(-2) + "-" + ("00" + (date.getMonth() + 1)).slice(-2) + "-"  + date.getFullYear();
            
            
            $('#reportrange span').html(`<p>${dateStr2_inicio + ' A ' + dateStr2_fin}</p>`);
            $('#reportrange span').addClass('text-black text-sm mr-1');
        });




        //modal crear
        $('.modal-open,.modal-overlay,.modal-close,.cerrar-modal').click(function(e) {
            e.preventDefault();
            toggleModal();
        });

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };


        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active-edit')
        }
        //fin modal crear


        //modal editar
        $(".modal-overlay-edit,.modal-close-edit").click(function(e) {
            e.preventDefault();
            toggleModalEdit();
        });

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active-edit')) {
                toggleModalEdit()
            }
        };


        function toggleModalEdit() {
            const body = document.querySelector('body')
            const modalEdit = document.querySelector('.modal-edit')
            modalEdit.classList.toggle('opacity-0')
            modalEdit.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active-edit')
        }
        //fin modal editar

        var listadoAsuntos = function(inicio = false, fin = false) {
            var table = $('#table-asuntos').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('asuntos.table') }}",
                    type: 'post',
                    data: {
                        inicio,
                        fin,
                        "_token": "{{csrf_token()}}"
                    }
                },
                dom: '<"top">lBft<"bottom"irp><"clear">',
                buttons: [{
                extend: 'pdf',
                text: 'PDF',
                exportOptions: {
                    columns: "thead th:not(.noExport)"
                }
                    },
                    {
                        extend: 'excel',
                        text: 'EXCEL',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        }
                    },
                    {
                        extend: 'csv',
                        text: 'CSV',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        }
                    },
                    {
                        extend: 'print',
                        text: 'IMPRIMIR',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        }
                    }
                ],
                columns: [{
                        data: 'asun_nombre',
                        name: 'asun_nombre',
                        searchable: true
                    },
                    {
                        data: 'asun_estado',
                        name: 'asun_estado',
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,

                        "render": function(data, type, row, full) {
                            return `
                       
                        <div class="flex justify-center w-full">
                            <button data-tooltip="Editar" id="btn-edit" onclick="datosEditar(` + row.id + `)" class="inline-block py-1 px-2 text-center relative   text-white transition bg-blue-700 tooltip rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none waves-effect">
                                <i class="fas fa-pencil-alt text-white text-center" ></i>
                            </button>
                            <button data-tooltip="Eliminar"  id="btn-delete" onclick="eliminar(` + row.id + `)" class="inline-block ml-3 py-1 px-2 text-center relative tooltip   text-white transition bg-red-700 rounded-full shadow ripple hover:shadow-lg hover:bg-red-800 focus:outline-none waves-effect">
                                <i class="fas fa-trash-alt text-white text-center" ></i>
                            </button>
                        </div>
                        `
                            /*  <div class="grid grid-cols-2 text-center">
                                 <div class="w-full">
                                     <a href="#" id="btn-edit" onclick="datosEditar(` + row.id + `)" class="text-sm font-normal bg-transparent text-blueGray-700">
                                     <i class="fas fa-pencil-alt text-blue-600"></i> Editar</a>
                                 </div>
                                 <div class="w-full">
                                     <a href="#" id="btn-delete" onclick="eliminar(` + row.id + `)" class="text-sm font-normal bg-transparent text-blueGray-700">
                                     <i class="fas fa-trash-alt text-red-500"></i> Eliminar</a>
                                 </div>
                             </div> */
                        }
                    },
                ],
                columnDefs: [{
                        targets: 0,
                        width: "40%",
                    },
                    {
                        targets: 1,
                        width: "40%",
                        render: function(data, type, row) {
                            return data == "1" ?
                                `<span class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap flex-col p-4"><i class="fas fa-circle text-emerald-500 mr-2"></i>Activo</span>` :
                                `<span class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap flex-col p-4"><i class="fas fa-circle text-red-500 mr-2"></i>Inactivo</span>`
                        }
                    },
                    {
                        targets: 2,
                        width: "20%",
                    }
                ]
            });
        }

        $(function() {

            var start = moment();
            var end = moment();

            function cb(start, end) {

                var inicio = start.format('YYYY-MM-DD');
                var fin = end.format('YYYY-MM-DD');
             
                listadoAsuntos(inicio, fin);

                $('#reportrange span').html(start.format('DD-MM-YYYY') + ' A ' + end.format('DD-MM-YYYY'));
                $('#reportrange span').addClass('text-black');
            }

            $('#reportrange').daterangepicker({
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "A",
                    "customRangeLabel": "Personalizado",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "D",
                        "L",
                        "M",
                        "M",
                        "J",
                        "V",
                        "S"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    "firstDay": 1
                },
                startDate: start,
                endDate: end,
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
                    'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                    'Este mes': [moment().startOf('month'), moment().endOf('month')],
                    'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });


        function datosEditar(id_asunto) {
            toggleModalEdit();
            var id = id_asunto;
            $.ajax({
                type: "get",
                url: "{{ route('asuntos.datosEditar') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    "id_asunto": id,
                },
                success: function(response) {
                    $('#editName').val(response.asun_nombre);
                    $('#estadoSelect').val(response.asun_estado);
                    $('#idModalEditar').val(response.id);
                }
            });
        }

        $('#botonEditar').click(function(e) {
            e.preventDefault();
            var nombre = $("#editName").val();
            var estado = $("#estadoSelect").val();
            var id = $("#idModalEditar").val();
            $.ajax({
                type: "post",
                url: "{{ route('asuntos.editar') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    "nombre": nombre,
                    "estado": estado,
                    "id": id,
                },
                success: function(response) {
                    console.log(response);
                    toggleModalEdit();
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
                    });
                    var date = new Date();
                    var inicio = date.getFullYear() + "/" + ("00" + (date.getMonth() )).slice(-2) + "/" + ("00" + date
                        .getDate()).slice(-2);
                    var fin = date.getFullYear() + "/" + ("00" + (date.getMonth() + 1)).slice(-2) + "/" + ("00" + date
                    .getDate()).slice(-2);
                    listadoAsuntos(inicio,fin);

                    if (response.status === 200) {

                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });

                    } else {

                        Toast.fire({
                            icon: 'error',
                            title: response.message
                        })

                    }
                },
                error: function(response) {
                    console.log(response);
                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    });
                }
            });
        });

        function eliminar(id_asunto, e) {

            Swal.fire({
                title: '¿Estas seguro que quieres eliminar este asunto?',
                text: "Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#1E3A8A',
                cancelButtonColor: '#9CA3AF',
                confirmButtonText: 'Si, estoy seguro'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = id_asunto;
                    $.ajax({
                        type: "post",
                        url: "{{ route('asuntos.eliminar') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            "id_asunto": id,
                        },
                        success: function(response) {
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
                            });
                            if (response.status == 200) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Asunto eliminado satisfactoriamente!'
                                });
                                var date = new Date();
                                var inicio = date.getFullYear() + "/" + ("00" + (date.getMonth() )).slice(-2) + "/" + ("00" + date
                                .getDate()).slice(-2);
                                var fin = date.getFullYear() + "/" + ("00" + (date.getMonth() + 1)).slice(-2) + "/" + ("00" + date
                                .getDate()).slice(-2);
                                listadoAsuntos(inicio,fin);
                                
                            } else if (response.status == 500) {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.message
                                });
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Ha ocurrido un error interno. Intentelo de nuevo mas tarde.'
                                });
                            }


                        }
                    });
                }
            });


        }





        function eliminarModal(id) {
            $.ajax({
                type: "post",
                url: "{{ route('usuarios.dataDelete') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(response) {
                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: "Se borrará el usuario " + response.name,
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
                                url: "{{ route('usuarios.delete') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    "id": response.id,
                                },
                                success: function(respuesta) {
                                    var date = new Date();
                                    var inicio = date.getFullYear() + "/" + ("00" + (date.getMonth() )).slice(-2) + "/" + ("00" + date
                                    .getDate()).slice(-2);
                                    var fin = date.getFullYear() + "/" + ("00" + (date.getMonth() + 1)).slice(-2) + "/" + ("00" + date
                                    .getDate()).slice(-2);
                                    listadoAsuntos(inicio,fin);
                                    
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
                                    });


                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Usuario borrado correctamente.'
                                    })
                                }
                            });
                        }
                    })
                }
            });
        }
</script>




@endsection