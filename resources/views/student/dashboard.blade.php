@extends('partials.app')

@section('title','Student Dashboard')

@section('content')

<div class="hero bg-primary text-primary-content rounded-box mb-6">
    <div class="hero-content text-center py-10">
        <div>
            <h1 class="text-4xl font-bold">
                Welcome, {{ Auth::user()->name }} 
            </h1>
           
        </div>
    </div>
</div>

<div class="stats shadow w-full mb-6">

    <div class="stat">
        <div class="stat-title">College</div>
        <div class="stat-value text-primary text-lg">
            {{ Auth::user()->student->college_name ?? 'N/A' }}
        </div>
    </div>

    <div class="stat">
        <div class="stat-title">Skills</div>
        <div class="stat-value text-secondary text-lg">
            {{ Auth::user()->student->skills ?? 'N/a' }}
        </div>
    </div>

    <div class="stat">
        <div class="stat-title">Resume</div>
        <div class="stat-value text-success text-lg">
            <a href="{{ asset('storage/' . Auth::user()->student->resume) }}" >View Resume</a>
        </div>
    </div>

</div>

<div class="card bg-base-100 shadow-xl mb-6">
    <div class="card-body">
        <h2 class="card-title">Profile Information</h2>

        <p><b>Name:</b> {{ Auth::user()->name }}</p>
        <p><b>Email:</b> {{ Auth::user()->email }}</p>
        <p><b>Phone:</b> {{ Auth::user()->student->phone_number ?? 'N/A' }}</p>
        <p><b>College:</b> {{ Auth::user()->student->college_name ?? 'N/A' }}</p>

        <div class="mt-3">
            <b>Skills:</b><br>

            @foreach(explode(',', Auth::user()->student->skills ?? '') as $skill)
                @if(trim($skill))
                    <div class="badge badge-primary mr-1 mt-1">
                        {{ trim($skill) }}
                    </div>
                @endif
            @endforeach
        </div>

    </div>
</div>

<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title">Quick Actions</h2>

        <div class="flex gap-3">

            <a href="{{ route('internship.view') }}"
               class="btn btn-primary">
                View Internships
            </a>

            <a href="{{ route('resume.upload.page') }}"
               class="btn btn-secondary">
                Upload Resume
            </a>

        </div>
    </div>
</div>

@endsection