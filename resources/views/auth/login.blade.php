<x-layout>
    <form action="/login" method="POST"> {{-- I put this for triggering the endpoint--}}
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
            <legend class="fieldset-legend">Log In</legend>

            <label class="label" for="email">Email</label>
            <input class="input" type="email" name="email" placeholder="Your Email" required />
            <x-forms.error name="email"/>

            <label class="label" for="password">Password</label>
            <input class="input" type="password" name="password" placeholder="Password" required />
            <x-forms.error name="password"/>

            {{-- When we click this button, where are we going?--}}
            {{-- We're going to make a post request to this /login endpoint -> form action ... --}}
            <button class="btn btn-neutral mt-4">Log In</button>
        </fieldset>
    </form>
</x-layout>
