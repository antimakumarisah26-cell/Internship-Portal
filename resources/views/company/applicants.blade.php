@extends('partials.app')

@section('title', 'Applicants - ' . $internship->title)

@section('content')
<div class="container mx-auto px-4 py-6">
    
    {{-- Back Button --}}
    <a href="{{ route('company.dashboard') }}" class="btn btn-sm btn-outline mb-4">
        ← Back to Dashboard
    </a>
    
    {{-- Internship Info Card --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold mb-2">{{ $internship->title }}</h1>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div><span class="font-semibold">📍 Location:</span> {{ $internship->location }}</div>
            <div><span class="font-semibold">📅 Deadline:</span> {{ \Carbon\Carbon::parse($internship->deadline)->format('M d, Y') }}</div>
            <div><span class="font-semibold">👥 Total Applicants:</span> {{ $totalApplicants }}</div>
            <div><span class="font-semibold">🏢 Company:</span> {{ $internship->company->company_name }}</div>
        </div>
    </div>
    
    {{-- Statistics Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-100 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-blue-600">{{ $totalApplicants }}</div>
            <div class="text-sm text-gray-600">Total</div>
        </div>
        <div class="bg-yellow-100 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-yellow-600">{{ $pendingCount }}</div>
            <div class="text-sm text-gray-600">Pending</div>
        </div>
        <div class="bg-green-100 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-green-600">{{ $shortlistedCount }}</div>
            <div class="text-sm text-gray-600">Shortlisted</div>
        </div>
        <div class="bg-red-100 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-red-600">{{ $rejectedCount }}</div>
            <div class="text-sm text-gray-600">Rejected</div>
        </div>
    </div>
    
    {{-- Filter Tabs --}}
    <div class="flex flex-wrap gap-2 mb-4 border-b">
        <button class="filter-btn px-4 py-2 text-sm font-medium rounded-t-lg border-b-2 border-blue-500 text-blue-600" data-status="all">
            All ({{ $totalApplicants }})
        </button>
        <button class="filter-btn px-4 py-2 text-sm font-medium rounded-t-lg text-gray-500 hover:text-gray-700" data-status="pending">
            Pending ({{ $pendingCount }})
        </button>
        <button class="filter-btn px-4 py-2 text-sm font-medium rounded-t-lg text-gray-500 hover:text-gray-700" data-status="shortlisted">
            Shortlisted ({{ $shortlistedCount }})
        </button>
        <button class="filter-btn px-4 py-2 text-sm font-medium rounded-t-lg text-gray-500 hover:text-gray-700" data-status="rejected">
            Rejected ({{ $rejectedCount }})
        </button>
    </div>
    
    {{-- Applicants Table --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied On</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($applicants as $applicant)
                <tr class="applicant-row" data-status="{{ $applicant->status }}">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-gray-600 font-medium">
                                        {{ strtoupper(substr($applicant->student->name, 0, 2)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $applicant->student->user->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $applicant->student->user->email }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($applicant->applied_at ?? $applicant->created_at)->format('M d, Y g:i A') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="status-badge px-2 py-1 text-xs rounded-full 
                            @if($applicant->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($applicant->status == 'shortlisted') bg-green-100 text-green-800
                            @elseif($applicant->status == 'rejected') bg-red-100 text-red-800
                            @else bg-blue-100 text-blue-800
                            @endif">
                            {{ ucfirst($applicant->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <select class="status-select border rounded px-2 py-1 text-sm" data-id="{{ $applicant->id }}">
                            <option value="pending" {{ $applicant->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="shortlisted" {{ $applicant->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            <option value="rejected" {{ $applicant->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="hired" {{ $applicant->status == 'hired' ? 'selected' : '' }}>Hired</option>
                        </select>
                        <a href="{{ route('company.application.view', $applicant->id) }}" class="ml-2 text-blue-600 hover:text-blue-800 text-sm">
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        No applicants yet for this internship.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<script>
    // Filter by status
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            const status = this.dataset.status;
            
            // Update active tab style
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('border-blue-500', 'text-blue-600');
                btn.classList.add('text-gray-500');
            });
            this.classList.add('border-blue-500', 'text-blue-600');
            this.classList.remove('text-gray-500');
            
            // Filter rows
            document.querySelectorAll('.applicant-row').forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    
    // Update status via AJAX
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const applicationId = this.dataset.id;
            const newStatus = this.value;
            
            fetch(`/company/application/${applicationId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update status badge
                    const row = this.closest('tr');
                    const badge = row.querySelector('.status-badge');
                    
                    // Update badge class and text
                    badge.className = 'status-badge px-2 py-1 text-xs rounded-full ';
                    if (newStatus === 'pending') {
                        badge.classList.add('bg-yellow-100', 'text-yellow-800');
                    } else if (newStatus === 'shortlisted') {
                        badge.classList.add('bg-green-100', 'text-green-800');
                    } else if (newStatus === 'rejected') {
                        badge.classList.add('bg-red-100', 'text-red-800');
                    } else {
                        badge.classList.add('bg-blue-100', 'text-blue-800');
                    }
                    badge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                    
                    // Update row data-status
                    row.dataset.status = newStatus;
                    
                    // Show success message
                    alert('Status updated successfully!');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update status');
            });
        });
    });
</script>


@endsection