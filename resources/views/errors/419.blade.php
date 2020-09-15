@extends('layouts.error')

@section('error.master.title', page_title('419'))
@section('error.title', trans('error.419_title'))
@section('error.message', trans('error.419_message'))

@section('error.code')
    <h1><strong>4</strong><span>1</span><strong>9</strong></h1>
@endsection