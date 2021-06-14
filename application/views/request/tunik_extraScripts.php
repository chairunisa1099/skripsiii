<script type="text/javascript">
    $(document).ready(function() {

        //Harga yang ditampilin di view
        var harga_S = 'Rp. 120.000'
        var harga_M = 'Rp. 135.000'
        var harga_L = 'Rp. 150.000'
        var harga_XL = 'Rp. 165.000'
        //var harga_UKURAN = 'Rp. HARGA'

        //Harga yang dikirim ke database
        var vHarga_S = 120000
        var vHarga_M = 135000
        var vHarga_L = 150000
        var vHarga_XL = 165000
        //var vHarga_UKURAN = 'Rp. HARGA'

        $('#ukuranBusana').change(function() {
            console.log('changed!')
            if (this.value == 'S') {
                $('#hargaShow').html(harga_S)
                $('#hargaValue').val(vHarga_S)
            } else if (this.value == 'M') {
                $('#hargaShow').html(harga_M)
                $('#hargaValue').val(vHarga_M)
            } else if (this.value == 'L') {
                $('#hargaShow').html(harga_L)
                $('#hargaValue').val(vHarga_L)
            } else if (this.value == 'XL') {
                $('#hargaShow').html(harga_XL)
                $('#hargaValue').val(vHarga_XL)
            }/* else if (this.value == 'UKURAN') {
                $('#hargaShow').html(harga_UKURAN)
                $('#hargaValue').val(vHarga_UKURAN)
            }*/

        })
    })
</script>