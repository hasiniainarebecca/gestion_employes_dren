@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Paramètres d'affichage</h2>

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="theme">Choisir un thème</label>
                <select name="theme" id="theme" class="form-control">
                    <option value="light" {{ isset($settings) && $settings->theme == 'light' ? 'selected' : '' }}>Clair</option>
                    <option value="dark" {{ isset($settings) && $settings->theme == 'dark' ? 'selected' : '' }}>Sombre</option>
                </select>
            </div>

            <div class="form-group">
                <label for="language">Langue de l'interface</label>
                <select name="language" id="language" class="form-control">
                    <option value="en" {{ isset($settings) && $settings->language == 'en' ? 'selected' : '' }}>Anglais</option>
                    <option value="fr" {{ isset($settings) && $settings->language == 'fr' ? 'selected' : '' }}>Français</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dashboard_layout">Disposition du tableau de bord (JSON)</label>
                <textarea name="dashboard_layout" id="dashboard_layout" class="form-control">{{ isset($settings) ? $settings->dashboard_layout : '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </form>
    </div>
@endsection