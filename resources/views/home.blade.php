@extends('layouts.app')

@section('content')
<div>
    <index :vendors='{!! json_encode($vendors) !!}' :categories='{!! json_encode($categories) !!}' />

</div>
@endsection
