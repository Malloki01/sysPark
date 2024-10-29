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
                        <!-- Opciones ajustadas para coincidir con los datos de la base de datos -->
                        <option value="all">Todos</option>
                        <option value="carro">Carro</option>
                        <option value="bicicleta">Bicicleta</option>
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
    // Cargar la biblioteca de Google Charts y llamar a fetchData cuando esté lista
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(fetchData);

    let originalData = []; // Inicializar como un array vacío para almacenar los datos reales

    // Función para obtener datos reales desde el backend
    function fetchData() {
        fetch('/obtener-datos')
            .then(response => response.json())
            .then(data => {
                console.log("Datos obtenidos del servidor:", data); // Agrega esta línea para ver los datos en la consola
                originalData = data;
                drawVisualization();
            })
            .catch(error => console.error('Error al obtener los datos:', error));
    }


    // Función para dibujar el gráfico
function drawVisualization(filteredData = null) {
    // Convertir los datos en un formato compatible con Google Charts
    const data = google.visualization.arrayToDataTable(
        filteredData || originalData
    );

    // Opciones de configuración del gráfico
    const options = {
        title: 'Número de Vehículos por Hora',
        vAxis: {
            title: 'Cantidad de Vehículos',
            viewWindow: {
                min: 0,
                max: 10
            }, // Rango de 0 a 10 (ajústalo si necesitas otro rango)
            ticks: [0, 2, 4, 6, 8, 10], // Intervalos de 2 en 2
            
            // Agrega el limite de referencia en el valor 7
            

            

        },
        hAxis: {
            title: 'Hora'
        },
        seriesType: 'bars', // Tipo de gráfico principal: barras
        series: {
            2: {
                type: 'line'
            }
        }, // Tipo de serie secundaria: línea
        lineWidth: 2,
        colors: ['#4285F4', '#DB4437'], // Colores para cada tipo de vehículo
        legend: {
            position: 'bottom'
        },

        // Ajusta el ancho de las barras
        bar: { groupWidth: "80%" } // Aumenta el valor para hacer las barras más anchas; prueba con "80%", "90%", o un tamaño fijo como "50px"
    };

    // Crear el gráfico y dibujarlo en el contenedor chart_div
    const chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}


    // Función para filtrar datos por tipo de vehículo y rango de horas
    function filterData() {
        // Obtener valores de los filtros
        const hourStart = document.getElementById('hourStartInput').value;
        const hourEnd = document.getElementById('hourEndInput').value;
        const vehicleType = document.getElementById('vehicleTypeSelect').value;

        // Clonar los datos originales para aplicar filtros sin modificar originalData
        let filteredData = originalData.map(row => row.slice());

        // Filtrar por rango de horas
        if (hourStart !== '' && hourEnd !== '') {
            filteredData = filteredData.filter(row => {
                const hour = row[0]; // Hora en el formato "HH:00"
                return (hour >= hourStart && hour <= hourEnd) || row[0] === 'Hora'; // Mantener la fila de encabezado
            });
        }

        // Filtrar por tipo de vehículo
        if (vehicleType !== 'all') {
            // Índice del tipo de vehículo en los datos (1 para carro y 2 para bicicleta)
            const vehicleTypeIndex = {
                'carro': 1,
                'bicicleta': 2
            } [vehicleType];

            // Crear un nuevo conjunto de datos solo con el tipo de vehículo seleccionado
            filteredData = filteredData.map(row => {
                if (row[0] === 'Hora') {
                    // Cambiar encabezado según el tipo de vehículo seleccionado
                    return ['Hora', vehicleType.charAt(0).toUpperCase() + vehicleType.slice(1)];
                }
                return [row[0], row[vehicleTypeIndex]]; // Mantener solo la hora y el tipo filtrado
            });
        }

        // Dibujar el gráfico con los datos filtrados
        drawVisualization(filteredData);
    }
</script>