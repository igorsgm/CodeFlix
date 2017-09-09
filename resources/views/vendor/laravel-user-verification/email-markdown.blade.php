@component('mail::message')

Só mais um passo!

@component('mail::button', ['url' => route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) ])
Clique aqui para verificar a sua conta
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
