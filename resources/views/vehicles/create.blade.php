@extends('layouts.app')
@section('header', 'Add Vehicle')
@section('content')
<div class="card p-4"><form action="{{ route('vehicles.store') }}" method="POST">@csrf
<div class="mb-3"><label>Vehicle Number</label><input type="text" name="vehicle_number" class="form-control" required></div>
<div class="mb-3"><label>Type</label><input type="text" name="type" class="form-control" required></div>
<div class="mb-3"><label>Capacity</label><input type="number" name="capacity" class="form-control" required></div>
<div class="mb-3"><label>Fuel Type</label><input type="text" name="fuel_type" class="form-control" required></div>
<button class="btn btn-primary">Save</button></form></div>
@endsection