@extends('layouts.admin')

@section('title')
 Estadisticas Contactos   
@endsection


@section('content')

<div class="px-4 md:px-10 mx-auto w-full -m-24">
    <div class="flex flex-wrap mt-4">

        <div class="w-full mb-12 px-4">
            <a>
                <div class="flex flex-row w-full text-lg justify-end " style="height: 40px">
                    <x-button id="btn-pdf"
                        class="btn-aeurus bg-red-500 w-100 ml-3 mt-2 absolute px-4 p-3 rounded-lg text-white font-sans font-bold float-right">
                        <i class="fas fa-file-pdf mr-2 fa-2x"></i>Exportar a PDF
                    </x-button>


                </div>
            </a>

            <div id="containerGraficos" style="background-color: white; color: white">
                <div class="relative  flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded bg-white" style="min-height: 60vh">
                    <div class="rounded-t mb-0 px-4 py-3 border-0 bg-gray-400">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-2xl text-white">
                                    Gráfico de Contactos
                                </h3>
                            </div>
                            <input name="dateInicio"
                                class="appearance-none block float-right my-2 text-gray-700 border  rounded py-3mb-3 leading-tight focus:outline-none bg-white"
                                id="dateInicio" type="date">
                            <input name="dateInicio"
                                class="appearance-none block float-right ml-2 mr-2 my-2 text-gray-700 border  rounded py-3mb-3 leading-tight focus:outline-none bg-white"
                                id="dateFin" type="date">
                            <button id="btnFilterGraph"
                                class="float-right inline-block py-2 px-3 text-white text-center text-white transition bg-blue-700 rounded-lg shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none waves-effect">
                                <i class="fas fa-search fa-md "></i>
                            </button>
                        </div>
                    </div>
                    <div class="hidden sm:block" aria-hidden="true">
                        <div>
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>
                    <div class="w-full flex flex-col p-10" id="containerPDF">
                        <div class="grid md:grid-cols-3 grid-cols-1">
                            <div class="col-span-1">
                                <div class="relative mb-2">
                                    <canvas id="graficoContactos" width="200" height="80"></canvas>
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Asuntos
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Cantidad
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    %
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="cuerpoTabla">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
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

<script src="{{ asset('public/assets/js/html2pdf.bundle.min.js') }}"></script>

<script>
    var asuntos = [];
        var valores = [];
        var colores = [];

        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "{{ route('contactos.datosGrafico') }}",
                success: function(response) {
                    var total  = response.total;
                    response.asuntos.forEach((asunto, index) => {
                        asuntos.push(asunto.asun_nombre);
                        colores.push('rgba(' + grc() + ', ' + grc() + ', ' + grc() + ', 0.5)');
                        if(response.count_asuntos[index] > 0){
                            $('#cuerpoTabla').append(`
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-bold" style="background-color: ${colores[index]}">
                                    ${asunto.asun_nombre}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-800 font-bold" style="background-color: ${colores[index]}">
                                    ${response.count_asuntos[index]}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-800 font-bold" style="background-color: ${colores[index]}">
                                    ${((response.count_asuntos[index]/total)*100).toFixed(2)}
                                </td>
                            </tr>
                        `)
                        }
                    });
                    valores.push(response.count_asuntos);
                    generarGrafico(asuntos, valores[0], colores);

                    if(total == 0){
                        $('#cuerpoTabla').append(`
                            <tr class="text-center">
                                <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-800 font-bold" >
                                    Sin resultados
                                </td>
                            </tr>
                        `)
                    }
                }
            });
        });

        function generarGrafico(asuntos, valores, colores) {
            var ctx = document.getElementById('graficoContactos').getContext('2d');

            if (window.grafica) {
                window.grafica.clear();
                window.grafica.destroy();
            }

            window.grafica = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: asuntos,
                    datasets: [{
                        label: 'Asuntos',
                        data: valores,
                        backgroundColor: colores,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'N° de Asuntos' 
                        }
                    }
                },
            });
        }

        function grc() {
            let min = 0;
            let max = 255;
            return Math.floor(
                Math.random() * (max - min) + min
            )
        }

        $('#btnFilterGraph').click(function(e) {
            e.preventDefault();
            var asuntos = [];
            var valores = [];
            var fechaInicio = $('#dateInicio').val();
            var fechaFin = $('#dateFin').val();

            var fecha = ""

            $.ajax({
                type: "post",
                url: "{{ route('contactos.filtroGrafico') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    fechaInicio,
                    fechaFin,
                },
                success: function(response) {
                    var total  = response.total;
                    if (response.asuntos.length > 0) {
                        $('#cuerpoTabla').html('');
                        response.asuntos.forEach((asunto, index) => {
                            asuntos.push(asunto.asun_nombre);
                            colores.push('rgba(' + grc() + ', ' + grc() + ', ' + grc() + ', 0.5)');
                            $('#cuerpoTabla').append(`
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-bold" style="background-color: ${colores[index]}">
                                    ${asunto.asun_nombre}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-bold" style="background-color: ${colores[index]}">
                                    ${response.count_asuntos[index]}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-bold" style="background-color: ${colores[index]}">
                                    ${((response.count_asuntos[index]/total)*100).toFixed(2)}
                                </td>
                            </tr>
                        `)
                        });
                        valores.push(response.count_asuntos);
                        generarGrafico(asuntos, valores[0],colores);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'No hay resultados para su busqueda',
                        })
                    }
                }
            });
        });


        $('#btn-pdf').click(function(e) {
            
            e.preventDefault();
            
            generarPDF();
        });



        function generarPDF() {
            var elemento = document.querySelector('#containerPDF');

            var str1 = "Asuntos";
            var opt = {
                margin: 1,
                filename: str1,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3,
                    letterRendering: true,
                },
                jsPDF: {
                    unit: 'cm',
                    format: 'a2',
                    orientation: 'p'
                }
            };

            html2pdf().set(opt).from(elemento).save();

        }

</script>

@endsection