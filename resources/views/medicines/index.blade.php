<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Total Medicines</div>
                    <div class="text-3xl font-bold">{{ $totalMedicines }}</div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Available</div>
                    <div class="text-3xl font-bold text-green-600">{{ $availableCount }}</div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Low Stock (≤5)</div>
                    <div class="text-3xl font-bold text-yellow-600">{{ $lowStockCount }}</div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Expired</div>
                    <div class="text-3xl font-bold text-red-600">{{ $expiredCount }}</div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Expiring Soon (30d)</div>
                    <div class="text-3xl font-bold text-orange-600">{{ $expiringSoonCount }}</div>
                </div>
            </div>

            <!-- Add Medicine Button -->
            <div class="mb-4">
                <a href="{{ route('medicines.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Medicine</a>
            </div>

            <!-- Full Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">All Medicines</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border px-4 py-2 text-left">Name</th>
                                    <th class="border px-4 py-2 text-left">Generic</th>
                                    <th class="border px-4 py-2 text-left">Category</th>
                                    <th class="border px-4 py-2 text-left">Qty</th>
                                    <th class="border px-4 py-2 text-left">Expiry</th>
                                    <th class="border px-4 py-2 text-left">Price</th>
                                    <th class="border px-4 py-2 text-left">Status</th>
                                    <th class="border px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($medicines as $medicine)
                                <tr>
                                    <td class="border px-4 py-2">{{ $medicine->medicine_name }}</td>
                                    <td class="border px-4 py-2">{{ $medicine->generic_name }}</td>
                                    <td class="border px-4 py-2">{{ $medicine->category }}</td>
                                    <td class="border px-4 py-2">{{ $medicine->quantity }}</td>
                                    <td class="border px-4 py-2">{{ $medicine->expiration_date->format('Y-m-d') }}</td>
                                    <td class="border px-4 py-2">${{ number_format($medicine->price,2) }}</td>
                                    <td class="border px-4 py-2">
                                        @if($medicine->status == 'available')
                                            <span class="text-green-600">Available</span>
                                        @else
                                            <span class="text-red-600">Unavailable</span>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('medicines.show', $medicine) }}" class="text-blue-600">View</a>
                                        <a href="{{ route('medicines.edit', $medicine) }}" class="text-yellow-600 ml-2">Edit</a>
                                        <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" class="inline ml-2">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600" onclick="return confirm('Delete?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr><td colspan="8" class="text-center py-4">No medicines found</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $medicines->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>