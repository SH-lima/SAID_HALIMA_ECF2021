<x-layout>
  <x-slot name="top">
    
  </x-slot>
  <ul>
  @foreach($watchlist as $film)
  <li>{{$film->title}}</li>
  @endforeach
  </ul>
</x-layout>