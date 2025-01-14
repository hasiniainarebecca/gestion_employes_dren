<?php

namespace App\Http\Controllers;

use App\Models\Employes;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer le mot-clé de recherche
        $search = $request->input('search');

        // Chercher dans la table des employés (nom, email, ou position)
        $employees = Employes::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('position', 'like', "%{$search}%");
            })
            ->paginate(10); // Paginer les résultats

        return view('employees.index', compact('employees', 'search'));
    }
}
