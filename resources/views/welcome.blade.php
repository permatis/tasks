@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 15%">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            
            @include('partials.notifications.success')
            @include('partials.notifications.errors')

            {!! Form::open(['url' => 'register', 'method' => 'post']) !!}
                
                <div class="input-group {{ $errors->has('emails') ? ' has-error' : '' }}" style="margin-bottom: 30px;">
                    {!! Form::text('emails', '', ['class' => 'form-control input-lg', 'placeholder' => 'What is your email']) !!}
                    <span class="input-group-btn">
                        <button class="btn btn-success btn-lg" type="submit">Get Started</button>
                    </span>
                </div>

                <div class="radio">
                    What do you want to be? &nbsp;
                    <label> <input type="radio" name="roles" value="user" checked> User </label>
                    &nbsp;
                    <label> <input type="radio" name="roles" value="client"> Client </label>
                </div>

            {!! Form::close() !!}

            <p>Already have an account? <a href="#login" data-dismiss="modal" data-toggle="modal" id="toLogin">Login</a></p>
        </div>
    </div>
</div>

@endsection
