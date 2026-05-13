@extends('layouts.app')
@section('header', 'Add Delivery Center')
@section('content')
<div class="card p-4"><form action="{{ route('centers.store') }}" method="POST">@csrf
<div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" required></div>
<div class="mb-3"><label>Address</label><textarea name="address" class="form-control" required></textarea></div>
<div class="mb-3"><label>Latitude</label><input type="text" name="latitude" class="form-control" required></div>
<div class="mb-3"><label>Longitude</label><input type="text" name="longitude" class="form-control" required></div>
<div class="mb-3"><label>Contact</label><input type="text" name="contact_number" class="form-control"></div>
<button class="btn btn-primary">Save</button></form></div>
@endsection