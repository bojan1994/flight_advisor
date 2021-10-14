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
                    <h4>Add comment</h4>
                    <form method="POST" action="{{ route('comment.store') }}">
                        @csrf

                        <label for="city_id">City</label>
                        <select name="city_id" id="city_id" class="form-select">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />

                        <textarea id="content" class="block mt-1 w-full form-input rounded-md shadow-sm" name="content" rows="4" cols="50"></textarea>
                    
                        @error('content')
                            <span style="color: #a50606;">{{ $message }}</span>
                        @enderror

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Post comment') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
