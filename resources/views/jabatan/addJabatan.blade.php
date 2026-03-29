<div class="modal fade" id="modalTambahJabatan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jabatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('jabatan.store') }}">
                        @csrf
                        <div class="form-group basic mb-2">
                            <div class="input-wrapper">
                                <label class="label" for="jenis">Nama Departemen</label>
                                <select name="departemen_id" id="departemen_id" class="form-control tomselect" required>
                                    <option value="">-- Departemen --</option>
                                    @foreach ($departemen as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_departemen }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-wrapper">
                                <label class="label" for="jenis">Nama Jabatan</label>
                                <input type="text" class="form-control" id="jenis" name="nama_jabatan"
                                    placeholder="IT Support/Customer Service" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary shadowed btn-block  me-1 mb-1">SIMPAN</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
