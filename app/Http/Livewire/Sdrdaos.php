<?php

namespace App\Http\Livewire;

use App\Models\SdrDao;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MatHerVei;
use App\Models\Cotizacion;
use App\Models\Certificado;
use App\Models\Consolidado;
use App\Models\SolicitudPedido;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Sdrdaos extends Component
{
    use WithFileUploads;

    public $search = '';
    public $nuevoSdr = false;
    public $totalSdr;
    public $fecha = '';
    public $fecha_unidad = '';
    public $solicitado_por = '';
    public $unidad = '';
    public $cuenta_presupuestaria = '';
    public $folio_sdr = '';
    public $justificacion_del_requerimiento = '';
    public $certificado_de_presupuesto = '';
    public $cotizacion = '';
    public $materiales = [];
    public $selectedMaterial = null;

    public $solicitudes = [];
    public $products = [
        ['item' => '', 'descripcion' => '', 'unidad_medida' => '', 'cantidad' => '']
    ];
    public $cotizaciones = [];
    public $certificados = [
        ['numeroCertificado' => '', 'archivoCertificado' => null, 'fechaCertificado' => '']
    ];

    #variables Modal
    public $id_update;
    public $mfecha = '';
    public $mfecha_unidad = '';
    public $msolicitado_por = '';
    public $munidad = '';
    public $mcuenta_presupuestaria = '';
    public $mfolio_sdr = '';
    public $mjustificacion_del_requerimiento = '';
    public $mcertificado_de_presupuesto = '';
    public $mcotizacion = '';
    public $mmateriales = [];
    public $mselectedMaterial = null;
    public $msolicitudes = [];
    public $mproducts = [
        ['item' => '', 'descripcion' => '', 'unidad_medida' => '', 'cantidad' => '']
    ];
    public $mcotizaciones = [];
    public $mcertificados = [
        ['numeroCertificado' => '', 'archivoCertificado' => null, 'fechaCertificado' => '']
    ];






    public function mount()
    {
        $this->materiales = MatHerVei::all();
    }

    public function toggleEstado()
    {
        $this->nuevoSdr = !$this->nuevoSdr;
    }


    public function addProduct()
    {
        $this->products[] = ['item' => '', 'descripcion' => '', 'unidad_medida' => '', 'cantidad' => ''];
    }

    public function maddProduct()
    {
        $this->mproducts[] = ['item' => '', 'descripcion' => '', 'unidad_medida' => '', 'cantidad' => ''];
    }

    public function removeProduct($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products);
    }

    public function mremoveProduct($index)
    {
        unset($this->mproducts[$index]);
        $this->mproducts = array_values($this->mproducts);
    }

    public function addCertificado()
    {
        $this->certificados[] = '';
    }

    public function maddCertificado()
    {
        $this->mcertificados[] = [
            'numeroCertificado' => '',
            'archivoCertificado' => null,
            'fechaCertificado' => ''
        ];
    }

    public function removeCertificado($index)
    {
        unset($this->certificados[$index]);
        $this->certificados = array_values($this->certificados);
    }

    public function mremoveCertificado($index)
    {
        unset($this->mcertificados[$index]);
        $this->mcertificados = array_values($this->mcertificados);
    }



    public function addSolicitud()
    {
        $this->solicitudes[] = [
            'numeroSolicitud' => null,

        ];
    }

    public function removeSolicitud($index)
    {
        unset($this->solicitudes[$index]);
        $this->solicitudes = array_values($this->solicitudes);
    }

    public function maddSolicitud()
    {
        $this->msolicitudes[] = [
            'numeroSolicitud' => null,

        ];
    }

    public function mremoveSolicitud($index)
    {
        unset($this->msolicitudes[$index]);
        $this->msolicitudes = array_values($this->msolicitudes);
    }


    public function addCotizacion()
    {
        $this->cotizaciones[] = [
            'archivo' => null,

        ];
    }

    public function removeCotizacion($index)
    {
        unset($this->cotizaciones[$index]);
        $this->cotizaciones = array_values($this->cotizaciones);
    }


    public function maddCotizacion()
    {
        $this->mcotizaciones[] = [
            'archivo' => null,

        ];
    }

    public function mremoveCotizacion($index)
    {
        unset($this->mcotizaciones[$index]);
        $this->mcotizaciones = array_values($this->mcotizaciones);
    }

    public function resetFields()
    {
        $this->fecha = '';
        $this->solicitado_por = '';
        $this->unidad = '';
        $this->fecha_unidad = '';
        $this->solicitudes = [];
        $this->cuenta_presupuestaria = '';
        $this->justificacion_del_requerimiento = '';
        $this->certificado_de_presupuesto = '';
        $this->cotizacion = '';
        $this->selectedMaterial = null;
        $this->products = [
            ['item' => '', 'descripcion' => '', 'unidad_medida' => '', 'cantidad' => '']
        ];
        $this->cotizaciones = [];
        $this->certificados = [];
    }

    public function save()
    {
      $year = date('Y'); // Obtener el año actual
                $lastFolio = SdrDao::whereYear('fecha', $year)->orderBy('folio_sdr', 'desc')->first();

                // Si hay un folio del año actual, incrementa el número, si no, inicia en 1
                if ($lastFolio) {
                    // Extraer la parte numérica antes del año
                    $lastNumber = (int) substr($lastFolio->folio_sdr, 0, -strlen($year));
                    $newFolio = ($lastNumber + 1) . $year;
                } else {
                    $newFolio = '1' . $year; // Inicia en 1 para el nuevo año
                }

                $sdr_dao = SdrDao::create([
                    'fecha' => $this->fecha,
                    'solicitado_por' => $this->solicitado_por,
                    'unidad' => $this->unidad,
                    'fecha_unidad' => $this->fecha_unidad,
                    'cuenta_presupuestaria' => $this->cuenta_presupuestaria,
                    'folio_sdr' => $newFolio,
                    'id_materiales' => $this->selectedMaterial,
                    'justificacion_del_requerimiento' => $this->justificacion_del_requerimiento,
                ]);
      
        $this->validate([
            'fecha' => 'required|date',
            'solicitado_por' => 'required|string|max:255',
            'unidad' => 'required|string|max:255',
            'solicitudes.*' => 'required',
            'cuenta_presupuestaria' => 'required|string|max:255',
            'selectedMaterial' => 'required',
            'products.*.item' => 'required|string|max:255',
            'products.*.descripcion' => 'required|string|max:255',
            'products.*.unidad_medida' => 'required|string|max:255',
            'products.*.cantidad' => 'required|integer|min:1',
            'justificacion_del_requerimiento' => 'required|string|max:255',
            'cotizaciones.*' => 'required',
            'certificados.*.archivoCertificado' => 'required',
            'certificados.*.fechaCertificado' => 'required',
            'certificados.*.numeroCertificado' => 'required',
        ]);
        DB::transaction(
            function () {

                $year = date('Y'); // Obtener el año actual
                $lastFolio = SdrDao::whereYear('fecha', $year)->orderBy('folio_sdr', 'desc')->first();

                // Si hay un folio del año actual, incrementa el número, si no, inicia en 1
                if ($lastFolio) {
                    // Extraer la parte numérica antes del año
                    $lastNumber = (int) substr($lastFolio->folio_sdr, 0, -strlen($year));
                    $newFolio = ($lastNumber + 1) . $year;
                } else {
                    $newFolio = '1' . $year; // Inicia en 1 para el nuevo año
                }

                $sdr_dao = SdrDao::create([
                    'fecha' => $this->fecha,
                    'solicitado_por' => $this->solicitado_por,
                    'unidad' => $this->unidad,
                    'fecha_unidad' => $this->fecha_unidad,
                    'cuenta_presupuestaria' => $this->cuenta_presupuestaria,
                    'folio_sdr' => $newFolio,
                    'id_materiales' => $this->selectedMaterial,
                    'justificacion_del_requerimiento' => $this->justificacion_del_requerimiento,
                ]);



                foreach ($this->solicitudes as $solicitud) {

                    SolicitudPedido::create(['sdr_dao_id' => $sdr_dao->id, 'numero_solicitud' => $solicitud['numeroSolicitud']]);
                }

                foreach ($this->products as $product) {
                    $sdr_dao->sdrproductos()->create($product);
                }


                foreach ($this->cotizaciones as $cotizacion) {
                    if ($cotizacion['archivo'] instanceof \Illuminate\Http\UploadedFile) {
                        $path = $cotizacion['archivo']->store('cotizaciones', 'public');
                        Cotizacion::create(['sdr_dao_id' => $sdr_dao->id, 'archivo' => $path]);
                    }
                }

                foreach ($this->certificados as $certificado) {
                    if ($certificado['archivoCertificado'] instanceof \Illuminate\Http\UploadedFile) {
                        $path = $certificado['archivoCertificado']->store('certificados', 'public');
                        Certificado::create([
                            'sdr_dao_id' => $sdr_dao->id,
                            'numero_certificado' => $certificado['numeroCertificado'],
                            'archivo' => $path,
                            'fecha_emision' => $certificado['fechaCertificado'],
                        ]);
                    }
                }
                $consolidado = Consolidado::create([
                    'sdr_dao_id' => $sdr_dao->id,
                    'fecha_ing_sp' => $this->fecha,
                    'fecha_recepcion_direccion' => $this->fecha_unidad,
                    'direccion' => $this->unidad,

                ]);

                session()->flash('message', 'SDR DAO guardado exitosamente.');
                $this->emit('showPdfModal');

                $this->resetFields();
                return redirect()->route('generate.pdf', ['id' => $sdr_dao]);
            }


        );
    }

    public function printPdf($id)
    {
        $sdr_dao = SdrDao::findOrFail($id);
        return redirect()->route('generate.pdf', ['id' => $sdr_dao]);
    }

    public function edit($id)
    {
        $sdr_dao = SdrDao::findOrFail($id);
        $this->id_update = $id;

        // Asigna los valores del registro a las propiedades del componente
        $this->mfecha = $sdr_dao->fecha;
        $this->msolicitado_por = $sdr_dao->solicitado_por;
        $this->munidad = $sdr_dao->unidad;
        $this->mfecha_unidad = $sdr_dao->fecha_unidad;
        $this->mcuenta_presupuestaria = $sdr_dao->cuenta_presupuestaria;
        $this->mfolio_sdr = $sdr_dao->folio_sdr;
        $this->mjustificacion_del_requerimiento = $sdr_dao->justificacion_del_requerimiento;
        $this->mselectedMaterial = $sdr_dao->id_materiales;

        // Manejar productos, cotizaciones, certificados si es necesario
        $this->mproducts = $sdr_dao->sdrproductos ? $sdr_dao->sdrproductos->map(function ($producto) {
            return [
                'item' => $producto->item,
                'descripcion' => $producto->descripcion,
                'unidad_medida' => $producto->unidad_medida,
                'cantidad' => $producto->cantidad,
            ];
        })->toArray()
            : [];

        // Manejar Solicitudes
        $this->msolicitudes = $sdr_dao->solicitud ? $sdr_dao->solicitud->map(function ($msolicitud) {
            return [
                'numeroSolicitud' => $msolicitud->numero_solicitud,
            ];
        })->toArray() : [];

        // Manejar cotizaciones
        $this->mcotizaciones = $sdr_dao->cotizacions ? $sdr_dao->cotizacions->map(function ($mcotizacion) {
            return [
                'archivo' => $mcotizacion->archivo,
            ];
        })->toArray() : [];


        $this->mcertificados = $sdr_dao->certificados ? $sdr_dao->certificados->map(function ($mcertificado) {
            return [
                'numeroCertificado' => $mcertificado->numero_certificado,
                'archivoCertificado' => $mcertificado->archivo, // Ajusta aquí el campo para la URL del archivo
                'fechaCertificado' => $mcertificado->fecha_emision,
            ];
        })->toArray() : [];

        // Emitir un evento para mostrar el modal
        $this->emit('openEditModal');
    }


    public function update()
    {
        // Encuentra el registro que quieres actualizar
        $sdr_dao = SdrDao::findOrFail($this->id_update);

        // Actualiza los datos del registro principal
        $sdr_dao->update([
            'fecha' => $this->mfecha,
            'solicitado_por' => $this->msolicitado_por,
            'unidad' => $this->munidad,
            'fecha_unidad' => $this->mfecha_unidad,
            'cuenta_presupuestaria' => $this->mcuenta_presupuestaria,
            'folio_sdr' => $this->mfolio_sdr,
            'justificacion_del_requerimiento' => $this->mjustificacion_del_requerimiento,
            'id_materiales' => $this->mselectedMaterial,
        ]);

        // Obtener IDs de productos existentes
        $existingProductIds = $sdr_dao->sdrproductos->pluck('id')->toArray();

        foreach ($this->mproducts as $product) {
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




        // Obtén los IDs de las solicitudes existentes
        $existingSolicitudesIds = $sdr_dao->solicitud->pluck('id')->toArray();
        $solicitudesToDelete = [];

        // Recorre cada solicitud en $this->msolicitudes
        foreach ($this->msolicitudes as $solicitud) {
            if (isset($solicitud['id'])) {
                // Actualiza una solicitud existente
                $existingSolicitudesIds = array_filter($existingSolicitudesIds, function ($id) use ($solicitud) {
                    return $id == $solicitud['id'];
                });

                $sdr_dao->solicitud()->where('id', $solicitud['id'])->update([
                    'numero_solicitud' => $solicitud['numeroSolicitud']
                ]);
            } else {
                // Crea una nueva solicitud
                $sdr_dao->solicitud()->create([
                    'numero_solicitud' => $solicitud['numeroSolicitud']
                ]);
            }
        }



        // Eliminar productos que no están en la lista actual
        $sdr_dao->solicitud()->whereIn('id', $existingSolicitudesIds)->delete();


        // Actualizar o crear cotizaciones
        $existingCotizacionesIds = $sdr_dao->cotizacions->pluck('id')->toArray();
        $cotizacionesToDelete = [];

        foreach ($this->mcotizaciones as $cotizacion) {
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

        foreach ($this->mcertificados as $certificado) {
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
        $certificadosToDelete = $sdr_dao->certificados()->whereIn('id', $existingCertificadosIds)->get();
        foreach ($certificadosToDelete as $certificado) {
            // Eliminar el archivo si existe
            if ($certificado->archivoCertificado) {
                Storage::disk('public')->delete($certificado->archivoCertificado);
            }
        }

        $sdr_dao->certificados()->whereIn('id', $existingCertificadosIds)->delete();

        // Emitir un mensaje de éxito y cerrar el modal
        session()->flash('message', 'Consolidado actualizado correctamente.');
        $this->emit('closeEditModal');
    }

    public function searchRecords()
    {
        $this->totalSdr = SdrDao::query()
            ->where('fecha', 'like', "%{$this->search}%")
            ->orWhere('solicitado_por', 'like', "%{$this->search}%")
            ->orWhere('unidad', 'like', "%{$this->search}%")
            ->orWhere('cuenta_presupuestaria', 'like', "%{$this->search}%")
            ->orWhere('folio_sdr', 'like', "%{$this->search}%")
            ->orWhere('justificacion_del_requerimiento', 'like', "%{$this->search}%")
            ->orWhereHas('solicitud', function ($query) {
                $query->where('numero_solicitud', 'like', "%{$this->search}%");
            })
            ->get();
    }
    public function render()
    {

        $this->searchRecords();
        return view('livewire.sdrdaos', [
            'totalSdr' => $this->totalSdr
        ]);
    }
}
