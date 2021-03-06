@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">
        {{$room->title}}
    </h4>
    <div class="row">
        <div class="col-md-2">
            <livewire:chat.users :room="$room"/>
        </div>
        <div class="col-md-10">
            <livewire:chat.messages :room="$room" :messages="$messages" />
            
            <livewire:chat.new-message :room="$room" />
            new messages
        </div>
    </div>
</div>
@endsection

<!-- 
    1. Prikazes poruke
    2. Poruke za tebe u real-time
    3. Poruke za ostale u realtime
    4. Users 
 -->