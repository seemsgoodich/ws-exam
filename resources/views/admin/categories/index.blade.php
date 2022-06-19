@extends('admin.index')

@section('title', 'Все категории')

@section('content')
<a href="{{route('admin.categories.createPage')}}" class="btn btn-success">Создать категорию</a>

<h3 class="mt-4">Все категории</h3>
    @forelse($categories as $category)
        <div class="card">
            <div class="card-body">
                {{$category->name}}
                <a href="{{route('admin.categories.delete', $category)}}" class="btn btn-danger ml-4">Удалить</a>
            </div>
        </div>
    @empty
        <div class="alert alert-primary" role="alert">
            Категорий нет
        </div>
    @endforelse
@endsection
