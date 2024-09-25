<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;


class HomeVacantes extends Component
{
    public $termino;
    public $categoria;
    public $salario;

    protected $listeners=['terminosbusqueda'=>'buscar'];

    public function buscar($termino, $categoria, $salario)
    {
        $this->termino=$termino;
        $this->salario=$salario;
        $this->categoria=$categoria;
    }
    public function render()
    {
            //$vacantes=Vacante::when('salario_id',$this->salario)->when('categoria_id',$this->categoria)->when('titulo','LIKE',"%{$this->termino}%")->get();

        $vacantes=Vacante::when($this->termino,function($query){
            $query->where('titulo','LIKE',"%" . $this->termino . "%")
            ->orWhere('empresa','LIKE',"%" . $this->termino . "%");
        })
         ->when($this->salario,function($query){
            $query->where('salario_id',$this->salario);
         })
         ->when($this->categoria,function($query){
            $query->where('categoria_id',$this->categoria);
         })
        ->paginate(20);

        return view('livewire.home-vacantes', ['vacantes'=>$vacantes]);
    }
}
