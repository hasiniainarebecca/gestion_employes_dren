@extends('layouts.template')

@section('content')
<style>
	.table-container {
        display: grid;
        grid-template-columns: 100px 300px; /* 4 colonnes de taille égale */
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
			            <h1 class="app-page-title mb-0">Listes des administrateurs</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center">
					                    <div class="col-auto">
					                        <input type="text" id="search" name="search" value="{{ $search ?? '' }}" class="form-control search-orders" placeholder="Rechercher un adminstrateur...">
					                    </div>
					                    <div class="col-auto">
					                        <button type="submit" class="btn app-btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
					                    </div>
					                </form>
					                
							    </div><!--//col-->
								<div class="col-auto">
        									<a href="{{ route('administrateurs') }}" class="btn app-btn-secondary">
            								<i class="fa-solid fa-arrows-rotate"></i> Actualiser
        									</a>
    							</div>
							    
							    <div class="col-auto">						    
								    <a class="btn app-btn-secondary" href="{{route('administrateurs.create')}}">
									<i class="fa-solid fa-plus"></i>
									    Ajouter administrateur
									</a>
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
				@if(!empty($search))
    			<div class="alert alert-success">
        		<h5>Résultat pour "{{ $search }}" :</h5>
        		@forelse ($admins as $admin)
				<div class="table-container">
					<div class="table-header table-cell">Nom :</div><div class="table-cell">{{ $admin->name }}</div>
                	<div class="table-header table-cell">Email :</div><div class="table-cell">{{ $admin->email }}</div>
				</div>
        		@empty
            	<p>Aucun administrateur trouvé.</p>
        		@endforelse
    			</div>
				@endif
			    
			   
				@if(Session::get('success_message'))
					<div class="alert alert-success">{{ Session::get('success_message') }}</div>
				@endif

				@if(Session::get('error_msg'))
					<div class="alert alert-danger">{{ Session::get('error_msg') }}</div>
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
												<th class="cell">Nom complet</th>
												<th class="cell">Email</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
                                        @forelse($admins as $admin)
                                            <tr>
												<td class="cell">{{ $admin->id }}</td>
												<td class="cell">{{ $admin->name }}</td>
												<td class="cell">{{ $admin->email }}</td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="{{ route('administrateurs.delete',$admin->id) }}">Supprimer</a></td>
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
							{{ $admins->links() }}
						</nav><!--//app-pagination-->
						
			        </div><!--//tab-pane-->

				</div><!--//tab-content-->

@endsection