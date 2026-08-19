<x-layout title="Home">
    <p>
        {{-- @forelse = foreach + the empty case --}}
        @forelse($tasks as $task)
            <li>{{ $task  }}</li>
        @empty
            <p>There are no active tasks. </p>
        @endforelse

        {{--We use {{ $person }} istead of <?= $person ?> because it verify the characters for us automatically--}}
        {{ $greeting }}, {{ $person }} !
    </p>
</x-layout>
