<h3>{{ config('app.name') }}</h3>
<p>Sua conta na plataforma foi criada</p>
<p>
    <a href="{{ $link = route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) }}">
        Clique aqui
    </a>
    para verificar sua conta
</p>

<p>Não responda este e-mail, ele é gerado automaticamente.</p>
