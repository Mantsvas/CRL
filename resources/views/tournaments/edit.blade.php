@extends('layouts.app')

@section('content')

    <x-cards.responsive-card :cardTitle="$tournament->title">
        
        @include('tournaments.forms.form')

    </x-cards.responsive-card>
    
@endsection