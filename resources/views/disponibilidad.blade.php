<div class="card">
    <div class="card-header text-center">
        <h4>Disponibilidad</h4>
    </div>
    <div class="card-body">
        <p>Automovil: {{ $disponibilidad['automovil'] }} libres</p>
        <p>Moto: {{ $disponibilidad['moto'] }} libres</p>
        <p>Scooter eléctrico: {{ $disponibilidad['scooter'] }} libres</p>
        <p>Bicicleta: 
            @if ($disponibilidad['bicicleta'] == 0)
                lleno
            @else
                {{ $disponibilidad['bicicleta'] }} libres
            @endif
        </p>
    </div>
</div>
