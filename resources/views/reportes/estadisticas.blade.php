@extends('layouts.app',['title'=>'Estadísticas'])

@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Estadísticas</h5>
        <form action="{{ route('generarEstadisticas') }}"  method="get">
            <div class="input-group mb-3">
                <input type="date" name="fecha" value="{{ $fecha??'' }}" class="form-control" placeholder="Fecha" aria-label="Fecha" aria-describedby="basic-addon2" required>
                <div class="input-group-append">
                    <button class="btn btn-dark" type="submit">Buscar </button>
                </div>
            </div>
        </form>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if ($fecha)

            <div class="card">
                <figure class="highcharts-figure">
                    <div id="containerLineaAnio"></div>

                </figure>

            </div>
                <div class="card">
                    {{--  <canvas id="myChart" height="100"></canvas>  --}}
                    <figure class="highcharts-figure">
                        <div id="containerLinea"></div>

                    </figure>

                </div>
                <div class="card">
                    <figure class="highcharts-figure">
                        <div id="containerBar"></div>

                    </figure>
                </div>
                <div class="card">
                    <figure class="highcharts-figure">
                        <div id="containerPorcentajeMes"></div>

                    </figure>
                </div>


        @else
        <div class="alert alert-danger" role="alert">
            No se existen datos
        </div>

        @endif
    </div>


</div>
@push('linksCabeza')
{{--  datatable  --}}

<script src="{{ asset('admin/plus/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('admin/plus/highcharts/data.js') }}"></script>
<script src="{{ asset('admin/plus/highcharts/drilldown.js') }}"></script>
<script src="{{ asset('admin/plus/highcharts/exporting.js') }}"></script>
<script src="{{ asset('admin/plus/highcharts/export-data.js') }}"></script>
<script src="{{ asset('admin/plus/highcharts/accessibility.js') }}"></script>
@endpush

@prepend('linksPie')
<script>
var languaje={
    downloadCSV:"Descargar CSV",

    downloadJPEG:"Descargar imagen JPEG",
    downloadPDF:"Descargar documento PDF",
    downloadPNG:"Descargar imagen PNG ",
    downloadSVG:"Descargar imagen vectorial SVG",
    downloadXLS:"Descargar XLS",
    loading:"Cargando...",
    printChart:"Imprimir",
    viewFullscreen:"Expander",
    viewAsDataTableButtonText:"Ver tabla",
    viewData:"Ver tabla de valores",
    drillUpText:"◁ Regresar"
};
$('#menuEstadisticas').addClass('nav-item-expanded nav-item-open');
$('#menuEstadisticas_m').addClass('active');
// Create the chart
var categorias= ['null','Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Séptiembre', 'Octubre', 'Noviembre', 'Diciembre'];
Highcharts.chart('containerLinea', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Total de emergencias de mes de '+categorias[{{ date('n',strtotime($fecha)) }}]+ ' del '+{{ date('Y',strtotime($fecha)) }}
    },
    subtitle: {
        text: 'Click sobre las columnas para ver los tipos de Emeregencia'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total de emergencias'
        }

    },
    legend: {
        enabled: false
    },
    lang:languaje,
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> en total<br/>'
    },

    series: [
        {
            name: "Emergencia",
            colorByPoint: true,
            data: [
                @foreach ($emergencias as $emergencia)
                {
                    name: "{{$emergencia->nombre}}",
                    y:{{ $emergencia->formulariosEstadisticas($emergencia->id,$fecha) }},
                    drilldown: "{{$emergencia->nombre}}"
                },
                @endforeach
            ]
        }
    ],
    drilldown: {
        series: [
            @foreach ($emergencias as $emergencia)
            {
                name: "{{$emergencia->nombre}}",
                id: "{{$emergencia->nombre}}",
                data: [
                    @foreach ($emergencia->tipos as $tipo)
                    [
                        "{{$tipo->nombre}}",
                       {{$tipo->formulariosEstadisticasTipos($tipo->id,$fecha)}}
                    ],
                    @endforeach
                ]

            },
        @endforeach

        ]
    }
});
Highcharts.chart('containerLineaAnio', {
    chart: {
        type: 'column',
        downloadXLS:false,
    },
    title: {
        text: 'Total Emergencias'
    },
    subtitle: {
        text: 'Total de emergencias en el año {{date('Y',strtotime($fecha))}}'
    },
    xAxis: {
        categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Séptiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        crosshair: true
    },
    lang:languaje,
    yAxis: {
        min: 0,
        title: {
            text: 'Emergencias (E)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f} E</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            dataLabels: {
                enabled: true
            },
        }
    },
    series: [
        @foreach ($emergencias as $emergencia)
            {
            name: '{{$emergencia->nombre}}',
            data: [
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,1) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,2) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,3) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,4) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,5) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,6) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,7) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,8) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,9) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,10) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,11) }},
                {{ $emergencia->formulariosEstadisticasAnio($emergencia->id,$fecha,12) }},

            ]

            },
        @endforeach
    ]
});


Highcharts.chart('containerBar', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Porcentajes de emergencias del año {{date('Y',strtotime($fecha))}}',
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    lang:languaje,
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
            @foreach ($emergencias as $emergencia)
                {
                    name: '{{$emergencia->nombre}}',
                    y: {{ $emergencia->formularioPastel($emergencia->id,$fecha) }},
                    sliced: true,
                    selected: true
                },
            @endforeach
            ]
    }]
});



//porcentajes por mes
// Create the chart
Highcharts.chart('containerPorcentajeMes', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Total de emergencias de mes de '+categorias[{{ date('n',strtotime($fecha)) }}]+ ' del '+{{ date('Y',strtotime($fecha)) }}
    },
    subtitle: {
        text: 'sobre las partes del pastel para ver los tipos de Emeregencia'
    },

    accessibility: {
        announceNewData: {
            enabled: true
        },
        point: {
            valueSuffix: '%'
        }
    },

    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> en total<br/>'
    },
    lang:languaje,

    series: [
        {
            name: "Emergencia",
            colorByPoint: true,
            data: [
                @foreach ($emergencias as $emergencia)
                {
                    name: "{{$emergencia->nombre}}",
                    y:{{ $emergencia->formularioPastelMes($emergencia->id,$fecha) }},
                    drilldown: "{{$emergencia->nombre}}"
                },
                @endforeach
            ]
        }
    ],
    drilldown: {
        series: [

            @foreach ($emergencias as $emergencia)
            {
                name: "{{$emergencia->nombre}}",
                id: "{{$emergencia->nombre}}",
                data: [
                    @foreach ($emergencia->tipos as $tipo)
                    [
                        "{{$tipo->nombre}}",
                       {{$tipo->formulariosEstadisticasTiposPastel($tipo->id,$fecha,$emergencia->formulariosEstadisticasMas($emergencia->id,$fecha))}}
                    ],
                    @endforeach
                ]

            },
        @endforeach
        ]
    }
});
</script>

@endprepend


@endsection
