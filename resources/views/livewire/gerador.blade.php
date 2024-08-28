<?php

use App\Models\Client;
use Livewire\Volt\Component;

new class extends Component {
   
    public $client;
    public $senhaRelada='';
    
    public function mount($id)
    {
        $this->client= Client::with(['user','bank'])->findOrfail($id);
    }

     public function addPassword()
     {
        $code=mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
        $this->senhaRelada=$code;
        $this->client->update([
           'password'=>(int)$code
        ]);
     }
}; ?>

<div>

    <div class="wrapper mx-auto bg-gray" x-data >
      <header>
      
        <h3 class="text-center font-semibold">Gerar cartão de Multicaixa</h3>
        <p class="text-center text-blue-500 font-semibold mb-2">{{$client->user->name}}</p>
        <img src="../storage/{{$client->bank->logo}}" style="display: block; margin: auto;" class="wx-auto display mt-4" alt="">
        <h3 class="text-white text-center">{{$senhaRelada}}</h3>
      </header>
      <div class="form">
        <input type="hidden" spellcheck="false" placeholder="Enter text or url" value="authpi/{{$client->id}}">
        <button >Gerar Cartão</button>
        <button @click="$wire.addPassword()">Gerar senha</button>
      </div>
      
      <div class="qr-code" wire:ignore>
        <img src="" alt="qr-code">
      </div>
     
    </div>

</div>