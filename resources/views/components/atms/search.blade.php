@props([
'search'    
])

<select wire:model.live="search" class="select select-blue w-full border-blue-400 " >
    {{$slot}}
</select>