@extends('layouts.app')

@section('content')

    <x-cards.responsive-card cardTitle="Turnyrai">

        @if (Auth::user() && Auth::user()->is_admin) 
            <x-slot name="cardTools">
                <x-buttons.redirect-button :route="route('tournaments.create')" :name="__('messages.Add')" />
            </x-slot>
        @endif
        
        @include('tournaments.lists.index', [
            'tournaments' => $tournaments
        ])

    </x-cards.responsive-card>

@endsection
