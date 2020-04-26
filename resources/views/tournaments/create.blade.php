@extends('layouts.app')

@section('content')

    <x-cards.responsive-card cardTitle="Naujas turnyras">
        
        @include('tournaments.forms.form')

    </x-cards.responsive-card>
    
@endsection