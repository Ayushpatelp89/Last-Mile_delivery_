@extends('layouts.app')
@section('header', 'Edit Order')
@section('content')
<div class="card p-4"><form action="{{ route('orders.update', $order) }}" method="POST">@csrf @method('PUT')
<div class="mb-3"><label>Customer Name</label><input type="text" name="customer_name" class="form-control" value="{{ $order->customer_name }}" required></div>
<div class="mb-3"><label>Address</label><textarea name="address" class="form-control" required>{{ $order->address }}</textarea></div>
<div class="mb-3"><label>Latitude</label><input type="text" name="latitude" class="form-control" value="{{ $order->latitude }}" required></div>
<div class="mb-3"><label>Longitude</label><input type="text" name="longitude" class="form-control" value="{{ $order->longitude }}" required></div>
<div class="mb-3"><label>Weight</label><input type="text" name="parcel_weight" class="form-control" value="{{ $order->parcel_weight }}" required></div>
<div class="mb-3"><label>Priority</label><select name="priority" class="form-control"><option value="normal" {{ $order->priority=='normal'?'selected':'' }}>Normal</option><option value="high" {{ $order->priority=='high'?'selected':'' }}>High</option></select></div>
<div class="mb-3"><label>Status</label><select name="status" class="form-control"><option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option><option value="assigned" {{ $order->status=='assigned'?'selected':'' }}>Assigned</option><option value="delivered" {{ $order->status=='delivered'?'selected':'' }}>Delivered</option></select></div>
<div class="mb-3"><label>Center</label><select name="delivery_center_id" class="form-control">@foreach($centers as $c)<option value="{{ $c->id }}" {{ $order->delivery_center_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach</select></div>
<button class="btn btn-primary">Update</button></form></div>
@endsection