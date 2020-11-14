@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach ($clans as $clan)
            @if ($loop->index == 6)
                <div class="col-12 my-3">
                    @include('adsense.top_horizontal')
                </div>
            @endif
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">  {{ $loop->index + 1 . '. ' . $clan->name . ' (' . $clan->clanWarTrophies .')' }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Clan</th>
                                    <th>Fame</th>
                                </tr>
                                @foreach (json_decode($clan->currentRiverRace->clans) as $riverClan) 
                                    <tr style="{{ '#' . $clan->tag == $riverClan->tag ? 'background-color: #ffc107' : ''}}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            {{-- <a style="color: inherit;" href="{{ route('clan', ltrim($riverClan->tag, '#')) }}"> --}}
                                                {{ $riverClan->name }} <br><span style="font-size: 9px">{{ isset($riverClan->finishTime) ? $riverClan->finishTime : null }}</span>
                                            {{-- </a> --}}
                                        </td>
                                        <td style="width: 30%">{{ $riverClan->fame }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @endforeach
    </div>
@endsection
