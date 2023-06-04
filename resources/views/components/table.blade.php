<div class="card card-docs mb-2">
    <div class="card-body fs-8 fs-xxl-6 py-5 px-5 text-gray-700">
        @if(session('success'))
            <div class="row">
                <div class="col-sm-12 px-3 py-1">
                    <div class="alert alert-success text-center">
                        {!! session('success') !!}
                    </div>
                </div>
            </div>
        @endif
        @if(session('fail'))
            <div class="row">
                <div class="col-sm-12 px-3 py-1">
                    <div class="alert alert-danger text-center">
                        {!! session('fail') !!}
                    </div>
                </div>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-row-bordered table-striped table-bordered table-hover"
                   id="datatable" style="width:100%">
                <thead class="table-dark">
                <tr class="fw-bold text-gray-800 border-bottom text-center border-gray-500">
                    {{$thead}}
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
