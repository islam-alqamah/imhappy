<div class="card">
    <div class="card-header">
            <h4 class="mb-0 text-info"><i class="fas fa-comment-dots" style="font-size: 24px"></i> {{ __('Add reply') }}</h4>
    </div>
    <div class="card-body">
        <div class="comment-form">

            <form action="{{ url('account/comment') }}" method="POST" class="form">
                    {{ method_field('POST') }}
                {!! csrf_field() !!}

                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <textarea rows="4" id="comment" class="form-control" name="comment"></textarea>

                    @if ($errors->has('comment'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comment') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>