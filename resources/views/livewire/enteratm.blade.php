<?php

use App\Models\Atm;
use App\Models\Bank;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
   
    public $atm;
    public $enter='';
    public $cont=0;
    public $clicntId;
    public $sms=false;
    public function mount($id,$atm)
    {
        $this->atm= Atm::with(['bank','countrie','state'])->findOrFail($atm);
        $this->clicntId=Client::findOrFail($id);
    }
    
    public function digitEnter($number)
    {
          $this->enter.=$number;
          $this->sms=false;
    }

    public function removeDigit()
    {
        $this->enter= substr($this->enter,0,strlen($this->enter)-1);
        $this->sms=false;
    }
    
   public function login()
   {
      if($this->clicntId->password === (int)$this->enter){
        $user=User::where('id',$this->clicntId->user_id);
    Auth::login($user);

      }else{
            $this->cont += 1;
            $this->sms=true;
      }
       if($this->cont > 3){
            // vai mandar sms 
       }
   }
}; ?>
<div>
    <div class="mt-8">
        <div class="mt-16 flex grid grid-cols-5 gap-8 justify-between">
            <div class=" grid col-span-3 rounded-lg px-8 py-8 border border-gray-600 ">
                <div class=" flex justify-between  py-4">
                    <img class="w-42" src="../../storage/{{$atm->bank->logo}}" />
                    <ul>
                        <li><b>BANCO : </b>{{$atm->bank->name}}</li>
                        <li><b>N série : </b>{{$atm->serialNumber}}</li>
                        <li><b>Endereço : </b>{{$atm->state->name.'-'.$atm->bairro}}</li>
                    </ul>
                </div>
                <div class=" shadow">
                    <div class="stat">

                        <span class="text-center">Insira a senha</span><br>
                        <span class="text-center text-seccess text-semibold">{{$enter}}</span>
                           @if($sms)
                           <span class="text-center text-red text-semibold">Código incorrecto</span>
                           @endif
                        <div class="mt-8 border-t py-6 border-gray-600 " x-data="{ open: false }">
                        </div>
                    </div>
                </div>

            </div>
            <!--DIGITOS--->
            <div class=" border border-gray-600  grid col-span-2 rounded-lg px-20 py-8">
                <h3 class="text-blue-400 text-center font-semibold">DIGITALIZAR</h3>

                <div class="flex gap-4 grid grid-cols-4 container mx-auto">
                    @for($i=0;$i<=9;$i++) 
                    
                    <button @click="$wire.digitEnter({{$i}})"  class="btn btn-primary text-white rounded-xl font-semibold">
                        {{$i}}</button>
                        @endfor
                        <button class="btn btn-warning font-semibold text-white" @click="$wire.removeDigit()">limpar</button>
                        <button class="btn btn-success font-semibold text-white" @click="$wire.login()"> Ok </button>
                </div>
            </div>
        </div>

        <div>
            <!-- Modal -->
        </div>
    </div>