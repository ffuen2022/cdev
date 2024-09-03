<div>
    <h4>SDR</h4>
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">

        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-info"><i class="bx bx-edit fs-3"></i></span>
                    </div>
                    @php

                    @endphp
                    <span class="d-block mb-1 text-nowrap">Sdr Total</span>
                    <h2 class="mb-0">{{ $totalSdr->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-warning"><i
                                class="bx bx-dock-top fs-3"></i></span>
                    </div>
                    <span class="d-block mb-1 text-nowrap">Archivos</span>
                    <h2 class="mb-0">17</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-primary"><i
                                class="bx bx-cube fs-3"></i></span>
                    </div>
                    @php
                    $DireccionA = 'Adquisicion'; // O el valor dinámico que necesites
                    $sdrunidadA = $totalSdr->filter(function($sdrdireccion) use ($DireccionA) {
                    return $sdrdireccion->unidad === $DireccionA;
                    })->count();
                    @endphp
                    <span class="d-block mb-1 text-nowrap">Adquisicion</span>
                    <h2 class="mb-0">{{ $sdrunidadA }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-md mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-success"><i
                                class="bx bx-purchase-tag fs-3"></i></span>
                    </div>

                    @php
                    $Direccion = 'secplan'; // O el valor dinámico que necesites
                    $sdrunidad = $totalSdr->filter(function($sdrdireccion) use ($Direccion) {
                    return $sdrdireccion->unidad === $Direccion;
                    })->count();
                    @endphp
                    <span class="d-block mb-1 text-nowrap">Secplan</span>
                    <h2 class="mb-0">{{ $sdrunidad }}</h2>
                </div>
            </div>
        </div>


    </div>
    <button type="button" wire:click="toggleEstado" class="btn btn-primary">@if ($nuevoSdr)
        Cerrar Sdr
        @else
        Nuevo Sdr
        @endif </button>
    @if ($nuevoSdr)
    <div class="col-lg-12" id="scrollable-card">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">SDR-DAO</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="form-group">
                        <label class="form-label" for="basic-default-company">Fecha</label>
                        <input type="date" wire:model.defer="fecha" class="form-control" id="basic-default-company">
                        @error('fecha')
                        <span class="text-danger">Falta el Campo Fecha</span>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label class="form-label" for="basic-default-company">Solicitado Por</label>
                        <input type="text" wire:model.defer="solicitado_por" class="form-control"
                            id="basic-default-company">
                        @error('solicitado_por')
                        <span class="text-danger">Falta el Campo Solicitante</span>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label>Unidad</label>
                        <select wire:model.defer="unidad" class="form-control" id="basic-default-company">
                            <option value="">Selecciona una unidad</option>
                            <option value="Adquisicion">Adquisicion</option>
                            <option value="Secplan">Secplan</option>
                        </select>
                        @error('unidad')
                        <span class="text-danger">Falta el Campo Unidad</span>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label class="form-label" for="basic-default-company">Fecha Unidad</label>
                        <input type="date" wire:model.defer="fecha_unidad" class="form-control"
                            id="basic-default-company">
                        @error('fecha_unidad')
                        <span class="text-danger">Falta el campo fecha</span>
                        @enderror
                    </div><br>
                 
                    <div class="form-group">
                        <label>Cuenta Presupuestaria</label>
                        <input type="text" wire:model.defer="cuenta_presupuestaria" class="form-control">
                        @error('cuenta_presupuestaria')
                        <span class="text-danger">Falta el campo Cuenta Presupuestaria</span>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label class="form-label" for="basic-default-company">Folio SDR</label>
                        <input type="text" wire:model.defer="folio_sdr" class="form-control" id="basic-default-company">
                        @error('folio_sdr')
                        <span class="text-danger">Falta el campo Folio SDR</span>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label>Materiales - Herramientas - Vehiculos</label>
                        <select wire:model.defer="selectedMaterial" id="materiales" class="form-control">
                            <option value="">Seleccione un Material | Herramienta | Vehiculo</option>
                            @foreach($materiales as $material)
                            <option value="{{ $material->id }}">{{ $material->materiales }}</option>
                            @endforeach
                        </select>
                        @error('selectedMaterial')
                        <span class="text-danger">Falta el campo Material</span>
                        @enderror

                    </div><br><br>
                    <div class="form-group">
                        <label>Justificacion Del Requerimiento</label>
                        <input wire:model.defer="justificacion_del_requerimiento" class="form-control">
                        @error('justificacion_del_requerimiento')
                        <span class="text-danger">Falta el campo Justificacion</span>
                        @enderror
                    </div>
                    <br><br>
                    <hr>

                    <h3>Solicitudes de Pedido</h3>

                    @foreach($solicitudes as $index => $solicitud)
                    <br><br>
                    <div class="form-group">
                        <label>Ingrese las Solicitudes:</label>
                        <input type="text" class="form-control"
                            wire:model.defer="solicitudes.{{ $index }}.numeroSolicitud"
                            placeholder="Número de Solicitud">
                        @error('solicitudes.' . $index . '.numeroSolicitud')
                        <span class="text-danger">Falta el campo Numero</span>
                        @enderror
                    </div>
                    <br>
                    <button type="button" class="btn btn-danger" wire:click="removeSolicitud({{ $index }})">Eliminar
                        Solicitud</button>

                    @endforeach

                    <button type="button" wire:click="addSolicitud" class="btn btn-success">Agregar
                        Solicitud</button><br><br>

                    <br><br>
                    <hr>

                    <h3>Productos</h3>
                    @foreach($products as $index => $product)
                    <div class="form-group">
                        <label>Item</label>
                        <input type="text" wire:model.defer="products.{{ $index }}.item" class="form-control">
                        @error('products.' . $index . '.item')
                        <span class="text-danger">Falta el campo item</span>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <input type="text" wire:model.defer="products.{{ $index }}.descripcion" class="form-control">
                        @error('products.' . $index . '.descripcion')
                        <span class="text-danger">Falta el campo Descripcion</span>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label>Unidad</label>
                        <input type="text" wire:model.defer="products.{{ $index }}.unidad_medida" class="form-control">
                        @error('products.' . $index . '.unidad_medida')
                        <span class="text-danger">Falta el campo Unidad Medida</span>
                        @enderror
                    </div><br>
                    <div class="form-group">
                        <label>Cantidad</label>
                        <input wire:model.defer="products.{{ $index }}.cantidad" class="form-control">
                        @error('products.' . $index . '.cantidad')
                        <span class="text-danger">Falta el campo Cantidad</span>
                        @enderror
                    </div><br>
                    <button type="button" class="btn btn-danger" wire:click="removeProduct({{ $index }})">Eliminar
                        Producto</button>
                    @endforeach
                    <button type="button" wire:click="addProduct" class="btn btn-success">Agregar
                        Producto</button><br><br>
                    <br>
                    <br>

                    <hr>

                    <h3>Cotizaciones</h3>
                    @foreach($cotizaciones as $index => $cotizacion)
                    <br><br>
                    <div class="form-group">
                      <label>Archivo Cotizacion</label>
                      <input type="file" class="form-control"
                      wire:model.defer="cotizaciones.{{ $index }}.archivo">
                    </div><br>
                    <button type="button" class="btn btn-danger"
                      wire:click="removeCotizacion({{ $index }})">Eliminar Cotizacion</button>
                    @endforeach
                    <button type="button" wire:click="addCotizacion" class="btn btn-success">Agregar
                        Cotizacion</button><br><br>

                    <br><br>
                    <hr>

                    <h3>Certificados</h3>

                    @foreach($certificados as $index => $certificado)
                    <br><br>
                    <div class="form-group">
                        <label>Adjuntar Certificados:</label>
                        <input type="text" class="form-control"
                            wire:model.defer="certificados.{{ $index }}.numeroCertificado"
                            placeholder="Número de certificado">
                        @error('certificados.' . $index . '.numeroCertificado')
                        <span class="text-danger">Falta el campo Numero</span>
                        @enderror
                        <br> <input type="date" class="form-control"
                            wire:model.defer="certificados.{{ $index }}.fechaCertificado"
                            placeholder="Fecha Certificado">
                        @error('certificados.' . $index . '.fechaCertificado')
                        <span class="text-danger">Falta el campo Fecha</span>
                        @enderror
                        <br> <input type="file" class="form-control"
                            wire:model.defer="certificados.{{ $index }}.archivoCertificado">
                        @error('certificados.' . $index . '.archivoCertificado')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <button type="button" class="btn btn-danger" wire:click="removeCertificado({{ $index }})">Eliminar
                        certificado</button>

                    @endforeach

                    <button type="button" wire:click="addCertificado" class="btn btn-success">Agregar
                        Certificado</button><br><br>





                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <!--<button type="button" wire:click="resetFields" class="btn btn-secondary">Cancelar</button>-->
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
            <!-- Mensajes de éxito -->
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif




            <!-- Tabla de Consolidados -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Solicitado Por</th>
                        <th>Direccion</th>
                        <th>Fecha Direccion</th>
                        <th>S-P-Asociada</th>
                        <th>Cuenta-P</th>
                        <th>Folio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($totalSdr as $sdr)
                    <tr>
                        <td>{{ $sdr->fecha }}</td>
                        <td>{{ $sdr->solicitado_por }}</td>
                        <td>{{ $sdr->unidad }}</td>
                        <td>{{ $sdr->fecha_unidad }}</td>
                        <td> @foreach($sdr->solicitud as $solicitud)
                            {{ $solicitud->numero_solicitud }}<br>
                            @endforeach</td>
                        <td>{{ $sdr->cuenta_presupuestaria }}</td>
                        <td>{{ $sdr->folio_sdr }}</td>
                        <td>
                            <button wire:click="edit({{ $sdr->id }})" class="btn btn-info btn-sm">Editar</button>
                            <button wire:click="printPdf({{ $sdr->id }})" class="btn btn-info btn-sm">Descargar</button>


                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            <!-- Formulario para agregar/editar -->

        </div>
    </div>

    <!-- Modal PDF -->
    <div wire:ignore.self class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="pdfModalLabel">SDR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-success"> Registro Guardado Correctamente </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal editar -->

    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Contenido del modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar SDR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form wire:submit.prevent="update">
                            <div class="form-group">
                                <label class="form-label" for="basic-default-company">Fecha</label>
                                <input type="date" wire:model.defer="mfecha" class="form-control"
                                    id="basic-default-company">
                            </div><br>
                            <div class="form-group">
                                <label class="form-label" for="basic-default-company">Solicitado Por</label>
                                <input type="text" wire:model.defer="msolicitado_por" class="form-control"
                                    id="basic-default-company">
                            </div><br>
                            <div class="form-group">
                                <label>Unidad</label>
                                <select wire:model.defer="munidad" class="form-control" id="basic-default-company">
                                    <option value="">Selecciona una unidad</option>
                                    <option value="Adquisicion">Adquisicion</option>
                                    <option value="Secplan">Secplan</option>
                                </select>
                            </div><br>
                            <div class="form-group">
                                <label class="form-label" for="basic-default-company">Fecha Unidad</label>
                                <input type="date" wire:model.defer="mfecha_unidad" class="form-control"
                                    id="basic-default-company">
                            </div><br>

                            <div class="form-group">
                                <label>Cuenta Presupuestaria</label>
                                <input type="text" wire:model.defer="mcuenta_presupuestaria" class="form-control">
                            </div><br>
                            <div class="form-group">
                                <label class="form-label" for="basic-default-company">Folio SDR</label>
                                <input type="text" wire:model.defer="mfolio_sdr" class="form-control"
                                    id="basic-default-company">
                            </div><br>
                            <div class="form-group">
                                <label>Materiales - Herramientas - Vehiculos</label>
                                <select wire:model.defer="mselectedMaterial" id="materiales" class="form-control">
                                    <option value="">Seleccione un Material | Herramienta | Vehiculo</option>
                                    @foreach($materiales as $material)
                                    <option value="{{ $material->id }}">{{ $material->materiales }}</option>
                                    @endforeach
                                </select>


                            </div><br><br>

                            <br><br>
                            <hr>

                            <h3>Solicitudes de Pedido</h3>

                            @foreach($msolicitudes as $index => $msolicitud)
                            <br><br>
                            <div class="form-group">
                                <label>Ingrese las Solicitudes:</label>
                                <input type="text" class="form-control"
                                    wire:model.defer="msolicitudes.{{ $index }}.numeroSolicitud"
                                    placeholder="Número de Solicitud">
                                @error('msolicitudes.' . $index . '.numeroSolicitud')
                                <span class="text-danger">Falta el campo Numero</span>
                                @enderror
                            </div>
                            <br>
                            <button type="button" class="btn btn-danger"
                                wire:click="mremoveSolicitud({{ $index }})">Eliminar
                                Solicitud</button>

                            @endforeach

                            <button type="button" wire:click="maddSolicitud" class="btn btn-success">Agregar
                                Solicitud</button><br><br>

                            <hr>
                            <h3>Productos</h3>
                            @foreach($mproducts as $index => $mproduct)
                            <div class="form-group">
                                <label>Item</label>
                                <input type="text" wire:model.defer="mproducts.{{ $index }}.item" class="form-control">
                            </div><br>
                            <div class="form-group">
                                <label>Descripcion</label>
                                <input type="text" wire:model.defer="mproducts.{{ $index }}.descripcion"
                                    class="form-control">
                            </div><br>
                            <div class="form-group">
                                <label>Unidad</label>
                                <input type="text" wire:model.defer="mproducts.{{ $index }}.unidad_medida"
                                    class="form-control">
                            </div><br>
                            <div class="form-group">
                                <label>Cantidad</label>
                                <input wire:model.defer="mproducts.{{ $index }}.cantidad" class="form-control">
                            </div><br>
                            <button type="button" class="btn btn-danger"
                                wire:click="mremoveProduct({{ $index }})">Eliminar Producto</button>
                            @endforeach
                            <button type="button" wire:click="maddProduct" class="btn btn-success">Agregar
                                Producto</button><br><br>
                            <br>
                            <div class="form-group">
                                <label>Justificacion Del Requerimiento</label>
                                <input wire:model.defer="mjustificacion_del_requerimiento" class="form-control">
                            </div><br><br>

                            @foreach($mcotizaciones as $index => $mcotizacion)
                            <br><br>
                            <div class="form-group">
                                <label>Archivo Cotizacion</label>
                                @if(isset($mcotizaciones[$index]['archivo']))
                                <a href="{{ Storage::url($mcotizaciones[$index]['archivo']) }}" target="_blank">Ver
                                    Cotizacion</a>
                                @endif
                                <input type="file" wire:model="mcotizaciones.{{ $index }}.nuevo_archivo"
                                    class="form-control">
                            </div><br>
                            <button type="button" class="btn btn-danger"
                                wire:click="mremoveCotizacion({{ $index }})">Eliminar Cotizacion</button>
                            @endforeach
                            <button type="button" wire:click="maddCotizacion" class="btn btn-success">Agregar
                                Cotizacion</button><br><br>

                            <br>

                            <br><br>

                            @foreach($mcertificados as $index => $mcertificado)

                            <div class="form-group">
                                <label>Número Certificado</label>
                                <input type="text" wire:model="mcertificados.{{ $index }}.numeroCertificado"
                                    class="form-control">
                            </div><br>
                            <div class="form-group">
                                <label>Fecha Certificado</label>
                                <input type="date" wire:model="mcertificados.{{ $index }}.fechaCertificado"
                                    class="form-control">
                            </div><br>
                            <div class="form-group">
                                <label>Archivo Certificado</label>
                                @if(isset($mcertificados[$index]['archivoCertificado']))
                                <a href="{{ Storage::url($mcertificados[$index]['archivoCertificado']) }}"
                                    target="_blank">Ver Certificado</a>
                                @endif
                                <input type="file" wire:model="mcertificados.{{ $index }}.nuevo_archivo"
                                    class="form-control">
                            </div><br>
                            <button type="button" class="btn btn-danger"
                                wire:click="mremoveCertificado({{ $index }})">Eliminar Certificado</button>
                            @endforeach
                            <button type="button" wire:click="maddCertificado" class="btn btn-success">Agregar
                                Certificado</button><br><br>

                            <br>


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