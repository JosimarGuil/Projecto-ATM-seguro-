<?php

use App\Models\Client;
use Livewire\Volt\Component;

new class extends Component {
   
    public $client;

    public function mount($id)
    {
        $this->client= Client::findOrfail($id);
    }

}; ?>

<div>
    <h3 class="font-semibold">Gerador de Cartões</h3>
 
</div>
