<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contrat de location</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; line-height: 1.6; }
        h1 { font-size: 18px; }
    </style>
</head>
<body>
    <h1>Contrat de location</h1>

    <p>Entre :</p>
    <p><strong>Propriétaire :</strong> {{ $reservation->logement->proprietaire->name }}</p>

    <p>Et :</p>
    <p><strong>Étudiant :</strong> {{ $reservation->etudiant->name }}</p>

    <p>Concernant le logement situé à <strong>{{ $reservation->logement->adresse }}</strong></p>

    <p>Date de début de location : <strong>{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}</strong></p>

    <p>Montant du loyer mensuel : <strong>{{ number_format($reservation->logement->loyer, 0, ',', ' ') }} FCFA</strong></p>

    <p>Fait à {{ $reservation->logement->proprietaire->ville }}, le {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
</body>
</html>
