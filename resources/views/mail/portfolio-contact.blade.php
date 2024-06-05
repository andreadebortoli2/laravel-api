<x-mail::message>




    HI {{ $contact->name }},

    thanks for you're message, il contact you back ASAP!




    {{-- <x-mail::button :url="''">
        Button Text
    </x-mail::button> --}}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
