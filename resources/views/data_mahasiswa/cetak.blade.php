<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .group {
            margin-bottom: 100px;
        }
        .table.static {
            position: relative;
            border: 1px solid #000000;
        }

        .container {
            text-align: center;
        }

        th,td{
            font-size: 12px;
        }
    </style>

</head>
<body>
        <div class="group">
            <div class="container">
            <img src="../public/dist/img/logo_unri.jpg">
            <h1 style="font-size: 24px; margin-top: 4; margin-bottom: 0;">UNIVERSITAS RIAU</h1>
            <h5 style="margin-top: 0; margin-bottom: 0;">Kampus Bina Widya Km 12,5 Simpang Baru 28923</h5>
            <hr style="border: 0; width: 75%; height: 0.5px; background-color: black;">
            </div>

            <h1 align="center" style="font-size: 20px; margin-bottom: 0;">TRASNKRIP CPL</h1>
            <hr style="border: 0; width: 25%; height: 0.5px; background-color: black;">
            <P style="margin-bottom: 0;">Nama Mahasiswa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rio Persal Anugrah</P>
            <P style="margin-top: 0; margin-bottom: 0;">Nomor Induk Mahasiswa &nbsp;&nbsp;&nbsp;: 1907111500</P>
            <P style="margin-top: 0; margin-bottom: 0;">Angkatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 2019</P>
            <P style="margin-top: 0; margin-bottom: 0;">Jurusan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Teknik Sipil</P>
            <P style="margin-top: 0;">Program Studi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Teknik Informatika S1</P>
            <table class="static" align="center" rules="all" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($mahasiswa as $key => $value)
                  <tr>
                      <td style="text-align: center;">{{ $loop->iteration }}</td>
                      <td style="text-align: center;">{{$value->nim}}</td>
                      <td>{{$value->nama}}</td>
                      <td style="text-align: center;">{{$value->angkatan}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>

            
            <div style="float: right; width: 35%">
                <p style="margin-bottom: 0;">Mengesahkan,</p>
                <p style="margin-top: 0; margin-bottom: 0;">Koordinator Prodi Teknik Sipil S1,</p>
                <br>
                <br>
                <br>
                <p style="margin-bottom: 0;">(Andy Hendri, ST, MT)</p>
                <p style="margin-top: 0; margin-bottom: 0;">NIP. 19690717 199803 1 000</p>
            </div>

            <div style="float: left; width: 35%">
                <p style="margin-bottom: 0;">Pekanbaru,</p>
                <p style="margin-top: 0; margin-bottom: 0;">31 Agustus 2001</p>
            </div>
        </div>
        
    </body>
</html>