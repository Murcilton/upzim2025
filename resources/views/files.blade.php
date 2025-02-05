@extends('layouts.layout')

@section('content')

<div class="list-container">
    <div class="files-title">
        <h1>Файлы</h1>
        <i class="fa-solid fa-file"></i>

    </div>
    <div class="files-container">
        <div class="files-input">
            <form class="files-input-form" action="{{route('store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="file" class="form-control" name="file" id="file" placeholder="Выберите файл">
                <button type="submit" class="btnnav">Сохранить</button>
            </form>
        </div>
    </div>



    <div class="files-cycle">

        <div class="folder-create">
            <div class="dropdown-button createFolderBtn createTaskBtn">
                <ul class="dropdown">
                    <div class="dropdown-title">
                        <i class="fa-solid fa-folder-open" style="color: #000000;"></i><span>+</span>
                    </div>
                    <div class="dropdown-items">
                        <form action="{{route('folder.store')}}" method="POST">
                            @csrf
                            <li>
                                <input type="text" class="form-control inputEdit" name="foldersName" placeholder="Название"
                                    autocomplete="off">
                            </li>
                            <li>
                                <button type="submit" class="btnnav"><i class="fa-solid fa-check"></i></button>
                            </li>
                        </form>
                    </div>
                </ul>
            </div>
        </div>
        <div class="file-items">
        @if (!empty($files) && $files->isNotEmpty())
            @foreach ($files as $file)
                <div class="file-item">
                    <a href="{{ asset('storage/' . $file->path) }}"><i class="fa-solid fa-file-alt"></i>
                        {{ $file->name }}</a>
                    <div class="file-actions">
                        <!-- <a href="{{ route('edit', $file->id) }}"><i class="fa-solid fa-pencil-alt"></i></a> -->
                        <form action="{{ route('destroy.file', $file->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btnnav"><i class="fa-solid fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <h6>Файлов не обнаружено</h6>
        @endif
        </div>

    </div>




</div>
</div>

@endsection