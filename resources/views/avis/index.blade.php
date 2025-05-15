@extends('layouts.etudiant')
{{-- Voir les avis coté étudiant --}}

@section('content')
    <div class="container">
        <h2>Liste de tous les avis</h2>
        <ul>
            @foreach($avis as $avisItem)
                <li>
                    <strong>{{ $avisItem->auteur->name }}</strong> a noté 
                    <em>{{ $avisItem->logement->titre ?? 'Logement supprimé' }}</em> : 
                    {{ $avisItem->note }}/5 <br>
                    "{{ $avisItem->commentaire }}"
                </li>
            @endforeach
        </ul>
    </div>
@endsection
