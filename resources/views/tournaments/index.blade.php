@extends('layouts.app')

@section('content')

    <x-cards.responsive-card cardTitle="Turnyrai">

        <x-slot name="cardTools">
            <x-buttons.redirect-button :route="route('tournaments.create')" name="Pridėti" />
        </x-slot>
        
        @include('tournaments.lists.index', [
            'tournaments' => $tournaments
        ])

    </x-cards.responsive-card>

@endsection
