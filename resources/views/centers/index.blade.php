@extends('layouts.app')

@section('header', 'Delivery Centers')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Manage Hubs</h5>
        <a href="{{ route('centers.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Center</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Coordinates</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($centers as $center)
                <tr>
                    <td>#{{ $center->id }}</td>
                    <td class="fw-bold text-primary">{{ $center->name }}</td>
                    <td>{{ $center->address }}</td>
                    <td><small class="text-muted">{{ $center->latitude }}, {{ $center->longitude }}</small></td>
                    <td>{{ $center->contact_number ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('centers.edit', $center) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('centers.destroy', $center) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No delivery centers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
