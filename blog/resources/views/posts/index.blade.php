@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg  mt-5 mb-5">
        <form action="{{ route('posts') }}" method="post" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>

                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
            </div>

            @if ($posts->count())
            @foreach ($posts as $post)
            <div class="mb-4">
                <a href="" class="font-bold">
                    {{ $post->user->name }}
                </a>
                <span class="text-gray-600 text-sm">
                    {{ $post->created_at->diffForHumans() }}
                </span>
                <p class="mb-4">
                    {{ $post->body }}
                </p>
                <div class="flex items-center">
                    <form action="" method="post" class="mr-1">
                        @csrf
                        <button class="btn btn-primary text-blue-500 mr-4" type="submit">Like</button>
                    </form>
                    <form action="" method="post" class="mr-1">
                        @csrf
                        <button class="btn btn-primary text-blue-500 mr-4" type="submit">Unlike</button>
                    </form>
                    <span>{{ $post->likes->count() }} {{ Str::plural('like',$post->likes->count())}} </span>

                </div>

                @if ($post->user_id == Auth::id())
                <form action="" method="post" class="mr-1">
                    @csrf
                    <button class="btn btn-primary text-blue-500 mt-4" type="submit">Update</button>
                </form>
                @endif

            </div>
            @endforeach


            {{ $posts->links() }}


            @else
            <p>There are no posts</p>
            @endif

        </form>
    </div>
</div>
@endsection