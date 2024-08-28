<?php

use App\Models\Client;
use Livewire\Volt\Component;

new class extends Component {
   
    public $client;
    public $codeCard;
    public function mount($id)
    {
        $this->client= Client::findOrfail($id);
        $this->codeCard=$this->client->user->name.$this->client->id;
    }

}; ?>

<div>
    
    <div class="wrapper mx-auto bg-gray" >
      <header>
       
        <h3 class="text-center font-semibold">Gerar cartão de Multicaixa</h3><br>
        <img src="../storage/{{$client->bank->logo}}" style="display: block; margin: auto;" class="wx-auto display mt-4" alt="">
      </header>
      <div class="form">
        <input type="hidden" spellcheck="false" placeholder="Enter text or url" value="{{route('authpi',$codeCard)}}">
        <button>Generate Cartão</button>
      </div>
      <div class="qr-code">
        <img src="" alt="qr-code">
      </div>
    </div>

</div>