@props([
       'name',
       'location',
       'image',
       'id'
    ])
<div class=" col-span-1 card bg-base-100 image-full w-86 shadow-xl">
  <figure>
    <img
      src="storage/{{$image}}"
      alt="Shoes" />
  </figure>
  <div class="card-body">
    <h1 class="card-title font-semibold text-white">{{$name}}</h1>
    <p class="font-semibold">{{$location}}</p>
    <div class="card-actions justify-end">
       <x-buttons.primay-button id="{{$id}}">
             Efecturar operações
       </x-buttons.primay-button>
    </div>
  </div>
</div>