@extends('home')
@section('content')
    <div class="d-flex bg-success flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">&ensp;Sell Tickets</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="client" class="text-md-left">{{ __('Client:') }}</label>
                                    <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ old('client') }}" required autocomplete="client" autofocus>
                                    @error('client')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="ci" class="text-md-left">{{ __('CI:') }}</label>
                                    <input id="ci" type="number" min="1" class="form-control @error('ci') is-invalid @enderror" name="ci" value="{{ old('ci') }}" required autocomplete="ci" autofocus>
                                    @error('ci')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="bus_id" class="text-md-left">{{ __('Bus:') }}</label>
                                    <select id="buses" class="select-js form-control @error('bus_id') is-invalid @enderror" required autocomplete="bus_id" autofocus name="bus_id">
                                        <option value="" selected> Select all</option>
                                        @foreach($buses as $bus)
                                            <option value="{{$bus->id}}">{{$bus->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('bus_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="city_id" class="text-md-left">{{ __('City:') }}</label>
                                    <select id="cities" class="select-js form-control @error('city_id') is-invalid @enderror" required autocomplete="city_id" autofocus name="city_id">
                                        {{--                                    ajax code--}}
                                    </select>

                                    @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="quantity" class="text-md-left">{{ __('Seats:') }}</label>
                                    <select id="seats" class="select-multiple-js form-control" required autofocus name="seats[]" multiple="multiple">
                                        {{--                                    ajax code--}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sub_total" class="text-md-left">{{ __('Sub Total') }} <b>( Bs. )</b></label>
                                    <input type="number" id="sub_total" class="form-control" name="sub_total" readonly>
{{--                                    the value with jquey code--}}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="total" class="text-md-left">{{ __('Total') }} <b>( Bs. )</b></label>
                                    <input type="number" id="total" class="form-control " name="total" readonly>
{{--                                    the value with jquery code--}}
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="options">{{__('Options')}}</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{route('tickets.create')}}" class="btn btn-danger btn-block">Cancel</a>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-success btn-block">Sell</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 text-center">
                    <div id="seats_bus" class="container d-flex flex-wrap border rounded w-50">
{{--                        jquery code--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // $('.select-js').select2();
            $('.select-multiple-js').select2();
        });
    </script>

    <script>
        $(document).ready(function () {
            // get cities
            $('#buses').on('change',function () {
                var bus_id = $('#buses').val();
                if ($.trim(bus_id) != ''){
                    $('#cities').empty();
                    $('#sub_total').empty();
                    $('#cities').append("<option value='' selected>Select a city</option>");
                    $.get('/get_cities',{bus_id: bus_id}, function (cities) {
                        $.each(cities, function (index , value){
                            $('#cities').append("<option value='"+index+"'>"+value[0]+" - "+value[1]+" Bs.</option>");
                            // $('#cities').append("<option value='"+index+"'>"+value[0]+"</option>");
                        });
                    }).done();
                }
            });

            // get sub_total
            $('#cities').on('change',function () {
                var city_id = $('#cities').val();
                var bus_id = $('#buses').val();
                if ($.trim(city_id) != ''){
                    $('#sub_total').empty();
                    $.get('/get_sub_total',{ bus_id: bus_id , city_id: city_id}, function (price) {
                        $('#sub_total').val(price);
                    }).done();
                }
            });

            // get seats
            $('#buses').on('change',function () {
                var bus_id = $('#buses').val();
                if ($.trim(bus_id) != ''){
                    $('#seats').empty();
                    // $('#sub_total').empty();
                    $('#seats').append("<option value=''>Select a or more seat</option>");
                    $.get('/get_seats',{bus_id: bus_id}, function (seats) {
                        $.each(seats, function (index , value){
                            $('#seats').append("" +
                                "<option  value='"+index+"'>"+value+"</option>"
                            );
                        });
                    }).done();
                }
            });

            // total
            $('#seats').on('change',function () {
                var seats = $('#seats').val();
                var subtotal = $('#sub_total').val();
                if ($.trim(seats) != ''){
                    $('#total').empty();
                    $.get('/price_total',{ seats: seats , subtotal: subtotal}, function (number) {
                        $('#total').val(number[0]*number[1])
                    }).done();
                }
            });

            // get seats for image bus
            $('#buses').on('change',function () {
                var bus_id = $('#buses').val();
                if ($.trim(bus_id) != ''){
                    $('#seats_bus').empty();
                    $.get('/get_seats_buses',{bus_id: bus_id}, function (seats) {
                        $.each(seats, function (index , value){
                            $('#seats_bus').append("<span class='w-50 h-50'><h1>"+value+"</h1></span>");
                        });
                    }).done();
                }
            });
        });
    </script>
@endsection
{{--<span data-feather="file"></span>--}}
