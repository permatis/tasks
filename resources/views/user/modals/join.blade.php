<!-- Login modal -->
<div class="modal fade" id="join" tabindex="-1" role="dialog" aria-labelledby="joinLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="forgotLabel">Are you sure you join this task?</h4>
            </div>
            <div class="modal-body">
                
                <div id="join-table"></div>
				
				{!! Form::open(['method' => 'PUT', 'class' => 'text-center', 'id' => 'joins']) !!}

                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">

						{!! Form::textarea('comment', '', ['placeholder' => 'Comment here...', 'class' => 'form-control']) !!}

                        @if ($errors->has('comment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-random"></i> Join Task
                        </button>
                    </div>
				{!! Form::close() !!}
            </div>
        </div>
    </div>
</div>