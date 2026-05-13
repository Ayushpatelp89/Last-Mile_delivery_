@extends('layouts.app')

@section('header', 'Delivery Orders')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Manage Deliveries</h5>
        <a href="{{ route('orders.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Order</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Destination</th>
                    <th>Weight</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Center Hub</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td class="fw-bold">{{ $order->customer_name }}</td>
                    <td><small>{{ Str::limit($order->address, 30) }}</small></td>
                    <td>{{ $order->parcel_weight }} kg</td>
                    <td>
                        @if($order->priority == 'high')
                            <span class="badge bg-danger"><i class="fa-solid fa-fire me-1"></i> High</span>
                        @else
                            <span class="badge bg-secondary">Normal</span>
                        @endif
                    </td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($order->status == 'assigned')
                            <span class="badge bg-info">Assigned</span>
                        @elseif($order->status == 'delivered')
                            <span class="badge bg-success">Delivered</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                        @endif
                    </td>
                    <td>{{ $order->deliveryCenter->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
