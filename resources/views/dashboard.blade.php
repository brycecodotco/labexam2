<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="container bg-white p-4 shadow-sm rounded">
            <h2 class="mb-4 fw-bold text-primary">Rice Business Management</h2>

            <ul class="nav nav-tabs mb-4" id="riceSystemTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="storage-tab" data-bs-toggle="tab" data-bs-target="#storage" type="button">🌾 Rice Storage</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button">🛒 Order Transactions</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button">💳 Payment History</button>
                </li>
            </ul>

            <div class="tab-content" id="riceSystemTabsContent">
                
                <div class="tab-pane fade show active" id="storage" role="tabpanel">
                    <div class="card mb-4 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="fw-bold">Add New Rice</h5>
                            <form action="{{ route('rices.store') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-4"><input type="text" name="rice_name" class="form-control" placeholder="Rice Name" required></div>
                                <div class="col-md-3"><input type="number" step="0.01" name="price" class="form-control" placeholder="Price/kg" required></div>
                                <div class="col-md-3"><input type="number" name="stock" class="form-control" placeholder="Stock Quantity" required></div>
                                <div class="col-md-2"><button type="submit" class="btn btn-success w-100">Add Rice</button></div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr><th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            @foreach($rices as $rice)
                            <tr>
                                <td>#{{ $rice->id }}</td>
                                <td>{{ $rice->rice_name }}</td>
                                <td>₱{{ number_format($rice->price, 2) }}</td>
                                <td>{{ $rice->stock }} kg</td>
                                <td>
                                    <form action="{{ route('rices.destroy', $rice->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="orders" role="tabpanel">
                    <div class="card mb-4 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="fw-bold">New Order</h5>
                            <form action="{{ route('orders.store') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-8">
                                    <select name="rice_id" class="form-select" required>
                                        <option value="" disabled selected>Select Rice Variety...</option>
                                        @foreach($rices as $rice)
                                            <option value="{{ $rice->id }}">{{ $rice->rice_name }} (₱{{ $rice->price }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2"><input type="number" name="quantity" class="form-control" placeholder="Qty (kg)" required></div>
                                <div class="col-md-2"><button type="submit" class="btn btn-primary w-100">Create Order</button></div>
                            </form>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr><th>Order ID</th><th>Rice</th><th>Total Cost</th><th>Status</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->rice->rice_name ?? 'N/A' }} ({{ $order->quantity }}kg)</td>
                                <td class="fw-bold">₱{{ number_format($order->total_cost, 2) }}</td>
                                <td><span class="badge {{ $order->status == 'Paid' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $order->status ?? 'Unpaid' }}</span></td>
                                <td>
                                    @if($order->status != 'Paid')
                                    <form action="{{ route('payments.store', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="amount" value="{{ $order->total_cost }}">
                                        <button type="submit" class="btn btn-sm btn-success">Pay Now</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="payments" role="tabpanel">
                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr><th>Date</th><th>Order ID</th><th>Rice Variety</th><th>Amount Paid</th></tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                <td>Order #{{ $payment->order_id }}</td>
                                <td>{{ $payment->order->rice->rice_name ?? 'N/A' }}</td>
                                <td class="text-success fw-bold">₱{{ number_format($payment->amount, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>