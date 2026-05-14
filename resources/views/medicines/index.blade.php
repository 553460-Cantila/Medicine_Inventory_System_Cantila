<x-app-layout>
    <div class="py-4">
        <h1 class="text-xl font-bold mb-4">Medicines</h1>
        <a href="{{ route('medicines.create') }}" class="bg-blue-500 text-white px-3 py-1 rounded">+ Add Medicine</a>
        @if(session('success')) <p class="text-green-600 mt-2">{{ session('success') }}</p> @endif
        <table class="w-full border mt-4">
            <thead><tr class="bg-gray-100"><th>Name</th><th>Generic</th><th>Category</th><th>Qty</th><th>Expiry</th><th>Price</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($medicines as $m)
                <tr>
                    <td>{{ $m->medicine_name }}</td>
                    <td>{{ $m->generic_name }}</td>
                    <td>{{ $m->category }}</td>
                    <td>{{ $m->quantity }}</td>
                    <td>{{ $m->expiration_date->format('Y-m-d') }}</td>
                    <td>Php {{ number_format($m->price,2) }}</td>
                    <td>{{ ucfirst($m->status) }}</td>
                    <td>
                        <a href="{{ route('medicines.show',$m) }}">View</a> |
                        <a href="{{ route('medicines.edit',$m) }}">Edit</a>
                        <form action="{{ route('medicines.destroy',$m) }}" method="POST" class="inline">@csrf @method('DELETE')<button onclick="return confirm('Delete?')">Delete</button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $medicines->links() }}
    </div>
</x-app-layout>