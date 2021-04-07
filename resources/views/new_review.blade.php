<x-layout>
  <x-slot name="title">
    Nouvelle critique de {{$reviews[0]->title}}
  </x-slot>

  <h1>Nouvelle Critique de {{$reviews[0]->title}}</h1>

  
  
  <form id="reviewForm" action="/add_review" method="POST">
  @csrf
    <input type="text" name="comment" >
    <input type="number" step="1" name="rating" min="0" max="10">
    <input type="hidden" name="anime_id" value="{{$anime_id_value}}">
    <input type="hidden" name="user_id" value="{{$user_id_value}}">
    <button id="formbutton">Send</button>
  </form>
  
  

  <table>
    <tbody>
        @foreach($reviews as $review)
        <tr>
        <td>{{$review->rating}}/10</td>
        <td>{{$review->comment}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>

</x-layout>

