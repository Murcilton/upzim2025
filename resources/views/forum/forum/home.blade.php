@extends('forum.layouts.layout')

@section('content')




<div class="d-flex align-items-center p-3 my-3 bg-purple rounded shadow-sm">
    <img class="me-3" src="/docs/5.3/assets/brand/bootstrap-logo-white.svg" alt="" width="48" height="38">
    <div class="lh-1">

        <h1 class="h6 mb-0 text-capitalize lh-1">{{$forum->name }}</h1>
        <small>{{ $forum->created_at }}</small>
    </div>
    @if (Auth::check())

    @if (Auth::user()->id ==$forum->author && $forum->status == 1) 
    <form method="POST" action="{{ route('forum.status', $forum->id) }}" enctype="multipart/form-data" class=" p-1  bg-white ">
  @csrf
    <button type="submit" class="btn btn-outline-secondary">Закрыть тему</button>
  </form>
    @endif
    @if (Auth::user()->id ==$forum->author && $forum->status == 0) 
    <form method="POST" action="{{ route('forum.status', $forum->id) }}" enctype="multipart/form-data" class=" p-1  bg-white ">
  @csrf
    <button type="submit" class="btn btn-outline-secondary">Открыть тему</button>
  </form>
    @endif
    @endif

    
    
</div>

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h5 class="border-bottom pb-2 mb-0">Обсуждение</h5>
  
    
    @foreach($comments as $comment)


    <div class="d-flex text-body-secondary pt-3">
        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text>
        </svg>
        <p class="pb-3 mb-0 small lh-sm border-bottom">
            <strong class="d-block text-gray-dark">
                @foreach($users as $user)
                <?  if ($user->id==$comment->author) {
               echo( $user->name);
            }  ?>
            @endforeach
                </strong>
            {{ $comment->text }}
        </p>
    </div>
    @endforeach
    <div class="mt-4 mb-4">
 {{ $comments->links('pagination::bootstrap-4', ['onEachSide' => 2]) }}
    </div>
@if (Auth::check())

@if ($forum->status == 1)


    <form method="POST" action="{{ route('forum.create', Auth::user()->id) }}" enctype="multipart/form-data" class="p-3">
        @csrf
          <div class="mb-3">
            <label class="form-label">Добавить своё очень-Очень важное мнение</label>
            <input type="hidden" value="{{$forum->id}}" name="id">
            <textarea type="text" name="text" class="form-control" ></textarea>
          </div>
          <button type="submit" class="btn btn-outline-secondary">Отправить</button>
    </form>
@else  
<div class="mb-3 p-3"> <h3>Темка усё</h3> </div>
@endif

@endif
    <small class="d-block text-end mt-3">
        <a href="#">All updates</a>
    </small>
</div>


</main>

@endsection