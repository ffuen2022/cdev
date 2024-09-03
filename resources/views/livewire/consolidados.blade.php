<div>
  <h4>Consolidado</h4>
  <div class="row">
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-danger"><i
                class="bx bx-message-square-detail fs-3"></i></span>
          </div>
          <span class="d-block mb-1 text-nowrap">Consolidados Total</span>
          <h2 class="mb-0">{{ $consolidados->count() }}</h2>

        </div>
      </div>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-warning"><i class="bx bx-dock-top fs-3"></i></span>
          </div>
          @php
          $estadoS = 'Solicitud Ingresada'; // O el valor dinámico que necesites
          $estadoCountS = $consolidados->filter(function($consolidado) use ($estadoS) {
          return $consolidado->estado === $estadoS;
          })->count();
          @endphp
          <span class="d-block mb-1 text-nowrap">Solicitudes</span>
          <h2 class="mb-0">{{ $estadoCountS }}</h2>
        </div>
      </div>
    </div>

    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-info"><i class="bx bx-edit fs-3"></i></span>
          </div>
          @php
          $estadoO = 'Orden de Compra Ingresada';
          $estadoCount = $consolidados->filter(function($consolidado) use ($estadoO) {
          return $consolidado->estado === $estadoO;
          })->count();
          @endphp
          <span class="d-block mb-1 text-nowrap">Estado Orden Compra</span>
          <h2 class="mb-0">{{ $estadoCount }}</h2>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-cube fs-3"></i></span>
          </div>
          @php
          $estadoR = 'Recepción Ingresada'; // O el valor dinámico que necesites
          $estadoRecepcion = $consolidados->filter(function($consolidado) use ($estadoR) {
          return $consolidado->estado === $estadoR;
          })->count();
          @endphp
          <span class="d-block mb-1 text-nowrap">Estado Recepcion</span>
          <h2 class="mb-0">{{ $estadoRecepcion }}</h2>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-purchase-tag fs-3"></i></span>
          </div>

          @php
          $estadoF = 'Factura Ingresada'; // O el valor dinámico que necesites
          $estadoFactura = $consolidados->filter(function($consolidado) use ($estadoF) {
          return $consolidado->estado === $estadoF;
          })->count();
          @endphp
          <span class="d-block mb-1 text-nowrap">Estado Facturas</span>
          <h2 class="mb-0">{{ $estadoFactura }}</h2>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="avatar avatar-md mx-auto mb-3">
            <span class="avatar-initial rounded-circle bg-label-danger"><i class="bx bx-cart fs-3"></i></span>
          </div>

          <span class="d-block mb-1 text-nowrap">Productos Inventario</span>
          <h2 class="mb-0">40</h2>
        </div>
      </div>
    </div>
  </div>


  <!-- Buscador -->
  <input type="text" wire:model="csearch" placeholder="Buscar..." class="form-control mb-3">

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
            <th>Folio Sdr</th>
            <th>F-I-Sp</th>
            <th>F.Recepcion</th>
            <th>Direccion</th>
            <th>N.Certificado</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($consolidados as $consolidado)
          <tr>
            <td>{{ $consolidado->sdrDao->folio_sdr }}</td>
            <td>{{ $consolidado->sdrDao->fecha }}</td>
            <td>{{ $consolidado->sdrDao->fecha_unidad }}</td>
            <td>{{ $consolidado->sdrDao->unidad }}</td>
            <td>
              @foreach($consolidado->sdrDao->certificados as $certificado)
              <p>{{ $certificado->numero_certificado }}</p>
              @endforeach
            </td>
            <td>
              @foreach($consolidado->sdrDao->sdrproductos as $producto)
              <p>{{ $producto->descripcion }}</p>
              @endforeach
            </td>
            <td> <span class="badge 
                        @if($consolidado->estado === 'Factura Ingresada')
                            bg-label-success
                        @elseif($consolidado->estado === 'Recepción Ingresada')
                            bg-label-primary 
                        @elseif($consolidado->estado === 'Orden de Compra Ingresada')
                            bg-label-info 
                        @elseif($consolidado->estado === 'Solicitud Ingresada')
                            bg-label-warning 
                            
                    
                        @endif
                        me-1">{{ $consolidado->estado }}</span>
            </td>
            <td>
              <button type="button" class="btn btn-info btn-sm" wire:click="consolidadoEdit({{ $consolidado->id }})"
                data-bs-toggle="modal" data-bs-target="#detailsModal">Ver Detalles</button>
            </td>

          </tr>
          @endforeach
        </tbody>
      </table>

      {{ $consolidados->links() }}
      <!-- Paginación -->
      <!-- Formulario para agregar/editar -->


    </div>
  </div>

  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="consolidadoEditModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailsModalLabel">Detalles del Consolidado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-lg-12" id="scrollable-card">
            <div class="card mb-4">
              <div class="card-body">
                <form wire:submit.prevent="consolidadoGuardar">
                  <div class="form-group">
                    <label class="form-label" for="basic-default-company">Fecha Ing. SP</label>
                    <input type="date" wire:model.defer="cfecha_ing_sp" class="form-control" id="basic-default-company">
                  </div><br>
                  <div class="form-group">
                    <label>Fecha Recepción</label>
                    <input type="date" wire:model.defer="cfecha_recepcion_direccion" class="form-control"
                      id="basic-default-company">
                  </div><br>
                  <div class="form-group">
                    <label>Direccion</label> <select wire:model.defer="cdireccion" class="form-control"
                      id="basic-default-company">
                      <option value="">Selecciona una unidad</option>
                      <option value="Adquisicion">Adquisicion</option>
                      <option value="Secplan">Secplan</option>
                    </select>
                  </div>

                  <br><br>

             
                  <div class="form-group">
                    <label>Estado</label>
                    <input type="text" wire:model.defer="cestado" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Descripción</label>
                    <textarea wire:model.defer="cdescripcion" class="form-control"></textarea>
                  </div><br>
                  <div class="form-group">
                    <label>Unidad</label>
                    <input type="text" wire:model.defer="cunidad" class="form-control">
                  </div><br>

                  <div class="form-group">
                    <label>Observaciones</label>
                    <textarea wire:model.defer="cobservaciones" class="form-control"></textarea>
                  </div>
                  <br>
                  <br>
                  <hr>

                  <h3>Productos</h3>

                  @foreach($cproducts as $index => $cproduct)
                  <div class="form-group">
                    <br>
                    <label>Item</label>
                    <input type="text" wire:model="cproducts.{{ $index }}.item" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Descripcion</label>
                    <input type="text" wire:model="cproducts.{{ $index }}.descripcion" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Unidad</label>
                    <input type="text" wire:model="cproducts.{{ $index }}.unidad_medida" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Cantidad</label>
                    <input wire:model="cproducts.{{ $index }}.cantidad" class="form-control">
                  </div><br>
                  <button type="button" class="btn btn-danger"
                    wire:click="consolidadoRemoveProduct({{ $index }})">Eliminar Producto</button>
                  @endforeach
                  <button type="button" wire:click="consolidadoAddProduct" class="btn btn-success">Agregar
                    Producto</button><br><br>
                  <br><br>
                  <hr>

                  <h3>Certificados</h3>
                  @foreach($ccertificados as $index => $ccertificado)

                  <div class="form-group">
                    <br><br>
                    <label>Número Certificado</label>
                    <input type="text" wire:model="ccertificados.{{ $index }}.numeroCertificado" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Fecha Certificado</label>
                    <input type="date" wire:model="ccertificados.{{ $index }}.fechaCertificado" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Archivo Certificado</label>
                    @if(isset($ccertificados[$index]['archivoCertificado']))
                    <a href="{{ Storage::url($ccertificados[$index]['archivoCertificado']) }}" target="_blank">Ver
                      Certificado</a>
                    @endif
                    <input type="file" wire:model="ccertificados.{{ $index }}.nuevo_archivo" class="form-control">
                  </div><br>
                  <button type="button" class="btn btn-danger"
                    wire:click="consolidadoRemoveCertificado({{ $index }})">Eliminar Certificado</button>
                  @endforeach
                  <button type="button" wire:click="consolidadoAddCertificado" class="btn btn-success">Agregar
                    Certificado</button><br><br>

                  <br><br><br>

                  <hr>


                  <h3>Cotizaciones</h3>

                  @foreach($ccotizaciones as $index => $ccotizacion)
                  <br><br>
                  <div class="form-group">
                    <label>Archivo Cotizacion</label>
                    @if(isset($ccotizaciones[$index]['archivo']))
                    <a href="{{ Storage::url($ccotizaciones[$index]['archivo']) }}" target="_blank">Ver Cotizacion</a>
                    @endif
                    <input type="file" wire:model="ccotizaciones.{{ $index }}.nuevo_archivo" class="form-control">
                  </div><br>
                  <button type="button" class="btn btn-danger"
                    wire:click="consolidadoRemoveCotizacion({{ $index }})">Eliminar Cotizacion</button>
                  @endforeach
                  <button type="button" wire:click="consolidadoAddCotizacion" class="btn btn-success">Agregar
                    Cotizacion</button><br><br>

                  <br>

                  <br>
                  <hr>

                  <h3>Solicitudes Timbradas</h3>

                  @foreach($csolicitudPedidoTimbradas as $index => $csolicitudPedidoTimbrada)
                  <div class="form-group">
                    <br><br>
                    <label>Número Solicitud Pedido</label>
                    <input type="text" wire:model="csolicitudPedidoTimbradas.{{ $index }}.numeroSolicitud"
                      class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Fecha Solicitud Pedido</label>
                    <input type="date" wire:model="csolicitudPedidoTimbradas.{{ $index }}.fechaSolicitud"
                      class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Archivo Solicitud Pedido</label>
                    @if(isset($csolicitudPedidoTimbradas[$index]['archivo']))
                    <a href="{{ Storage::url($csolicitudPedidoTimbradas[$index]['archivo']) }}" target="_blank">Ver
                      Solicitud</a>
                    @endif
                    <input type="file" wire:model="csolicitudPedidoTimbradas.{{ $index }}.nuevo_archivo"
                      class="form-control">
                  </div><br>
                  <button type="button" class="btn btn-danger"
                    wire:click="consolidadoRemoveSolicitud({{ $index }})">Eliminar Solicitud</button>
                  @endforeach
                  <button type="button" wire:click="consolidadoAddSolicitud" class="btn btn-success">Agregar
                    Solicitud</button><br><br>

                  <br>

                  <br><br>
                  <hr>
                  <h3>Ordenes de Compra</h3>

                  @foreach($cordenCompras as $index => $cordenCompra)
                  <div class="form-group">
                    <br><br>
                    <label>Número OrdenCompra</label>
                    <input type="text" wire:model="cordenCompras.{{ $index }}.numeroOrden" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Fecha OrdenCompra</label>
                    <input type="date" wire:model="cordenCompras.{{ $index }}.fechaOrden" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Archivo Orden de Compra</label>
                    @if(isset($cordenCompras[$index]['archivo']))
                    <a href="{{ Storage::url($cordenCompras[$index]['archivo']) }}" target="_blank">Ver Solicitud</a>
                    @endif
                    <input type="file" wire:model="cordenCompras.{{ $index }}.nuevo_archivo" class="form-control">
                  </div><br>
                  <button type="button" class="btn btn-danger"
                    wire:click="consolidadoRemoveOrdenCompra({{ $index }})">Eliminar Orden de Compra</button>
                  @endforeach
                  <button type="button" wire:click="consolidadoAddOrdenCompra" class="btn btn-success">Agregar Orden de Compra</button><br><br>

                  <br>

                  <br><br>
                  <hr>
                  <h3>Recepcion Producto / Servicio</h3>

                  @foreach($crecepciones as $index => $crecepcion)
                  <div class="form-group">
                    <br><br>
                    <label>Número Recepcion</label>
                    <input type="text" wire:model="crecepciones.{{ $index }}.numeroRecepcion" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Fecha Recepcion</label>
                    <input type="date" wire:model="crecepciones.{{ $index }}.fechaRecepcion" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Archivo Recepcion</label>
                    @if(isset($crecepciones[$index]['archivo']))
                    <a href="{{ Storage::url($crecepciones[$index]['archivo']) }}" target="_blank">Ver Solicitud</a>
                    @endif
                    <input type="file" wire:model="crecepciones.{{ $index }}.nuevo_archivo" class="form-control">
                  </div><br>
                  <button type="button" class="btn btn-danger"
                    wire:click="consolidadoRemoveRecepcion({{ $index }})">Eliminar Orden de Compra</button>
                  @endforeach
                  <button type="button" wire:click="consolidadoAddRecepcion" class="btn btn-success">Agregar Recepcion</button><br><br>

                  <br>

                  <br><br>

                  <hr>
                  <h3>Facturas</h3>

                  @foreach($cfacturas as $index => $cfactura)
                  <div class="form-group">
                    <br><br>
                    <label>Número Factura</label>
                    <input type="text" wire:model="cfacturas.{{ $index }}.numeroFactura" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Fecha Factura</label>
                    <input type="date" wire:model="cfacturas.{{ $index }}.fechaFactura" class="form-control">
                  </div><br>
                  <div class="form-group">
                    <label>Archivo Factura</label>
                    @if(isset($cfacturas[$index]['archivo']))
                    <a href="{{ Storage::url($cfacturas[$index]['archivo']) }}" target="_blank">Ver Solicitud</a>
                    @endif
                    <input type="file" wire:model="cfacturas.{{ $index }}.nuevo_archivo" class="form-control">
                  </div><br>
                  <button type="button" class="btn btn-danger"
                    wire:click="consolidadoRemoveFactura({{ $index }})">Eliminar Factura</button>
                  @endforeach
                  <button type="button" wire:click="consolidadoAddFactura" class="btn btn-success">Agregar
                    Factura</button><br><br><br><br>
                  <hr>



                  <button type="submit" class="btn btn-success">Guardar</button>
                 <!--  <button type="button" wire:click="consolidadoResetForm" class="btn btn-secondary">Cancelar</button>-->
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('livewire:load', function () {
    
        @this.on('openEditModal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('consolidadoEditModal'), {
                keyboard: false,
                backdrop: 'static',
            });
            myModal.show();
        });

        @this.on('closeEditModal', () => {
            var myModalEl = document.getElementById('consolidadoEditModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
        });
        
    });
  </script>
</div>