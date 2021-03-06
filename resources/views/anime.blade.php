<x-layout>
  <x-slot name="title">
    {{ $anime->title }}
  </x-slot>

  <article class="anime">
    <header class="anime--header">
      <div>
        <img alt="" src="/covers/{{ $anime->cover }}" />
      </div>
      <h1>{{ $anime->title }}</h1>
      <h3>{{$rating->average}}/10</h3>
    </header>
    <p>{{ $anime->description }}</p>
    <div>
      <div class="actions">
        <div>
          <a class="cta" href="/anime/{{ $anime->id }}/new_review">Écrire une critique</a>
        </div>
        <form action="/anime/{{$anime->id}}/add_to_watch_list" method="POST">
        @csrf
          <button class="cta">Ajouter à ma watchlist</button>
        </form>
        </div>
        @error('message')
            <p class="error">{{ $message }}</p>
          @enderror
      
    </div>
  </article>
</x-layout>
