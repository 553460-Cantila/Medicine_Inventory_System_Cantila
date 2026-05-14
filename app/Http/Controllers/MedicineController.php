<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{


    public function index()
    {
        $totalMedicines = Medicine::count();
        $lowStockCount = Medicine::where('quantity', '<=', 5)->count();
        $expiredCount = Medicine::where('expiration_date', '<', now())->count();
        $expiringSoonCount = Medicine::whereBetween('expiration_date', [now(), now()->addDays(30)])->count();
        $availableCount = Medicine::where('status', 'available')
            ->where('quantity', '>', 0)
            ->where('expiration_date', '>=', now())
            ->count();

        $medicines = Medicine::latest()->paginate(10);

        return view('medicines.index', compact(
            'totalMedicines', 'lowStockCount', 'expiredCount',
            'expiringSoonCount', 'availableCount', 'medicines'
        ));
    }

    public function create()
    {
        return view('medicines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'medicine_name'   => 'required|string|max:255',
            'generic_name'    => 'required|string|max:255',
            'category'        => 'required|string|max:100',
            'quantity'        => 'required|integer|min:0',
            'expiration_date' => 'required|date',
            'price'           => 'required|numeric|min:0',
            'status'          => 'required|in:available,unavailable',
        ]);
        Medicine::create($validated);
        return redirect()->route('medicines.index')->with('success', 'Medicine added.');
    }

    public function show(Medicine $medicine)
    {
        return view('medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'medicine_name'   => 'required|string|max:255',
            'generic_name'    => 'required|string|max:255',
            'category'        => 'required|string|max:100',
            'quantity'        => 'required|integer|min:0',
            'expiration_date' => 'required|date',
            'price'           => 'required|numeric|min:0',
            'status'          => 'required|in:available,unavailable',
        ]);
        $medicine->update($validated);
        return redirect()->route('medicines.index')->with('success', 'Medicine updated.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index')->with('success', 'Medicine deleted.');
    }

    public function report(Request $request)
    {
        $query = Medicine::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('expiration_status')) {
            switch ($request->expiration_status) {
                case 'expired':
                    $query->expired();
                    break;
                case 'valid':
                    $query->valid();
                    break;
                case 'expiring_soon':
                    $query->expiringSoon();
                    break;
            }
        }

        $medicines = $query->get();
        $categories = Medicine::distinct()->pluck('category');

        return view('medicines.report', compact('medicines', 'categories', 'request'));
    }

    public function applyFilters(Request $request)
    {
        $query = Medicine::query();
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('expiration_status')) {
            switch ($request->expiration_status) {
                case 'expired':
                    $query->expired();
                    break;
                case 'valid':
                    $query->valid();
                    break;
                case 'expiring_soon':
                    $query->expiringSoon();
                    break;
            }
        }
        return $query;
    }
}