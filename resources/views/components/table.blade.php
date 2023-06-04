<div class="card card-docs mb-2">
    <div class="card-body fs-8 fs-xxl-6 py-5 px-5 text-gray-700">
        <div class="text-center">
            <label class="alert alert-danger col-md-9 error" id="gnlError" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </label>
        </div>
        <div class="text-center">
            <label class="alert alert-success col-md-9 error" id="gnlSuccess" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </label>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover"
                   id="datatable" style="width:100%">
                <thead class="table-dark">
                <tr class="fw-bold">
                    {{$thead}}
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>