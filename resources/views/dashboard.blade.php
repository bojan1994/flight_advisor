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
                    @if (Auth::user()->role == 'administrator')
                        <a href="{{ route('city.create') }}">Add city</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities as $city)
                                    <tr>
                                        <th scope="row">{{ $city->id }}</th>
                                        <td>{{ $city->name }}</td>
                                        <td>{{ $city->country }}</td>
                                        <td>{{ $city->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="{{ route('import') }}">Import airports and routes</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Airport ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">IATA</th>
                                    <th scope="col">ICAO</th>
                                    <th scope="col">Latitude</th>
                                    <th scope="col">Longitude</th>
                                    <th scope="col">Altitude</th>
                                    <th scope="col">Tz</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Source</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($airports as $airport)
                                    <tr>
                                        <th scope="row">{{ $airport->airport_id }}</th>
                                        <td>{{ $airport->name }}</td>
                                        <td>{{ $airport->city }}</td>
                                        <td>{{ $airport->country }}</td>
                                        <td>{{ $airport->iata }}</td>
                                        <td>{{ $airport->icao }}</td>
                                        <td>{{ $airport->latitude }}</td>
                                        <td>{{ $airport->longitude }}</td>
                                        <td>{{ $airport->altitude }}</td>
                                        <td>{{ $airport->tz }}</td>
                                        <td>{{ $airport->type }}</td>
                                        <td>{{ $airport->source }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @elseif (Auth::user()->role == 'regular')
                        <a href="{{ route('comment.create') }}">Add comment</a>
                        <div>
                            Search by city: <input class="filter_by_city" type="text" name="filter_by_city" />
                        </div>
                        <div class="unfiltered-cities">
                            @foreach ($cities as $city)
                                <h3>{{ $city->name }}</h3>
                                <h6>Comments</h6>
                                Show only <input data-city-id="{{ $city->id }}" class="number_of_comments" type="text" name="number_of_comments" style="width: 50px" /> comments
                                <div class="unfiltered-comments-{{ $city->id }}">
                                        @foreach ($city->comment as $comment)
                                            <p>{{ $comment->content }}</p>
                                            <div>
                                                <small>Posted on {{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y H:i:s') }}</small>
                                            </div>
                                            <div>
                                                <small>Updated at {{ \Carbon\Carbon::parse($comment->updated_at)->format('d.m.Y H:i:s') }}</small>
                                            </div>
                                            <div>
                                                <a class="btn btn-link" href="{{ route('comment.edit', [$comment]) }}">Update</a>
                                            </div>
                                            <form method="POST" action="{{ route('comment.delete', [$comment])}}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-link" type="submit">Delete</button>
                                            </form>
                                            @if (!$loop->last)
                                                <hr>
                                            @endif
                                        @endforeach
                                </div>
                                <div class="filtered-comments-{{ $city->id }} d-none"></div>
                                <hr>
                            @endforeach
                        </div>
                        <div class="filtered-cities d-none"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.number_of_comments').on('input', function (e) {
            let limit = $(this).val();
            let cityId = $(this).attr('data-city-id');
            if (limit) {
                $.ajax({
                    url: '/dashboard/number-of-comments/' + cityId + '/' + limit,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    beforeSend: function() {
                        $('.unfiltered-comments-' + cityId).addClass('d-none');
                    },
                }).done(function (data) {
                    $('.filtered-comments-' + cityId).html(data.html);
                    $('.filtered-comments-' + cityId).removeClass('d-none');
                });
            } else {
                $('.unfiltered-comments-' + cityId).removeClass('d-none');
                $('.filtered-comments-' + cityId).addClass('d-none');
            }
        });

        $('.filter_by_city').on('input', function (e) {
            let cityName = $(this).val();
            let limit;
            let cityId;
            if (cityName) {
                $.ajax({
                    url: '/dashboard/search-by-city/' + cityName,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    beforeSend: function() {
                        $('.unfiltered-cities').addClass('d-none');
                    },
                }).done(function (data) {
                    $('.filtered-cities').html(data.html);
                    $('.filtered-cities').removeClass('d-none');
                    $('.number_of_comments').on('input', function (e) {
                        limit = $(this).val();
                        cityId = $(this).attr('data-city-id');
                        if (limit) {
                            $.ajax({
                                url: '/dashboard/number-of-comments/' + cityId + '/' + limit,
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                },
                                beforeSend: function() {
                                    $('.unfiltered-comments-' + cityId).addClass('d-none');
                                },
                            }).done(function (data) {
                                $('.filtered-comments-' + cityId).html(data.html);
                                $('.filtered-comments-' + cityId).removeClass('d-none');
                            });
                        } else {
                            $('.unfiltered-comments-' + cityId).removeClass('d-none');
                            $('.filtered-comments-' + cityId).addClass('d-none');
                        }
                    });
                });
            } else {
                $('.unfiltered-cities').removeClass('d-none');
                $('.filtered-cities').addClass('d-none');
            }
        });
    </script>
</x-app-layout>
