@extends('layouts.default')

{{-- Page title --}}
@section('title') Pick Winners
@parent
@stop

@section('footer_scripts')
    <script type="text/javascript">
        let raffle_type_id;
        let how_many_winners;

        let retrieve_winners = function (e) {
            raffle_type_id = document.getElementById('raffle_type_id').value;
            how_many_winners = document.getElementById('winners').value;

            const form_data = new FormData();
            form_data.append('raffle_type_id', raffle_type_id);
            form_data.append('how_many_winners', how_many_winners);

            window.axios.post("{{ route('ajax.raffle.winner') }}", form_data)
                .then(function (response) {
                    let winners = response.data[0];
                    let k = Object.keys(winners)
                    let res;
                    if (winners.length > 1) {
                        res = "The winners are: ";
                    } else {
                        res = "The winner is: ";
                    }

                    k.forEach(key => res += '<br>' + winners[key].name + ' | Phone:' + winners[key].phone);
                    let ele = document.getElementById('response');
                    ele.innerHTML = res;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        }

        let manage_validation = (txt) => {
            let btn = document.getElementById('submit');
            if (txt.value == '' || txt.value == 'Please Choose...') {
                btn.disabled = true;
            } else {
                btn.disabled = false;
            }
        }
    </script>
@endsection

{{-- Page content --}}
@section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pick a Raffle Entry</h1>
            <h4>To enter the raffle, please submit your:</h4>

            <div class="card col-6">

                <div class="card-header">
                    Enter your information here
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="raffle_type_id">Pick Which Raffle</label>
                        <select name="raffle_type_id" class="form-control" id="raffle_type_id"
                                onchange="manage_validation(this)">
                            <option>Please Choose...</option>
                            @foreach($raffle_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="winners">How many random winners:</label>
                        <input name="winners" type="number" class="form-control" id="winners" value="1" required>
                    </div>
                </div>

                <div class="card-footer">
                    <button id="submit" onclick="retrieve_winners()" class="btn btn-primary" disabled>Submit</button>
                </div>
            </div>

            <p id="response" class="lead mt-5"></p>

        </div>
    </main>

@stop
