@extends('layouts.app')

@section('header', 'Fleet Management')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Vehicles</h5>
        <a href="{{ route('vehicles.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Vehicle</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Vehicle Number</th>
                    <th>Type</th>
                    <th>Capacity (kg)</th>
                    <th>Fuel</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehicles as $vehicle)
                <tr>
                    <td>#{{ $vehicle->id }}</td>
                    <td class="fw-bold">{{ $vehicle->vehicle_number }}</td>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->capacity }}</td>
                    <td>{{ $vehicle->fuel_type }}</td>
                    <td>
                        @if($vehicle->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">{{ ucfirst($vehicle->status) }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No vehicles found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
