@extends('layouts.admin')

@section('title')
 Contactos   
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
            {{-- <div class="flex flex-row w-full text-lg justify-between " style="height: 40px">
                <x-button id="btn-image"
                    class="modal-open btn-aeurus bg-green-500 w-100 ml-3 mt-2 absolute px-4 p-3 rounded-lg text-white font-sans font-bold float-left">
                    <i class="fas fa-file-excel mr-2 fa-2x"></i> Exportar a Excel
                </x-button>
                <div id="reportrange" class="relative text-right flex justify-end items-center bg-white rounded-lg" style="cursor: pointer; width: 200px;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span class="text-black"></span> <i class="fa fa-caret-down"></i>
                </div>
            </div> --}}

            <div class="flex flex-row w-full text-lg justify-between" style="">
               
                <x-button id="btn-image"
                class="modal-open btn-aeurus bg-green-500 w-100 ml-3 mt-2 relative px-4 p-3 rounded-lg text-white font-sans font-bold float-right">
                <i class="fas fa-file-excel mr-2 fa-2x"></i> Exportar a Excel
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
                                Contactos
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
                    <table class="cell-border " style="width:100%" id="table-contactos">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Nombre
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Email
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Teléfono
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Asunto
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Dirección
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Fecha
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Opciones
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


    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Exportar a Excel</p>
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
                <form class="w-full max-w-lg" method="GET" action="{{route('contactos.export')}}">
                    @csrf
                    <br>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
                                for="grid-first-name">
                                Inicio:
                            </label>
                            <input name="dateInicio"
                                class="appearance-none block w-full bg-gray-200 my-2  text-gray-700 border  rounded py-3mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="dateInicio" type="date">
                        </div>
                        <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
                                for="grid-first-name">
                                Fin:
                            </label>
                            <input name="dateFin"
                                class="appearance-none block w-full bg-gray-200 my-2  text-gray-700 border  rounded py-3mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="dateFin" type="date">
                        </div>
                    </div>
                    <br>
                    <div class="grid grid-cols-5 mt-2">
                        <div></div>
                        <div class="col-span-3">
                            <button type="submit"
                                class="px-4 p-3 rounded-lg flex justify-center bg-green-500 w-full hover:bg-gray-700  text-white font-sans font-bold">
                                Exportar a excel
                            </button>
                        </div>
                        <div></div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection


@section('scripts')

@if(session('date_error'))
<script>
    var message = @json(session('date_error'));
       
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
          })
</script>
@php Session::forget('date_error') @endphp

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
            tableContacto(inicio, fin);


            const dateStr2_inicio = ("00" + date
                .getDate()).slice(-2) + "-" + ("00" + (date.getMonth() )).slice(-2) + "-"  + date.getFullYear();

            const dateStr2_fin = ("00" + date
            .getDate() ).slice(-2) + "-" + ("00" + (date.getMonth() + 1)).slice(-2) + "-"  + date.getFullYear();
            
            
            $('#reportrange span').html(`<p>${dateStr2_inicio + ' A ' + dateStr2_fin}</p>`);
            $('#reportrange span').addClass('text-black text-sm mr-1');
        });
    var tableContacto = function (inicio = false, fin = false) {
        var table = $('#table-contactos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            destroy: true,
            "order": [[ 5, "desc" ]],
            ajax: {
                    url: "{{ route('contactos.table') }}",
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
                /*   {
                        extend: 'excel',
                        text: 'EXCEL',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"
                        }
                    }, */
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
                    data: 'con_nombre',
                    name: 'con_nombre',
                    searchable: true
                },
                {
                    data: 'con_email',
                    name: 'con_email',
                    searchable: true
                },
                {
                    data: 'con_telefono',
                    name: 'con_telefono',
                    searchable: true
                },
                {
                    data: 'asunto',
                    name: 'asunto',
                    searchable: true
                },
                {
                    data: 'con_direccion',
                    name: 'con_direccion',
                    searchable: true
                },
                {
                    data: 'fecha',
                    name: 'fecha',
                    searchable: true,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ],
        });
    }
    
    $(function() {

    var start = moment();
    var end = moment();

    function cb(start, end) {

        var inicio = start.format('YYYY-MM-DD');
        var fin = end.format('YYYY-MM-DD');

        tableContacto(inicio, fin);

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
</script>
@endsection