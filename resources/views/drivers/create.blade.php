@extends('layouts.app')

@section('header', 'Add New Driver')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h5 class="mb-4">Driver Information</h5>
            
            <form action="{{ route('drivers.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">Full Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">Phone Number</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold">Assign Vehicle (Optional)</label>
                    <select class="form-select" name="vehicle_id">
                        <option value="">-- No Vehicle Assigned --</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }} ({{ $vehicle->type }})</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold">Status</label>
                    <select class="form-select" name="availability_status" required>
                        <option value="available">Available</option>
                        <option value="off_duty">Off Duty</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('drivers.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
