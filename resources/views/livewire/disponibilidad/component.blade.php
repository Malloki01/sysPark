<div class="card">
    <div class="card-header text-center" style="background-color: #f8f9fa;">
        <h4 style="font-weight: bold; color: #4a4a4a;">Disponibilidad</h4>
    </div>
    <div class="card-body">
        <p>Carro: {{ $disponibilidad['carro'] }} libres</p>
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