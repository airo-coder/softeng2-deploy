@extends('main')
@section('poshistory', 'System 1')
@section('content')
@vite(['resources/css/pos-history.css'])

<div class="main-container">
    <div class="parent-container">
        <div class="header-container">
            <div class="search-container">
                <form method="GET" action="{{ route('POShistory') }}">
                    <input type="text" name="search" class="search-input" placeholder="Search by Transaction ID" value="{{ request('search') }}">
                </form>
            </div>
            <div class="date-container">
                <form method="GET" action="{{ route('POShistory') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="date" name="date" id="dateInput" value="{{ request('date') }}" onchange="this.form.submit()"/>
                </form>
            </div>
            <!-- PAYMENT FILTER ADDED -->
            <div class="filter-container" style="display: flex; align-items: center; background-color: white; border: 1px solid #ccc; border-radius: 6px; padding: 0.2rem 0.5rem; margin-right: 0.5rem;">
                <div id="filter-button" class="filter-icon-container" style="margin-right:0.5rem; cursor:pointer;">
                    <i class="bi bi-funnel"></i>
                </div>
                <div class="filter-dropdown" id="filterDropdown">
                    <form method="GET" action="{{ route('POShistory') }}" class="filter-dropdown-form" style="display:flex; gap:0.5rem;">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="date" value="{{ request('date') }}">
                        <div class="filter-group">
                            <select name="payment_method" style="padding:0.2rem; border-radius:4px; border:1px solid #ccc;" onchange="this.form.submit()">
                                <option value="">All Payments</option>
                                <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="gcash" {{ request('payment_method') === 'gcash' ? 'selected' : '' }}>GCash</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="pagination-container">
                @include('components.pagination', ['paginator' => $transactions])
            </div>
            <div class="export-sales-data-container">
                <button data-export-name="pos-transaction-history" data-export-url="/export/pos-history">
                    <i class="fa-solid fa-print"></i>
                    <span>Export Sales Data</span>
                </button>
            </div>
        </div>

        <div class="main-body-container">
            @php
                $payFilter = request('payment_method');
                $payLabels = ['cash' => 'Cash', 'gcash' => 'GCash'];
                $filterLabel = $payLabels[$payFilter] ?? 'All Transactions';
            @endphp
            <div class="active-filter-title" style="font-weight: 600; padding: 1rem 1.5rem; border-bottom: 1px solid #eee; background-color: #f8f9fa;"><i class="bi bi-funnel-fill"></i> {{ $filterLabel }}</div>
            <table>
                <colgroup>
                    <col style="width: 20%">
                    <col style="width: 18%">
                    <col style="width: 12%">
                    <col style="width: 15%">
                    <col style="width: 15%">
                    <col style="width: 20%">
                </colgroup>
                <thead>
                    <tr class="tr">
                        <th class="th">Order ID</th>
                        <th class="th">Date & Time</th>
                        <th class="th">Items Sold</th>
                        <th class="th">Payment Method</th>
                        <th class="th">Grand Total</th>
                        <th class="th">Cashier</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $txn)
                        <tr class="tr clickable-row" data-order-id="{{ $txn->order_id }}">
                            <td>{{ $txn->order_id }}</td>
                            <td>{{ $txn->created_at->format('m/d/Y h:i A') }}</td>
                            <td>{{ $txn->items->sum('quantity') }}</td>
                            <td>
                                <span class="payment-badge payment-{{ $txn->payment_method }}">
                                    {{ ucfirst($txn->payment_method) }}
                                </span>
                            </td>
                            <td class="amount-cell">₱{{ number_format($txn->total_amount, 2) }}</td>
                            <td>{{ $txn->user ? $txn->user->first_name . ' ' . $txn->user->last_name : 'System' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:2rem;color:#999;">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection