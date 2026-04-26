@extends('layouts.masterdash')
@section('title', 'Riwayat Tanam')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4" style="color: #1d433b;">Riwayat Tanam</h2>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="agrisense-card p-3 mb-4 shadow-sm" style="background: #f0f7ef; border-radius: 12px; border: 1px solid #7a9d75;">
        <form method="POST" action="{{ route('riwayat.store') }}">
            @csrf
            <div class="row g-2">
                <div class="col-md-2">
                    <label class="small fw-bold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="small fw-bold">Kegiatan</label>
                    <input type="text" name="kegiatan_perawatan" class="form-control" placeholder="Jenis Kegiatan" required>
                </div>
                <div class="col-md-4">
                    <label class="small fw-bold">Catatan</label>
                    <input type="text" name="catatan" class="form-control" placeholder="Keterangan">
                </div>
                <div class="col-md-1 text-center">
                    <label class="small fw-bold d-block">Selesai</label>
                    <input type="checkbox" name="status" value="1" class="form-check-input mt-2">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">Tambah Data</button>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <table class="table table-hover align-middle mb-0 bg-white">
            <thead class="text-white" style="background: #1d433b;">
                <tr>
                    <th>Tanggal</th>
                    <th>Kegiatan Perawatan</th>
                    <th>Catatan</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td class="fw-bold">{{ $item->kegiatan_perawatan }}</td>
                    <td class="text-muted small">{{ $item->catatan ?? '-' }}</td>
                    <td class="text-center">
                        @if($item->status)
                            <span class="badge bg-success"><i class="fas fa-check"></i> Selesai</span>
                        @else
                            <span class="badge bg-secondary text-white">Proses</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-warning"
                                onclick="openEditModal('{{ $item->id_riwayat }}', '{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}', '{{ $item->kegiatan_perawatan }}', '{{ $item->catatan }}', '{{ $item->status }}')">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form method="POST" action="{{ route('riwayat.destroy', $item->id_riwayat) }}" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-muted">Belum ada riwayat tanam.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $data->links() }}
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" id="editForm">
        @csrf
        @method('PUT')
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header text-white" style="background: #1d433b;">
                <h5 class="modal-title">Edit Riwayat Tanam</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="fw-bold small">Tanggal</label>
                    <input type="date" name="tanggal" id="editTanggal" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="fw-bold small">Kegiatan Perawatan</label>
                    <input type="text" name="kegiatan_perawatan" id="editKegiatan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="fw-bold small">Catatan</label>
                    <textarea name="catatan" id="editCatatan" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="status" id="editStatus" value="1" class="form-check-input">
                    <label class="form-check-label" for="editStatus">Selesai</label>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn text-white" style="background: #1d433b;">Simpan Perubahan</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
    function openEditModal(id, tanggal, kegiatan, catatan, status) {
        document.getElementById('editForm').action = '/riwayat-tanam/' + id;
        document.getElementById('editTanggal').value = tanggal;
        document.getElementById('editKegiatan').value = kegiatan;
        document.getElementById('editCatatan').value = catatan;
        document.getElementById('editStatus').checked = (status == 1 || status == true);
        var modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
    }
</script>
@endpush