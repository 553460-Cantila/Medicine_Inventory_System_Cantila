<x-app-layout>
    <div class="py-4">
        <h1 class="text-xl font-bold">Edit Medicine</h1>
        <form method="POST" action="{{ route('medicines.update', $medicine) }}">
            @csrf @method('PUT')
            <div><label>Medicine Name</label><input type="text" name="medicine_name" value="{{ old('medicine_name', $medicine->medicine_name) }}" required></div>
            <div><label>Generic Name</label><input type="text" name="generic_name" value="{{ old('generic_name', $medicine->generic_name) }}" required></div>
            <div><label>Category</label><input type="text" name="category" value="{{ old('category', $medicine->category) }}" required></div>
            <div><label>Quantity</label><input type="number" name="quantity" value="{{ old('quantity', $medicine->quantity) }}" required></div>
            <div><label>Expiration Date</label><input type="date" name="expiration_date" value="{{ old('expiration_date', $medicine->expiration_date->format('Y-m-d')) }}" required></div>
            <div><label>Price</label><input type="number" step="0.01" name="price" value="{{ old('price', $medicine->price) }}" required></div>
            <div><label>Status</label><select name="status">
                <option value="available" {{ $medicine->status=='available'?'selected':'' }}>Available</option>
                <option value="unavailable" {{ $medicine->status=='unavailable'?'selected':'' }}>Unavailable</option>
            </select></div>
            <button type="submit">Update</button>
        </form>
    </div>
</x-app-layout>