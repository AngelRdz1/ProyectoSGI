<div class="card card-docs mb-2">
    <div class="card-body fs-8 fs-xxl-6 py-5 px-5 text-gray-700">
        <div class="text-center">
            <label class="alert alert-danger col-md-9 error" id="gnlError" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </label>
        </div>
        <div class="text-center">
            <label class="alert alert-success col-md-9 error" id="gnlSuccess" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </label>
        </div>
        <div>
            <div class="row">
                <div class="col-4 mb-4">
                    <select class="form-control" id="idEstudiante">
                        @foreach ($estudiantes as $estudiante)
                            <option value="{{ $estudiante->nie }}">{{ $estudiante->nombre }}</option>
                        @endforeach()
                    </select>
                </div>
                <div class="col-4 mb-4">
                    <button class="btn btn-success" id="btn-buscar">Buscar</button>
                </div>
            </div>
            <div id=tabla>

            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#gnlError").hide();
        $("#gnlSuccess").hide();

        $('#btn-buscar').on('click', function() {
            var id = $('#idEstudiante').val();
            $.ajax({
                url: "{{ route('reportes.reporteBoletaNotas.tabla') }}",
                data: {
                    id: id,
                },
                type: 'GET',
                success: function(response) {
                    $("#tabla").html(response);
                }
            });
            
        });


        //Abrir modal para agregar
        $('body').on('click', '.add-class', function() {
            $("label.error").hide();
            $("#FormModal #gnlError").hide();
            $(".error").removeClass("error");

            $('#FormModal').modal("show");
            $('#FormModal #modal-body #name').val('');

            $('#FormModal #modal-footer #action_type').val('store');
            $('#modal-title').text('Agregar Materias');
            $('#materiaCsv').val('');
        });
        //guardar
        $("#AForm").validate({
            rules: {
                materiaCsv: {
                    "required": true
                }
            },
            messages: {
                materiaCsv: {
                    required: "El campo es requerido"
                }
            },
            submitHandler: function(form) {
                var url = '{{ route('materia.upload.csv') }}';
                var formData = new FormData(
                    form); // Crear objeto FormData para enviar el formulario

                $.ajax({
                    url: url,
                    method: 'post',
                    data: formData,
                    processData: false, // Evitar el procesamiento automático de los datos
                    contentType: false, // Evitar el establecimiento automático del encabezado Content-Type
                    success: function(result) {
                        $('#FormModal').modal('hide');
                        $('#gnlSuccess').html(result.message);
                        $('#gnlSuccess').show();
                        $('#datatable').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#gnlSuccess').hide();
                        }, 1000);
                    },
                    error: function(err) {
                        if (err.status == 422) {
                            $.each(err.responseJSON.errors, function(i, error) {
                                var el = $(document).find('[name="' + i + '"]');
                                el.after($('<label style="color: red;" class="error">' +
                                    error[0] + '</label>'));
                            });
                        }
                        if (err.status == 400) {
                            $('#FormModal #gnlError').html(err.responseJSON.message);
                            $('#FormModal #gnlError').show();
                            setTimeout(function() {
                                $('FormModal #gnlError').hide();
                            }, 1000);
                        }
                    }
                });
            },

        });
    });
</script>
