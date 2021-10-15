<table class="table">
    <thead>
        <tr>
            <th scope="col">Source airport</th>
            <th scope="col">Destination airport</th>
            <th scope="col">Stops</th>
            <th scope="col">Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($routes as $key => $route)
            <tr>
                <td>{{ $airportNames[$route->source_airport] }}</td>
                <td>{{ $airportNames[$route->destination_airport] }}</td>
                <td>{{ $route->stops }}</td>
                <td>{{ $route->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>