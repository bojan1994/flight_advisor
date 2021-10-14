<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
