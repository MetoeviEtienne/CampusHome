<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Contrat de location - CampusHome</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab&family=Nunito+Sans:wght@400;600&display=swap');

    body {
      font-family: 'Nunito Sans', sans-serif;
      color: #2c3e50;
      background: #f9fafb;
      margin: 40px auto;
      max-width: 700px;
      padding: 30px 40px;
      box-shadow: 0 12px 30px rgb(0 0 0 / 0.07);
      border-radius: 12px;
      position: relative;
      line-height: 1.6;
    }

    h2 {
      font-family: 'Roboto Slab', serif;
      font-weight: 700;
      font-size: 2.2rem;
      color: #2563eb;
      text-align: center;
      margin-bottom: 30px;
      letter-spacing: 1.1px;
      text-transform: uppercase;
    }

    h3 {
      color: #334155;
      font-weight: 600;
      margin-top: 40px;
      margin-bottom: 16px;
      border-bottom: 2px solid #3b82f6;
      padding-bottom: 6px;
    }

    p {
      font-size: 1rem;
      margin: 12px 0;
    }

    strong {
      color: #1e293b;
      font-weight: 600;
    }

    .section {
      margin-bottom: 24px;
    }

    /* Signature */
    .signatures {
      margin-top: 60px;
      display: flex;
      justify-content: space-between;
      gap: 20px;
    }

    .signature-box {
      width: 45%;
      border-top: 2px solid #3b82f6;
      padding-top: 8px;
      font-weight: 600;
      color: #475569;
      font-size: 1rem;
      text-align: center;
    }

    /* Filigrane */
    .watermark {
      position: fixed;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%);
      font-family: 'Roboto Slab', serif;
      font-size: 48px;
      color: rgba(100, 116, 139, 0.12);
      user-select: none;
      pointer-events: none;
      z-index: 0;
      letter-spacing: 12px;
    }

    /* Responsive */
    @media (max-width: 600px) {
      body {
        margin: 20px 15px;
        padding: 20px 25px;
      }

      .signatures {
        flex-direction: column;
        gap: 40px;
      }

      .signature-box {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <h2>Contrat de location</h2>

  <div class="section">
    <p>Ce contrat est établi entre <strong>{{ $etudiant->name }}</strong> (le locataire) et le propriétaire <strong>{{ $logement->proprietaire->name }}</strong>.</p>

    <p><strong>Type du logement :</strong> {{ $logement->type }}</p>
    <p><strong>Adresse du logement :</strong> {{ $logement->adresse }}</p>

    <p><strong>Durée de la location :</strong> du {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</p>

    <p><strong>Prix du logement (loyer mensuel) :</strong> {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA</p>

    <p><strong>Premier paiement (avance) :</strong> {{ number_format($logement->loyer * 3, 0, ',', ' ') }} FCFA (correspond à 3 mois de loyer)</p>
    <p><strong>Les paiements suivants :</strong> seront effectués mensuellement au montant de {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA.</p>
  </div>

  <h3>Engagements des parties</h3>
  <div class="section">
    <p>Le locataire s'engage à respecter le logement, à maintenir de bonnes relations avec le propriétaire, et à faire preuve de bonne moralité tout au long de la location.</p>
    <p>Le propriétaire s'engage à fournir un logement en bon état et à respecter les droits du locataire.</p>
  </div>

  <p><strong>Date de génération :</strong> {{ now()->format('d/m/Y') }}</p>

  <div class="signatures">
    <div class="signature-box">
      Signature du locataire
    </div>
    <div class="signature-box">
      Signature du propriétaire
    </div>
  </div>

  <div class="watermark">CampusHome</div>
</body>
</html>








{{-- <!DOCTYPE html>
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
</html> --}}
