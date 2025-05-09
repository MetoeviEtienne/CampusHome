@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tableau de bord Proprietaire</h1>
    <p>Bienvenue, {{ auth()->user()->name }}!</p>
    <!-- Contenu spécifique aux étudiants -->
</div>
@endsection