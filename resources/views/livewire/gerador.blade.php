<?php

use App\Models\Client;
use Livewire\Volt\Component;

new class extends Component {
   
    public $client;
   
    public function mount($id)
    {
        $this->client= Client::with(['user','bank'])->findOrfail($id);
    }

}; ?>

<div>
    @if(session('error'))
    <div role="alert" class="alert alert-error">
  <svg
    xmlns="http://www.w3.org/2000/svg"
    class="h-6 w-6 shrink-0 stroke-current"
    fill="none"
    viewBox="0 0 24 24">
    <path
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{session('error')}}.</span>
</div>
    @endif
    <div class="wrapper mx-auto bg-gray" >
      <header>
       
        <h3 class="text-center font-semibold">Gerar cartão de Multicaixa</h3>
        <p class="text-center text-blue-500 font-semibold mb-2">{{$client->user->name}}</p>
        <img src="../storage/{{$client->bank->logo}}" style="display: block; margin: auto;" class="wx-auto display mt-4" alt="">
      </header>
      <div class="form">
        <input type="hidden" spellcheck="false" placeholder="Enter text or url" value="{{route('authpi',$client->id)}}">
        <button>Generate Cartão</button>
      </div>
      <div class="qr-code">
        <img src="" alt="qr-code">
      </div>
    </div>

</div>