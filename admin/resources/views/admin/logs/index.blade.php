@extends('layouts.admin')

@section('title')
 Logs   
@endsection


@section('content')


<div class="relative  flex flex-col min-w-0 break-words w-full mb-6 mt-4 shadow-lg rounded  bg-white">
    <div class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-lg text-blueGray-700">
                   Registro de logs
                </h3>
            </div>
        </div>
    </div>
    <div class="block w-full p-4 overflow-x-auto ">
        <table id="table-logs" class="cell-border  " style="width:100%">
            <thead>
                <tr>
                    @if ($standardFormat)
                    <th
                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                        Nivel</th>
                    <th
                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                        Context</th>
                    <th
                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                        Fecha</th>
                    @else
                    <th
                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                        Line number</th>
                    @endif
                    <th
                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                        Contenido</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @foreach($logs as $key => $log)
                <tr data-display="stack{{{$key}}}">
                    @if ($standardFormat)
                    @php

                    switch ($log['level']) {
                        case 'error':
                        $color = "red-600";
                        break;
                        case 'critical':
                        $color = "black";
                        break;
                        case 'info':
                        $color = "pink-400";
                        break;
                        case 'warning':
                        $color = "yellow-200";
                        break;
                        case 'emergency':
                        $color = "pink-900";
                        break;
                        default:
                        $color = "red-600";
                        break;
                    }
                    @endphp
                    <td class="text-center text-{{$color}} {{$log['level_class']}}">
                        <span class="fa fa-{{{$log['level_img']}}}"
                            aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                    </td>
                    <td class="text-center">{{$log['context']}}</td>
                    @endif
                    <td class="date">{{{$log['date']}}}</td>
                    <td class="text-left ">
                        @if ($log['stack'])
                 
                        <x-button  type="button" data-display="stack{{{$key}}}"
                        class="btn-aeurus  btn-search  bg-blue-500 w-100 ml-3 mt-2 relative px-4 p-3 rounded-lg text-white font-sans font-bold float-right">
                        <span class="fa fa-search"></span>
                         </x-button>
                        @endif
                        {{{$log['text']}}}
                        @if (isset($log['in_file']))
                        <br />{{{$log['in_file']}}}
                        @endif
                        @if ($log['stack'])
                        <div class="stack break-all" id="stack{{{$key}}}"   style="display: none; white-space: pre-wrap; ">
                            {{{ trim($log['stack']) }}}
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{--  <div class="col sidebar mb-3">
              <h1><i class="fa fa-calendar" aria-hidden="true"></i> Laravel Log Viewer</h1>
              {{-- <p class="text-muted"><i>by Rap2h</i></p> --}}

        {{--    <div class="custom-control custom-switch" style="padding-bottom:20px;">
                <input type="checkbox" class="custom-control-input" id="darkSwitch">
                <label class="custom-control-label" for="darkSwitch" style="margin-top: 6px;">Dark Mode</label>
              </div>
        
              <div class="list-group div-scroll">
                @foreach($folders as $folder)
                  <div class="list-group-item">
                    <a href="?f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}">
        <span class="fa fa-folder"></span> {{$folder}}
        </a>
        @if ($current_folder == $folder)
        <div class="list-group folder">
            @foreach($folder_files as $file)
            <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}&f={{ \Illuminate\Support\Facades\Crypt::encrypt($folder) }}"
                class="list-group-item @if ($current_file == $file) llv-active @endif">
                {{$file}}
            </a>
            @endforeach
        </div>
        @endif
    </div>
    @endforeach
    @foreach($files as $file)
    <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
        class="list-group-item @if ($current_file == $file) llv-active @endif">
        {{$file}}
    </a>
    @endforeach
</div>
</div> --}}
{{--   <div class="col-10 table-container">
              @if ($logs === null)
                <div>
                  Log file >50M, please download it.
                </div>
              @else
                <table id="table-log" class="cell-border" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
<thead>
    <tr>
        @if ($standardFormat)
        <th>Level</th>
        <th>Context</th>
        <th>Date</th>
        @else
        <th>Line number</th>
        @endif
        <th>Content</th>
    </tr>
</thead>
<tbody>

    @foreach($logs as $key => $log)
    <tr data-display="stack{{{$key}}}">
        @if ($standardFormat)
        <td class="nowrap text-{{{$log['level_class']}}}">
            <span class="fa fa-{{{$log['level_img']}}}" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
        </td>
        <td class="text">{{$log['context']}}</td>
        @endif
        <td class="date">{{{$log['date']}}}</td>
        <td class="text">
            @if ($log['stack'])
            <button type="button" class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                data-display="stack{{{$key}}}">
                <span class="fa fa-search"></span>
            </button>
            @endif
            {{{$log['text']}}}
            @if (isset($log['in_file']))
            <br />{{{$log['in_file']}}}
            @endif
            @if ($log['stack'])
            <div class="stack" id="stack{{{$key}}}" style="display: none; white-space: pre-wrap;">
                {{{ trim($log['stack']) }}}
            </div>
            @endif
        </td>
    </tr>
    @endforeach

</tbody>
</table>
@endif
<div class="p-3">
    @if($current_file)
    <a
        href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
        <span class="fa fa-download"></span> Download file
    </a>
    -
    <a id="clean-log"
        href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
        <span class="fa fa-sync"></span> Clean file
    </a>
    -
    <a id="delete-log"
        href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
        <span class="fa fa-trash"></span> Delete file
    </a>
    @if(count($files) > 1)
    -
    <a id="delete-all-log"
        href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
        <span class="fa fa-trash-alt"></span> Delete all files
    </a>
    @endif
    @endif
</div>
</div> --}}


<div class="p-3">
    @if($current_file)
      <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
        <span class="fa fa-download"></span> Descargar archivo
      </a>
      -
      <a id="clean-log" href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
        <span class="fa fa-sync"></span> Limpiar archivo
      </a>
      -
      <a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
        <span class="fa fa-trash"></span> Borrar archivo
      </a>
      @if(count($files) > 1)
        -
        <a id="delete-all-log" href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
          <span class="fa fa-trash-alt"></span> Delete all files
        </a>
      @endif
    @endif
  </div>

</div>


</div>

<footer class="block py-4">
    <div class="container mx-auto px-4">
        <hr class="mb-4 border-b-1 border-blueGray-200" />
        <div class="flex flex-wrap items-center md:justify-between justify-center">
            <div class="w-full md:w-4/12 px-4">
                <div class="text-sm text-blueGray-500 font-semibold py-1 text-center md:text-left">
                    Aeurus © <span id="get-current-year"></span>

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



@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
     $('.tbody tr').on('click', function () {
        $('#' + $(this).data('display')).toggle();
    });
   var table = $('#table-logs').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            "order": [[ 2, "desc" ]], // Order on init. # is the column, starting at 0
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
                    width: "10%",
                },
                {
                    targets: 1,
                    width: "10%",
                },
                {
                    targets: 2,
                    width: "10%",
                },
                {
                    targets: 2,
                    width: "60%",
                    maxWidth: '60%'
                }
            ],
           
        });
</script>
@endsection