@extends('layouts.app')
@section('header', 'Edit Vehicle')
@section('content')
<div class="card p-4"><form action="{{ route('vehicles.update', $vehicle) }}" method="POST">@csrf @method('PUT')
<div class="mb-3"><label>Vehicle Number</label><input type="text" name="vehicle_number" class="form-control" value="{{ $vehicle->vehicle_number }}" required></div>
<div class="mb-3"><label>Type</label><input type="text" name="type" class="form-control" value="{{ $vehicle->type }}" required></div>
<div class="mb-3"><label>Capacity</label><input type="number" name="capacity" class="form-control" value="{{ $vehicle->capacity }}" required></div>
<div class="mb-3"><label>Fuel Type</label><input type="text" name="fuel_type" class="form-control" value="{{ $vehicle->fuel_type }}" required></div>
<div class="mb-3"><label>Status</label><select name="status" class="form-control"><option value="active" {{ $vehicle->status=='active'?'selected':'' }}>Active</option><option value="inactive" {{ $vehicle->status=='inactive'?'selected':'' }}>Inactive</option></select></div>
<button class="btn btn-primary">Update</button></form></div>
@endsection