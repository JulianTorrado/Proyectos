<?php //echo "Layout OPERARIO SUP " ?>
<div class="container-fluid">
    <section>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <a href="?c=informes&a=al">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger elavation-1">
                                <i class="fas fa-check"></i>
                            </span>
                            <div class="info-box-content">
                                <div class="info-box-text">Actividades Logradas</div>
                                <div class="info-box-number"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="?c=informes&a=ap">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elavation-1">
                                <i class="far fa-handshake"></i>
                            </span>
                            <div class="info-box-content">
                                <div class="info-box-text">Actividades Pendientes</div>
                                <div class="info-box-number"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="?c=informes&a=cp">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elavation-1"><i class="fas fa-clock"></i></span>
                            <div class="info-box-content">
                                <div class="info-box-text">Compromisos Pendientes</div>
                                <div class="info-box-number"></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="?c=informes&a=pf">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elavation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <div class="info-box-text">Progreso X funcionario</div>
                                <div class="info-box-number"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <a href="?c=informes&a=estproyecto">
                <div class="alert alert-success">
                    <div class="info-box-content">
                        <div class="info-box-text">Ver Informe de Estado de los Proyectos</div>
                        <div class="info-box-number"></div>
                    </div>
                </div>
            </a>
        </div>
        <div id="Graficas" class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="body">
                            <div id="crm" style="width: 400px;height:400px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="body">
                            <div id="est_actividad" style="width: 400px;height:400px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="body">
                            <div id="rendimiento" style="width: 400px;height:400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal 1-->
<?
// echo '<pre>';
// print_r($ac);
// echo '</pre>';
?>
<script>
    // Inicializar el objeto de ECharts y asignarlo al div correspondiente
    var mi_crm = echarts.init(document.getElementById('crm'));
    const dataCliente = <?= json_encode($datosCliente) ?>;
    var colors = ['#e6b4e5', '#a3a8e2', '#2b91c8', '#5793f3', '#d14a61', '#675bba', '#ff8feb', '#ffbf90', '#d6f8ca', '#ff95aa', '#f6e5a6'];

    const tipoCliente = dataCliente.map(item => item.name);
    const valorTipo = dataCliente.map(item => item.value);
    // Configurar las opciones del gráfico de barras
    var opciones = {
        // Tipo de gráfico
        type: 'bar',
        title: {
            text: 'CRM',
            subtext: 'Muestra la cantidad de intersados, prospectos y clientes',
            left: 'center',
        },

        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },

        legend: {
            orient: 'horizontal',
            bottom: "bottom",
        },

        // Datos para el eje X (tipo de cliente)
        xAxis: {


            type: 'category',
            data: tipoCliente

        },

        // Datos para el eje Y (cantidad de clientes)
        yAxis: {
            type: 'value',
            boundaryGap: [0, 0.01],
        },

        // Serie de datos para el gráfico de barras
        series: [{
            name: tipoCliente,
            data: valorTipo,
            type: 'bar',
            markPoint: {
                data: [{
                        type: 'max',
                        name: 'Max'
                    },
                    {
                        type: 'min',
                        name: 'Min'
                    }
                ]
            },
            itemStyle: {
                normal: {
                    type: 'linear',
                    color: function(params) {
                        return colors[params.dataIndex % colors.length];
                    },
                    colorStops: [{
                        offset: 0,
                        color: 'rgba(80, 141, 255, 0.8)'
                    }, {
                        offset: 1,
                        color: 'rgba(80, 141, 255, 0)'
                    }],
                    barBorderRadius: [10, 10, 0, 0],
                }
            }
        }]
    };

    // Aplicar las opciones del gráfico de barras
    mi_crm.setOption(opciones);
    mi_crm.resize();

    /** estado de las actividades */
    /** estado de las actividades */
    // Inicializar el objeto de ECharts y asignarlo al div correspondiente
    var chartDom = document.getElementById('est_actividad');
    var myChart = echarts.init(chartDom);

    var option;

    option = {
        title: {
            text: 'Actividades x Estado',
            subtext: 'Muestra la cantidad de actividades  y su estado',
            left: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c} ({d}%)'
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: <?php echo json_encode($d_actividad); ?>
        },
        series: [{
            name: 'Estado',
            type: 'pie',
            radius: ['30%', '50%'],
            center: ['50%', '50%'],

            itemStyle: {
                borderRadius: 10,
                borderColor: '#fff',
                borderWidth: 2
            },
            label: {
                show: true,
                formatter(param) {
                    // correct the percentage
                    return param.name + ' (' + param.percent + '%)';
                }
            },

            data: [{
                    value: <?php echo $datosActividades[0]->cumplidas; ?>,
                    name: 'Cumplidas'
                },
                {
                    value: <?php echo $datosActividades[0]->no_cumplidas; ?>,
                    name: 'No cumplidas'
                }
            ],

            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }]
    };

    option && myChart.setOption(option);


    //** rendimiento */



    const data0 = <?= json_encode($ac) ?>;
    const xAxisData0 = data0.map(item => item.fullName);
    const yAxisData0 = data0.map(item => item.completed_activities);
    const amount = data0.map(item => item.amount);
    const por = data0.map(item => item.percentage_completed);


    var chartDom01 = document.getElementById('rendimiento');
    var myChart01 = echarts.init(chartDom01);
    var option;

    option = {
            title: {
                text: 'Colaboradores',
                subtext: 'Muestra la cantidad de actividades terminadas',
                left: 'center',
            },

            tooltip: {
                trigger: 'axis',               
                formatter: function(params) {
                    const name = params[0].name;
                    const value = params[0].value;
                    const index = params[0].dataIndex;
                    const amt = amount[index];
                    const porc= por[index];
                    return `${name}<br>Terminadas: ${value} <br>Agendadas: ${amt} <br> % avance: ${porc}`;
                }
            },

        

        legend: {
            orient: 'horizontal',
            bottom: "bottom",
        },
        xAxis: {
            type: 'category',
            data: xAxisData0,
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: yAxisData0,
            type: 'bar',
            showBackground: true,
            markPoint: {
                data: [{
                        type: 'max',
                        name: 'Max'
                    },
                    {
                        type: 'min',
                        name: 'Min'
                    }
                ]
            },
            itemStyle: {
                normal: {
                    type: 'linear',
                    color: function(params) {
                        return colors[params.dataIndex % colors.length];
                    },
                    colorStops: [{
                        offset: 0,
                        color: 'rgba(80, 141, 255, 0.8)'
                    }, {
                        offset: 1,
                        color: 'rgba(80, 141, 255, 0)'
                    }],
                    barBorderRadius: [10, 10, 0, 0],
                }
            }
        }]
    };

    option && myChart01.setOption(option);
</script>