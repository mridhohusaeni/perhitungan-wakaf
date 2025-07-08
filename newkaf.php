<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wakaf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="position-fixed top-0 start-0 m-4">
        <!-- <div class="d-flex flex-column gap-2">
            <a href="?hal=perhitungan" class="btn btn-primary">Perhitungan</a>
            <a href="?hal=konversi" class="btn btn-primary">Konversi</a>
        </div> -->
    </div>
        
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
        <?php
        $hal = isset($_GET['hal']) ? $_GET['hal'] : '';
        if ($hal == 'konversi') {
        ?>
        
        <h2 class="text-center mb-4"> Konversi Nilai Angka ke Huruf </h2>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr><th>Nilai Angka</th><th>Nilai Huruf</th></tr>
            </thead>
            <tr><td>86-100</td><td>A</td></tr>
            <tr><td>80-85</td><td>A-</td></tr>
            <tr><td>75-79</td><td>B+</td></tr>
        </table>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Input Nilai Anda</label>
                <input type="number" name="nilai" class="form-control" required>
            </div>
            <button type="submit" name="konversi" class="btn btn-success w-100">Submit</button>
        </form>

        <?php
            if (isset($_POST['konversi'])) {
                $nilai = $_POST['nilai'];
                if ($nilai >= 86 && $nilai <= 100) {
                    $huruf = 'A';
                } elseif ($nilai >= 80) {
                    $huruf = 'A-';
                } elseif ($nilai >= 75) {
                    $huruf = 'B+';
                } elseif ($nilai >= 70) {
                    $huruf = 'B';
                } elseif ($nilai >= 60) {
                    $huruf = 'C+';
                } elseif ($nilai >= 50) {
                    $huruf = 'C';
                } elseif ($nilai >= 41) {
                    $huruf = 'D';
                } else {
                    $huruf = 'E';
                }
                echo "<div class='alert alert-success mt-4'>Nilai anda dalam huruf adalah <strong>$huruf</strong></div>";
            }
        ?>

        <?php
        } else {
        ?>
        <h2 class="text-center mb-4">Perhitungan Wakaf</h2>
        <form method="post">
            <div class="mb-3"><label>Nilai Wakaf</label><input type="number" name="item1" class="form-control" value="0"></div>
            <div class="mb-3"><label>Bulan</label><input type="number" name="item2" class="form-control" value="0"></div>
            <div class="mb-3"><label>Total</label><input type="number" name="total" class="form-control" value="0"></div>
            <div class="mb-3"><label>Bunga (%)</label><input type="number" name="diskon" class="form-control" value="0"></div>
            <button type="submit" name="submit" class="btn btn-success w-100">Hitung</button>
        </form>

        <script>
        function hitungTotal() {
            let item1 = parseInt(document.getElementsByName('item1')[0].value) || 0;
            let item2 = parseInt(document.getElementsByName('item2')[0].value) || 0;
            let total = item1 * item2 ;
            document.getElementsByName('total')[0].value = total;
        }

        document.addEventListener('DOMContentLoaded', function() {
            let inputs = document.querySelectorAll('input[type=number]');
            inputs.forEach(input => {
                input.addEventListener('input', hitungTotal);
            });
        });
        </script>

        <?php
            if (isset($_POST['submit'])) {
                $item1 = $_POST['item1'];
                $item2 = $_POST['item2'];
                $diskon = $_POST['diskon'];
            
                $total = $item1 * $item2 ;
                $potongan = $total * ($diskon / 100);
                $bayar = $total + $potongan;
                echo "<div class='alert alert-info mt-4'>";
                echo "<strong>Total Wakaf:</strong> Rp." . number_format($total, 0, ',', '.') . "<br>";
                echo "<strong>Bunga ($diskon%):</strong> Rp." . number_format($potongan, 0, ',', '.') . "<br>";
                echo "<strong>Total Wakaf Terhimpun :</strong> Rp." . number_format($bayar, 0, ',', '.') . "</div>";
            }
        ?>
        <?php } ?>
        </div>
    </div>
</div>

</body>
</html>
