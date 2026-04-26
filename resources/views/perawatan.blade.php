@extends('layouts.masterdash')

@section('title', 'Perawatan HPT')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #1d433b;">Manajemen Perawatan HPT</h2>

    @if(session('success'))
      <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <form action="{{ route('hpt.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Cari kegiatan perawatan atau catatan..." value="{{ request('q') }}">
            <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i> Cari</button>
        </div>
    </form>

    <div class="agrisense-card p-3 mb-4 shadow-sm" style="background: #f0f7ef; border-radius: 12px; border: 1px solid #7a9d75;">
        <form method="POST" action="{{ route('hpt.store') }}">
          @csrf
          <div class="row g-2">
            <div class="col-md-2">
                <label class="small fw-bold">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold">Jenis Perawatan</label>
                <input type="text" name="kegiatan" class="form-control" placeholder="Contoh: Semprot Hama" required>
            </div>
            <div class="col-md-4">
                <label class="small fw-bold">Catatan</label>
                <input type="text" name="catatan" class="form-control" placeholder="Keterangan tambahan">
            </div>
            <div class="col-md-2 d-flex align-items-end">
              <button type="submit" class="btn btn-success w-100">Tambah Data</button>
            </div>
          </div>
        </form>
    </div>

    <div class="table-responsive shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <table class="table table-hover align-middle mb-0">
          <thead class="text-white" style="background: #1d433b;">
            <tr>
              <th>Tanggal</th>
              <th>Kegiatan</th>
              <th>Catatan</th>
              <th class="text-center">Status</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @forelse($data as $item)
            <tr>
              <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
              <td class="fw-bold text-dark">{{ $item->kegiatan }}</td>
              <td class="text-muted small">{{ $item->catatan ?? '-' }}</td>
              <td class="text-center">
                <div class="form-check form-switch d-inline-block">
                    <input class="form-check-input" type="checkbox" role="switch" 
                           {{ $item->status ? 'checked' : '' }} 
                           onclick="toggleStatus('{{ $item->id_perawatan }}', this.checked)">
                </div>
              </td>
              <td class="text-center">
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-sm btn-outline-warning"
                    onclick="openEditModal('{{ $item->id_perawatan }}', '{{ $item->tanggal->format('Y-m-d') }}', '{{ $item->kegiatan }}', '{{ $item->catatan }}', '{{ $item->status }}')">
                    <i class="fas fa-pen"></i>
                  </button>
                  <form method="POST" action="{{ route('hpt.destroy', $item->id_perawatan) }}" class="d-inline" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-4 text-muted">Belum ada data perawatan HPT.</td>
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
        @csrf @method('PUT')
        <div class="modal-content" style="border-radius: 15px; border: none;">
          <div class="modal-header text-white" style="background: #1d433b;">
            <h5 class="modal-title">Edit Perawatan HPT</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="fw-bold small">Tanggal</label>
              <input type="date" name="tanggal" id="editTanggal" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="fw-bold small">Jenis Perawatan</label>
              <input type="text" name="kegiatan" id="editKegiatan" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="fw-bold small">Catatan</label>
              <textarea name="catatan" id="editCatatan" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-check form-switch mt-3">
              <input class="form-check-input" type="checkbox" name="status" id="editStatus" value="1">
              <label class="form-check-label" for="editStatus">Tandai sebagai Selesai</label>
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
    // Fungsi buka modal edit
    function openEditModal(id, tanggal, kegiatan, catatan, status) {
      // PERBAIKAN: Sesuaikan URL dengan route (tambah -hpt)
      document.getElementById('editForm').action = '/perawatan-hpt/' + id; 
      
      document.getElementById('editTanggal').value = tanggal;
      document.getElementById('editKegiatan').value = kegiatan;
      document.getElementById('editCatatan').value = catatan;
      document.getElementById('editStatus').checked = (status == 1 || status == true);
      new bootstrap.Modal(document.getElementById('editModal')).show();
    }

    // Fungsi AJAX untuk ganti status via switch di tabel
    function toggleStatus(id, isChecked) {
        // PERBAIKAN: Sesuaikan URL dengan route (tambah -hpt)
        fetch(`/perawatan-hpt/${id}`, { 
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: isChecked ? 1 : 0 })
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if(!data.success) alert('Gagal memperbarui status');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan koneksi ke server');
        });
    }
</script>
@endpush