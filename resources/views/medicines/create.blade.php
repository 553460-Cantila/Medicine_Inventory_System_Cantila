<x-app-layout>
    <div class="py-4">
        <h1 class="text-xl font-bold">Add Medicine</h1>
        @if($errors->any()) <ul>@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul> @endif
        <form method="POST" action="{{ route('medicines.store') }}">
            @csrf
            <div><label>Medicine Name</label><input type="text" name="medicine_name" required></div>
            <div><label>Generic Name</label><input type="text" name="generic_name" required></div>
            <div><label>Category</label><input type="text" name="category" required></div>
            <div><label>Quantity</label><input type="number" name="quantity" required></div>
            <div><label>Expiration Date</label><input type="date" name="expiration_date" required></div>
            <div><label>Price</label><input type="number" step="0.01" name="price" required></div>
            <div><label>Status</label><select name="status"><option value="available">Available</option><option value="unavailable">Unavailable</option></select></div>
            <button type="submit">Save</button>
        </form>
    </div>
</x-app-layout>