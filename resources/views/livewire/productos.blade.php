<div>
    <h4>Productos</h4>
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">

        </div>    
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">

        </div>
        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-5 col-7 mb-5">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-info"><i class="bx bx-edit fs-3"></i></span>
                    </div>
                    @php

                    @endphp
                    <span class="d-block mb-1 text-nowrap">Tipos De Productos En Total</span>
                    <h2 class="mb-0">{{ $productos->count() }}</h2>
                </div>
            </div>
        </div>

    </div>
     <!-- Mensajes de éxito -->
     @if (session()->has('message'))
     <div class="alert alert-success">
         {{ session('message') }}
     </div>
     @endif
    <button type="button" wire:click="toggleEstado" class="btn btn-primary">@if ($nuevoProducto)
        Cerrar Producto
        @else
        Nuevo Producto
        @endif </button>
    @if ($nuevoProducto)
    <div class="col-lg-12" id="scrollable-card">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Inventario Productos</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="saveProductos">
                    <div class="form-group">
                        <label class="form-label" for="basic-default-company">Descripcion</label>
                        <input type="text" wire:model.defer="pdescripcion" class="form-control"
                            id="basic-default-company">
                    </div><br>
                    <div class="form-group">
                        <label>Lote</label>
                        <select wire:model.defer="plote" class="form-control" id="basic-default-company">
                            <option value="">Lote</option>
                            <option value="p1">P1</option>
                            <option value="p2">p2</option>
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label class="form-label" for="basic-default-company">Entradas</label>
                        <input type="text" wire:model.defer="pentradas" class="form-control" id="basic-default-company">
                    </div><br>

                    <div class="form-group">
                        <label class="form-label" for="basic-default-company">Salidas</label>
                        <input type="text" wire:model.defer="psalidas" class="form-control" id="basic-default-company">
                    </div><br>  

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" wire:click="resetFields" class="btn btn-secondary">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
    @endif
    <br><br>
    <input type="text" wire:model="search" placeholder="Buscar..." class="form-control mb-3">
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">

            <!-- Tabla de Consolidados -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Codigo Producto</th>
                        <th>Descripcion</th>
                        <th>Lote</th>
                        <th>Entradas</th>
                        <th>Salidas</th>
                        <th>Stock Actual</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->lote }}</td>
                        <td>{{ $producto->entradas }}</td>
                        <td>{{ $producto->salidas }}</td>
                        <td>{{ $producto->stockActual }}</td>
                        <td>
                            <button wire:click="productoEdit({{ $producto->id }})" class="btn btn-primary">Editar</button>

                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    <!-- Modal editar -->

    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Contenido del modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form wire:submit.prevent="productoUpdate">
                            <div class="form-group">
                                <label class="form-label" for="basic-default-company">Descripcion</label>
                                <input type="text" wire:model.defer="mpdescripcion" class="form-control"
                                    id="basic-default-company">
                            </div><br>
                            <div class="form-group">
                                <label>Lote</label>
                                <select wire:model.defer="mplote" class="form-control" id="basic-default-company">
                                    <option value="">Lote</option>
                                    <option value="p1">P1</option>
                                    <option value="p2">p2</option>
                                </select>
                            </div><br>

                            <div class="form-group">
                                <label class="form-label" for="basic-default-company">Entradas</label>
                                <input type="text" wire:model.defer="mpentradas" class="form-control" id="basic-default-company">
                            </div><br>

                            <div class="form-group">
                                <label class="form-label" for="basic-default-company">Salidas</label>
                                <input type="text" wire:model.defer="mpsalidas" class="form-control" id="basic-default-company">
                            </div><br> 
                            
                            <div class="form-group">
                                <label class="form-label" for="basic-default-company">Stock Actual</label>
                                <input type="text" wire:model.defer="mpstock_actual" class="form-control" id="basic-default-company">
                            </div><br> 

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts for modal handling -->
    <script>
        document.addEventListener('livewire:load', function () {
        @this.on('showPdfModal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('pdfModal'), {
                keyboard: false
            });
            myModal.show();
        });

        @this.on('openEditModal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
                keyboard: false,
                backdrop: 'static',
            });
            myModal.show();
        });
        

        @this.on('closeEditModal', () => {
            var myModalEl = document.getElementById('editModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
        });
        
    });

    </script>


</div>