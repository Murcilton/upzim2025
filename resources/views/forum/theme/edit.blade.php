@extends('forum.layouts.layout')

@section('content')
@if (Auth::check())

<form method="POST" action="{{ route('theme.edit', $id) }}" enctype="multipart/form-data" class="shadow p-5 rounded bg-white">
  @csrf
    <div class="mb-3">
      <label class="form-label">Изменить название темы</label>
      <input type="name" name="name" class="form-control" >
    </div>
    <button type="submit" class="btn btn-outline-secondary">Изменить</button>
  </form>
  @else
 <h2>Вы не смешарик</h2> 
  @endif
@endsection