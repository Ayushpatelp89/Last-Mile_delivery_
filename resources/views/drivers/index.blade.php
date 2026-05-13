@extends('layouts.app')

@section('header', 'Drivers Management')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Delivery Partners</h5>
        <a href="{{ route('drivers.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Driver</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Assigned Vehicle</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($drivers as $driver)
                <tr>
                    <td>#{{ $driver->id }}</td>
                    <td class="fw-bold">{{ $driver->name }}</td>
                    <td>{{ $driver->phone }}</td>
                    <td>
                        @if($driver->vehicle)
                            <span class="badge bg-secondary">{{ $driver->vehicle->vehicle_number }}</span>
                        @else
                            <span class="text-muted">Unassigned</span>
                        @endif
                    </td>
                    <td>
                        @if($driver->availability_status == 'available')
                            <span class="badge bg-success">Available</span>
                        @elseif($driver->availability_status == 'on_delivery')
                            <span class="badge bg-warning text-dark">On Delivery</span>
                        @else
                            <span class="badge bg-danger">Off Duty</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('drivers.destroy', $driver) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No drivers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
