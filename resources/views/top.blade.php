<x-layout>
  <x-slot name="top">
    
  </x-slot>

 <table>
    <thead>
        <tr>
        <td>Title</td>
        <td>Note Moyenne</td>
        </tr>
    </thead>
    <tbody>
    @foreach($top_list as $anime)
    <tr>
    <td>{{$anime->title}}</td>
    <td>{{$anime->average}}</td>
    </tr>
    @endforeach
    </tbody>
 </table>
</x-layout>