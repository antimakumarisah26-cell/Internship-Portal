@extends('partials.app')
@section('title')
Internship Opportunities
@endsection
@section('content')

<div class="flex justify-center items-center min-h-screen">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        @if(session('error'))
            <div class="alert alert-error mb-4">
                <span>{{ session('error') }}</span>
            </div>
        @endif
        
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
            <legend class="fieldset-legend">Login</legend>
            
            <label class="label">Email</label>
            <input type="email" name="email" class="input w-full" placeholder="Email" required />
            
            <label class="label">Password</label>
            <input type="password" name="password" class="input w-full" placeholder="Password" required />
            
            <button type="submit" class="btn btn-neutral mt-4 w-full">Login</button>
        </fieldset>
    </form>
</div>

@endsection