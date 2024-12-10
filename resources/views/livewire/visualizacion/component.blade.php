<div class="container mt-5">
    <div class="row">
    <div class="mb-3">
            <!-- Label de DNI arriba -->
            <label for="dniInput" class="form-label">DNI:</label>
            
            <!-- Input debajo del label -->
            <input type="text" id="dniInput" class="form-control mb-2" style="max-width: 200px;">
            
            <!-- Botón debajo del input -->
            <button class="btn btn-primary" onclick="fetchData()">Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <h2 class="text-center" style="font-size: 20px; font-weight: bold; color: #007bff;">
                    Datos de la persona
                </h2>
                <div id="chart_div" style="width: 100%; height: 400px;">
                    <!-- Aquí se mostrarán los datos obtenidos -->
                    <table class="table table-bordered" id="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DNI</th>
                                <th>Placa del Vehículo</th>
                                <th>Tipo</th>
                                <th>Hora de Entrada</th>
                                <th>Hora de Salida</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Las filas de datos se agregarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function fetchData() {
        const dni = document.getElementById('dniInput').value;

        if (dni === "") {
            alert("Por favor ingresa un DNI válido.");
            return;
        }

        // Solicita a la ruta correcta sin el prefijo /api/
        fetch(`/registros?dni=${dni}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener los datos');
                }
                return response.json();
            })
            .then(data => {
                const tableBody = document.querySelector('#data-table tbody');
                tableBody.innerHTML = ''; // Limpiar la tabla antes de agregar los nuevos datos

                // Verifica si hay datos
                if (data.length > 0) {
                    data.forEach(record => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${record.id}</td>
                            <td>${record.dni}</td>
                            <td>${record.placa_vehiculo}</td>
                            <td>${record.tipo}</td>
                            <td>${record.hora_entrada}</td>
                            <td>${record.hora_salida}</td>
                            <td>${record.fecha}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                } else {
                    alert("No se encontraron registros para el DNI ingresado.");
                }
            })
            .catch(error => {
                console.error("Error al obtener los datos:", error);
                alert("Ocurrió un error al intentar obtener los datos. Intenta de nuevo.");
            });
    }
</script>