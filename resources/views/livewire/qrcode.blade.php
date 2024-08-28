<?php

use App\Models\Client;
use Livewire\Volt\Component;

new class extends Component {
    
    public function mount()
    {
       
    }

    public function with()
    {
        return [
            'clientes' => Client::with('user')->get()
        ];
    }
    
};
?>

<div>
<div class="overflow-x-auto">
  <table class="table">
    <!-- head -->
    <thead>
      <tr>
        <th>
          <label>
            <input type="checkbox" class="checkbox" />
          </label>
        </th>
        <th>Foto </th>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Gerar Código</th>
      </tr>
    </thead>
    <tbody>
     @forelse($clientes as $item)
      <tr>
        <th>
          <label>
            <input type="checkbox" class="checkbox" />
          </label>
        </th>
        <td>
          <div class="flex items-center gap-3">
            <div class="avatar">
              <div class="mask mask-squircle h-12 w-12">
                <img
                  src="storage/{{$item->foto}}"
                  alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
          </div>
        </td>
        <td>
             <div>
              <div class="font-bold">{{$item->user->name}}</div>
            </div>
        </td>
        <td>
             <div>
              <div class="font-bold">{{$item->phone}}</div>
            </div>
        </td>
        <td>
        <a href="{{route('gerador',$item->id)}}" wire:navigate class="btn btn-active btn-primary">Gerar cartão</a>
        </td>
      </tr>
     @empty

     @endforelse
    </tbody>
    <!-- foot -->
    <tfoot>
      <tr>
        <th></th>
        <th>Name</th>
        <th>Job</th>
        <th>Favorite Color</th>
        <th></th>
      </tr>
    </tfoot>
  </table>
</div>
</div>
