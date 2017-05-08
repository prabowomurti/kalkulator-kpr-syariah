<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kalkulator KPR Syariah</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <h2>Kalkulator KPR Syariah &#8212; v1.0</h2>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
                <h3>Input Data</h3>
                <form method="post" onsubmit="return process()">
                    <div class="form-group">
                        <label for="harga_rumah">Harga Rumah (dalam Rp)</label>
                        <input type="number" name="harga_rumah" min="50000000" id="harga_rumah" class="form-control input-sm" required="required" autofocus placeholder="Contoh : 300000000" value="300000000" />
                    </div>
                    <div class="form-group">
                        <label for="uang_muka">Uang Muka (minimal 20% dari harga rumah, dalam Rp)</label>
                        <input type="number" name="uang_muka" min="1" id="uang_muka" class="form-control input-sm" required="required" placeholder="Contoh : 60000000" value="60000000" />
                    </div>
                    <div class="form-group">
                        <label for="margin">Margin (dalam persen disetarakan p.a, asumsi kisaran 7.00 - 9.50)</label>
                        <input type="number" name="margin" min="5" max="20" id="margin" class="form-control input-sm" required="required" step="any" placeholder="Contoh : 8.50" value="8"/>
                    </div>
                    <div class="form-group">
                        <label for="tenor">Jangka Waktu (dalam tahun)</label>
                        <select name="tenor" id="tenor" class="form-control input-sm">
                            <option value="5">5 tahun</option>
                            <option value="10">10 tahun</option>
                            <option value="15" selected>15 tahun</option>
                            <option value="20">20 tahun</option>
                            <option value="25">25 tahun</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="penghasilan">Total Penghasilan Bulanan (gabungan suami istri, dalam Rp)</label>
                        <input type="number" name="penghasilan" id="penghasilan" class="form-control input-sm" required="required" placeholder="Contoh : 10000000" value="10000000"/>
                    </div>
                    <div class="form-group">
                        <label for="cicilan_lain">Cicilan Lain per Bulan (bila ada (misal kredit mobil atau KPR), dalam Rp)</label>
                        <input type="number" name="cicilan_lain" id="cicilan_lain" class="form-control input-sm" placeholder="Contoh : 1500000" value="0"/>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md col-xs-12">HITUNG CICILAN</button>
                </form>
            </div>
            <div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
                <h3>Perhitungan</h3>
                <table class="table">
                    <tbody>
                        <tr>
                            <td rowspan="3" valign="top">Pinjaman </td>
                            <td> = Harga Rumah - Uang Muka</td>
                        </tr>
                        <tr>
                            <td> = Rp <span id="hasil_harga_rumah">0</span> - Rp <span id="hasil_uang_muka">0</span></td>
                        </tr>
                        <tr>
                            <td> = Rp <strong><span id="pinjaman">0</span></strong></td>
                        </tr>
                        <tr>
                            <td rowspan="3" valign="top">Total Pinjaman</td>
                            <td> = Pinjaman + (Pinjaman * Margin * Tenor)</td>
                        </tr>
                        <tr>
                            <td> = Rp <span class="hasil_pinjaman">0</span> + (Rp <span class="hasil_pinjaman">0</span> * <span id="hasil_margin">0</span>% * <span class="hasil_tenor">0</span> tahun)</td>
                        </tr>
                        <tr>
                            <td> = Rp <strong><span id="total_pinjaman">0</span></strong></td>
                        </tr>
                        <tr>
                            <td rowspan="3" valign="top">Cicilan / bulan </td>
                            <td> = Total Pinjaman / Tenor / 12 bulan</td>
                        </tr>
                        <tr>
                            <td> = Rp <span id="hasil_total_pinjaman">0</span> / <span class="hasil_tenor">0</span> / 12 </td>
                        </tr>
                        <tr>
                            <td> = Rp <strong><span id="cicilan_bulanan">0</span></strong></td>
                        </tr>
                        <tr>
                            <td rowspan="2" valign="top">Persentase Cicilan</td>
                            <td> = Cicilan Bulanan / Penghasilan Bulanan</td>
                        </tr>
                        <tr>
                            <td> = <strong><span id="persentase_cicilan">0</span> %</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2">Pengajuan KPR kemungkinan besar diterima bila persentase cicilan &lt;= 40 persen</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <hr />
        <footer>Source code : <a href="https://github.com/prabowomurti/kalkulator-kpr-syariah">kalkulator KPR Syariah</a>, <br />
            referensi <a href="http://muhajirin.net/keuangan/syarat-kpr-btn-syariah/">KPR BTN Syariah</a></footer>
    </div> <!-- /container -->

