<x-layout title="Home">
    <form method="POST" action="/ideas">
        @csrf

        <div class="col-span-full">
            <label for="idea" class="block text-sm/6 font-medium text-white">New Idea</label>
            <div class="mt-2">
                <textarea id="idea" name="idea" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
            </div>
            <p class="mt-3 text-sm/6 text-gray-400">Write an idea you want to save for later.</p>
        </div>

        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>

    <div class="mt-6 text-white">
        <h2 class="font-bold">Your Ideas</h2>

        <ul class="mt-6">
            @forelse($ideas as $idea)
                <li class="text-small">{{ $idea }}</li>
            @empty
                <p> No ideas yet.</p>
            @endforelse
        </ul>

    </div>
</x-layout>
