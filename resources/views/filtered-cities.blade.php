@foreach ($cities as $city)
    <h3>{{ $city->name }}</h3>
    <h6>Comments</h6>
    Show only <input data-city-id="{{ $city->id }}" class="number_of_comments" type="text" name="number_of_comments" style="width: 50px" /> comments
    <div class="unfiltered-comments-{{ $city->id }}">
        @if (count($city->comment))
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
        @endif
    </div>
    <div class="filtered-comments-{{ $city->id }} d-none"></div>
    <hr>
@endforeach