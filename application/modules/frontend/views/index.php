<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page </title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <div class="relative bg-white">
        <div id="toastError"
            class="hidden fixed right-10 top-10  px-5 py-4 border-r-8 border-red-500 bg-white drop-shadow-lg">
            <p class="text-sm">
                <span class="mr-2 inline-block px-3 py-1 rounded-full bg-red-500 text-white font-extrabold">Error</span>
                <span id="toastErrorMsg"></span>
            </p>
        </div>
        <div id="toastSuccess"
            class="hidden fixed right-10 top-10  px-5 py-4 border-r-8 border-green-500 bg-white drop-shadow-lg">
            <p class="text-sm">
                <span
                    class="mr-2 inline-block px-3 py-1 rounded-full bg-green-500 text-white font-extrabold">Success</span>
                <span id="toastSuccessMsg"></span>
            </p>
        </div>
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div
                class="flex items-center justify-between border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <a href="#">
                        <span class="sr-only">Ruang Public</span>
                        <img class="h-8 w-auto sm:h-10"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
                    </a>
                </div>
                <div class="-my-2 -mr-2 md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        aria-expanded="false">
                        <span class="sr-only">Open menu</span>
                        <!-- Heroicon name: outline/bars-3 -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

                <div class="hidden items-center justify-end md:flex md:flex-1 lg:w-0">
                    <a href="<?= site_url('auth/login') ?>"
                        class="ml-8 inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Login</a>
                </div>
            </div>
        </div>

    </div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 mt-5">
        <div class="flex flex-col w-full px-0 mx-auto md:flex-row">
            <div class="flex flex-col md:w-full">
                <h2 class="mb-4 font-bold md:text-xl text-heading ">Form Booking
                </h2>
                <form class="justify-center w-full mx-auto" id="formAction">
                    <div class="">
                        <div class="space-x-0 lg:flex lg:space-x-4">
                            <div class="w-full lg:w-1/2">
                                <label for="first_name" class="block mb-3 text-sm font-semibold text-gray-500">First
                                    Name</label>
                                <input name="first_name" type="text" placeholder="First Name"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                            </div>
                            <div class="w-full lg:w-1/2 ">
                                <label for="last_name" class="block mb-3 text-sm font-semibold text-gray-500">Last
                                    Name</label>
                                <input name="last_name" type="text" placeholder="Last Name"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                            </div>
                        </div>
                        <div class="space-x-0 lg:flex lg:space-x-4 mt-4">
                            <div class="w-full lg:w-1/2">
                                <label for="email" class="block mb-3 text-sm font-semibold text-gray-500">Email</label>
                                <input name="email" type="text" placeholder="Email"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                            </div>
                            <div class="w-full lg:w-1/2 ">
                                <label for="phone" class="block mb-3 text-sm font-semibold text-gray-500">Phone</label>
                                <input name="phone" type="number" placeholder="No Telepon"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                            </div>
                        </div>
                        <div class="space-x-0 lg:flex lg:space-x-4 mt-4">
                            <div class="w-full lg:w-1/2">
                                <label for="jenis_ruangan" class="block mb-3 text-sm font-semibold text-gray-500">Jenis
                                    Ruangan</label>
                                <select name="jenis_ruangan" id="jenis_ruangan"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <option value="">Pilih Jenis Ruangan</option>
                                    <?php
                                    foreach ($ruangan as $row) {
                                        echo '<option value="' . $row->asset_type_code . '">' . $row->desc . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="space-x-0 lg:flex lg:space-x-4 mt-4">
                            <div class="w-full lg:w-1/2">
                                <label for="area_kantor" class="block mb-3 text-sm font-semibold text-gray-500">Area
                                    Kantor</label>
                                <select name="area_kantor" id="area_kantor"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <option value="">Pilih area kantor yang di inginkan</option>
                                </select>
                            </div>

                            <div class="w-full lg:w-1/2">
                                <label for="pilih_gedung"
                                    class="block mb-3 text-sm font-semibold text-gray-500">Gedung</label>
                                <select name="pilih_gedung" id="pilih_gedung"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <option value="">Pilih Gedung</option>
                                </select>
                            </div>
                        </div>
                        <div class="space-x-0 lg:flex lg:space-x-4 mt-4">
                            <div class="w-full lg:w-1/2">
                                <label for="date_from" class="block mb-3 text-sm font-semibold text-gray-500">Tanggal
                                    Sewa</label>
                                <input name="date_from" type="date" id="date_from" onchange="get_total()"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                            </div>

                            <div class="w-full lg:w-1/2">
                                <label for="date_to" class="block mb-3 text-sm font-semibold text-gray-500">Tanggal
                                    Berakhir Sewa</label>
                                <input name="date_to" type="date" id="date_to" onchange="get_total()"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded lg:text-sm focus:outline-none focus:ring-1 focus:ring-blue-600">
                            </div>
                        </div>
                        <div class="mt-4">
                            <!-- Site key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
                            Secret key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe -->
                            <div class="g-recaptcha mb-3" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                            <button class="w-full px-6 py-2 text-white bg-blue-600 hover:bg-blue-900" type="button"
                                id="btnSubmit">Process</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="flex flex-col w-full ml-0 lg:ml-12 lg:w-2/5">
                <div class="pt-12 md:pt-0 2xl:ps-4">
                    <div class="flex p-4 mt-4">
                        <h2 class="text-xl font-bold">Total</h2>
                    </div>
                    <div
                        class="flex items-center w-full py-4 text-sm font-semibold border-b border-gray-300 lg:py-5 lg:px-3 text-heading last:border-b-0 last:text-base last:pb-0">
                        Price/day Rp.<span class="ml-2" id="price_per_day">0</span></div>
                    <div
                        class="flex items-center w-full py-4 text-sm font-semibold border-b border-gray-300 lg:py-5 lg:px-3 text-heading last:border-b-0 last:text-base last:pb-0">
                        Date Booked<span class="ml-2" id="date_booked">0</span></div>
                    <div
                        class="flex items-center w-full py-4 text-sm font-semibold border-b border-gray-300 lg:py-5 lg:px-3 text-heading last:border-b-0 last:text-base last:pb-0">
                        Total Rp.<span class="ml-2" id="total">0</span></div>
                </div>
            </div>
        </div>
    </div>


</body>
<script type="text/javascript" src="<?php echo base_url() . "assets/plugins/jquery/jquery.min.js" ?>"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
$('#btnSubmit').on('click', function() {
    var form = new FormData($('#formAction')[0])
    form.append('total', number($('#total').text()))
    $.ajax({
        type: "post",
        url: "<?php echo site_url('frontend/booking_action'); ?>",
        data: form,
        processData: false,
        contentType: false,
        cache: false,
        dataType: "json",
        success: function(data) {
            if (data.error == false) {
                toastSuccess(data.message)
                $('#formAction').trigger("reset");
            } else {
                toastError(data.message)
            }
        },
        error: function(xhr, status, errorThrown) {
            console.log(xhr.status);
        }

    });
})

$('#jenis_ruangan').on('change', function() {
    var id = $(this).val();
    $.ajax({
        url: "<?php echo site_url('frontend/get_area'); ?>",
        method: "POST",
        data: {
            id: id
        },
        async: true,
        dataType: 'json',
        success: function(data) {

            var html = '';
            var i;
            html += '<option value="" selected>Pilih area kantor yang di inginkan</option>';
            for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].area_code + '>' + data[i]
                    .area_name + '</option>';
            }
            $('#area_kantor').html(html);

        }
    });
    return false;
});

