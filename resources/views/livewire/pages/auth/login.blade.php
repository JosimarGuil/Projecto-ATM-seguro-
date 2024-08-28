<?php

use App\Models\Atm;
use App\Models\Bank;
use Livewire\Volt\Component;

new class extends Component {
   
    public $atm;
    public $isActive=false;

    public function mount($id)
    {
        $this->atm= Atm::with(['bank','countrie','state'])->findOrFail($id);
    }
    
    public function activeCount()
    {

    }
    
}; ?>

<div class="mt-8">
    <div class="mt-16 flex grid grid-cols-5 gap-8 justify-between">
        <div class=" grid col-span-3 rounded-lg px-8 py-8 border border-gray-600 ">
            <div class=" flex justify-between  py-4">
                <img style="" class="w-42" src="../storage/{{$atm->bank->logo}}" />
                <ul>
                    <li><b>BANCO : </b>{{$atm->bank->name}}</li>
                    <li><b>N série : </b>{{$atm->serialNumber}}</li>
                    <li><b>Endereço : </b>{{$atm->state->name.'-'.$atm->bairro}}</li>
                </ul>
            </div>
            <div class=" shadow">
                <div class="stat">
                    @if($isActive)
                    <div class="stat-value text-center">00</div>
                    @endif
                   
                    <div class="mt-8 border-t py-6 border-gray-600 " x-data="{ open: false }">
                        <button
                            class="w-full btn btn-outline btn-success mt-8/ text-lg text-white font-semibold" @click="open = ! open">Inserir
                            cartão multicaixa</button>
                    </div>
                </div>
            </div>

        </div>
        <!--DIGITOS--->
        <div class=" border border-gray-600  grid col-span-2 rounded-lg px-20 py-8">
            <h3 class="text-blue-400 text-center font-semibold">DIGITALIZAR</h3>

            <div class="flex gap-4 grid grid-cols-4 container mx-auto  ">
                @for($i=0;$i<=9;$i++) <button class="btn btn-primary text-white rounded-xl font-semibold">
                    {{$i}}</button>
                    @endfor
                    <button class="btn btn-warning font-semibold text-white">00</button>
                    <button class="btn btn-success font-semibold text-white"> Ok </button>
            </div>
        </div>
    </div>

    <div>
    <!-- Modal -->
 
</div>