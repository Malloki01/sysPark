<div class="widget-content-area">
    <div class="widget-one">
        @include('common.messages') <!-- Mostrar mensajes de éxito o error -->
        
        <div class="widget-content-area br-4">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5>FORMULARIO</h5>
                    </div>
                </div>
            </div>
        
        <div class="row">
            <!-- DNI -->
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label>DNI</label>
                <input type="text" wire:model.lazy="dni" class="form-control" placeholder="Ingrese el DNI" maxlength="8">
                @error('dni') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Nombres -->
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label>Nombres</label>
                <input type="text" wire:model.lazy="nombres" class="form-control" placeholder="Ingrese los nombres">
                @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Apellidos -->
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label>Apellidos</label>
                <input type="text" wire:model.lazy="apellidos" class="form-control" placeholder="Ingrese los apellidos">
                @error('apellidos') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Teléfono -->
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label>Teléfono</label>
                <input type="text" wire:model.lazy="telefono" class="form-control" placeholder="Ingrese el teléfono" maxlength="10">
                @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Correo Institucional -->
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label>Correo</label>
                <input type="email" wire:model.lazy="correo" class="form-control" placeholder="Ingrese el correo">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Tipo de Vehículo -->
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label>Tipo de Vehículo</label>
                <select wire:model="tipo" class="form-control text-center">
                    <option value="">Seleccione</option>
                    <option value="carro">Carro</option>
                    <option value="moto">Moto</option>
                    <option value="bicicleta">Bicicleta</option>
                </select>
                @error('tipo_vehiculo') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Número de Placa -->
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label>Número de Placa</label>
                <input type="text" wire:model.lazy="nro_placa" class="form-control" placeholder="Ingrese la placa (opcional)">
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="row">
            <div class="col-lg-6 mt-2 text-left">
                <button type="button" wire:click="doAction(1)" class="btn btn-dark">
                    <i class="mbri-left"></i> Regresar
                </button>
            </div>
            <div class="col-lg-6 mt-2 text-right">
                <button wire:click.prevent="storeOrUpdate()" type="button" class="btn btn-primary">
                    <i class="mbri-success"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