$('#area_kantor').on('change', function() {
    var area = $(this).val();
    var jenis_ruangan = $('#jenis_ruangan').val()
    $.ajax({
        url: "<?php echo site_url('frontend/get_gedung'); ?>",
        method: "POST",
        data: {
            area: area,
            jenis_ruangan: jenis_ruangan,
        },
        async: true,
        dataType: 'json',
        success: function(data) {

            var html = '';
            var i;
            html += '<option value="" selected>Pilih Gedung</option>';
            for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].asset_code + '>' + data[i]
                    .asset_name + '</option>';
            }
            $('#pilih_gedung').html(html);

        }
    });
    return false;
});


$('#pilih_gedung').on('change', function() {

    var code = $(this).val();
    $.ajax({
        url: "<?php echo site_url('frontend/get_gedung_by_code'); ?>",
        method: "POST",
        data: {
            code: code,
        },
        async: true,
        dataType: 'json',
        success: function(data) {
            if (data) {
                $('#price_per_day').html(money(data.price))
                get_total()
            }

        }
    })
})

function get_total() {
    var date_from = $('#date_from').val()
    var date_to = $('#date_to').val()
    var price = $('#price_per_day').html()
    if (date_from === '' || date_to === '') {
        $('#date_booked').html(0);
        $('#total').html(0)
        // $('#price_per_day').html(0);
    } else {
        const oneDay = 24 * 60 * 60 * 1000;
        const firstDate = new Date($('#date_from').val())
        const secondDate = new Date($('#date_to').val())

        const diffDays = Math.round((secondDate - firstDate) / oneDay);

        if (diffDays < 0) {
            toastError('Tanggal berakhir sewa harus lebih besar dari tanggal sewa')
            return
        }

        var total = parseInt(number(price)) * parseInt(diffDays)
        $('#date_booked').html(diffDays)
        $('#total').html(money(total))
        $('#price_per_day').html(money(price))

    }

}

function money(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function number(x) {
    x = x.replace(/\,/g, "")
    x = parseInt(x, 10)
    return x
}

function toastError(msg) {
    document.getElementById("toastError").classList.remove("hidden");
    $('#toastErrorMsg').html(msg)
    setTimeout(function() {
        document.getElementById("toastError").classList.add("hidden");
    }, 5000);
}

function toastSuccess(msg) {
    document.getElementById("toastSuccess").classList.remove("hidden");
    $('#toastSuccessMsg').html(msg)
    setTimeout(function() {
        document.getElementById("toastSuccess").classList.add("hidden");
    }, 5000);
}
</script>

</html>