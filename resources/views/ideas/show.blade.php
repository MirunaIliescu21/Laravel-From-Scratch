<x-layout>
    <div class="mt-6 text-white">
        <h2 class="font-bold">Your Idea</h2>

        <div class="mt-6">
            {{ $idea->description }}
        </div>

        <div class="mt-6">
            <a href="/ideas/{{ $idea->id }}/edit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Edit
            </a>

        </div>
    </div>
</x-layout>
