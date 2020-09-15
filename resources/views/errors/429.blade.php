@extends('layouts.error')

@section('error.master.title', page_title('429'))
@section('error.title', trans('error.429_title'))
@section('error.message', trans('error.429_message'))

@section('error.code')
    <h1><strong>4</strong><span>2</span><strong>9</strong></h1>
@endsection