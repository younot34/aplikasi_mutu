@extends('layouts.app')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>REVIEW</h1>
        </div>

        

        <div class="section-body">
            
            
            @livewire('review', ['user_id' => $userId, 'mutu_id' => $mutuId])
            
        </div>
    </section>
</div>
@stop





