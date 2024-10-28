<div class="container mt-5">
    <div class="row">
        <!-- Columna para el formulario -->
        <div class="col-md-4">
            <div class="card p-4">
                <h2 class="text-center" style="font-size: 20px; font-weight: bold; color: #007bff;">
                    Filtrar Ingresos
                </h2>

                <!-- Control de filtrado por hora de entrada -->
                <div class="mb-3">
                    <label for="hourStartInput" class="form-label">Hora de entrada:</label>
                    <input type="time" id="hourStartInput" class="form-control" value="00:00" onchange="filterData()">
                </div>

                <!-- Control de filtrado por hora de salida -->
                <div class="mb-3">
                    <label for="hourEndInput" class="form-label">Hora de salida:</label>
                    <input type="time" id="hourEndInput" class="form-control" value="23:59" onchange="filterData()">
                </div>

                <!-- Control de filtrado por tipo de vehículo -->
                <div class="mb-3">
                    <label for="vehicleTypeSelect" class="form-label">Tipo de vehículo:</label>
                    <select id="vehicleTypeSelect" class="form-select" onchange="filterData()">
                        <option value="all">Todos</option>
                        <option value="car">Carro</option>
                        <option value="truck">Camión</option>
                        <option value="motorcycle">Moto</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Columna para el gráfico -->
        <div class="col-md-8">
            <div class="card p-4">
                <h2 class="text-center" style="font-size: 20px; font-weight: bold; color: #007bff;">
                    Ingreso de Vehículos por Hora
                </h2>
                <div id="chart_div" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Script de Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawVisualization);

    // Datos iniciales de ejemplo
    var originalData = [
        ['Hora', 'Carros', 'Camiones', 'Motos'],
        ['00:00', 5, 2, 1],
        ['01:00', 3, 1, 0],
        ['02:00', 8, 4, 2],
        ['03:00', 12, 6, 3],
        ['04:00', 13, 6, 3],
        ['22:00', 15, 7, 5],
        ['23:00', 20, 10, 7]
    ];

    function drawVisualization(filteredData = null) {
        const data = google.visualization.arrayToDataTable(
            filteredData || originalData
        );

        const options = {
            title: 'Número de Vehículos por Hora',
            vAxis: { title: 'Cantidad de Vehículos' },
            hAxis: { title: 'Hora' },
            seriesType: 'bars',
            series: { 3: { type: 'line' } },
            lineWidth: 2,
            colors: ['#4285F4', '#DB4437', '#F4B400'],
            trendlines: { 0: {} },
            legend: { position: 'bottom' },
        };

        const chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    // Función para filtrar datos por tipo de vehículo y rango de horas
    function filterData() {
        const hourStart = document.getElementById('hourStartInput').value;
        const hourEnd = document.getElementById('hourEndInput').value;
        const vehicleType = document.getElementById('vehicleTypeSelect').value;

        let filteredData = originalData.map(row => row.slice());

        // Filtrar por rango de horas
        if (hourStart !== '' && hourEnd !== '') {
            filteredData = filteredData.filter(row => {
                const hour = row[0];
                return (hour >= hourStart && hour <= hourEnd) || row[0] === 'Hora';
            });
        }

        // Filtrar por tipo de vehículo
        if (vehicleType !== 'all') {
            const vehicleTypeIndex = {
                'car': 1,
                'truck': 2,
                'motorcycle': 3
            }[vehicleType];
         // Crear un nuevo conjunto de datos solo con el tipo de vehículo seleccionado
         filteredData = filteredData.map(row => {
                if (row[0] === 'Hora') {
                    return ['Hora', row[vehicleTypeIndex], 16];
                }
                return [row[0], row[vehicleTypeIndex], 16];
            });

            filteredData = filteredData.map(row => {
                if (row[0] === 'Hora') {
                    return ['Hora', row[vehicleTypeIndex]];
                }
                return [row[0], row[vehicleTypeIndex]];
            });
        }

        // Agregar encabezados adecuados si solo se filtra un tipo de vehículo
        if (vehicleType !== 'all') {
            filteredData[0] = ['Hora', vehicleType.charAt(0).toUpperCase() + vehicleType.slice(1)];
        }

        drawVisualization(filteredData);
    }
</script>
