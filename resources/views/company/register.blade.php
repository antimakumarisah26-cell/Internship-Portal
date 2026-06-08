@extends('partials.app')

@section('title', 'Company Registration')

@section('content')
<div class="mx-auto max-w-2xl rounded-xl bg-white p-8 shadow-lg">
    <h2 class="mb-6 text-3xl font-semibold text-gray-900">Company Registration</h2>

    <form action="{{ route('company.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Company Name</label>
            <input
                type="text"
                name="company_name"
                value="{{ old('company_name') }}"
                class="input input-bordered w-full"
                placeholder="Enter company name"
                required
            />
            @error('company_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="input input-bordered w-full"
                placeholder="mail@site.com"
                required
            />
            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input
                type="password"
                name="password"
                class="input input-bordered w-full"
                placeholder="Enter a password"
                required
            />
            @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input
                type="tel"
                name="phone_number"
                value="{{ old('phone_number') }}"
                class="input input-bordered w-full"
                placeholder="Enter phone number"
                required
            />
            @error('phone_number')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Website</label>
            <input
                type="url"
                name="website"
                value="{{ old('website') }}"
                class="input input-bordered w-full"
                placeholder="https://example.com"
                required
            />
            @error('website')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Location</label>
            <input
                type="text"
                name="location"
                value="{{ old('location') }}"
                class="input input-bordered w-full"
                placeholder="Enter location"
                required
            />
            @error('location')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea
                name="description"
                class="textarea textarea-bordered w-full min-h-[120px]"
                placeholder="Describe your company"
                required
            >{{ old('description') }}</textarea>
            @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="btn btn-primary w-full">Register Company</button>
    </form>
</div>
@endsection