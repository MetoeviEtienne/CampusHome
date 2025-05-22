<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de paiement</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .details {
            margin-bottom: 20px;
        }

        .details th, .details td {
            padding: 8px;
            text-align: left;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f4f4f4;
        }

        td, th {
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reçu de Paiement</h2>
        <p>{{ \Carbon\Carbon::now()->format('d/m/Y à H:i') }}</p>
    </div>

    <table class="details">
        <tr>
            <th>Transaction ID</th>
            <td>{{ $transactionId }}</td>
        </tr>
        <tr>
            <th>Type de paiement</th>
            <td>{{ ucfirst($type) }}</td>
        </tr>
        <tr>
            <th>Montant payé</th>
            <td>{{ number_format($montant, 2, ',', ' ') }} FCFA</td>
        </tr>
        @if($type === 'avance')
        <tr>
            <th>Taxe prélevée (admin)</th>
            <td>{{ number_format($taxe, 2, ',', ' ') }} FCFA</td>
        </tr>
        @endif
        <tr>
            <th>Locataire</th>
            <td>{{ $etudiant->name }}</td>
        </tr>
        <tr>
            <th>Propriétaire</th>
            <td>{{ $proprietaire->name }}</td>
        </tr>

        <tr>
            <th>Logement</th>
            <td>{{ $logement->titre }} - {{ $logement->adresse }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Merci pour votre confiance.</p>
        <p>Ce reçu a été généré automatiquement par le système CampusHome.</p>
    </div>
</body>
</html>
