<!-- Main content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6">

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo @$deskripsi ?></h3>
                    </div>

                    <!-- Horizontal Form -->
                    <form id="formAction">
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status Type</label>
                                <div class="col-sm-10">
                                    <?php
                                    $options = array(
                                        "ASSET" => "ASSET",
                                        "SEWA" => "SEWA"
                                    );
                                    echo form_dropdown('status_type', $options, isset($status_type) ? $status_type : '', 'name="status_type" id="status_type" class="form-control select2"'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <?php
                                    $array_url = array(
                                        "type" => "text",
                                        "class" => "form-control",
                                        "name" => "status",
                                        "id" => "status",
                                        "placeholder" => "Status",
                                        "value" => isset($status) ? $status : ''
                                    );
                                    echo form_input($array_url); ?>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= isset($id) ? $id : ''; ?>" />

                        </div>
                        <!-- /.card body -->

                        <div class="card-footer">
                            <button type="button" id="btnSubmit" class="btn btn-primary"><i
                                    class="fa fa-check mr-1"></i> Submit</button>
                            <a href="<?php echo site_url("status") ?>" type="button"
                                class="btn btn-default float-right"><i class="fa fa-chevron-left mr-1"></i> Back</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->


<script>
$('#btnSubmit').on('click', function() {
    $.ajax({
        type: "post",
        url: "<?= $action ?>",
        data: new FormData($('#formAction')[0]),
        processData: false,
        contentType: false,
        cache: false,
        dataType: "json",
        success: function(data) {
            if (data.error == false) {
                toastSuccess(data.message)
                window.location.href = '<?= site_url('status') ?>'
            } else {
                toastError(data.message)
            }
        },
        error: function(xhr, status, errorThrown) {
            console.log(xhr.status);
        }

    });

})

function toastError(msg) {
    $(document).Toasts('create', {
        icon: 'fas fa-exclamation-triangle',
        class: 'bg-danger m-1',
        autohide: true,
        delay: 5000,
        title: 'An error has occured',
        body: msg
    })
}

function toastSuccess(msg) {
    $(document).Toasts('create', {
        icon: 'fas fa-exclamation-triangle',
        class: 'bg-success m-1',
        autohide: true,
        delay: 5000,
        title: 'Success',
        body: msg
    })
}
</script>