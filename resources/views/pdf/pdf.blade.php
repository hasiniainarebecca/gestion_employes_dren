<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Employé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .card {
            background-image: url("{{ public_path('logos/badge.jpeg') }}");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 270px;
            height: 493px;
            border: 1px solid #000;
            padding: 10px;
            margin: 0 auto;
            text-align: center;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            position: relative;
        }

        .header img {
            width: 30px;
            height: 30px;
            position: absolute;
        }

        .header .left{
            left:-5px;
        }

        .header .right{
            right: -5px;
        }
        .header .title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            flex-grow: 1;
            margin: 0 10px;
        }

        .dren {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin: 5px 0;
        }

        .photo {
            margin: 15px auto;
            width: 150px;
            height: 150px;
            border: 2px solid #407F3E;
            border-radius: 50%;
            overflow: hidden;
            margin-top: 130px;
        }
        
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .name {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0;
        }

        .fonction{
            text-transform: uppercase;
            font-size: 20px;
            font-weight: bold;
            color:#665191;
        }
        .im{
            font-size: 14px;
            color: #555;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .service {
            font-size: 16px;
            color: #BE0A0B;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .details {
            text-align: left;
            margin: 0 10px;
            font-size: 12px;
        }

        .details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="card">
        
        <!-- Photo Section -->
        <div class="photo">
            <img src="{{ public_path('storage/' . $employe->photo) }}" alt="Photo de l'employé">
        </div>

        <!-- Name Section -->
        <div class="name">
            {{ $employe->nom }} </br> {{ $employe->prenom }}
        </div>

        <!-- Service Section -->
        <div class="im">
            IM : {{ $employe->montant_journalier }}
        </div>

        <div class="fonction">
            {{ $employe->sexe }}
        </div>

        <div class="service">
            {{ $employe->service->nom }}
        </div>

        <!-- Details Section -->
        <!--<div class="details">
            <p><strong>Date de naissance :</strong> </p>
            <p><strong>Genre :</strong> {{ $employe->service->nom }}</p>
            <p><strong>Email :</strong> {{ $employe->email }}</p>
            <p><strong>Contact :</strong> {{ $employe->contact }}</p>
        </div>-->
    </div>
</body>
</html>
