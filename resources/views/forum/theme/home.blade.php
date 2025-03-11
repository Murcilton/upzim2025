@extends('forum.layouts.layout')

@section('content')
<div class="mb-3">
    <a href="{{ route('theme.FormCreate') }}" class="btn btn-outline-secondary">Добавить новую тему</a>
</div>

<div class="row">
    @foreach ($themes as $theme)
    <div class="col-md-4">
      <div class="card mb-4 box-shadow">
        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Felis_silvestris_silvestris.jpg/800px-Felis_silvestris_silvestris.jpg" data-holder-rendered="true" style="height: 100%; width: 100%; display: block;">
        <div class="card-body">
          <p class="card-text text-capitalize">{{ $theme->name }}</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">

              <form method="GET" action="{{ route('forum.home',$theme->id) }}" enctype="multipart/form-data" class="">
               @csrf
               <button type="submit" class="btn btn-outline-secondary">Обладубала</button>
              </form>
              
              @if (Auth::check())

              <form method="GET" action="{{ route('theme.FormEdit',$theme->id) }}" enctype="multipart/form-data" class="">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">Изменить</button>
               </form>

               @endif


               
            </div>
            <small class="text-muted">{{ $theme->created_at }}</small>
          </div>
        </div>
      </div>
    </div>
@endforeach
</div>

@endsection