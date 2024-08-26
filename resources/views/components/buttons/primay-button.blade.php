@props([
    'id'
    ])
<a href="{{route('atm',$id)}}" wire:navigate style="border-color: transparent;" {{$attributes->except('calss')}} class="btn bg-blue-500 text-gray-100 text-md font-semibold">
    {{$slot}}
</a>