@extends('main')
@section('content')
    <p>
        @empty($cats)
            No cats found.
        @else
            {{ $cats }}
        @endempty
    </p>
@endsection
