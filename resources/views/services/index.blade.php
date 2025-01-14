@extends('layouts.template')

@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Listes des services</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center">
					                    <div class="col-auto">
					                        <input type="text" id="search" name="search" value="{{ $search ?? '' }}" class="form-control search-orders" placeholder="Rechercher un service...">
					                    </div>
					                    <div class="col-auto">
					                        <button type="submit" class="btn app-btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
					                    </div>
					                </form>
					                
							    </div><!--//col-->
								<div class="col-auto">
        									<a href="{{ route('services.index') }}" class="btn app-btn-secondary">
            								<i class="fa-solid fa-arrows-rotate"></i> Actualiser
        									</a>
    							</div>
							    
							    <div class="col-auto">						    
								    <a class="btn app-btn-secondary" href="{{route('services.create')}}">
									    <i class="fa-solid fa-plus"></i>
									    Ajouter service
									</a>
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
				@if(!empty($search))
    <div class="alert alert-success">
        <h5>Résultat pour "{{ $search }}" :</h5>
        @forelse ($services as $service)
            <p>
                Nom : {{ $service->nom }} <br>
            </p>
        @empty
            <p>Aucun service trouvé.</p>
        @endforelse
    </div>
@endif
				
	
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
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
												<th class="cell">Sigle</th>
												<th class="cell">Intitulé</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>

										@forelse($services as $service)
                                            <tr>
												<td class="cell">{{ $service->id }}</td>
												<td class="cell"><span class="truncate">{{ $service->nom }}</span></td>
												<td class="cell">{{ $service->a_propos }}</td>
												<td class="cell">
													<a class="btn-sm app-btn-secondary" href="{{ route('services.employes', $service->id) }}">Voir les employés</a>
													<a class="btn-sm app-btn-secondary" href="{{ route('services.edit', $service->id) }}">Modifier</a>
													<a class="btn-sm app-btn-secondary" href="{{ route('services.delete', $service->id) }}">Supprimer</a>
												</td>
											</tr>
										@empty
                                            <tr>
												<td class="cell" colspan="2">Aucun service ajouter</td>
											</tr>
										@endforelse
											
											
		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
						<nav class="app-pagination">
							{{ $services->links() }}
						</nav><!--//app-pagination-->
						
			        </div><!--//tab-pane-->
			        
				</div><!--//tab-content-->

@endsection