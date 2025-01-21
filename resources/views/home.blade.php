@extends('layouts.layout')

@section('content')

    <div class="list-container">
        <div class="panel">
            <div class="logo">
                <i class="fa-duotone fa-solid fa-clipboard-list" style="--fa-primary-color: #dbdbdb; --fa-secondary-color: #dbdbdb;"></i>
            </div>
            <div class="controls">
                <button class="btnnav btnCreate">Создать задание</button>
                <button class="btnnav btnCreate">Обновить задание</button>
            </div>
        </div>
        @foreach ($tasks as $task)
            <div class="window">
                <div class="context">
                    <div class="title">
                        {{ $task->name }}
                    </div>
                    <div class="status">
                        {{ $task->status }}
                    </div>
                    <div class="deadline">
                        До {{ $task->deadline }}
                    </div>
                </div>
                <div class="divider"></div>
                    <div class="description">
                        {{ $task->description }}
                    </div>
                    <button type="button" class="btnnav editButton" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-pen" style="color: black"></i>
                    </button>
            </div>
        @endforeach

    </div>
