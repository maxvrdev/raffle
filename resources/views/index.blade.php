@extends('layouts.default')

{{-- Page title --}}
@section('title') Raffle
@parent
@stop

{{-- Page content --}}
@section('content')


    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <h2>Raffle</h2>

            <p>The county fair staff currently take down entries manually in Microsoft Excel, but they’re ready to move to a simpler system, one they can use across the fairgrounds without having to reconcile entries from multiple data sheets.</p>

            <h3># INSTRUCTIONS</h3>

            <p>Write the following two components of the Raffle system in PHP using the Laravel framework, that has the functionality outlined below.

            <p>This is not intended to be a fully featured system, but rather, just enough to demonstrate your experience, technical knowledge, and work style. Keep it simple  -- there's no need for authentication.

            <p>The estimated time to complete the assessment is 1 - 2 hours.

            <h4>## Add & View Entries</h4>

            <p>The system must accept entries with the following required fields:</p>

            <ul>
                <li>Full Name</li>
                <li>Phone Number</li>
                <li>Raffle Name (this should be a dropdown)</li>
            </ul>


            <h4>### View Entries</h4>

            <p>A county fair staff member wants to be able to see the list of entries. A list output or HTML table works here.</p>

            <h4>## Pick Winners</h4>

            <p>A county fair staff wants the system to be able to pick random winners for each raffle. The system must allow the staff to enter the total number of winners to be selected.</p>

            <p>For example, they may want to pick three winners for one raffle, and just one winner for another.</p>

            <h4>## SUBMITTING THE ASSESSMENT</h4>

            <p>When complete, please supply a GItHub, BitBucket, or other Git cloud provider link to the repository.</p>


        </div>
    </main>


@stop
