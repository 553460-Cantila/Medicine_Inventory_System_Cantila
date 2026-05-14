<x-app-layout>
    <div class="py-4">
        <h1>Medicine Details</h1>
        <p><strong>Name:</strong> {{ $medicine->medicine_name }}</p>
        <p><strong>Generic:</strong> {{ $medicine->generic_name }}</p>
        <p><strong>Category:</strong> {{ $medicine->category }}</p>
        <p><strong>Quantity:</strong> {{ $medicine->quantity }}</p>
        <p><strong>Expiry:</strong> {{ $medicine->expiration_date->format('Y-m-d') }}</p>
        <p><strong>Price:</strong> ${{ number_format($medicine->price,2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($medicine->status) }}</p>
        <a href="{{ route('medicines.index') }}">Back</a>
    </div>
</x-app-layout>