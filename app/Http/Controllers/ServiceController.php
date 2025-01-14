<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveServiceRequest;
use App\Models\Services;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request){
        //$services = Services::paginate(10);
        //return view('services.index',compact('services'));

        // Récupérer le mot-clé de recherche
        $search = $request->input('search');

        // Chercher dans la table des services (par exemple, selon le nom)
        $services = Services::query()
        ->when($search, function ($query, $search) {
            return $query->where('nom', 'like', "%{$search}%");
        })
        ->paginate(10);

        return view('services.index', compact('services', 'search'));
    }

    public function create(){
        return view('services.create');
    }

    public function edit($id){
        $service = Services::findOrFail($id);
        return view('services.edit',compact('service'));
    }

    //Interraction avec la base de données
    public function store(Services $service,saveServiceRequest $request){
        //Enregistrer un nouveau service
        try {
            //$service->nom = $request->nom;
            //$service->save();
            $request->validate([
                'nom' => 'required|string|max:255',
                'a_propos' => 'nullable|string',
            ]);
        
            Services::create($request->all());
            return redirect()->route('services.index')->with('success_message','Service enregistré avec succès');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function update(saveServiceRequest $request,$id){
        //Enregistrer les modifications du service
        $request->validate([
            'nom'=>'required|string|max:255',
            'a_propos' => 'nullable|string',
        ]);
        $service = Services::findOrFail($id);
        $service->update($request->all());
        //$service->nom=$request->input('nom');
        //$service->save();
        return redirect()->route('services.index')->with('success_message','Service mis à jour avec succès');
    }

    public function delete($id){
        //Supprimer un service
        $service = Services::findOrFail($id);
        if ($service->employes()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer ce service car il est lié à des employés.');
        }


        $service->delete();
        return redirect()->route('services.index')->with('success_message','Service supprimé avec succès');
    }
     
    
    public function showEmployes($id)
    {
        $service = Services::findOrFail($id); // Trouver le service par ID
        $employes = $service->employes; // Récupérer les employés associés

        return view('services.employes', compact('service', 'employes'));
    }
}
