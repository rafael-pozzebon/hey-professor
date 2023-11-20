@props([
    'action',
    'post' => null,
    'put' => null,
    'patch' => null,
    'delete' => null
])

<form action="{{ $action }}" method="post" {{ $attributes }}>
    @csrf

    @if($post)
        @method('post')
    @endif

    @if($put)
        @method('put')
    @endif

    @if($patch)
        @method('patch')
    @endif

    @if($delete)
        @method('delete')
    @endif

    {{ $slot }}
</form>

