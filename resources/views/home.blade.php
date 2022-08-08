@extends('layouts.asoft')

@section('content')
    <div class="wrapper">
        <total-streams-component></total-streams-component>
        <total-viewers-component></total-viewers-component>
        <median-viewers-component></median-viewers-component>
        <total-even-and-odds-component></total-even-and-odds-component>
        <same-viewers-streams-component></same-viewers-streams-component>
        <top-hundred-streams-component></top-hundred-streams-component>
    </div>
@endsection
