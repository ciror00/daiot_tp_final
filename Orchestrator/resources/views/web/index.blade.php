@extends('web.master')
@section('content')
    <h1>UUID: @{{ device }}</h1>  
    <list-measurements title="Mediciones"></list-measurements>
@endsection