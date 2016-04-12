@extends('core::admin.master')

@section('title', $title)

@section('main')
{{ dd($module) }}
@include($module . '::admin._index')


@endsection
