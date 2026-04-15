<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12 bg-light min-vh-100">
        <div class="container">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-dark py-4 px-4 border-0">
                    <h2 class="h4 text-white mb-0 fw-bold">Rice Business Management</h2>
                </div>

                <div class="card-body p-4">
                    <ul class="nav nav-pills mb-4" id="riceTab" role="tablist">
                        <li class="nav-item"><button class="nav-link active fw-semibold" data-bs-toggle="tab"
                                data-bs-target="#storage" type="button">Inventory</button></li>
                        <li class="nav-item"><button class="nav-link fw-semibold" data-bs-toggle="tab"
                                data-bs-target="#orders" type="button">Transactions</button></li>
                        <li class="nav-item"><button class="nav-link fw-semibold" data-bs-toggle="tab"
                                data-bs-target="#payments" type="button">History</button></li>
                    </ul>

                    <div class="tab-content" id="riceTabContent">
                        <div class="tab-pane fade show active" id="storage">
                            <h5 class="fw-bold mb-3">Add Rice Variety</h5>
                            <form action="{{ route('rices.store') }}" method="POST" class="row g-3 mb-4">
                                @csrf
                                <div class="col-md-4"><input type="text" name="rice_name" class="form-control"
                                        placeholder="Rice Name" required></div>
                                <div class="col-md-3"><input type="number" step="0.01" name="price" class="form-control"
                                        placeholder="Price/kg" required></div>
                                <div class="col-md-3"><input type="number" name="stock" class="form-control"
                                        placeholder="Initial Stock" required></div>
                                <div class="col-md-2"><button type="submit" class="btn btn-primary w-100">Save</button>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Rice Name</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rices as $rice)
                                            <tr>
                                                <td class="fw-bold">{{ $rice->rice_name }}</td>
                                                <td>₱{{ number_format($rice->price, 2) }}</td>
                                                <td><span
                                                        class="badge {{ $rice->stock < 10 ? 'bg-danger' : 'bg-success' }}">{{ $rice->stock }}
                                                        kg</span></td>
                                                <td class="text-end">
                                                    <button class="btn btn-sm btn-outline-primary border-0"
                                                        data-bs-toggle="modal" data-bs-target="#editRice{{ $rice->id }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('rices.destroy', $rice->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm text-danger border-0">Delete</button>
                                                    </form>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="orders">
                            <h5 class="fw-bold mb-3">Place New Order</h5>
                            <form action="{{ route('orders.add') }}" method="POST" class="row g-3 mb-4">
                                @csrf
                                <div class="col-md-4">
                                    <select name="rice_id" class="form-select" required>
                                        <option value="" disabled selected>Choose Rice...</option>
                                        @foreach($rices as $rice) <option value="{{ $rice->id }}">{{ $rice->rice_name }}
                                        (₱{{ $rice->price }})</option> @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2"><input type="number" name="quantity" class="form-control"
                                        placeholder="Qty" required></div>
                                <div class="col-md-2"><button type="submit" class="btn btn-primary w-100">Order</button>
                                </div>
                            </form>
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th> 
                                        <th>Rice Name</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->rice->rice_name }} ({{ $order->quantity }}kg)</td>
                                            <td class="fw-bold text-success">₱{{ number_format($order->total_cost, 2) }}
                                            </td>
                                            <td><span
                                                    class="badge {{ $order->status == 'Paid' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $order->status }}</span>
                                            </td>
                                            <td class="text-end">
                                                @if($order->status != 'Paid')
                                                    <form action="{{ route('payments.store', $order->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="amount" value="{{ $order->total_cost }}">
                                                        <button class="btn btn-sm btn-success px-3">Pay Now</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="payments">
                            <table class="table table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Order #</th>
                                        <th>Rice</th>
                                        <th>Amount Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->created_at->format('M d, Y h:i A') }}</td>
                                            <td>#{{ $payment->order_id }}</td>
                                            <td>{{ $payment->order->rice->rice_name ?? 'Deleted Rice' }}</td>
                                            <td class="fw-bold text-primary">₱{{ number_format($payment->amount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @foreach($rices as $rice)
        <div class="modal fade" id="editRice{{ $rice->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header bg-dark text-white border-0 py-3">
                        <h5 class="modal-title fw-bold">Update Rice Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('rices.update', $rice->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body p-4">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Rice Name</label>
                                <input type="text" name="rice_name" class="form-control" value="{{ $rice->rice_name }}"
                                    required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small fw-bold text-muted">Price per kg</label>
                                    <input type="number" step="0.01" name="price" class="form-control"
                                        value="{{ $rice->price }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small fw-bold text-muted">Stock Level</label>
                                    <input type="number" name="stock" class="form-control" value="{{ $rice->stock }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 p-4 pt-0">
                            <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark fw-bold px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>