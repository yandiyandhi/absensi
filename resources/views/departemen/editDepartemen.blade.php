<div class="modal fade" id="modalEditDepartemen" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Departemen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form id="formEditDepartemen" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="form-group basic mb-2">
                            <div class="input-wrapper">
                                <label class="label" for="nama_departemen">Nama Departemen</label>
                                <input type="text" class="form-control" id="nama_departemen" name="nama_departemen"
                                    placeholder="IT/Finance" required>
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
