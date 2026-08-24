<x-layout>
    <form action="/register" method="POST"> {{-- I put this for triggering the endpoint--}}
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
            <legend class="fieldset-legend">Register</legend>

            {{-- Without type bc by default is type="text"--}}
            <label class="label" for="name">Name</label>
            <input class="input" name="name" placeholder="Your Name" required />

            <label class="label" for="email">Email</label>
            <input class="input" type="email" name="email" placeholder="Your Email" required />

            <label class="label" for="password">Password</label>
            <input class="input" type="password" name="password" placeholder="Password" required />

            {{-- When we click this button, where are we going?--}}
            {{-- We're ging to make a post request to this /register endpoint -> form action ... --}}
            <button class="btn btn-neutral mt-4">Register</button>
        </fieldset>
    </form>
</x-layout>
