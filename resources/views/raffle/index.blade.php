@extends('layouts.default')

{{-- Page title --}}
@section('title') Raffle
@parent
@stop

@section('header')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
@endsection

@section('footer_scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            let datatables = document.getElementsByClassName('datatable');
            for (var i = 0; i < datatables.length; i++) {
                new simpleDatatables.DataTable(datatables.item(i));

            }
        });
    </script>
@endsection


{{-- Page content --}}
@section('content')

    @include('partials.flash-messages')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Raffle Entries</h1>
            @foreach($raffle_types as $raffle_type)
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    {{ $raffle_type->name }}
                </div>

                <div class="card-body">
                    <table class="datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($raffles->where('raffle_type_id', $raffle_type->id) as $raffle)
                            <tr>
                                <td>{{ $raffle->id }}</td>
                                <td>{{ $raffle->name }}</td>
                                <td>{{ $raffle->phone }}</td>

                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('raffle.edit', $raffle) }}" class="btn btn-primary btn-sm start"
                                           data-id="{{ $raffle->id }}">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach

        </div>
    </main>

@stop
