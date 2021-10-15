@foreach ($routes as $route)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Source airport</th>
                <th scope="col">Destination airport</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($routes as $route)
                <tr>
                    <td>{{ $route->source_airport }}</td>
                    <td>{{ $route->destination_airport }}</td>
                    <td>{{ $route->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach