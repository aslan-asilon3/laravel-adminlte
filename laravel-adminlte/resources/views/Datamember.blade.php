@extends('adminlte::page')

@section('title', 'List User')

@section('content_header')
    <h1 class="m-0 text-dark">Data Member</h1>
@stop

@section('content')

@livewire('datamember.index')

@endsection