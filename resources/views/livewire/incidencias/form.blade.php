<div class="row layout-top-spacing justify-content-center">
    <style>
        .row {
            justify-content: center;
        }
    </style>

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">
                <h5 class="text-center">
                    <b>
                        @if ($selected_id == 0)
                        Crear Incidencia
                        @else
                        Editar Incidencia
                        @endif
                    </b>
                </h5>

                <div class="row">
                    <div class="col-sm-12 col-lg-8 col-md-8 mb-4">
                        <label>Título</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Ingrese el título"
                                wire:model.defer="titulo" autofocus>
                        </div>
                        @error('titulo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-sm-12 col-lg-8 col-md-8 mb-4">
                        <label>Descripción</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </span>
                            </div>
                            <textarea class="form-control" rows="3" placeholder="Ingrese la descripción"
                                wire:model.defer="descripcion"></textarea>
                        </div>
                        @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <!-- Campo para subir imagen -->
                    <div class="col-sm-12 col-lg-8 col-md-8 mb-4 ">
                        <label>Subir Imagen</label>
                        <div class="input-group">                  
                                                     <!-- wire:model="image" -->
                            <input type="file" class="form-control" accept="image/*">
                        </div>
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 justify-content-center mt-3  d-flex">
                    <button type="button" wire:click="doAction(1)" class="btn btn-outline-danger btn-rounded mr-1">
                        <i class="mbri-left"></i> Regresar
                    </button>
                    <button type="button" wire:click="StoreOrUpdate" class="btn btn-outline-success btn-rounded">
                        <i class="mbri-success"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>