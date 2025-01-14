@extends('layouts.template')

@section('content')
<style>
	.table-container {
        display: grid;
        grid-template-columns: 160px 300px 100px 1fr; /* 4 colonnes de taille égale */
        gap: 10px; /* Espacement entre les colonnes */
        align-items: center; /* Centrer verticalement le contenu dans chaque cellule */
    }
    .table-header {
        font-weight: bold; /* Mettre les en-têtes en gras */
        text-align: left; /* Aligner le texte à gauche */
    }
    .table-cell {
        padding: 5px; /* Ajoute un peu d'espace intérieur */
    }
	.espace {
    display: inline-block;
    width: 100px; /* Largeur pour définir l'espace */
    }
</style>
<div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Liste des employés dans le service : {{ $service->nom }}</h1>
				    </div>
				    
					                
</div><!--//col-->



    @if($employes->count() > 0)
    <div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
        <table class="table app-table-hover mb-0 text-left">
            <thead>
                <tr>
                    <th class="cell">IM</th>
                    <th class="cell">Nom</th>
                    <th class="cell">Prénom</th>
                    <th class="cell">Email</th>
                    <th class="cell">Contact</th>
                    <th class="cell">Fonction</th>
                    <th class="cell">Photo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employes as $employe)
                    <tr>
                        <td class="cell">{{ $employe->montant_journalier }}</td>
                        <td class="cell">{{ $employe->nom }}</td>
                        <td class="cell">{{ $employe->prenom }}</td>
                        <td class="cell">{{ $employe->email }}</td>
                        <td class="cell">{{ $employe->contact }}</td>
                        <td class="cell">{{ $employe->sexe }}</td>
                        <td>
                    		@if ($employe->photo)
                        		<img src="{{ asset('storage/' . $employe->photo) }}" alt="Photo de {{ $employe->nom }}" width="50" height="50">
                    		@else
                        		<span>Aucune photo</span>
                    		@endif
                		</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun employé n'est associé à ce service.</p>
    @endif
    <a href="{{ route('services.index') }}" class="btn btn-primary">Retour</a>
    
    </div>
    </div>
    </div>
    </div>
    </div>
</div>
@endsection
