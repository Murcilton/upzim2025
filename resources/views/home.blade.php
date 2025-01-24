@extends('layouts.layout')

@section('content')

<div class="list-container">
    <div class="panel">
        <div class="logo">
            <i class="fa-duotone fa-solid fa-clipboard-list"
                style="--fa-primary-color: #dbdbdb; --fa-secondary-color: #dbdbdb;"></i>
        </div>
        <div class="controls">
            <button class="btnnav btnCreate" data-bs-toggle="modal" data-bs-target="#exampleModal">Создать задачу</button>
            
            <div class="dropdown-button">
                <ul class="dropdown">
                    <div class="dropdown-title">
                        <span>Сортировать по</span>
                    </div>
                    <div class="dropdown-items">
                        <li>Статусу</li>
                        <li>Дедлайну</li>
                        <li>
                            <span class="dropdownLayerBtn">Содержимому</span>
                            <ul class="dropdownLayer">
                                <div class="dropdown-items-layer">
                                    <li>Название</li>
                                    <li>Описание</li>
                                    
                                </div>
                            </ul>
                        </li>
                    </div>
                </ul>
            </div>

        </div>

    </div>
    @if (isset($tasks))
        @foreach ($tasks as $task)
            <div class="window">
                <div class="context">
                    <div class="title">
                        {{ $task->name }}
                    </div>
                    <div class="status">
                        <span class="
                        @if ($task->status == 'Активно') 
                        sSucсess 
                        @elseif ($task->status == 'Завершено')
                        sDanger
                        @elseif ($task->status == 'Ожидание')
                        sDepleted
                        @endif">{{ $task->status }}
                    </span>
                    </div>
                    <div class="deadline">
                        До {{ $task->deadline }}
                    </div>
                </div>
                <div class="divider"></div>
                <div class="description">
                    {{ $task->description }}
                </div>
                <button type="button" class="btnnav editButton" data-bs-toggle="modal" data-bs-target="#exampleModal{{$task->id}}">
                    <i class="fa-solid fa-pen" style="color: black"></i>
                </button>
                <button type="button" class="btnnav deleteButton" data-bs-toggle="modal" data-bs-target="#deleteModal{{$task->id}}">
                    <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                </button>
            </div>

            <!-- Modal -->
            <form action="{{route('edit', $task->id)}}" method="POST">
                @csrf
                <div class="modal fade" id="exampleModal{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content editModal">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование задачи: <br>{{$task->name}}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input value="{{$task->name}}" type="text" class="form-control inputEdit" name="name" placeholder="Название">
                                <textarea value="{{$task->description}}" type="text" class="form-control inputEdit descriptionEdit" name="description" placeholder="Описание">{{$task->description}}</textarea>
                                <select class="form-select inputEdit" name="status" aria-label="Default select example">
                                    <option class="selectContext" value="" disabled>Выберите статус</option> <!-- Опционально: заголовок для выбора -->
                                    <option value="Активно" {{ $task->status === 'Активно' ? 'selected' : '' }}>Активно</option>
                                    <option value="Завершено" {{ $task->status === 'Завершено' ? 'selected' : '' }}>Завершено</option>
                                    <option value="Ожидание" {{ $task->status === 'Ожидание' ? 'selected' : '' }}>Ожидание</option>
                                </select>
                                <input value="{{$task->deadline}}" type="date" class="form-control inputEdit" name="deadline" placeholder="Дедлайн">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btnnav">Сохранить <i class="fa-solid fa-circle-check" style="color: #2b2b2b; margin-left: 5px"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Modal для удаления -->
<div class="modal fade" id="deleteModal{{$task->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content editModal">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Подтвердите удаление</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить задачу: <strong>{{ $task->name }}</strong>?
            </div>
            <div class="modal-footer">
                <form action="{{ route('delete', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btnnav" style="color: rgb(255, 0, 0)">Удалить</button>
                    <button type="button" class="btnnav" data-bs-dismiss="modal">Отмена</button>
                </form>
            </div>
        </div>
    </div>
</div>
            
        @endforeach
    @else
        <h1>Нет заданий</h1>
    @endif

    <!-- Modal -->
    <form action="{{route('create')}}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content editModal">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Создание задачи</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control inputEdit" name="name" placeholder="Название">
                        <textarea type="text" class="form-control inputEdit descriptionEdit" name="description" placeholder="Описание"></textarea>
                        <select class="form-select inputEdit" name="status" aria-label="Default select example">
                            <option value="Активно">Активно</option>
                            <option value="Завершено">Завершено</option>
                            <option value="Ожидание">Ожидание</option>
                        </select>
                        <input type="date" class="form-control inputEdit" name="deadline" placeholder="Дедлайн">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btnnav">Сохранить <i class="fa-solid fa-circle-check" style="color: #2b2b2b; margin-left: 5px"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    

</div>