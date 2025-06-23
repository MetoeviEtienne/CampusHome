<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OCRController extends Controller
{
    public function form()
    {
        return view('ocr.form');
    }

   public function extractText(Request $request)
{
    set_time_limit(60); // étendre le temps d’exécution

    $request->validate([
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $image = $request->file('image');
    $imagePath = $image->getRealPath();
    $base64Image = base64_encode(file_get_contents($imagePath));

    $response = Http::timeout(30)
        ->withoutVerifying()
        ->asForm()
        ->post('https://api.ocr.space/parse/image', [
            'apikey' => 'K86280889688957',
            'language' => 'fre',
            'isOverlayRequired' => false,
            'base64Image' => 'data:image/jpeg;base64,' . $base64Image,
        ]);

    $result = $response->json();

    $text = $result['ParsedResults'][0]['ParsedText'] ?? 'Aucun texte détecté.';

    return view('ocr.result', compact('text'));
}


}
