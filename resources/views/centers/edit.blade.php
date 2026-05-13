@extends('layouts.app')
@section('header', 'Edit Delivery Center')
@section('content')
<div class="card p-4"><form action="{{ route('centers.update', $center) }}" method="POST">@csrf @method('PUT')
<div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" value="{{ $center->name }}" required></div>
<div class="mb-3"><label>Address</label><textarea name="address" class="form-control" required>{{ $center->address }}</textarea></div>
<div class="mb-3"><label>Latitude</label><input type="text" name="latitude" class="form-control" value="{{ $center->latitude }}" required></div>
<div class="mb-3"><label>Longitude</label><input type="text" name="longitude" class="form-control" value="{{ $center->longitude }}" required></div>
<div class="mb-3"><label>Contact</label><input type="text" name="contact_number" class="form-control" value="{{ $center->contact_number }}"></div>
<button class="btn btn-primary">Update</button></form></div>
@endsection