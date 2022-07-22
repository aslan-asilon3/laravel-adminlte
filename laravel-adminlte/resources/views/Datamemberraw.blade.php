@extends('adminlte::page')

@section('title', 'List User')

@section('content_header')
    <h1 class="m-0 text-dark">Data Member Raw</h1>
@stop

@section('content')

@livewire('datamemberraw.index')

@endsection