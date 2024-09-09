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
    <table class="static" align="center" rules="all" style="width: 100%">
      <thead>
        <tr>
          <th rowspan="2">Minggu ke-</th>
          <th rowspan="2">Sub CPMK</th>
          <th colspan="3">Metode Penilaian</th>
          <th rowspan="2">Bahan Kajian (Materi Pembelajaran)</th>
          <th rowspan="2">Metode Pembelajaran</th>
          <th rowspan="2">Beban Waktu Pembelajaran</th>
          <th rowspan="2">Pengalaman Belajar Mahasiswa</th>
          <th rowspan="2">Media Pembelajaran</th>
          <th rowspan="2">Fasilitator</th>
        </tr>
        <tr>
          <th>indikator</th>
          <th>Komponen</th>
          <th>Bobot (%)</th>
        </tr>
      </thead>

      <tbody>
        @isset($rincian)
        @foreach ($rincian as $rc)
        <tr>
          @php
              $asesmen = explode(',',$rc->asesmen);
              $fasilitator = explode(',',$rc->fasilitator);
          @endphp

          <td align="center">{{ $rc->week }}</td>

          @foreach ($cpmk->where('id',$rc->sub_cpmk) as $cpmkk)
            <td>({{ $cpmkk->kode_cpmk }}) {{ $cpmkk->ket_cpmk }}</td>
          @endforeach

          @foreach ($asesmen as $ases)
            <td align="center">{{ $ases }}</td>
          @endforeach
          
          <td>{{ $rc->kajian }}</td>

          <td>{{ $rc->metode }}</td>
          <td align="center">{{ $rc->time }}</td>
          <td>{{ $rc->pengalaman }}</td>
          <td>{{ $rc->media }}</td>

          <td>
            @foreach ($fasilitator as $fas)
                
            
            {{ $loop->iteration }}. 
          @foreach ($dosen->where('id',$fas) as $dsn)
          @if (isset($dsn->gelar_depan))
          {{$dsn->gelar_depan}}.    
          @endif

          {{$dsn->nama}}

          @if (isset($dsn->gelar_belakang))
              {{$dsn->gelar_belakang}}<br><br>
          @endif
          @endforeach
          @endforeach
          </td>
        </tr>
          @endforeach    
        @endisset
      </tbody>

    </table>
  </div>
</body>
</html>