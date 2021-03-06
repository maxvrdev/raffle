@extends('layouts.default')

{{-- Page title --}}
@section('title') Raffle
@parent
@stop


{{-- Page content --}}
@section('content')

    @include('partials.flash-messages')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create a Raffle Entry</h1>
            <h4>To enter the raffle, please submit your:</h4>
            <ul>
                <li>Full Name</li>
                <li>Phone Number</li>
                <li>Raffle Name (this should be a dropdown)</li>
            </ul>

            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>


            <form name="raffle_form" method="POST" action="{{ route('raffle.store') }}" id="raffle_form">
                @csrf
                <div class="card col-6">
                    <div class="card-header">
                        Enter your information here
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="raffle_type_id">Which Raffle</label>
                            <select name="raffle_type_id" class="form-control @error('raffle_type_id') is-invalid @enderror" id="raffle_type_id">
                                <option>Please Choose...</option>
                                @foreach($raffle_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('raffle_type_id')
                            <div class="invalid-feedback mt-0" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback mt-0" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" {{ old('phone') }} required>
                            @error('phone')
                            <div class="invalid-feedback mt-0" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Submit" class="btn btn-primary" />
                    </div>
                </div>
            </form>

        </div>
    </main>

@stop
