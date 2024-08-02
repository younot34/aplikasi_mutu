@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit mutu</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Edit mutu</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('mutus.update', $mutu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>NAME</label>
                            <input type="text" name="name" value="{{ old('name', $mutu->name) }}" class="form-control" >
                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>TIME (MINUTE)</label>
                            <input type="number" name="time" value="{{ old('time', $mutu->time) }}" class="form-control" >

                            @error('time')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>TOTAL QUESTION</label>
                            <input type="number" name="total_question" value="{{ old('total_question', $mutu->total_question) }}" class="form-control" >

                            @error('total_question')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>START</label>
                            <input type="datetime-local" name="start" value="<?php echo date('Y-m-d\TH:i:s', strtotime($mutu->start)); ?>" class="form-control @error('start') is-invalid @enderror">

                            @error('start')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>END</label>
                            <input type="datetime-local" name="end" value="<?php echo date('Y-m-d\TH:i:s', strtotime($mutu->end)); ?>" class="form-control @error('end') is-invalid @enderror">

                            @error('end')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        @livewire('question-checklist', ['selectedmutu' => $mutu->id])


                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop