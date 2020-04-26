<x-headings.small :heading="__('messages.Sponsors')" />

@if ($tournament->canModerate())
    <form action="{{ route('tournaments.sponsorUpload', $tournament->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <x-inputs.text name="title" :label="__('messages.Title')" />
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <x-inputs.text name="url" :label="__('messages.Url')" />
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <x-inputs.file name="file" id="sponsorImage" />
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <x-buttons.submit_button type="success" :name="__('messages.Upload')" />
            </div>
        </div>
    </form>
@endif

<div class="row">
    @foreach ($tournament->sponsors as $sponsor)
        <div class="col-6 col-sm-4 col-md-2 sponsor">
            <a href="{{ $sponsor->url }}" target="_blank" />
                <img src="/storage/images/{{ isset($sponsor->image) ? $sponsor->image->file_name : null}}" alt="{{ $sponsor->title }}" title="{{ $sponsor->title }}">
            </a>
        </div>
    @endforeach
</div>
