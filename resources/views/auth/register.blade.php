<x-guest-layout>
    <div class="auth-card">
        <a href="{{ route('home') }}" class="auth-brand">
            <span class="auth-brand__mark">PA</span>
            <span>
                <strong>Admin Portfolio</strong>
                <small>Premier démarrage</small>
            </span>
        </a>

        <div class="auth-heading">
            <p>Création unique</p>
            <h1>Compte admin</h1>
            <span>Ce compte sera le seul autorisé à gérer le portfolio. Après sa création, l'inscription sera automatiquement fermée.</span>
        </div>

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <div class="auth-field">
                <label for="name">Nom</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Votre nom">
                <x-input-error :messages="$errors->get('name')" class="auth-error" />
            </div>

            <div class="auth-field">
                <label for="email">Adresse email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="vous@exemple.com">
                <x-input-error :messages="$errors->get('email')" class="auth-error" />
            </div>

            <div class="auth-field">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Choisissez un mot de passe">
                <x-input-error :messages="$errors->get('password')" class="auth-error" />
            </div>

            <div class="auth-field">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Répétez le mot de passe">
                <x-input-error :messages="$errors->get('password_confirmation')" class="auth-error" />
            </div>

            <button type="submit" class="auth-submit">Créer l'administrateur</button>

            <a href="{{ route('login') }}" class="auth-secondary-action">J'ai déjà un compte</a>
        </form>
    </div>
</x-guest-layout>
