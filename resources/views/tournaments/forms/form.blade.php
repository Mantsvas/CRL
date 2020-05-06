<form action="{{ route('tournaments.store') }}" method="post">
    @csrf

    <x-inputs.text :label="__('messages.Tourn title')" name="title" />

    <x-inputs.textarea label="Aprašymas" name="description" />

    <x-inputs.textarea label="Taisyklės" name="rules" />

    <x-inputs.text label="Video" name="video" />
    
    <x-inputs.select label="Formatas" name="format" 
        :options="['round_robin' => 'Ratų sistema']" />

    <x-inputs.select label="Tipas" name="type" 
        :options="[
            'clans'            => 'Klanas vs Klanas',
            '1vs1'             => '1 vs 1',
            '2vs2'             => '2 vs 2'
        ]" />

    <x-inputs.numeric label="Minimalus dalyvių skaičius" name="min_participiants" min="0" step="1" />

    <x-inputs.numeric label="Maksimalus dalyvių skaičius (0 - neribota)" name="max_participiants" min="0" step="1" />

    <x-inputs.numeric label="Patenka kitą etapą" name="playoff_count" min="0" step="1" />

    <x-inputs.numeric label="Grupių skaičius" name="group_count" min="1" step="1" />

    <x-inputs.date label="Pradžios data" name="start_date" />

    <x-buttons.submit-button :name="__('messages.Create')" />
</form>

