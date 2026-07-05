<x-guest-layout>
    <div class="auth-card">
        <a href="{{ route('home') }}" class="auth-brand">
            <span class="auth-brand__mark">PA</span>
            <span>
                <strong>Admin Portfolio</strong>
                <small>Gestion de votre vitrine</small>
            </span>
        </a>

        <div class="auth-heading">
            <p>Connexion sécurisée</p>
            <h1>Bienvenue</h1>
            <span>Accédez au tableau de bord pour mettre à jour vos contenus.</span>
        </div>

        <x-auth-session-status class="auth-status" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="auth-field">
                <label for="email">Adresse email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="vous@exemple.com">
                <x-input-error :messages="$errors->get('email')" class="auth-error" />
            </div>

            <div class="auth-field">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Votre mot de passe">
                <x-input-error :messages="$errors->get('password')" class="auth-error" />
            </div>

            <div class="auth-options">
                <label class="auth-check" for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Se souvenir de moi</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                @endif
            </div>

            <button type="submit" class="auth-submit">Se connecter</button>

            @if (! \App\Models\User::query()->exists())
                <a href="{{ route('register') }}" class="auth-secondary-action">Créer le compte administrateur</a>
            @endif
        </form>
    </div>
</x-guest-layout>
