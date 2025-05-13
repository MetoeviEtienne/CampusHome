@extends('layouts.proprietaire')

@section('content')
    <div class="container">
        <h1>Les avis du propriétaire</h1>
        
        @if($avis->isEmpty())
            <p>Aucun avis pour le moment.</p>
        @else
            <ul>
                @foreach($avis as $avisItem)
                    <li>
                        <strong>{{ $avisItem->etudiant->nom }}</strong> - {{ $avisItem->commentaire }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
