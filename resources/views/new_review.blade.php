<x-layout>
  <x-slot name="title">
    
  </x-slot>
  <h1>Nouvelle Critique </h1>

  @if($userReview )
    <h3>T'as déja ajouté un critique</h3>
  @else
    <h3>ajouter un critique </h3>
    <form id="reviewForm" action="/add_review" method="POST">
    @csrf
      <input type="text" name="comment" required>
      <input type="number" step="1" name="rating" min="0" max="10" required >
      <input type="hidden" name="anime_id" value="{{$anime_id_value}}">
      <input type="hidden" name="user_id" value="{{$user_id_value}}">
      <button id="formbutton">Send</button>
    </form>
  @endif


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













