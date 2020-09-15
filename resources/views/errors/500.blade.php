@extends('layouts.error')

@section('error.master.title', page_title('500'))
@section('error.title', trans('error.500_title'))
@section('error.message', trans('error.500_message'))

@section('error.code')
    <h1><strong>5</strong><span>0</span><strong>0</strong></h1>
@endsection