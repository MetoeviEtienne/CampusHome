<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat OCR</title>
</head>
<body>
    <h2>Texte extrait :</h2>
    <pre style="background-color: #f4f4f4; padding: 10px;">{{ $text }}</pre>
    <a href="{{ route('ocr.form') }}">← Retour</a>
</body>
</html>
