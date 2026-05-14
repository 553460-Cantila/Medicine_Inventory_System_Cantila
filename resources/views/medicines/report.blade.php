<x-app-layout>
    <div class="py-4">
        <h1 class="text-xl font-bold">Medicine Reports</h1>
        <form method="GET" action="{{ route('medicines.report') }}">
            <label>Category:</label>
            <select name="category">
                <option value="">All</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category')==$cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <label>Expiration Status:</label>
            <select name="expiration_status">
                <option value="">All</option>
                <option value="valid" {{ request('expiration_status')=='valid' ? 'selected' : '' }}>Valid</option>
                <option value="expired" {{ request('expiration_status')=='expired' ? 'selected' : '' }}>Expired</option>
                <option value="expiring_soon" {{ request('expiration_status')=='expiring_soon' ? 'selected' : '' }}>Expiring soon (30 days)</option>
            </select>
            <button type="submit">Filter</button>
            <a href="{{ route('medicines.report') }}">Reset</a>
        </form>

        <!-- Excel Export Button -->
        <div class="mt-4">
            <a href="{{ route('medicines.export.excel', request()->query()) }}">Export Excel</a>
        </div>

        <table class="w-full border mt-4">
            <thead><tr><th>Name</th><th>Generic</th><th>Category</th><th>Qty</th><th>Expiry</th><th>Price</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($medicines as $m)
                <tr>
                    <td>{{ $m->medicine_name }}</td>
                    <td>{{ $m->generic_name }}</td>
                    <td>{{ $m->category }}</td>
                    <td>{{ $m->quantity }}</td>
                    <td>{{ $m->expiration_date->format('Y-m-d') }}</td>
                    <td>Php {{ number_format($m->price,2) }}</td>
                    <td>{{ ucfirst($m->status) }}</td>
                </tr>
                @empty
                <tr><td colspan="7">No records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>