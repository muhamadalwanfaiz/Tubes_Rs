@component('mail::message')
# Hallo,

Terimakasih Telah melakukan Pendaftaran Mohon Di tunggu Untuk Pemerosesannya

@component('mail::button', ['url' => ''])
oke
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
