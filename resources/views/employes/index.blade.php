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
			            <h1 class="app-page-title mb-0">Listes des employés</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center" action="{{ route('employe.index') }}" method="GET">
									<div class="col-auto">
										<label for="excel_file">Rechercher par le nom de l'agent :</label> 
									</div>
									<div class="col-auto">
					                        <input type="text" id="search" name="search" value="{{ $search ?? '' }}" class="form-control search-orders" placeholder="Rechercher un employé...">
					                    </div>
					                    <div class="col-auto">
					                        <button type="submit" class="btn app-btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
					                    </div>
					                </form>
					                
							    </div><!--//col-->
							    <div class="col-auto">
        									<a href="{{ route('employe.index') }}" class="btn app-btn-secondary">
            								<i class="fa-solid fa-arrows-rotate"></i> Actualiser
        									</a>
    							</div>
							    <div class="col-auto">						    
								    <a class="btn app-btn-secondary" href="{{ route('employe.create')}}">
									<i class="fa-solid fa-plus"></i>
									    Ajouter employé
									</a>
							    </div>
								<div class="col-auto">						    
								    <a class="btn app-btn-secondary" href="{{ route('employes.export') }}">
									<i class="fa-solid fa-file-export"></i>
									    Exporter en csv
									</a>
							    </div>
								<div class="col-auto">
    <form action="{{ route('employes.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="excel_file">Importer un fichier Excel :</label>
        <input type="file" name="excel_file" id="excel_file" required>
        <button type="submit" class="btn app-btn-secondary">
            <i class="fa-solid fa-file-import"></i>
            Importer
        </button>
    </form>
</div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
				@if (!empty($search))
    <div style="background:white">
        <h4>Résultat de la recherche</h4>
		@if ($highlightedEmployees->isNotEmpty())
			@foreach ($highlightedEmployees as $highlightedEmployee)
			<div class="alert alert-success">
		<div class="table-container">
			<div class="table-header table-cell">Nom :</div>
    		<div class="table-cell">{{ $highlightedEmployee->nom }}</div>
    		<div class="table-header table-cell">Prénom :</div>
    		<div class="table-cell">{{ $highlightedEmployee->prenom }}</div>
			<!--<div class="table-header table-cell">Date de naissance :</div>
    		<div class="table-cell">{{ $highlightedEmployee->date_naissance }}</div>-->
    		<div class="table-header table-cell">Fonction :</div>
    		<div class="table-cell">{{ $highlightedEmployee->sexe }}</div>
			<div class="table-header table-cell">Email :</div>
    		<div class="table-cell">{{ $highlightedEmployee->email }}</div>
    		<div class="table-header table-cell">Contact :</div>
    		<div class="table-cell">{{ $highlightedEmployee->contact }}</div>
			<div class="table-header table-cell">Service :</div>
    		<div class="table-cell">{{ $highlightedEmployee->service->nom ?? 'Non assigné' }}</div>
		</div>
		</div>
			@endforeach
		@else
		<div class="table-container">
			<p>Aucun employé trouvé.</p>
		</div>
		@endif
    </div>
@endif

			    
			   
				@if(Session::get('success_message'))
					<div class="alert alert-success">{{ Session::get('success_message') }}</div>
				@endif
				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">#</th>
												<th class="cell">IM</th>
												<th class="cell">Nom</th>
												<th class="cell">Prénoms</th>
                                                <!--<th class="cell">Date de naissance</th>-->
												<th class="cell">Email</th>
												<th class="cell">Contact</th>
												<th class="cell">Service</th>
												<th class="cell">Fonction</th>
                                                <th class="cell">Photo</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
                                        @forelse($employes as $employe)
                                            <tr>
												<td class="cell">{{ $employe->id }}</td>
												<td class="cell">{{ $employe->montant_journalier }}</td>
												<td class="cell">{{ $employe->nom }}</td>
												<td class="cell">{{ $employe->prenom }}</td>
												<!--<td class="cell">{{ $employe->date_naissance }}</td>-->
												<td class="cell">{{ $employe->email }}</td>
												<td class="cell">{{ $employe->contact }}</td>
												<td class="cell">{{ $employe->service->nom ?? 'Aucun service'  }}</td>
												<td class="cell">{{ $employe->sexe }}</td>
												<td>
                    								@if ($employe->photo)
                        								<img src="{{ asset('storage/' . $employe->photo) }}" alt="Photo de {{ $employe->nom }}" width="50" height="50">
                    								@else
                        								<span>Aucune photo</span>
                    								@endif
                								</td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="{{ route('employe.edit',$employe->id) }}">Modifier</a></td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="{{ route('employe.delete',$employe->id) }}">Supprimer</a></td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="{{ route('employe.print', $employe->id) }}">Imprimer</a></td>
											</tr>
                                        @empty
                                            <tr>
												<td class="cell" colspan="10">Aucun employe ajouter</td>
											</tr>
                                        @endforelse
											
											
		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
						<nav class="app-pagination">
							{{ $employes->links() }}
						</nav><!--//app-pagination-->
						
			        </div><!--//tab-pane-->

				</div><!--//tab-content-->

@endsection