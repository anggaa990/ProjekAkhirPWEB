@extends('layouts.employee')

@section('content')
<div class="container mt-4">

    <h3 class="mb-3">Detail Reservasi</h3>

    <div class="card p-3">
        <p><strong>ID Reservasi:</strong> {{ $reservation->id }}</p>
        <p><strong>Nama Customer:</strong> {{ $reservation->user->name }}</p>
        <p><strong>Tanggal Reservasi:</strong> {{ $reservation->reservation_date }}</p>
        <p><strong>Jumlah Orang:</strong> {{ $reservation->guests }}</p>
        <p><strong>Meja:</strong> {{ $reservation->table ? $reservation->table->table_number : '-' }}</p>
        <p><strong>Status:</strong> 
            <span class="badge bg-primary">{{ $reservation->status }}</span>
        </p>
    </div>

    <hr>

    {{-- ================= STATUS UPDATE ================= --}}
    <h5 class="mt-4">Ubah Status Reservasi</h5>

    <form action="{{ route('employee.reservations.updateStatus', $reservation->id) }}" method="POST" class="mt-2">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-md-6">
                <select name="status" class="form-select" required>
                    <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Update Status</button>
            </div>
        </div>
    </form>

    {{-- ================= COMPLETE BUTTON ================= --}}
    <h5 class="mt-4">Tandai Selesai</h5>
    <form action="{{ route('employee.reservations.complete', $reservation->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-success">
            ✔ Tandai Reservasi Telah Selesai
        </button>
    </form>

    <a href="{{ route('employee.reservations.index') }}" class="btn btn-secondary mt-3">
        Kembali ke Daftar Reservasi
    </a>

</div>
@endsection
