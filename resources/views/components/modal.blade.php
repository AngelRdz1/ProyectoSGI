<div class="modal" id="FormModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modal-title"></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
            </div>
            <form method="post" id="AForm">
                @csrf
                <div class="modal-body" id="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <label class="alert alert-danger col-md-9 error" id="gnlError" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </label>
                            </div>
                            <div class="row" id="bodyRow">
                                {{$bodyForm}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="action_type" id="action_type" value="">
                    <button type="submit" id="formSubmit" class="btn btn-danger">Guardar</button>
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
