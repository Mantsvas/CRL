@extends('layouts.app')

@section('content')
    <div class="container">
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
                        <div class="card-body table-responsive no-padding">
                            <table class="table table-hover table-stripe">
                                <thead>
                                    <tr class="bg-dark">
                                        <th style="width: 10px">#</th>
                                        <th>Clan</th>
                                        <th class="text-right">Fame</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (json_decode($clan->currentRiverRace->clans) as $riverClan) 
                                        <tr style="{{ '#' . $clan->tag == $riverClan->tag ? 'background-color: lightgrey' : ''}}">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                @if (in_array(ltrim($riverClan->tag, '#'), Cnst::CLAN_TAGS))
                                                    <a style="color: inherit;" href="{{ route('clan', ltrim($riverClan->tag, '#')) }}">
                                                @endif
                                                        {{ $riverClan->name }} <br><span style="font-size: 9px">{{ isset($riverClan->finishTime) ? $riverClan->finishTime : null }}</span>
                                                @if (in_array(ltrim($riverClan->tag, '#'), Cnst::CLAN_TAGS))
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-right">{{ $riverClan->fame }} <icon icon="cw-fame"></icon></td>
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
    </div>
@endsection
