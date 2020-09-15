@extends('layouts.error')

@section('error.master.title', page_title('503'))
@section('error.title', trans('error.503_title'))
@section('error.message', trans('error.503_message'))

@section('error.code')
    <h1><strong>5</strong><span>0</span><strong>3</strong></h1>
@endsection