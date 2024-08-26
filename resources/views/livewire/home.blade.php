<?php

use App\Models\Atm;
use App\Models\Post;
use Livewire\Volt\Component;

new class extends Component {
    
    public $search='';

    public function clean()
    {
        $this->search='';
    }
    public function with()
    {
        if($this->search)
        {
            $atms= Atm::with(['bank','state','countrie'])
            ->where('bairro','like','%'.$this->search.'%')->get();
        }else
        {
            $atms=Atm::with(['bank','state','countrie'])->get();
        }
        return [
            'atms' => $atms,
            'bairros'=>Atm::with(['bank','state','countrie'])->get()
        ];
    }
    
};

?>


<!---COLLING MENU-PRINCIPAL-->
<div>
   
  
     <h3>Encontre um atm prxóximo</h3>
    <hr class="text-gray-500 mt-4 mb-8">
    <!--Search-form-->
 
    <div class="mb-8">
        <x-atms.search  search="{{$search}}">
            @foreach($bairros as $item)
                <x-atms.search-item bairro="{{$item->bairro}}"/>
            @endforeach
        </x-atms.search>
    </div>
    <div class="pb-4 flex justify-between">
        <h2 class="py-4 font-semibold text-xl">Nossos Atms</h2>
        <button wire:click="clean()">Ver todos</button>
    </div>
  
    <div class="flex mx-auto  grid grid-cols-4 gap-2">
        <!---Bank-lists-->
        @foreach($atms as $item)
            <x-atms.list name="{{$item->bank->name}}" image="{{$item->bank->img}}"
                location="{{$item->countrie->name.'-'.$item->state->name.'-'.$item->bairro}}" id="{{$item->id}}"/>
        @endforeach
       
    </div>
</div>
    
