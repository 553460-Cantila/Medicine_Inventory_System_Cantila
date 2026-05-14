<x-app-layout>
    <div class="py-4">
        <h1 class="text-xl font-bold">Medicine Reports</h1>

        <form method="GET" action="{{ route('medicines.report') }}" class="mb-4">
            <label>Category:</label>
            <select name="category">
                <option value="">All</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>

            <label class="ml-4">Expiration Status:</label>
            <select name="expiration_status">
                <option value="">All</option>
                <option value="valid" {{ request('expiration_status') == 'valid' ? 'selected' : '' }}>Valid</option>
                <option value="expired" {{ request('expiration_status') == 'expired' ? 'selected' : '' }}>Expired</option>
                <option value="expiring_soon" {{ request('expiration_status') == 'expiring_soon' ? 'selected' : '' }}>Expiring soon (30 days)</option>
            </select>

            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded ml-2">Filter</button>
            <a href="{{ route('medicines.report') }}" class="bg-gray-400 text-white px-3 py-1 rounded ml-2">Reset</a>
        </form>

        <div class="mt-4">
            <a href="{{ route('medicines.export.excel', request()->query()) }}" class="bg-red-500 text-white px-3 py-1 rounded">Export Excel</a>
        </div>

        <div class="overflow-x-auto mt-4">
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2 text-left">Name</th>
                        <th class="border px-4 py-2 text-left">Generic</th>
                        <th class="border px-4 py-2 text-left">Category</th>
                        <th class="border px-4 py-2 text-left">Qty</th>
                        <th class="border px-4 py-2 text-left">Expiry</th>
                        <th class="border px-4 py-2 text-left">Price</th>
                        <th class="border px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicines as $m)
                    <tr>
                        <td class="border px-4 py-2">{{ $m->medicine_name }}</td>
                        <td class="border px-4 py-2">{{ $m->generic_name }}</td>
                        <td class="border px-4 py-2">{{ $m->category }}</td>
                        <td class="border px-4 py-2">{{ $m->quantity }}</td>
                        <td class="border px-4 py-2">{{ $m->expiration_date->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2">Php{{ number_format($m->price, 2) }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($m->status) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="border px-4 py-2 text-center">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>