<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Contrat de location – CampusHome</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap');

        *{box-sizing:border-box;margin:0;padding:0}
        body{
            font-family:'Nunito Sans',sans-serif;
            color:#334155;
            background:#f9fafb;
            max-width:750px;
            margin:40px auto;
            padding:48px 56px;
            line-height:1.65;
            border-radius:14px;
            box-shadow:0 14px 40px rgba(0,0,0,.08);
            position:relative;
        }

        /* ----------  Bandeau supérieur  ---------- */
        .header-bar{
            display:flex;align-items:center;gap:14px;
            border-bottom:4px solid #3b82f6;
            padding-bottom:18px;margin-bottom:42px;
        }
        .header-bar img{width:70px;height:auto}
        .brand{
            font-family:'Roboto Slab',serif;
            font-size:1.55rem;
            font-weight:700;letter-spacing:.5px
        }
        .brand .green{color:#10b981}

        h2{
            text-align:center;
            font-family:'Roboto Slab',serif;
            font-size:2rem;color:#2563eb;
            margin-bottom:32px;text-transform:uppercase;
        }
        h3{
            margin:34px 0 14px;
            color:#1e293b;font-weight:600;
            border-left:6px solid #3b82f6;
            padding-left:12px
        }
        p{margin:10px 0;font-size:1rem}
        strong{font-weight:600;color:#1f2937}

        /* ------------  Bloc signatures  ------------ */
        .signatures{
            margin-top:60px;display:flex;gap:28px;justify-content:space-between
        }
        .sig-box{
            flex:1;border-top:2px solid #3b82f6;
            padding-top:10px;text-align:center;
            font-weight:600;color:#475569
        }

        /* ------------  Filigrane  ------------ */
        .watermark{
            position:fixed;top:45%;left:50%;
            transform:translate(-50%,-50%);
            font-family:'Roboto Slab',serif;
            font-size:60px;color:rgba(100,116,139,.09);
            pointer-events:none;user-select:none;
            letter-spacing:12px;white-space:nowrap
        }

        /* ------------  Footer  ------------ */
        footer{
            text-align:center;font-size:.8rem;margin-top:50px;
            color:#94a3b8;border-top:1px solid #e2e8f0;padding-top:18px
        }

        @media(max-width:640px){
            body{padding:32px 24px}
            .header-bar{flex-direction:column;text-align:center;gap:8px}
            .signatures{flex-direction:column;gap:40px}
        }
    </style>
</head>
<body>

    <!-- Bandeau logo + nom -->
    <div class="header-bar">
        <img src="{{ public_path('images/logo2.png') }}" alt="Logo">
        <div class="brand">
            <span class="white" style="color:#ffffff00">.</span><!-- invis. juste pr alignement PDF -->
            <span style="color:#fff0">.</span><!-- invisible -->
            <span style="color:#2563eb">Campus</span><span class="green">Home</span>
        </div>
    </div>

    <h2>Contrat de location</h2>

    <p>Ce contrat est établi entre <strong>{{ $etudiant->name }}</strong> (le locataire) et le propriétaire <strong>{{ $logement->proprietaire->name }}</strong>.</p>

    <div class="section">
        <p><strong>Type du logement&nbsp;:</strong> {{ $logement->type }}</p>
        <p><strong>Adresse&nbsp;:</strong> {{ $logement->adresse }}</p>
        <p><strong>Durée&nbsp;:</strong> du {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</p>
        <p><strong>Loyer mensuel&nbsp;:</strong> {{ number_format($logement->loyer,0,',',' ') }} FCFA</p>
        <p><strong>Premier paiement (avance)&nbsp;:</strong> {{ number_format($logement->loyer*3,0,',',' ') }} FCFA (3 mois)</p>
    </div>

    <h3>Engagements des parties</h3>
    <p>Le locataire s'engage à maintenir le logement en bon état, respecter le voisinage et honorer ses paiements.</p>
    <p>Le propriétaire s'engage à fournir un logement décent et à respecter les droits du locataire.</p>

    <p style="margin-top:28px;"><strong>Date de génération&nbsp;:</strong> {{ now()->format('d/m/Y') }}</p>

    <!-- Signatures -->
    <div class="signatures">
        <div class="sig-box">Signature du locataire</div>
        <div class="sig-box">Signature du propriétaire</div>
    </div>

    <div class="watermark">CampusHome</div>

    <footer>
        Ce contrat a été généré par la plateforme <strong>CampusHome</strong>.  
        Merci pour votre confiance.
    </footer>

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
