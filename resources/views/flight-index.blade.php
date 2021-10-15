<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->username }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('dashboard') }}">Back</a>
                    <h4>Find flight</h4>
                    From 
                    <select class="source_airport_id">
                        <option selected disabled>City</option>
                        @foreach ($airports as $airport)
                            <option value="{{ $airport->airport_id }}">{{ $airport->name }}</option>
                        @endforeach
                    </select>
                    To 
                    <select class="destination_airport_id">
                        <option selected disabled>City</option>
                        @foreach ($airports as $airport)
                            <option value="{{ $airport->airport_id }}">{{ $airport->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary find-flight">Find flights</button>
                    <div class="routes"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.find-flight').on('click', function (e) {
            e.preventDefault();
            let sourceAirportId = $('.source_airport_id').val();
            let destinationAirportId = $('.destination_airport_id').val();
            $.ajax({
                url: '/dashboard/find-flight/' + sourceAirportId + '/' + destinationAirportId,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                beforeSend: function() {
                    $('.routes').empty();
                },
            }).done(function (data) {
                if (data.html != '') {
                    $('.routes').html(data.html);
                } else {
                    $('.routes').html('No flights');
                }
            });
        });
    </script>
</x-app-layout>
