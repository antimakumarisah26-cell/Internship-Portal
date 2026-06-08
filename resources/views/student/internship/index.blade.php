@extends('partials.app')

@section('title', 'Internship')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="row">
@foreach($internships as $internship)
    <div class="cols">

        <div class="card w-96 shadow-sm mb-3">
            <div class="card-body">
                <h2 class="card-title">{{ $internship->title }}</h2>
                <p>{!! $internship->description !!}</p>
                <p><strong>Required Skills:</strong> {{ $internship->required_skills }}</p>
                <p><strong>Location:</strong> {{ $internship->location }}</p>
                <p><strong>Deadline:</strong> {{ $internship->deadline }}</p>
                <p><strong>Company:</strong> {{ $internship->company->company_name }}</p>
                <p><strong>Applicants:</strong> {{ $internship->application_count }}</p>
                
                {{-- Check if student has applied --}}
                @if(auth()->user()->student->hasAppliedTo($internship->id))
                    <div class="justify-end card-actions">
                        <button class="btn btn-success" disabled>✅ Applied</button>
                    </div>
                @else
                    <div class="justify-end card-actions">
                        <form action="{{ route('student.apply', $internship->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary" type="submit">Apply Now</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection