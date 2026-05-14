<?php

use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
    Route::get('/medicines/create', [MedicineController::class, 'create'])->name('medicines.create');
    Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
    Route::get('/medicines/{medicine}', [MedicineController::class, 'show'])->name('medicines.show');
    Route::get('/medicines/{medicine}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
    Route::put('/medicines/{medicine}', [MedicineController::class, 'update'])->name('medicines.update');
    Route::delete('/medicines/{medicine}', [MedicineController::class, 'destroy'])->name('medicines.destroy');

    Route::get('/medicines-report', [MedicineController::class, 'report'])->name('medicines.report');
    Route::get('/medicines-report/excel', function (Request $request) {
        $controller = new MedicineController();
        $query = $controller->applyFilters($request);
        $medicines = $query->get([
            'medicine_name', 'generic_name', 'category', 'quantity',
            'expiration_date', 'price', 'status'
        ]);

        return Excel::download(
            new class($medicines) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
                private $medicines;
                public function __construct($medicines) { $this->medicines = $medicines; }
                public function collection() { return $this->medicines; }
                public function headings(): array {
                    return [
                        'Medicine Name', 'Generic Name', 'Category', 'Quantity',
                        'Expiration Date', 'Price', 'Status'
                    ];
                }
            },
            'medicine_report.xlsx'
        );
    })->name('medicines.export.excel');
});

require __DIR__.'/auth.php';