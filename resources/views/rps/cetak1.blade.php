<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
        .page-break {
            page-break-before: always;
        }
        .table.static {
            border: 1px solid #000000;
        }
        th,td{
            font-size: 14px;
            padding: 5px;
        }
    </style>

</head>
<body>
  <div>
    <br><br><br><br>
    <h1 style="font-family: 'Times New Roman', Times, serif;" align="center">RENCANA PEMBELAJARAN SEMESTER (RPS)</h1>
    <br><br><br><br>
    <center>
      <img style="height: 30%;" src="../public/dist/img/LOGO-UNRI.png">
    </center>
    <br><br><br><br>
    <p align="center" style="font-size: 24px">{{ $matkul->nama_matkul }}</p>
    <p align="center" style="font-size: 24px">{{ $matkul->sks }} SKS</p>
    <br><br><br><br><br>
    <p align="center" style="font-size: 24px">Program Studi S1 Teknik Sipil</p>
    <p align="center" style="font-size: 24px">Universitas Riau</p>
    <p align="center" style="font-size: 24px">{{ date('Y') }}</p>
  </div>

  <div class="page-break"></div>

  <div>
    <table class="static" align="center" rules="all" style="width: 100%">
      <tr>
        <td>
          <center>
            <img style="height: 8%;" src="../public/dist/img/LOGO-UNRI.png">
          </center>
        </td>
        <td align="center" style="font-size: 16px;" colspan="4">
          UNIVERSITAS RIAU<br>Fakultas Teknik<br>Jurusan Teknik Sipil<br>Program Studi S1 Teknik Sipil
        </td>
      </tr>
      <tr>
        <th class="text-center" colspan="5">RENCANA PEMBELAJARAN SEMESTER</th>
      </tr>
      <tr>
        <td align="center" width="20%">Kode Mata Kuliah</td>
        <td align="center" width="20%">Nama Mata Kuliah</td>
        <td align="center" width="20%">SKS</td>
        <td align="center" width="20%">Semester</td>
        <td align="center" width="20%">Tanggal Penyusunan</td>
      </tr>
      <tr>
        <td align="center">{{ $matkul->kode_matkul }}</td>
        <td align="center">{{ $matkul->nama_matkul }}</td>
        <td align="center">{{ $matkul->sks }}</td>
        <td align="center">{{ $matkul->semester }}</td>
        <td align="center">{{ $waktu_terbaru->created_at->format('d-m-Y') }}</td>
      </tr>
      <tr>
        <td colspan="5">CPL-Prodi yang dibebankan pada MK</td>
      </tr>
      <tr>
        <td colspan="1">Capaian Pembelajaran Lulusan (CPL)</td>
        <td colspan="4">
          @foreach ($cepeel as $cpl)
            ({{ $cpl->kode_cpl }}) {{ $cpl->keterangan }}<br>
          @endforeach
        </td>
      </tr>
      <tr>
        <td colspan="1">Capaian Pembelajaran Mata Kuliah (CPMK)</td>
        <td colspan="4">
          @foreach ($indikator as $ind)
            ({{ $ind->indikator }}) {{ $ind->ket_indikator }}<br>
          @endforeach
        </td>
      </tr>
      <tr>
        <td colspan="1">Sub - Capaian Pembelajaran Mata Kuliah (Sub-CPMK)</td>
        <td colspan="4">
          @foreach ($indikator as $ind)
            @foreach ($cpmk->where('id_indikator',$ind->id)->where('id_matkul',$matkul->id) as $data)
              ({{ $data->kode_cpmk }}) {{ $data->ket_cpmk }}<br>
            @endforeach
          @endforeach
        </td>
      </tr>
      <tr>
        <td colspan="1">Deskripsi singkat Mata Kuliah</td>
        <td colspan="4">
          @if (isset($info))
          {{$info->deskripsi}}
          @else
          --
          @endif
          </td>
      </tr>
      <tr>
        <td colspan="1">Bahan Kajian</td>
        <td colspan="4">
          @if (isset($info))
          @php
              $value_kajian = explode(',', $info->kajian);
          @endphp
            @foreach ($value_kajian as $item)
              {{ $loop->iteration }}. {{ $item }}<br>
            @endforeach
          @else
          --
          @endif
        </td>
      </tr>
      <tr>
        <td colspan="1">Refrensi</td>
        <td colspan="4">
          @if (isset($info))
          @php
              $value_refrensi = explode(',', $info->refrensi);
          @endphp
            @foreach ($value_refrensi as $item2)
              {{ $loop->iteration }}. {{ $item2 }}<br>
            @endforeach
          @else
          --
          @endif
        </td>
      </tr>
      <tr>
        <td colspan="1">Dosen Pengampu</td>
        <td colspan="4">
          @foreach ($dsn_pengampu as $dosen)
            {{ $loop->iteration }}. 
              @if (isset($dosen->gelar_depan))
              {{$dosen->gelar_depan}}.    
              @endif

              {{$dosen->nama}}

              @if (isset($dosen->gelar_belakang))
              {{$dosen->gelar_belakang}}
              @endif<br>
          @endforeach
        </td>
      </tr>
      <tr>
        @php
            $count = count($dsn_pengampu);
        @endphp
        <td colspan="1" rowspan="3">Otorisasi</td>
        <td colspan="1">Dosen Pengembang RPS</td>
        <td colspan="2">
          @foreach ($dsn_pengampu as $dosen)
            @if (isset($dosen->gelar_depan))
              {{$dosen->gelar_depan}}.    
            @endif

              {{$dosen->nama}}

            @if (isset($dosen->gelar_belakang))
              {{$dosen->gelar_belakang}}
            @endif
            <br>
            {{ $dosen->nidn }}
            <br>
            <br>
            <br>
          @endforeach
        </td>
        <td align="center" colspan="1">
          @for ($i = 0; $i < $count; $i++)
          <br>
          <br>
          ....................
          <br>
          <br>
          @endfor
        </td>
      </tr>
      <tr>
        <td colspan="1">Koordinator Kelompok Bidang Keahlian</td>
        <td colspan="2">
        @if (isset($dsn_koordinator->gelar_depan))
          {{$dsn_koordinator->gelar_depan}}.    
        @endif

          {{$dsn_koordinator->nama}}

        @if (isset($dsn_koordinator->gelar_belakang))
          {{$dsn_koordinator->gelar_belakang}}
        @endif
        <br>
        {{ $dsn_koordinator->nidn }}
      </td>
        <td align="center" colspan="1"><br>....................</td>
      </tr>
      <tr>
        <td colspan="1">Koordinator Program Studi</td>
        <td colspan="2">
          @if (isset($kaprodi->gelar_depan))
          {{$kaprodi->gelar_depan}}.    
        @endif

          {{$kaprodi->nama}}

        @if (isset($kaprodi->gelar_belakang))
          {{$kaprodi->gelar_belakang}}
        @endif
        </td>
        <td align="center" colspan="1"><br>....................</td>
      </tr>

        
    </table>
  </div>
</body>
</html>