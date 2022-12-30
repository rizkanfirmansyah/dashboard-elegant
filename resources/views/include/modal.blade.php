<!--Disabled Backdrop Modal -->
<div class="modal fade text-left" id="modalInsert" tabindex="-1" role="dialog" aria-labelledby="modalInsertPoint"
    data-bs-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form action="" id="insertFormModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-capitalize" id="modalInsertPoint">
                        Input Data {{ $title }}
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @stack('modal')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><i class="fas fa-save"></i> Simpan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
