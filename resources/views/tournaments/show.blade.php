@extends('layouts.app')

@section('content')

    <x-headings.large :heading="$tournament->title" />

    @include('layouts.errors')

    <x-tabs.tab :active="$activeTab" :tabs="$tournament->tabs()">

        @if ($tournament->stage == 'preparation')
            <x-tabs.content :active="$activeTab" key="info">

                <x-cards.responsive-card>
                    @include('tournaments.tabs.info')
                </x-cards.responsive-card>

            </x-tabs.content>

            <x-tabs.content :active="$activeTab" key="players">

                <x-cards.responsive-card>
                    @include('tournaments.tabs.players')
                </x-cards.responsive-card>

            </x-tabs.content>
        @else
            <x-tabs.content :active="$activeTab" key="info">
                Info
            </x-tabs.content>
            <x-tabs.content :active="$activeTab" key="players">
                leaderboard
            </x-tabs.content>
        @endif

        
    </x-tabs.tab>

@endsection
