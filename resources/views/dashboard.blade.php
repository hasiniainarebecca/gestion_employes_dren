@extends('layouts.template')

@section('content')
<h1 class="app-page-title" style="color:#2F7693">Gestion des ressources humaines de la DREN</h1>
			    

    
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Service</h4>
                <div class="stats-figure">{{ $totalService }}</div>
            </div><!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div><!--//app-card-->
    </div><!--//col-->
    
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Employé</h4>
                <div class="stats-figure">{{ $totalEmployes }}</div>
            </div><!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Administrateur</h4>
                <div class="stats-figure">{{ $totalAdministrateurs }}</div>
            </div><!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <!--<div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Retard de payement</h4>
                <div class="stats-figure">0</div>
            </div>
            <a class="app-card-link-mask" href="#"></a>
        </div>-->
    </div>
</div>

<div class="app-branding">
        <img src="assets/images/fontGRH.jpg" style="width:100%;height:1000%;">

</div>

@endsection