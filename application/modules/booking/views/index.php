<!-- Main content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col">

                <div class="card">
                    <div class="card-body">

                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th class="text-center">Trx Code</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Asset</th>
                                    <th class="text-center">Date Booking</th>
                                    <th class="text-center">End Date Booking</th>
                                    <th class="text-center">Total Price</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($all_data as $row) : ?>
                                <tr>
                                    <td><?php echo $row->trx_code ?></td>
                                    <td><?php echo $row->customer_name ?></td>
                                    <td><?php echo $row->asset_name ?></td>
                                    <td><?php echo date('d M Y', strtotime($row->trx_date_from)) ?></td>
                                    <td><?php echo date('d M Y', strtotime($row->trx_date_to)) ?></td>
                                    <td>Rp. <?php echo number_format($row->total_price) ?></td>
                                    <td class="text-center" width="140px">
                                        <?php echo $row->status ?>
                                    </td>
                                    <td class="text-center" width="140px">
                                        <button class="btn btn-primary btn-sm"
                                            onclick="change_status(<?= $row->id ?>)">Change
                                            Status</button>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>


                    </div>
                    <!-- /.card-body -->
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
async function change_status(id) {
    const {
        value: status
    } = await swal.fire({
        title: "Ubah Status",
        text: "Ubah Status Booking?",
        icon: "warning",
        input: 'select',
        inputOptions: {
            6: 'ACCEPTED',
            7: 'REJECT',
            8: 'PENDING',
        },
        inputPlaceholder: 'Pilih Status',
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
                if (value !== '') {
                    resolve()
                } else {
                    resolve('Pilih Status!')
                }
            })
        }
    })

    if (status) {
        $.ajax({
            url: '<?= site_url('booking/change_status') ?>',
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                status: status,
            },
            success: function(result) {
                if (result.error === false) {
                    location.reload()
                    swal.fire({
                        title: "Sukses",
                        text: result.msg,
                        icon: "success",
                        showConfirmButton: false,
                        confirmButtonText: false,
                        timer: 2000,
                    });
                } else {
                    swal.fire({
                        title: "Error",
                        text: result.msg,
                        icon: "error",
                        showConfirmButton: false,
                        confirmButtonText: false,
                        timer: 2000,
                    });
                }

            },
            error: function(xhr, Status, err) {
                $("Terjadi error : " + Status);
            },
        });
    }
}
</script>