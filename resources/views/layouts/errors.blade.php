
<div id="flash">
    @foreach (['danger', 'warning', 'success', 'info', 'dangerHtml', 'warningHtml', 'successHtml', 'infoHtml'] as $msg)
        @if (in_array($msg, ['dangerHtml', 'warningHtml', 'successHtml', 'infoHtml']))
            @if(Session::has('alert-' . $msg))
                <div class="alert alert-{{ substr($msg, 0, -4) }} alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>{!! Session::get('alert-' . $msg) !!}</strong>
                </div>
            @endif
        @else
            @if(Session::has('alert-' . $msg))
                <div class="alert alert-{{ $msg }} alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>{{ Session::get('alert-' . $msg) }}</strong>
                </div>
            @endif
        @endif
    @endforeach
</div>
    