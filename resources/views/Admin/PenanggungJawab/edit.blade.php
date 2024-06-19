<!-- MODAL EDIT -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Penanggung Jawab</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idpenanggungjawabU">
                <div class="form-group">
                    <label for="penanggungjawabU" class="form-label">Penanggung Jawab Barang <span
                            class="text-danger">*</span></label>
                    <input type="text" name="penanggungjawabU" class="form-control" placeholder="">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success d-none" id="btnLoaderU" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkFormU()" id="btnSimpanU" class="btn btn-success">Simpan
                    Perubahan <i class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="resetU()" data-bs-dismiss="modal">Batal <i
                        class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>

@section('formEditJS')
    <script>
        function checkFormU() {
            const penanggungjawab = $("input[name='penanggungjawabU']").val();
            setLoadingU(true);
            resetValidU();

            if (penanggungjawab == "") {
                validasi('Penanggung Jawab Barang wajib di isi!', 'warning');
                $("input[name='penanggungjawabU']").addClass('is-invalid');
                setLoadingU(false);
                return false;
            } else {
                submitFormU();
            }
        }

        function submitFormU() {
            const id = $("input[name='idpenanggungjawabU']").val();
            const penanggungjawab = $("input[name='penanggungjawabU']").val();

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/penanggungjawab/proses_ubah') }}/" + id,
                enctype: 'multipart/form-data',
                data: {
                    penanggungjawab: penanggungjawab,
                },
                success: function(data) {
                    swal({
                        title: "Berhasil diubah!",
                        type: "success"
                    });
                    $('#Umodaldemo8').modal('toggle');
                    table.ajax.reload(null, false);
                    resetU();
                }
            });
        }

        function resetValidU() {
            $("input[name='penanggungjawabU']").removeClass('is-invalid');
        };

        function resetU() {
            resetValidU();
            $("input[name='idpenanggungjawabU']").val('');
            $("input[name='penanggungjawabU']").val('');
            setLoadingU(false);
        }

        function setLoadingU(bool) {
            if (bool == true) {
                $('#btnLoaderU').removeClass('d-none');
                $('#btnSimpanU').addClass('d-none');
            } else {
                $('#btnSimpanU').removeClass('d-none');
                $('#btnLoaderU').addClass('d-none');
            }
        }
    </script>
@endsection
