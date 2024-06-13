@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-small text-danger my-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
