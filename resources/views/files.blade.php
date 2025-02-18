@extends('layouts.layout')

@section('content')

    <div class="list-container">
        <div class="files-title">
            <h1>Файлы</h1>
            <i class="fa-solid fa-file"></i>

        </div>


        @if ($folders->isNotEmpty())
            <div class="folder-container">
                <div class="folder-create">
                    <div class="dropdown-button createFolderBtn createTaskBtn">
                        <ul class="dropdown">
                            <div class="dropdown-title">
                                <i class="fa-solid fa-folder-plus"
                                    style="color: #000000; font-size: 19px; margin-top: 3px;"></i>
                            </div>
                            <div class="dropdown-items">
                                <form action="{{route('folder.store')}}" method="POST">
                                    @csrf
                                    <li>
                                        <input type="text" class="form-control inputEdit" name="foldersName"
                                            placeholder="Название" autocomplete="off">
                                    </li>
                                    <li>
                                        <button type="submit" class="btnnav"><i class="fa-solid fa-check"
                                                style="position: relative; bottom: 2px;"></i></button>
                                    </li>
                                </form>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="folder-items">
                    <h2>Папки</h2>
                    @foreach ($folders as $folder)
                        <div class="folder-item">
                            <div class="folder">
                                <div class="dropdown-button dropdown-folder-btn">
                                    <ul class="dropdown dropdown-folder">
                                        <div class="folder-add">
                                            <form action="{{ route('folder.add') }}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <label class="upload-to-folder" for="file-to-folder-input-{{ $folder->id }}">
                                                    <i class="fa-solid fa-file-circle-plus" style="color: #000000;"></i>
                                                </label>
                                                <input type="hidden" name="folderId" value="{{ $folder->id }}">
                                                <input type="file" name="file" id="file-to-folder-input-{{ $folder->id }}"
                                                    class="form-control file-to-folder-input" placeholder='Добавить файл в папку'>
                                                <button type="submit" class="btnnav">
                                                    <i class="fa-solid fa-check" style="position: relative; bottom: 2px;"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="dropdown-title">
                                            <a href="#" class="ifolder"><i class="fa-solid fa-folder"></i><i
                                                    class="fa-solid fa-folder-open"></i> {{ $folder->name }}</a>
                                        </div>

                                        <div class="folder-actions">
                                            <form action="{{ route('destroy.folder', $folder->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class=""><i class="fa-regular fa-trash-can"
                                                        style="color: #ff0000;"></i></button>
                                            </form>
                                        </div>

                                        <div class="dropdown-items">
                                            <div class="divider-folder"></div>

                                            @foreach ($files as $file)

                                                @if ($file->folder_id == $folder->id)
                                                    <li>
                                                        <div class="file-item">
                                                            <a href="{{ asset('storage/' . $file->path) }}"><i
                                                                    class="fa-solid fa-file-alt"></i>
                                                                {{ $file->name }}</a>

                                                            <div class="file-actions">
                                                                <!-- Button Modal move folder -->
                                                                <button type="button" class="btnnav" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $file->id }}">
                                                                <i class="fa-solid fa-share" style="color: #000000;"></i>
                                                                </button>

                                                                <form action="{{ route('destroy.file', $file->id) }}" method="POST"
                                                                    style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btnnav"><i class="fa-solid fa-xmark"
                                                                            style="color: #ff0000;"></i></button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </li>
                                                @endif

                                                

                                            @endforeach
                                            
                                        </div>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

        @endif

        @foreach ($files as $file)
<!-- Modal move folder -->
<form action="" method="POST">
    @csrf
    <div class="modal fade" id="exampleModal{{ $file->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content editModal">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Перенос файла
                        <br>
                        "{{$file->name}}"
                        в папку:
                    </h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="folder-move-list">


                        @foreach ($folders as $folder)
                        
                            <label class="form-check-label" for="folder-{{ $folder->id }}">
                                
                                <input type="radio" class="form-check-input" id="folder-{{ $folder->id }}" name="folderId" value="{{ $folder->id }}">
                                <i class="fa-solid fa-folder"></i> {{ $folder->name }}
                            </label>
                            
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btnnav">Переместить <i
                            class="fa-solid fa-circle-check"
                            style="color: #2b2b2b; margin-left: 5px"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
        @endforeach

            <div class="files-cycle">

                <div class="file-items">
                    @if (!empty($files) && $files->isNotEmpty())
                        @foreach ($files as $file)
                        @if ($file->folder_id == null)
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
                        @endif
                        @endforeach
                    @else
                        <h6>Файлов не обнаружено</h6>
                    @endif
                </div>

            </div>

        </div>
    </div>



@endsection