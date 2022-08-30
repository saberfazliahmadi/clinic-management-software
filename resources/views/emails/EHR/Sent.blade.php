@component('mail::message')
# In the name of GOD

{{ $message }}

@component('mail::button', ['url' => config('global.app_url')])
{{ config('global.app_name') }}
@endcomponent

Thanks,<br>
{{ config('global.app_name') }}
@endcomponent