<script type="text/javascript">
function process(e)
{
    if (!e) e = window.event;
    e.preventDefault();

    var harga_rumah  = parseInt(document.getElementById('harga_rumah').value);
    var uang_muka    = parseInt(document.getElementById('uang_muka').value);
    var margin       = parseFloat(document.getElementById('margin').value).toFixed(2);
    var tenor        = parseInt(document.getElementById('tenor').value);
    var penghasilan  = parseInt(document.getElementById('penghasilan').value);
    var cicilan_lain = parseInt(document.getElementById('cicilan_lain').value);
    const LIMIT = 40;

    // error if...
    // uang_muka >= harga_rumah
    if (uang_muka >= harga_rumah)
    {
        alert('Uang Muka tidak boleh lebih dari Harga Rumah');
        return ;
    }

    // uang_muka < 0.2 * harga_rumah
    if (uang_muka < 0.2 * harga_rumah)
    {
        alert('Uang Muka minimal 20 persen dari Harga Rumah');
        return ;
    }

    // penghasilan >= harga rumah - uang_muka
    if (penghasilan >= harga_rumah)
    {
        alert('Penghasilan per bulan lebih dari Harga Rumah');
        return ;
    }

    // cicilan_lain >= penghasilan
    if (cicilan_lain >= penghasilan)
    {
        alert('Cicilan Lain lebih dari Penghasilan per Bulan');
        return ;
    }

    var pinjaman = harga_rumah - uang_muka;
    var total_pinjaman = pinjaman + (margin / 100 * pinjaman * tenor);
    var cicilan_bulanan = parseInt(total_pinjaman / tenor / 12);
    var persentase_cicilan = parseFloat((cicilan_bulanan + cicilan_lain) / penghasilan * 100).toFixed(2);

    document.getElementById('hasil_harga_rumah').innerHTML = addCommas(harga_rumah);
    document.getElementById('hasil_uang_muka').innerHTML = addCommas(uang_muka);
    document.getElementById('hasil_margin').innerHTML = margin;
    document.querySelectorAll('.hasil_pinjaman')[0].innerHTML = document.querySelectorAll('.hasil_pinjaman')[1].innerHTML = addCommas(pinjaman);
    document.querySelectorAll('.hasil_tenor')[0].innerHTML = document.querySelectorAll('.hasil_tenor')[1].innerHTML = tenor;
    document.querySelectorAll('.hasil_pinjaman')[0].innerHTML = 
        document.querySelectorAll('.hasil_pinjaman')[1].innerHTML = 
        document.getElementById('pinjaman').innerHTML = addCommas(pinjaman);
    document.getElementById('hasil_total_pinjaman').innerHTML = 
        document.getElementById('total_pinjaman').innerHTML = addCommas(total_pinjaman);

    document.getElementById('cicilan_bulanan').innerHTML = addCommas(cicilan_bulanan);
    document.getElementById('persentase_cicilan').innerHTML = persentase_cicilan;
    if (persentase_cicilan > LIMIT)
        document.getElementById('persentase_cicilan').style.color = 'red';
    else
        document.getElementById('persentase_cicilan').style.color = 'green';
}

function addCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

</script>

</body>
</html>