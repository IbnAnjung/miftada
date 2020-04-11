<form class="modal-part" id="form-tambah-siswa">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Status</label>
        <div class="input-group">
            <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-envelope"></i>
            </div>
            </div>
            <input type="text" class="form-control" placeholder="keterangan/nama status" name="keterangan" required>
        </div>
    </div>
    <button class="d-none" id="fire-modal-5-submit"></button>
</form>