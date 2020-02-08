Hey there {{ $user->name }} !

Don't miss our new posts ! :)

@foreach($posts as $post)
    {{ $post->title }}
    {{ route('posts.show', $post) }}
@endforeach
