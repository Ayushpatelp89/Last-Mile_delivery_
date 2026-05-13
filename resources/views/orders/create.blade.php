@extends('layouts.app')

@section('header', 'Add New Order')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h5 class="mb-4">Order Details</h5>
            
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">Customer Name</label>
                    <input type="text" class="form-control" name="customer_name" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold">Address</label>
                    <textarea class="form-control" name="address" rows="2" required></textarea>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted fw-bold">Latitude (For Map)</label>
                        <input type="number" step="any" class="form-control" name="latitude" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted fw-bold">Longitude (For Map)</label>
                        <input type="number" step="any" class="form-control" name="longitude" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted fw-bold">Parcel Weight (kg)</label>
                        <input type="number" step="0.1" class="form-control" name="parcel_weight" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted fw-bold">Priority</label>
                        <select class="form-select" name="priority" required>
                            <option value="normal">Normal</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted fw-bold">Delivery Center</label>
                    <select class="form-select" name="delivery_center_id" required>
                        <option value="">-- Choose Center --</option>
                        @foreach($centers as $center)
                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
