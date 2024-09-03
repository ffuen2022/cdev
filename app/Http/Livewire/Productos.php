<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class Productos extends Component
{
    public $psearch = '';
    public $pdescripcion;
    public $plote;
    public $pentradas;
    public $psalidas;
    public $pstock_actual;
    public $nuevoProducto = false;


    // Variables Modal

    public $mpdescripcion;
    public $mplote;
    public $mpentradas;
    public $mpsalidas;
    public $mpstock_actual;
    public $pid_update;

    public function toggleEstado()
    {
        $this->nuevoProducto = !$this->nuevoProducto;
    }

    public function saveProductos(){

        // Guarda el registro sin 'codigoProducto'

        $producto = Producto::create([
            'descripcion' => $this->pdescripcion,
            'lote' => $this->plote,
            'entradas' => $this->pentradas,
            'salidas' => $this->psalidas,
            'stockActual' => 100,
        ]);

           // Asigna el id al campo 'codigoProducto'
    $producto->codigoProducto = $producto->id;
    $producto->save();

        session()->flash('message', 'Producto Guardado Exitosamente.');
    }

    public function productoEdit($id){

        $producto = Producto::findOrFail($id);
        $this->pid_update = $id;

        $this->mpdescripcion = $producto->descripcion;
        $this->mplote = $producto->lote;
        $this->mpentradas = $producto->entradas;
        $this->mpsalidas = $producto->salidas;        
        $this->mpstock_actual = $producto->stockActual;

                // Emitir un evento para mostrar el modal
                $this->emit('openEditModal');

    }

    public function productoUpdate(){

        $producto = Producto::findOrFail($this->pid_update);

        $producto->update([
            'descripcion' => $this->mpdescripcion,
            'lote' => $this->mplote,
            'entradas' => $this->mpentradas,
            'salidas' => $this->mpsalidas,
            'stockActual' => 100,
        ]);

                // Emitir un mensaje de éxito y cerrar el modal
                session()->flash('message', 'Producto Actualizado Correctamente.');
                $this->emit('closeEditModal');
    }



    public function render()
    {
        $productos = Producto::all();
        return view('livewire.productos',[
            'productos' => $productos
        ]);
    }
}
