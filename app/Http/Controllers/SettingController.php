<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // Méthode pour afficher les paramètres
    public function show()
{
    $settings = auth()->user()->setting;

    // Si les paramètres n'existent pas, créez-les avec des valeurs par défaut
    if (!$settings) {
        $settings = auth()->user()->setting()->create([
            'theme' => 'light', 
            'language' => 'en', 
            'dashboard_layout' => null,
        ]);
    }

    return view('settings.index', compact('settings'));
}

    // Méthode pour mettre à jour les paramètres
    public function update(Request $request)
    {
        $request->validate([
            'theme' => 'required|in:light,dark',
            'language' => 'required|in:en,fr',
            'dashboard_layout' => 'nullable|json',
        ]);

        $settings = auth()->user()->setting;

        // Mise à jour des paramètres
        $settings->update([
            'theme' => $request->theme,
            'language' => $request->language,
            'dashboard_layout' => $request->dashboard_layout ? json_encode($request->dashboard_layout) : null,
        ]);

        return redirect()->route('settings.index')->with('success', 'Paramètres mis à jour');
    }
    public function index()
    {
        // Récupérer les paramètres associés à l'utilisateur connecté
        $settings = auth()->user()->setting;

        // Passer les paramètres à la vue
        return view('settings.index', compact('settings'));
    }
    public function __construct()
{
    $this->middleware('auth'); // Cette ligne assure que seuls les utilisateurs authentifiés peuvent accéder à cette page
}
    
}
