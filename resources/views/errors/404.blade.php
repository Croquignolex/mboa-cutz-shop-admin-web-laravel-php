@extends('layouts.error')

@section('error.master.title', page_title('404'))
@section('error.title', trans('error.404_title'))
@section('error.message', trans('error.404_message'))

@section('error.code')
    <h1><strong>4</strong><span>0</span><strong>4</strong></h1>
@endsection