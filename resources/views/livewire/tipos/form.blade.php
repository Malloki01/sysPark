<!-- Agregado reciente -->
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">
                <h5>
                    <b>
                        @if ($selected_id == 0)
                            Crear Tipo
                        @else
                            Editar Tipo
                        @endif
                    </b>
                </h5>
                <div class="row">
                    <div class="col-sm-14 col-lg-25 col-md-25 ">
                        <label>Descripción</label>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg></span>
                            </div>
                            <input type="text" class="form-control" autofocus{{-- placeholder="Tipo" --}}
                                wire:model.lary="descripcion">
                        </div>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="column">
                    <div class="col-lg-5 mt-2 d-flex justify-content-start">
                        <button type="button" wire:click="doAction(1)" class="btn btn-outline-danger btn-rounded mr-1">
                            <i class="mbri-left"></i> Regresar
                        </button>
                        <button type="button" wire:click="StoreOrUpdate()" class="btn btn-outline-success btn-rounded">
                            <i class="mbri-success"></i> Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>