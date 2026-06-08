@extends('partials.app')

@section('title', 'Company Dashboard')

@section('content')
<div class="container mx-auto px-4">
    
    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h3 class="card-title">Total Internships</h3>
                <p class="text-3xl font-bold">{{ $internships->count() }}</p>
            </div>
        </div>
        
        <div class="card bg-success text-white">
            <div class="card-body">
                <h3 class="card-title">Total Applications</h3>
                <p class="text-3xl font-bold">{{ $totalApplications }}</p>
            </div>
        </div>
        
        <div class="card bg-info text-white">
            <div class="card-body">
                <h3 class="card-title">Unique Students</h3>
                <p class="text-3xl font-bold">{{ $totalUniqueStudents }}</p>
            </div>
        </div>
    </div>
    
    {{-- Top Internship --}}
    @if($topInternship)
    <div class="alert alert-warning mb-4">
        <strong>🏆 Most Popular:</strong> {{ $topInternship->title }} 
        ({{ $topInternship->application_count }} applicants)
    </div>
    @endif
    
    {{-- Internships List --}}
    <div class="grid grid-cols-1 gap-4">
        <h2 class="text-2xl font-bold mb-3">Your Internships</h2>
        
        @forelse($internships as $internship)
        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="card-title text-xl">{{ $internship->title }}</h3>
                        <p class="text-gray-600">{{ Str::limit($internship->description, 100) }}</p>
                    </div>
                    <div class="badge badge-primary badge-lg">
                        {{ $internship->application_count }} Applicants
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-3 text-sm">
                    <div>📍 {{ $internship->location }}</div>
                    <div>📅 Deadline: {{ $internship->deadline }}</div>
                    <div>⚙️ {{ $internship->required_skills }}</div>
                </div>
                
                <div class="card-actions justify-end mt-3">
                    <a href="#" 
                       class="btn btn-sm btn-outline btn-info">
                        View Applicants ({{ $internship->application_count }})
                    </a>
                    <a href="{{ route('internship.edit',$internship->id) }}" 
                       class="btn btn-sm btn-outline btn-warning">
                        Edit
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-info">
            No internships posted yet. 
            <a href="{{ route('company.internship.create') }}" class="btn btn-sm btn-primary">
                Create Internship
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection