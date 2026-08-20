<x-layout title="Home">
    @if ($ideas->count())
    <div class="mt-6 text-white">
        <h2 class="font-bold">Your Ideas</h2>

        <ul class="mt-6">
            @foreach($ideas as $idea)
                <a href="/ideas/{{ $idea->id }}" class="text-small">{{ $idea->description }}</a>
            @endforeach
        </ul>
    </div>
    @else
        <p>No ideas yet. <a href="/ideas/create" class="underline">Create a new one</a></p>
    @endif
</x-layout>
