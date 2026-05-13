@extends('layouts.app')
@section('header', 'Edit Driver')
@section('content')
<div class="card p-4"><form action="{{ route('drivers.update', $driver) }}" method="POST">@csrf @method('PUT')
<div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="{{ $driver->name }}" required></div>
<div class="mb-3"><label>Phone</label><input type="text" name="phone" class="form-control" value="{{ $driver->phone }}" required></div>
<div class="mb-3"><label>Status</label><select name="availability_status" class="form-control"><option value="available" {{ $driver->availability_status=='available'?'selected':'' }}>Available</option><option value="on_delivery" {{ $driver->availability_status=='on_delivery'?'selected':'' }}>On Delivery</option><option value="off_duty" {{ $driver->availability_status=='off_duty'?'selected':'' }}>Off Duty</option></select></div>
<div class="mb-3"><label>Vehicle</label><select name="vehicle_id" class="form-control"><option value="">-- None --</option>@foreach($vehicles as $v)<option value="{{ $v->id }}" {{ $driver->vehicle_id == $v->id ? 'selected' : '' }}>{{ $v->vehicle_number }}</option>@endforeach</select></div>
<button class="btn btn-primary">Update</button></form></div>
@endsection