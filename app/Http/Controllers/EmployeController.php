<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Employes;
use App\Models\Services;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');

    // Chercher des employés correspondant au mot-clé
    $highlightedEmployees = collect(); // Collection vide par défaut

    if ($search) {
        $highlightedEmployees = Employes::where('nom', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->with('service') // Charger la relation service
            ->get(); // Récupérer tous les employés correspondants
    }

    // Liste des employés pour l'affichage normal
    $employes = Employes::with('service')->paginate(10);

    return view('employes.index', compact('employes', 'highlightedEmployees', 'search'));
    }

    public function create(){
        $services = Services::all();
        return view('employes.create',compact('services'));
    }

    public function edit(Employes $employe){
        $services = Services::all();
        return view('employes.edit',compact('employe','services'));
    }
    
    public function store(Request $request){
        
       $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'contact' => 'required|string|max:20',
        'date_naissance' => 'nullable|date',
        'montant_journalier' => 'nullable|numeric|min:0',
        'sexe' => 'required|string',
        'service_id' => 'required|exists:services,id',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
    ]);

    // Gestion de l'image
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('employes/photos', 'public');
        $validatedData['photo'] = $photoPath;
    }

    Employes::create($validatedData);

    return redirect()->route('employe.index')->with('success', 'Employé ajouté avec succès');
    }

    public function update(UpdateEmployeRequest $request,Employes $employe){
        try {
            // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'nullable|date',
            'sexe' => 'required|string',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:20',
            'montant_journalier' => 'nullable|numeric|min:0',
            'service_id' => 'required|exists:services,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mise à jour des données de l'employé
        $employe->nom = $validatedData['nom'];
        $employe->prenom = $validatedData['prenom'];
        //$employe->date_naissance = $validatedData['date_naissance'];
        $employe->sexe = $validatedData['sexe'];
        $employe->email = $validatedData['email'];
        $employe->contact = $validatedData['contact'];
        //$employe->montant_journalier = $validatedData['montant_journalier'];
        $employe->service_id = $validatedData['service_id'];

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($employe->photo) {
                Storage::disk('public')->delete($employe->photo);
            }

            // Enregistrer la nouvelle photo
            $photoPath = $request->file('photo')->store('employes/photos', 'public');
            $employe->photo = $photoPath;
        }
        $employe->save();

        return redirect()->route('employe.index')->with('success_message', 'Les informations de l\'employé ont été mises à jour avec succès.');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function delete(Employes $employe){
        try {
            $employe->delete();
            return redirect()->route('employe.index')->with('success_message','Employé supprimer avec succès');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function print($id)
    {
        $employe = Employes::findOrFail($id);

        // Chargement de la vue pour le PDF
        $pdf = PDF::loadView('pdf.pdf', compact('employe'));

        // Téléchargement du fichier PDF
        return $pdf->download("employe_{$employe->id}.pdf");
    }

}
