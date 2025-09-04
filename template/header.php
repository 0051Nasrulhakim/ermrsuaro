<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="identitasPasien" style="display: flex;">
            <div class="left" style="width: 50%; font-size: 8pt;">

                <table class="table">
                    <tr>
                        <td style="width: 40%;">NO. Rekam Medik</td>
                        <td style="width: 1%;">:</td>
                        <td id="noRM"></td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td style="width: 1%;">:</td>
                        <td id="namaPasien"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td id="alamat"></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td id="jenisKelamin">/td>
                    </tr>
                    <tr>
                        <td>TTL</td>
                        <td>:</td>
                        <td id="ttl"></td>
                    </tr>
                    
                </table>

            </div>
            <div class="right" style="width: 50%; font-size: 8pt;">
                <table class="table">
                    <tr>
                        <td style="width: 40%;">Nama Ibu Kandung</td>
                        <td style="width: 1%;">:</td>
                        <td id="namaIbuKandung">-</td>
                    </tr>
                    <tr>
                        <td>Status Nikah</td>
                        <td>:</td>
                        <td id="statusNikah">-</td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td id="pendidikan">-</td>
                    </tr>
                    <tr>
                        <td>Bahasa</td>
                        <td>:</td>
                        <td id="bahasa">-</td>
                    </tr>
                    <tr>
                        <td>Cacat Fisik</td>
                        <td>:</td>
                        <td id="cacatFisik">-</td>
                    </tr>
                </table>
            </div>
        </div>

        
<script>
    $(document).ready(function() {
        // fungsi untuk ambil data
        function isPasien() {
            let norm = '045904';
            $.ajax({
                url: "http://192.168.2.6:3005/api/pasien/getdata/byNorm?noRM=" + norm, // ganti sesuai endpoint API / PHP kamu
                type: "GET", // bisa POST kalau butuh kirim parameter
                dataType: "json",
                success: function(response) {

                    // contoh isi data ke elemen
                    if (response.data) {
                        $("#noRM").text(response.data.no_rkm_medis || "-");
                        $("#namaPasien").text(response.data.nm_pasien || "-");
                        $("#alamat").text(response.data.alamat || "-");
                        $("#jenisKelamin").text(response.data.jk || "-");

                        $("#cacatFisik").text(response.data.cacat || "-");
                        $("#bahasa").text(response.data.bahasa || "-");

                        $("#ttl").text(response.data.tmp_lahir +", " + response.data.tgl_lahir || "-");
                        $("#statusNikah").text(response.data.stts_nikah || "-");
                        $("#namaIbuKandung").text(response.data.nm_ibu || "-");
                        $("#pendidikan").text(response.data.pnd || "-");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Gagal ambil data:", error);
                }
            });
        }

        // panggil otomatis saat dokumen selesai load
        isPasien();
    });
</script>