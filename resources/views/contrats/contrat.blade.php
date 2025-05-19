<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contrat de location</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.5;
            margin: 40px;
            position: relative;
        }
        h2 {
            text-align: center;
            margin-top: 10px;
        }
        p {
            margin: 10px 0;
        }
        strong {
            color: #333;
        }
        .watermark {
            position: fixed;
            bottom: 30px;
            width: 100%;
            text-align: center;
            font-size: 22px;
            color: rgba(150, 150, 150, 0.25); /* gris clair et transparent */
            z-index: 0;
        }
    </style>
</head>
<body>
    <h2>Contrat de location</h2>

    <p>Ce contrat est établi entre <strong>{{ $etudiant->name }}</strong> (le locataire) et le propriétaire <strong>{{ $logement->proprietaire->name }}</strong>.</p>

    <p><strong>Type du logement :</strong> {{ $logement->type }}</p>
    <p><strong>Adresse du logement :</strong> {{ $logement->adresse }}</p>

    <p><strong>Durée de la location :</strong> du {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</p>

    <p><strong>Prix du logement (loyer mensuel) :</strong> {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA</p>

    <p><strong>Premier paiement (avance) :</strong> {{ number_format($logement->loyer * 3, 0, ',', ' ') }} FCFA (correspond à 3 mois de loyer)</p>
    <p><strong>Les paiements suivants :</strong> seront effectués mensuellement au montant de {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA.</p>

    <h3>Engagements des parties</h3>

    <p>Le locataire s'engage à respecter le logement, à maintenir de bonnes relations avec le propriétaire, et à faire preuve de bonne moralité tout au long de la location.</p>
    <p>Le propriétaire s'engage à fournir un logement en bon état et à respecter les droits du locataire.</p>

    <p><strong>Date de génération :</strong> {{ now()->format('d/m/Y') }}</p>

    <p>Signature du locataire : ________________________</p>
    <p>Signature du propriétaire : ______________________</p>

    <!-- FILIGRANE -->
    <div class="watermark">CampusHome</div>
</body>
</html>
