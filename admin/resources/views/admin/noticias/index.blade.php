@extends('layouts.admin')

@section('title')
 Noticias   
@endsection


@section('content')

<div class="px-4 md:px-10 mx-auto w-full -m-24" >
    <div class="flex flex-wrap mt-4" >

        <div class="w-full mb-12 px-4" >

            <div class="flex flex-row w-full text-lg justify-between" style="height: 40px">
                <a href="{{ route('noticia.create') }}">
                    <x-button id="btn-image"
                        class="btn-aeurus bg-blue-500 w-100 ml-3 mt-2 relative px-4 p-3 rounded-lg text-white font-sans font-bold float-right">
                        Crear noticia
                    </x-button>
                </a>
                <div id="reportrange" class="relative text-right flex justify-end items-center bg-white rounded-lg  "
            style="cursor: pointer; width: 200px;">
            <i class="fa fa-calendar"></i>&nbsp;
            <span class="text-black"></span> <i class="fa fa-caret-down"></i>
        </div>
            </div>
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded bg-white" style="min-height:60vh ">
                <div class="rounded-t mb-0 px-4 py-3 border-0 bg-gray-400">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-2xl text-white">
                                Noticias
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
                    <table class="cell-border " style="width:100%" id="table-noticias">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Título
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                                    Estado
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

</div>

@endsection


@section('scripts')

@if (session('news_created'))
<script>
    var message = @json(session('news_created'));
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
            Toast.fire({
                icon: 'success',
                title: message
            });

</script>
@php Session::forget('news_created') @endphp

@endif

@if (session('noticiaUpdate'))
<script>
    var message = @json(session('noticiaUpdate'));
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
@php Session::forget('noticiaUpdate') @endphp

@endif
@if($errors->any())
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
        })
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
            listadoNoticias(inicio, fin);


            const dateStr2_inicio = ("00" + date
                .getDate()).slice(-2) + "-" + ("00" + (date.getMonth() )).slice(-2) + "-"  + date.getFullYear();

            const dateStr2_fin = ("00" + date
            .getDate() ).slice(-2) + "-" + ("00" + (date.getMonth() + 1)).slice(-2) + "-"  + date.getFullYear();
            
            
            $('#reportrange span').html(`<p>${dateStr2_inicio + ' A ' + dateStr2_fin}</p>`);
            $('#reportrange span').addClass('text-black text-sm mr-1');
    });





    var listadoNoticias = function(inicio = false, fin = false) {
    var table = $('#table-noticias').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                    url: "{{ route('noticia.table') }}",
                    type: 'post',
                    data: {
                        inicio,
                        fin,
                        "_token": "{{csrf_token()}}"
                    }
                },
            columns: [{
                    data: 'not_titulo',
                    name: 'not_titulo',
                    searchable: true,
                },
                {
                    data: 'not_estado',
                    name: 'not_estado',
                    searchable: true,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ],
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

        function datosEliminar(id) {
            $.ajax({
                type: "post",
                url: "{{ route('noticia.dataDelete') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(response) {
                    Swal.fire({
                        title: '¿Estas seguro?',
                        html: "Se borrará la noticia <b>" + response.not_titulo + "</b>",
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
                                url: "{{ route('noticia.delete') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    "id": response.id,
                                },
                                success: function(respuesta) {
                                    table.ajax.reload();
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

                                    if(respuesta.status == 200){
                                        Toast.fire({
                                        icon: 'success',
                                        title: respuesta.message
                                    })
                                    }else{
                                        Toast.fire({
                                        icon: 'error',
                                        title: respuesta.message
                                    })
                                    }

                                  
                                }
                            });
                        }
                    })
                }
            });
        }

 
        $(function() {

            var start = moment();
            var end = moment();

            function cb(start, end) {

                var inicio = start.format('YYYY-MM-DD');
                var fin = end.format('YYYY-MM-DD');

                listadoNoticias(inicio, fin);

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

</script>

@endsection