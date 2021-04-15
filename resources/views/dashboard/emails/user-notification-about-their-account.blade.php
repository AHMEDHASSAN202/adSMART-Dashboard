@component('mail::message')
    # Thank's

    @component('mail::button', ['url' => $url])
        Visit Website
    @endcomponent

    {{ config('app.name') }}
@endcomponent
