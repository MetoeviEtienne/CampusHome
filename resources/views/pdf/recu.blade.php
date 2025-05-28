<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Reçu de paiement - CampusHome</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&display=swap');

    body {
      font-family: 'Nunito Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
        Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
      background: #f9fafb;
      color: #2c3e50;
      margin: 0;
      padding: 0;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    .container {
      max-width: 600px;
      background: #fff;
      margin: 40px auto;
      padding: 32px 40px;
      border-radius: 12px;
      box-shadow: 0 16px 40px rgb(0 0 0 / 0.08);
      border-top: 6px solid #3b82f6;
    }

    .header {
      text-align: center;
      margin-bottom: 32px;
    }

    .header img {
      width: 80px;
      margin-bottom: 16px;
    }

    .header h2 {
      font-weight: 700;
      font-size: 1.9rem;
      margin: 0 0 8px;
      color: #1e293b;
      letter-spacing: 1px;
    }

    .header p {
      font-size: 0.9rem;
      color: #64748b;
      margin: 0;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      margin-bottom: 32px;
    }

    th, td {
      padding: 12px 16px;
      text-align: left;
      font-weight: 600;
      font-size: 1rem;
      border-radius: 8px;
    }

    th {
      background: #f3f4f6;
      color: #475569;
      width: 40%;
      vertical-align: middle;
      box-shadow: inset 4px 4px 8px #d1d5db,
                  inset -4px -4px 8px #ffffff;
    }

    td {
      background: #e0e7ff;
      color: #1e293b;
      box-shadow: inset 4px 4px 8px #bec8f7,
                  inset -4px -4px 8px #ffffff;
    }

    .footer {
      text-align: center;
      font-size: 0.85rem;
      color: #94a3b8;
      border-top: 1px solid #e2e8f0;
      padding-top: 20px;
      letter-spacing: 0.3px;
      line-height: 1.4;
    }

    @media (max-width: 480px) {
      .container {
        padding: 24px 20px;
        margin: 20px 10px;
      }

      th, td {
        padding: 10px 12px;
        font-size: 0.9rem;
      }

      .header h2 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="container" role="main" aria-label="Reçu de paiement CampusHome">
    <header class="header">
      <!-- Remplace cette image par le logo réel de ton projet -->
      <img src="https://cdn-icons-png.flaticon.com/512/1828/1828817.png" alt="Logo CampusHome" />
      <h2>Reçu de Paiement</h2>
      <p>{{ \Carbon\Carbon::now()->format('d/m/Y à H:i') }}</p>
    </header>

    <table role="table" aria-describedby="recu-details">
      <tbody>
        <tr>
          <th scope="row">Transaction ID</th>
          <td>{{ $transactionId }}</td>
        </tr>
        <tr>
          <th scope="row">Type de paiement</th>
          <td>{{ ucfirst($type) }}</td>
        </tr>
        <tr>
          <th scope="row">Montant payé</th>
          <td>{{ number_format($montant, 2, ',', ' ') }} FCFA</td>
        </tr>
        @if($type === 'avance')
        <tr>
          <th scope="row">Taxe prélevée (admin)</th>
          <td>{{ number_format($taxe, 2, ',', ' ') }} FCFA</td>
        </tr>
        @endif
        <tr>
          <th scope="row">Locataire</th>
          <td>{{ $etudiant->name }}</td>
        </tr>
        <tr>
          <th scope="row">Propriétaire</th>
          <td>{{ $proprietaire->name }}</td>
        </tr>
        <tr>
          <th scope="row">Logement</th>
          <td>{{ $logement->titre }} - {{ $logement->adresse }}</td>
        </tr>
      </tbody>
    </table>

    <footer class="footer" role="contentinfo">
      <p>Merci pour votre confiance.</p>
      <p>Ce reçu a été généré automatiquement par le système <strong>CampusHome</strong>.</p>
    </footer>
  </div>
</body>
</html>




{{-- <!DOCTYPE html>
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
</html> --}}
