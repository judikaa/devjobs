<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use App\Models\Candidato;
use App\Notifications\NuevoCandidato;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacante;
    
    protected $rules = [
        'cv'=> 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        $datos=$this->validate();

        if ($this->vacante->ultimo_dia<now()){
            return redirect()->back()->with('mensaje_error', 'Esta vacante ya venció!');   
        }
        else if ($this->vacante->candidatos()->where('user_id',auth()->user()->id)->count()>0)
        {
            return redirect()->back()->with('mensaje_error', 'Ya te postulaste a esta vacante!');    
        }
        else
        {
        
            $cv=$this->cv->store('public/cv');
            $datos['cv']=str_replace('public/cv/','',$cv); 

            //almacenar el cv en el disco

            $this->vacante->candidatos()->create([
                'cv'=>$datos['cv'],
                'user_id'=>auth()->user()->id
            ]);
            $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));
            return redirect()->back()->with('mensaje', 'Te postulaste. Mucha suerte!');   
        };

        //actualizar bd
        //mostrar al usuario mensaje ok
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }

    
}
