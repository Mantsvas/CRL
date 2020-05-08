<form action="{{ isset($tournament) ? route('tournaments.update', $tournament) : route('tournaments.store') }}" method="post">
    @csrf
    @if (isset($tournament))
        @method('PUT')
    @endif

    <x-inputs.text :label="__('messages.Tourn title')" name="title" required="required" :value="isset($tournament) ? $tournament->title : '' " />

    <x-inputs.textarea label="Aprašymas" name="description" :value="isset($tournament) ? $tournament->description : ''" />

    <x-inputs.textarea label="Aprašymas anglų kalba" name="description_en" :value="isset($tournament) ? $tournament->description_en : ''" required="required" />

    <x-inputs.textarea label="Taisyklės" name="rules" :value="isset($tournament) ? $tournament->rules : ''" />

    <x-inputs.textarea label="Taisyklės anglų kalba" name="rules_en" :value="isset($tournament) ? $tournament->rules_en : ''" required="required" />

    <x-inputs.text label="Video" name="video" :value="isset($tournament) ? $tournament->video_link : ''" />
    
    <x-inputs.select label="Formatas" name="format" :selected="isset($tournament) ? $tournament->format : 'round_robin'"
        :options="['round_robin' => 'Ratų sistema']" />

    <x-inputs.select label="Tipas" name="type" :selected="isset($tournament) ? $tournament->type : 'clans'"
        :options="[
            'clans'            => 'Klanas vs Klanas',
            '1vs1'             => '1 vs 1',
            '2vs2'             => '2 vs 2'
        ]" />

    <x-inputs.numeric label="Minimalus dalyvių skaičius" name="min_participiants" :value="isset($tournament) ? $tournament->min_participiants : ''" min="0" step="1" required="required" />

    <x-inputs.numeric label="Maksimalus dalyvių skaičius (0 - neribota)" name="max_participiants" :value="isset($tournament) ? $tournament->max_participiants : ''" min="0" step="1" required="required" />

    <x-inputs.numeric label="Patenka kitą etapą" name="playoff_count" :value="isset($tournament) ? $tournament->playoff_count : ''" min="0" step="1" required="required" />

    <x-inputs.numeric label="Grupių skaičius" name="group_count" min="1" :value="isset($tournament) ? $tournament->group_count : ''" step="1" required="required" />

    <x-inputs.date label="Pradžios data" name="start_date" :value="isset($tournament) ? $tournament->start_date : ''" required="required" />

    <x-buttons.submit-button :name="__('messages.Create')" />
</form>

