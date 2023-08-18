@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-6/12 bg-white p-6 rounded-lg  mt-5 mb-5">
        <h1 class="text-center fs-2 mb-4 text-blue-600">Update Post</h1>
        <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="post" class="mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-2 rounded-lg text-left @error('body') border-red-500 @enderror">
                {{ old('body', $post->body) }}</textarea>

                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
            </div>
        </form>
    </div>
</div>
@endsection