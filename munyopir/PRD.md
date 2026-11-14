## 7. Struktur Kodingan (untuk AI)

### 7.1 Stack
- PHP 8.2+, Laravel 11, MySQL 8, Blade, Tailwind CSS, Composer
- Pola: MVC. Satu akun = satu kendaraan.
- Web responsif (mobile-first), tanpa OCR, tanpa pembayaran.

### 7.2 Struktur Direktori
```text
munyopir/
├── app/
│   ├── Console/Commands/
│   │   └── CekPengingat.php          # dipanggil scheduler (F1 & F3)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php
│   │   │   ├── TripController.php        # F1
│   │   │   ├── ExpenseController.php     # F2
│   │   │   ├── MaintenanceController.php # F3
│   │   │   ├── VehicleController.php
│   │   │   └── NotificationController.php
│   │   ├── Requests/                 # validasi (Form Request)
│   │   │   ├── StoreTripRequest.php
│   │   │   ├── StoreExpenseRequest.php   # foto: image|max:2048
│   │   │   └── StoreMaintenanceRuleRequest.php
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Vehicle.php
│   │   ├── Trip.php
│   │   ├── Expense.php
│   │   ├── MaintenanceRule.php
│   │   └── Notification.php
│   ├── Policies/                     # data hanya bisa diakses pemilik
│   └── Services/
│       ├── ImageCompressor.php       # kompres foto nota
│       ├── ReminderService.php       # logika KM/tanggal mendekati batas
│       └── ExpenseReportService.php  # rekap harian & bulanan
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_vehicles_table.php
│   │   ├── xxxx_create_trips_table.php
│   │   ├── xxxx_create_expenses_table.php
│   │   ├── xxxx_create_maintenance_rules_table.php
│   │   └── xxxx_create_notifications_table.php
│   └── seeders/
├── resources/views/
│   ├── layouts/app.blade.php
│   ├── components/                   # kartu-jadwal, form-pengeluaran, badge-status
│   ├── auth/                         # login, register (F4)
│   ├── dashboard.blade.php
│   ├── trips/                        # index, create, edit
│   ├── expenses/                     # index, create, rekap
│   └── maintenance/                  # index, create
├── routes/
│   ├── web.php
│   └── console.php                   # jadwal Task Scheduling
├── storage/app/public/receipts/      # foto nota
└── tests/Feature/                    # skenario black box
```

### 7.3 Pemetaan Fitur → Kode
| Kode | Fitur | Controller | Model | View |
|------|-------|-----------|-------|------|
| F1 | Manajemen Perjalanan | TripController | Trip | trips/* |
| F2 | Rekap Reimburse | ExpenseController | Expense | expenses/* |
| F3 | Pengingat Perawatan | MaintenanceController | MaintenanceRule, Vehicle | maintenance/* |
| F4 | Akun Pengguna | Auth (Breeze) | User | auth/* |

### 7.4 Rute Utama (routes/web.php)
- Route::resource('trips', TripController::class)
- PATCH /trips/{trip}/status → ubah status (terjadwal|berubah|selesai|batal)
- Route::resource('expenses', ExpenseController::class)
- GET /expenses/rekap?periode=harian|bulanan
- Route::resource('maintenance', MaintenanceController::class)
- PATCH /vehicle/odometer → update KM saat ini
- GET /notifications, PATCH /notifications/{id}/read

### 7.5 Relasi Eloquent
- User hasOne Vehicle; User hasMany Trip, Expense, Notification
- Vehicle hasMany MaintenanceRule
- Trip hasMany Expense (opsional)

### 7.6 Aturan Bisnis Penting
- Status trip: terjadwal → berubah → selesai | batal
- Pengingat oli: kirim jika (KM_sekarang >= KM_terakhir + interval_km - 500)
  ATAU (hari ini >= tanggal_terakhir + interval_hari - 14 hari); mana lebih dulu
- Pengingat STNK/KIR: H-30, H-7, H-1 sebelum masa berlaku
- Pengingat jemput: 60 dan 15 menit sebelum waktu_jemput
- Scheduler: php artisan app:cek-pengingat dijalankan setiap menit

### 7.7 Konvensi Koding untuk AI
- Nama tabel/kolom: bahasa Inggris snake_case (sesuai rancangan basis data)
- Teks antarmuka: Bahasa Indonesia
- Validasi wajib via Form Request; otorisasi via Policy
- Jangan menambah fitur di luar batasan masalah (OCR, pembayaran, multi-kendaraan)
- Tailwind mobile-first; tombol minimal 44px, bisa dipakai satu tangan
- Setiap controller method harus punya Feature test (skenario normal + error)

### 7.8 Urutan Pengerjaan (sesuai jadwal pertemuan 11–13)
1. Setup Laravel + auth + layout
2. Migration & model
3. F1 Trip → F2 Expense → F3 Maintenance
4. Scheduler & notifikasi
5. Testing & dokumentasi
