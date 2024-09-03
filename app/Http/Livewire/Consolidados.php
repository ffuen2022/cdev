<?php

namespace App\Http\Livewire;

use App\Models\SdrDao;
use Livewire\Component;
use App\Models\Cotizacion;
use App\Models\Certificado;
use App\Models\Consolidado;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Consolidados extends Component
{
    use WithFileUploads;
    use WithPagination;



    public $csearch = '';
    public $seleccionar_consolidado;
    #Variable Form Consolidado Model
    public $cfecha_ing_sp = '';
    public $cfecha_recepcion_direccion = '';
    public $cdireccion = '';
    public $cestado = '';
    public $cunidad = '';
    public $cdescripcion = '';
    public $cobservaciones = '';

    #variables
    public $cfecha_certificado;
    public $csolicitud_de_pedido_asociada = '';

    public $cfacturas = [
        ['numeroFactura' => '', 'archivo' => null, 'fechaFactura' => '']
    ];

    public $crecepciones = [
        ['numeroRecepcion' => '', 'archivo' => null, 'fechaRecepcion' => '']
    ];

    public $cordenCompras = [
        ['numeroOrden' => '', 'archivo' => null, 'fechaOrden' => '']
    ];

    public $csolicitudPedidoTimbradas = [
        ['numeroSolicitud' => '', 'archivo' => null, 'fechaSolicitud' => '']
    ];

    public $ccertificados = [
        ['numeroCertificado' => '', 'archivoCertificado' => null, 'fechaCertificado' => '']
    ];
    public $cproducts = [
        ['item' => '', 'descripcion' => '', 'unidad_medida' => '', 'cantidad' => '']
    ];
    public $ccotizaciones = [];


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function consolidadoAddProduct()
    {
        $this->cproducts[] = ['item' => '', 'descripcion' => '', 'unidad_medida' => '', 'cantidad' => ''];
    }

    public function consolidadoRemoveProduct($index)
    {
        unset($this->cproducts[$index]);
        $this->cproducts = array_values($this->cproducts);
    }

    public function consolidadoAddCertificado()
    {
        $this->ccertificados[] = [
            'numeroCertificado' => '',
            'archivoCertificado' => null,
            'fechaCertificado' => ''
        ];
    }

    public function consolidadoRemoveCertificado($index)
    {
        unset($this->ccertificados[$index]);
        $this->ccertificados = array_values($this->ccertificados);
    }


    public function consolidadoAddFactura()
    {
        $this->cfacturas[] = [
            'numeroFactura' => '',
            'archivo' => null,
            'fechaFactura' => ''
        ];
    }

    public function consolidadoRemoveFactura($index)
    {
        unset($this->cfacturas[$index]);
        $this->cfacturas = array_values($this->cfacturas);
    }


    public function consolidadoAddRecepcion()
    {
        $this->crecepciones[] = [
            'numeroRecepcion' => '',
            'archivo' => null,
            'fechaRecepcion' => ''
        ];
    }

    public function consolidadoRemoveRecepcion($index)
    {
        unset($this->crecepciones[$index]);
        $this->crecepciones = array_values($this->crecepciones);
    }

    public function consolidadoAddOrdenCompra()
    {
        $this->cordenCompras[] = [
            'numeroOrden' => '',
            'archivo' => null,
            'fechaOrden' => ''
        ];
    }

    public function consolidadoRemoveOrdenCompra($index)
    {
        unset($this->cordenCompras[$index]);
        $this->cordenCompras = array_values($this->cordenCompras);
    }


    public function consolidadoAddCotizacion()
    {
        $this->ccotizaciones[] = [
            'archivo' => null,

        ];
    }

    public function consolidadoRemoveCotizacion($index)
    {
        unset($this->ccotizaciones[$index]);
        $this->ccotizaciones = array_values($this->ccotizaciones);
    }

    public function consolidadoAddSolicitud()
    {
        $this->csolicitudPedidoTimbradas[] = [
            'archivo' => null,
            'numeroSolicitud'=> ''

        ];
    }

    public function consolidadoRemoveSolicitud($index)
    {
        unset($this->csolicitudPedidoTimbradas[$index]);
        $this->csolicitudPedidoTimbradas = array_values($this->csolicitudPedidoTimbradas);
    }

    public function consolidadoResetForm()
    {
        $this->reset([
            'cfecha_ing_sp',
            'cfecha_recepcion_direccion',
            'cdireccion',
            'cunidad',
            'cdescripcion',
            'cobservaciones',
            'csolicitud_de_pedido_asociada',
            'cproducts',
            'ccotizaciones',
            'ccertificados'
        ]);
    }


    public function consolidadoEdit($id)
    {
        $this->consolidadoResetForm();
        $this->seleccionar_consolidado = Consolidado::with([
            'sdrDao.certificados',
            'sdrDao.cotizacions',
            'sdrDao.sdrproductos'
        ])
            ->findOrFail($id);

        // Datos de Consolidado
        $this->cfecha_ing_sp = $this->seleccionar_consolidado->sdrDao->fecha;
        $this->cfecha_recepcion_direccion = $this->seleccionar_consolidado->fecha_recepcion_direccion;
        $this->cdireccion = $this->seleccionar_consolidado->direccion;
        $this->cestado = $this->seleccionar_consolidado->estado;

        $this->cunidad = $this->seleccionar_consolidado->unidad;
        $this->cdescripcion = $this->seleccionar_consolidado->descripcion;
        $this->cobservaciones = $this->seleccionar_consolidado->observaciones;

        // Datos de SdrDao
        $sdr_dao = $this->seleccionar_consolidado->sdrDao;
        $this->csolicitud_de_pedido_asociada = $sdr_dao->solicitud_de_pedido_asociada;


        // Manejar productos
        $this->cproducts = $sdr_dao->sdrproductos ? $sdr_dao->sdrproductos->map(function ($cproducto) {
            return [
                'item' => $cproducto->item,
                'descripcion' => $cproducto->descripcion,
                'unidad_medida' => $cproducto->unidad_medida,
                'cantidad' => $cproducto->cantidad,
            ];
        })->toArray()
            : [];

        // Manejar cotizaciones
        $this->ccotizaciones = $sdr_dao->cotizacions ? $sdr_dao->cotizacions->map(function ($ccotizacion) {
            return [
                'archivo' => $ccotizacion->archivo,
            ];
        })->toArray() : [];

        // Manejar Certificados
        $this->ccertificados = $sdr_dao->certificados ? $sdr_dao->certificados->map(function ($ccertificado) {
            return [
                'numeroCertificado' => $ccertificado->numero_certificado,
                'archivoCertificado' => $ccertificado->archivo, // Ajusta aquí el campo para la URL del archivo
                'fechaCertificado' => $ccertificado->fecha_emision,
            ];
        })->toArray() : [];

        // Manejar solicitudes
        $this->csolicitudPedidoTimbradas = $sdr_dao->solicitud ? $sdr_dao->solicitud->map(function ($csolicitudPedidoTimbrada) {
            return [
                'numeroSolicitud' => $csolicitudPedidoTimbrada->numero_solicitud,
                'archivo' => $csolicitudPedidoTimbrada->archivo, // Ajusta aquí el campo para la URL del archivo
                'fechaSolicitud' => $csolicitudPedidoTimbrada->fecha_emision,
            ];
        })->toArray() : [];

        // Manejar Ordenes
        $this->cordenCompras = $sdr_dao->ordencompra ? $sdr_dao->ordencompra->map(function ($cordenCompra) {
            return [
                'numeroOrden' => $cordenCompra->numero_orden,
                'archivo' => $cordenCompra->archivo, // Ajusta aquí el campo para la URL del archivo
                'fechaOrden' => $cordenCompra->fecha_emision,
            ];
        })->toArray() : [];

        // Manejar Recepciones
        $this->crecepciones = $sdr_dao->recepciones ? $sdr_dao->recepciones->map(function ($recepcion) {
            return [
                'numeroRecepcion' => $recepcion->numero_recepcion,
                'archivo' => $recepcion->archivo, // Ajusta aquí el campo para la URL del archivo
                'fechaRecepcion' => $recepcion->fecha_emision,
            ];
        })->toArray() : [];

        // Manejar Facturas
        $this->cfacturas = $sdr_dao->facturas ? $sdr_dao->facturas->map(function ($factura) {
            return [
                'numeroFactura' => $factura->numero_factura,
                'archivo' => $factura->archivo, // Ajusta aquí el campo para la URL del archivo
                'fechaFactura' => $factura->fecha_emision,
            ];
        })->toArray() : [];



        // Emitir un evento para mostrar el modal
        $this->emit('openEditModal');
    }

    public function consolidadoGuardar()
    {

        // Validar datos (incluyendo los archivos)
        $this->validate([
            'ccotizaciones.*.nuevo_archivo' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            'ccertificados.*.nuevo_archivo' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            'csolicitudPedidoTimbradas.*.nuevo_archivo' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            'cordenCompras.*.nuevo_archivo' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            'cfacturas.*.nuevo_archivo' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            // Agrega otras validaciones necesarias
        ]);

        // Buscar el consolidado seleccionado
        $consolidado = Consolidado::with('sdrDao')->findOrFail($this->seleccionar_consolidado->id);

        // Actualizar los datos del consolidado
        $consolidado->fecha_ing_sp = $this->cfecha_ing_sp;
        $consolidado->fecha_recepcion_direccion = $this->cfecha_recepcion_direccion;
        $consolidado->unidad = $this->cunidad;
        $consolidado->descripcion = $this->cdescripcion;
        $consolidado->direccion = $this->cdireccion;
        $consolidado->observaciones = $this->cobservaciones;
        $consolidado->save();

        // Actualizar los datos de SdrDao
        $sdr_dao = $consolidado->sdrDao;
        $sdr_dao->unidad = $this->cdireccion;
        $sdr_dao->save();

        // Obtener IDs de productos existentes
        $existingProductIds = $sdr_dao->sdrproductos->pluck('id')->toArray();

        foreach ($this->cproducts as $product) {
            if (isset($product['id'])) {
                // Actualizar producto existente
                $existingProductIds = array_filter($existingProductIds, function ($id) use ($product) {
                    return $id == $product['id'];
                });

                // Actualizar el producto
                $sdr_dao->sdrproductos()->where('id', $product['id'])->update($product);
            } else {
                // Crear nuevo producto
                $sdr_dao->sdrproductos()->create($product);
            }
        }

        // Eliminar productos que no están en la lista actual
        $sdr_dao->sdrproductos()->whereIn('id', $existingProductIds)->delete();

        // Actualizar o crear cotizaciones
        $existingCotizacionesIds = $sdr_dao->cotizacions->pluck('id')->toArray();
        $cotizacionesToDelete = [];

        foreach ($this->ccotizaciones as $cotizacion) {
            if (isset($cotizacion['id'])) {
                // Actualizar cotización existente
                $existingCotizacionesIds = array_filter($existingCotizacionesIds, function ($id) use ($cotizacion) {
                    return $id == $cotizacion['id'];
                });

                if (isset($cotizacion['nuevo_archivo']) && $cotizacion['nuevo_archivo']) {
                    // Eliminar archivo antiguo si es necesario
                    if (isset($cotizacion['archivo']) && $cotizacion['archivo']) {
                        Storage::delete($cotizacion['archivo']);
                    }
                    // Guardar nuevo archivo
                    $cotizacion['archivo'] = $cotizacion['nuevo_archivo']->store('cotizaciones', 'public');
                }

                $sdr_dao->cotizacions()->where('id', $cotizacion['id'])->update([
                    'archivo' => $cotizacion['archivo']
                ]);
            } else {
                // Crear nueva cotización
                if (isset($cotizacion['nuevo_archivo']) && $cotizacion['nuevo_archivo']) {
                    $cotizacion['archivo'] = $cotizacion['nuevo_archivo']->store('cotizaciones', 'public');
                }
                $sdr_dao->cotizacions()->create([
                    'archivo' => $cotizacion['archivo']
                ]);
            }
        }

        // Eliminar cotizaciones que no están en la lista actual
        $sdr_dao->cotizacions()->whereIn('id', $existingCotizacionesIds)->delete();

        // Actualizar o crear certificados
        $existingCertificadosIds = $sdr_dao->certificados->pluck('id')->toArray();
        $certificadosToDelete = [];

        foreach ($this->ccertificados as $certificado) {
            if (isset($certificado['id'])) {
                // Actualizar certificado existente
                $existingCertificadosIds = array_filter($existingCertificadosIds, function ($id) use ($certificado) {
                    return $id == $certificado['id'];
                });

                if (isset($certificado['nuevo_archivo']) && $certificado['nuevo_archivo']) {
                    // Eliminar archivo antiguo si es necesario
                    if (isset($certificado['archivoCertificado']) && $certificado['archivoCertificado']) {
                        Storage::delete($certificado['archivoCertificado']);
                    }
                    // Guardar nuevo archivo
                    $certificado['archivoCertificado'] = $certificado['nuevo_archivo']->store('certificados', 'public');
                }

                $sdr_dao->certificados()->where('id', $certificado['id'])->update([
                    'numero_certificado' => $certificado['numeroCertificado'],
                    'archivo' => $certificado['archivoCertificado'],
                    'fecha_emision' => $certificado['fechaCertificado'],
                ]);
            } else {
                // Crear nuevo certificado
                if (isset($certificado['nuevo_archivo']) && $certificado['nuevo_archivo']) {
                    $certificado['archivoCertificado'] = $certificado['nuevo_archivo']->store('certificados', 'public');
                }
                $sdr_dao->certificados()->create([
                    'numero_certificado' => $certificado['numeroCertificado'],
                    'archivo' => $certificado['archivoCertificado'],
                    'fecha_emision' => $certificado['fechaCertificado'],
                ]);
            }
        }

        // Eliminar certificados que no están en la lista actual

        $sdr_dao->certificados()->whereIn('id', $existingCertificadosIds)->delete();



        // Actualizar o crear Solicitudes
        $existingSolicitudesIds = $sdr_dao->solicitud->pluck('id')->toArray();
        $solicitudesToDelete = [];

        foreach ($this->csolicitudPedidoTimbradas as $csolicitudPedidoTimbrada) {
            if (isset($csolicitudPedidoTimbrada['id'])) {
                // Actualizar Solicitudes existente
                $existingSolicitudesIds = array_filter($existingSolicitudesIds, function ($id) use ($csolicitudPedidoTimbrada) {
                    return $id == $csolicitudPedidoTimbrada['id'];
                });

                if (isset($csolicitudPedidoTimbrada['nuevo_archivo']) && $csolicitudPedidoTimbrada['nuevo_archivo']) {
                    // Eliminar archivo antiguo si es necesario
                    if (isset($csolicitudPedidoTimbrada['archivo']) && $csolicitudPedidoTimbrada['archivo']) {
                        Storage::delete($csolicitudPedidoTimbrada['archivo']);
                    }
                    // Guardar nuevo archivo
                    $csolicitudPedidoTimbrada['archivo'] = $csolicitudPedidoTimbrada['nuevo_archivo']->store('solicitudes', 'public');
                }

                $sdr_dao->solicitud()->where('id', $csolicitudPedidoTimbrada['id'])->update([
                  'numero_solicitud' => $csolicitudPedidoTimbrada['numeroSolicitud'],
                    'archivo' => $csolicitudPedidoTimbrada['archivo'],
                ]);
            } else {
                // Crear nuevas Solicitudes
                if (isset($csolicitudPedidoTimbrada['nuevo_archivo']) && $csolicitudPedidoTimbrada['nuevo_archivo']) {
                    $csolicitudPedidoTimbrada['archivo'] = $csolicitudPedidoTimbrada['nuevo_archivo']->store('solicitudes', 'public');
                }
                $sdr_dao->solicitud()->create([
                    'numero_solicitud' => $csolicitudPedidoTimbrada['numeroSolicitud'],
                    'archivo' => $csolicitudPedidoTimbrada['archivo'],
                ]);
            }
        }

        // Eliminar Solicitudes que no están en la lista actual

        $sdr_dao->solicitud()->whereIn('id', $existingSolicitudesIds)->delete();



        // Actualizar o crear Orden
        $existingOrdenesIds = $sdr_dao->ordencompra->pluck('id')->toArray();
        $ordenCompraToDelete = [];

        foreach ($this->cordenCompras as $ordenCompra) {
            if (isset($ordenCompra['id'])) {
                // Actualizar ordenCompra existente
                $existingOrdenesIds = array_filter($existingOrdenesIds, function ($id) use ($ordenCompra) {
                    return $id == $ordenCompra['id'];
                });

                if (isset($ordenCompra['nuevo_archivo']) && $ordenCompra['nuevo_archivo']) {
                    // Eliminar archivo antiguo si es necesario
                    if (isset($ordenCompra['archivo']) && $ordenCompra['archivo']) {
                        Storage::delete($ordenCompra['archivo']);
                    }
                    // Guardar nuevo archivo
                    $ordenCompra['archivo'] = $ordenCompra['nuevo_archivo']->store('ordenCompra', 'public');
                }

                $sdr_dao->ordencompra()->where('id', $ordenCompra['id'])->update([
                    'numero_orden' => $ordenCompra['numeroOrden'],
                    'archivo' => $ordenCompra['archivo'],
                    'fecha_emision' => $ordenCompra['fechaOrden'],
                ]);
            } else {
                // Crear nuevo ordenCompra
                if (isset($ordenCompra['nuevo_archivo']) && $ordenCompra['nuevo_archivo']) {
                    $ordenCompra['archivo'] = $ordenCompra['nuevo_archivo']->store('ordenCompra', 'public');
                }
                $sdr_dao->ordencompra()->create([
                    'numero_orden' => $ordenCompra['numeroOrden'],
                    'archivo' => $ordenCompra['archivo'],
                    'fecha_emision' => $ordenCompra['fechaOrden'],
                ]);
            }
        }

        // Eliminar Ordenes que no están en la lista actual

        $sdr_dao->ordencompra()->whereIn('id', $existingOrdenesIds)->delete();




        // Actualizar o Recepciones
        $existingRecepcionesIds = $sdr_dao->recepciones->pluck('id')->toArray();
        $recepcionesToDelete = [];

        foreach ($this->crecepciones as $crecepcion) {
            if (isset($crecepcion['id'])) {
                // Actualizar ordenCompra existente
                $existingRecepcionesIds = array_filter($existingRecepcionesIds, function ($id) use ($crecepcion) {
                    return $id == $crecepcion['id'];
                });

                if (isset($crecepcion['nuevo_archivo']) && $crecepcion['nuevo_archivo']) {
                    // Eliminar archivo antiguo si es necesario
                    if (isset($crecepcion['archivo']) && $crecepcion['archivo']) {
                        Storage::delete($crecepcion['archivo']);
                    }
                    // Guardar nuevo archivo
                    $crecepcion['archivo'] = $crecepcion['nuevo_archivo']->store('recepciones', 'public');
                }

                $sdr_dao->recepciones()->where('id', $crecepcion['id'])->update([
                    'numero_recepcion' => $crecepcion['numeroRecepcion'],
                    'archivo' => $crecepcion['archivo'],
                    'fecha_emision' => $crecepcion['fechaRecepcion'],
                ]);
            } else {
                // Crear nueva Factura
                if (isset($crecepcion['nuevo_archivo']) && $crecepcion['nuevo_archivo']) {
                    $crecepcion['archivo'] = $crecepcion['nuevo_archivo']->store('recepciones', 'public');
                }

                $sdr_dao->recepciones()->create([
                    'numero_recepcion' => $crecepcion['numeroRecepcion'],
                    'archivo' => $crecepcion['archivo'],
                    'fecha_emision' => $crecepcion['fechaRecepcion'],
                ]);
            }
        }

        // Eliminar Facturas que no están en la lista actual

        $sdr_dao->recepciones()->whereIn('id', $existingRecepcionesIds)->delete();




        // Actualizar o Factura
        $existingFacturasIds = $sdr_dao->facturas->pluck('id')->toArray();
        $facturasToDelete = [];

        foreach ($this->cfacturas as $cfactura) {
            if (isset($cfactura['id'])) {
                // Actualizar ordenCompra existente
                $existingFacturasIds = array_filter($existingFacturasIds, function ($id) use ($cfactura) {
                    return $id == $cfactura['id'];
                });

                if (isset($cfactura['nuevo_archivo']) && $cfactura['nuevo_archivo']) {
                    // Eliminar archivo antiguo si es necesario
                    if (isset($cfactura['archivo']) && $cfactura['archivo']) {
                        Storage::delete($cfactura['archivo']);
                    }
                    // Guardar nuevo archivo
                    $cfactura['archivo'] = $cfactura['nuevo_archivo']->store('facturas', 'public');
                }

                $sdr_dao->facturas()->where('id', $cfactura['id'])->update([
                    'numero_factura' => $cfactura['numeroFactura'],
                    'archivo' => $cfactura['archivo'],
                    'fecha_emision' => $cfactura['fechaFactura'],
                ]);
            } else {
                // Crear nueva Factura
                if (isset($cfactura['nuevo_archivo']) && $cfactura['nuevo_archivo']) {
                    $cfactura['archivo'] = $cfactura['nuevo_archivo']->store('facturas', 'public');
                }
                $sdr_dao->facturas()->create([
                    'numero_factura' => $cfactura['numeroFactura'],
                    'archivo' => $cfactura['archivo'],
                    'fecha_emision' => $cfactura['fechaFactura'],
                ]);
            }
        }

        // Eliminar Facturas que no están en la lista actual

        $sdr_dao->facturas()->whereIn('id', $existingFacturasIds)->delete();



        $estado = 'inicio';
        // Lógica para actualizar el estado
        if ($this->cfacturas) {
            if ($sdr_dao->recepciones->isEmpty() && $sdr_dao->ordencompra->isEmpty() && $sdr_dao->solicitud->isEmpty()) {
                $estado = 'Factura Ingresada - Soli,Orden y Recepción Saltadas';
            } elseif ($sdr_dao->recepciones->isEmpty() && $sdr_dao->ordencompra->isEmpty()) {
                $estado = 'Factura Ingresada - Orden y Recepción Saltadas';
            } elseif ($sdr_dao->recepciones->isEmpty()) {
                $estado = 'Factura Ingresada - Recepción Saltada';
            } else {
                $estado = 'Factura Ingresada';
            }
        } elseif ($this->crecepciones) {
            if ($sdr_dao->ordencompra->isEmpty() && $sdr_dao->solicitud->isEmpty()) {
                $estado = 'Recepción Ingresada - Soli y Orden Saltadas';
            } elseif ($sdr_dao->ordencompra->isEmpty()) {
                $estado = 'Recepción Ingresada - Orden Saltada';
            } else {
                $estado = 'Recepción Ingresada';
            }
        } elseif ($this->cordenCompras) {
            if ($sdr_dao->solicitud->isEmpty()) {
                $estado = 'Orden de Compra Ingresada - Solicitud Saltada';
            } else {
                $estado = 'Orden de Compra Ingresada';
            }
        } elseif ($this->csolicitudPedidoTimbradas) {
            $estado = 'Solicitud Ingresada';
        }

        usleep(2000);
        $consolidado->estado = $estado;
        $consolidado->save();
        


        // Emitir un mensaje de éxito y cerrar el modal
        session()->flash('message', 'Consolidado actualizado correctamente.');
        $this->emit('closeEditModal');
    }


    public function render()
    {
        $consolidados = Consolidado::with(['sdrDao.certificados', 'sdrDao.cotizacions', 'sdrDao.sdrproductos'])
            ->where('estado', 'like', '%' . $this->csearch . '%')
            ->orWhereHas('sdrDao', function ($query) {
                $query->where('folio_sdr', 'like', '%' . $this->csearch . '%');
            })
            ->orWhereHas('sdrDao.certificados', function ($query) {
                $query->where('numero_certificado', 'like', '%' . $this->csearch . '%');
            })
            ->orWhereHas('sdrDao.cotizacions', function ($query) {
                $query->where('archivo', 'like', '%' . $this->csearch . '%');
            })
            ->orWhereHas('sdrDao.sdrproductos', function ($query) {
                $query->where('descripcion', 'like', '%' . $this->csearch . '%');
            })
            ->paginate(100);

        return view('livewire.consolidados', [
            'consolidados' => $consolidados,
        ]);
    }
}
