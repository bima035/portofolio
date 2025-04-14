@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-6 px-4">
        <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Proyek</a>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($projects as $project)
                <div class="bg-white dark:bg-gray-800 shadow p-4 rounded">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">{{ $project->title }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">{{ $project->description }}</p>

                    @if($project->image)
                        <img src="{{ asset($project->image) }}" class="w-full h-48 object-cover mb-2 rounded">
                    @endif

                    @if($project->link)
                        <a href="{{ $project->link }}" class="text-blue-600 underline dark:text-blue-400" target="_blank">Lihat Proyek</a><br>
                    @endif

                    <div class="mt-2 flex gap-2">
                        <a href="{{ route('projects.edit', $project->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection
