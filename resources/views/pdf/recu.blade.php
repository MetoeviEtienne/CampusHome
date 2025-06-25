<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Reçu de paiement – CampusHome</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&display=swap');

    body {
      font-family: 'Nunito Sans', sans-serif;
      background: #f9fafb;
      color: #1e293b;
      padding: 50px 30px;
      max-width: 700px;
      margin: auto;
      border-radius: 12px;
      box-shadow: 0 12px 32px rgba(0,0,0,0.07);
      position: relative;
    }

    /* Header */
    .header {
      display: flex;
      align-items: center;
      gap: 14px;
      border-bottom: 4px solid #3b82f6;
      padding-bottom: 18px;
      margin-bottom: 36px;
    }

    .header img {
      width: 70px;
      height: auto;
    }

    .brand {
      font-weight: 700;
      font-size: 1.6rem;
      letter-spacing: 0.5px;
    }

    .brand .green {
      color: #10b981;
    }

    h2 {
      font-size: 1.8rem;
      font-weight: 700;
      text-align: center;
      margin: 30px 0 12px;
    }

    .date {
      text-align: center;
      font-size: 0.95rem;
      color: #64748b;
      margin-bottom: 28px;
    }

    /* Table stylisée */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 36px;
    }

    th, td {
      padding: 14px 16px;
      text-align: left;
      font-size: 1rem;
      border-radius: 8px;
    }

    th {
      background-color: #f3f4f6;
      color: #475569;
      width: 40%;
    }

    td {
      background-color: #e0e7ff;
      color: #1e293b;
      font-weight: 600;
    }

    /* Footer */
    .footer {
      text-align: center;
      font-size: 0.9rem;
      color: #94a3b8;
      border-top: 1px solid #e2e8f0;
      padding-top: 20px;
      line-height: 1.5;
    }

    /* Filigrane */
    .watermark {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 52px;
      font-weight: 700;
      color: rgba(100,116,139,0.08);
      pointer-events: none;
      user-select: none;
    }

    @media (max-width: 640px) {
      body {
        padding: 30px 20px;
      }

      th, td {
        font-size: 0.95rem;
      }

      .header {
        flex-direction: column;
        text-align: center;
        gap: 10px;
      }

      .brand {
        font-size: 1.4rem;
      }
    }
  </style>
</head>
<body>

  <!-- Bandeau avec logo + nom -->
  <div class="header">
    <img src="{{ public_path('images/logo2.png') }}" alt="Logo CampusHome">
    <div class="brand">
      <span>Campus</span><span class="green">Home</span>
    </div>
  </div>

  <h2>Reçu de Paiement</h2>
  <div class="date">{{ \Carbon\Carbon::now()->format('d/m/Y à H:i') }}</div>

  <table role="table">
    <tbody>
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
    </tbody>
  </table>

  <div class="footer">
    <p>Merci pour votre confiance.</p>
    <p>Ce reçu a été généré automatiquement par la plateforme <strong>CampusHome</strong>.</p>
  </div>

  <div class="watermark">CampusHome</div>

</body>
</html>
