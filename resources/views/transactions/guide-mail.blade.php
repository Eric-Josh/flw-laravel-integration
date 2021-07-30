@component('mail::message')

{{ __('Hello '.$customerName.',') }}

{{ __('You have successfully purchased a product.') }}

{{ __('Please find attached, your purchased product.') }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent