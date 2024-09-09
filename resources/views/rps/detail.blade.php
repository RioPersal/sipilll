@extends('dashboard.master')
@section('judul','Detail Rencana Pembelajaran Semester (RPS)')
@section('css')
<style>
.table-responsive {
  overflow-x: auto;
  border-right: 1px solid #ddd; /* Tambahkan border kanan ke kontainer */
  white-space: nowrap; /* Menjaga teks tidak terbungkus */
}

.table {
  white-space: nowrap; /* Menjaga teks tidak terbungkus */
  border-collapse: collapse; /* Menggabungkan border tabel */
}

.table th, .table td {
  border: 1px solid #ddd; /* Border tabel */
}

</style>
@endsection
@section('content')
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col">
        <h3>{{ $matkul->nama_matkul }}</h3>
        <p>{{ $matkul->kode_matkul }} / {{ $matkul->sks }} sks / Semester {{ $matkul->semester }}</p>
      </div>
      <right>
        <div class="col">
          <a href="{{url('/rps')}}" class="btn btn-sm btn-outline-primary" title="Kembali"><i class="fa fa-arrow-left"></i></a>
          @if (auth()->user()->level == 'dosen')
            @if (isset($info))
              <a href="{{url('/rps/'.$matkul->id.'/edit_info_rps')}}" class="btn btn-sm btn-outline-warning ml-1" title="Edit Informasi RPS"><i class="fa fa-edit"></i></a>
            @else
              <a href="{{url('/rps/'.$matkul->id.'/create_info_rps')}}" class="btn btn-sm btn-outline-success ml-1" title="Tambah Informasi RPS"><i class="fa fa-plus"></i></a>
            @endif
          @endif
  
          <a href="/cetak-rps/{{$matkul->id}}" class="btn btn-sm btn-outline-success ml-1" target="_blank" title="Cetak RPS"><i class="fa-solid fa-print mr-1"></i></a>  
        </div>
    </right>
    </div>
  </div>
  <div class="card-body">
    <table class="table-bordered table-sm" style="width: 100%">
      <tr>
        <th class="text-center" colspan="5">RENCANA PEMBELAJARAN SEMESTER</th>
      </tr>
      <tr>
        <td class="col-1">Kode Mata Kuliah</td>
        <td class="col-1">Nama Mata Kuliah</td>
        <td class="col-1">SKS</td>
        <td class="col-1">Semester</td>
        <td class="col-1">Tanggal Penyusunan</td>
      </tr>
      <tr>
        <td>{{ $matkul->kode_matkul }}</td>
        <td>{{ $matkul->nama_matkul }}</td>
        <td>{{ $matkul->sks }}</td>
        <td>{{ $matkul->semester }}</td>
        <td>{{ $waktu_terbaru->created_at->format('d-m-Y') }}</td>
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

        
    </table>

    @if (auth()->user()->level == 'dosen')
    <br>
      <a href="{{url('/rps/'.$matkul->id.'/create_rincian_rps')}}" class="btn btn-sm btn-outline-success" title="Tambah Rincian RPS"><i class="fa fa-plus"></i></a>
      <br>
    @endif
    <br>

    <div class="table-responsive">
    <table class=" table table-bordered table-sm" style="width: 100%">
      <thead>
        <tr class="text-center">
          <th class="align-middle" rowspan="2">Minggu ke-</th>
          <th class="align-middle" rowspan="2">Sub CPMK</th>
          <th colspan="3">Metode Penilaian</th>
          <th class="align-middle" rowspan="2">Bahan Kajian (Materi Pembelajaran)</th>
          <th class="align-middle" rowspan="2">Metode Pembelajaran</th>
          <th class="align-middle" rowspan="2">Beban Waktu Pembelajaran</th>
          <th class="align-middle" rowspan="2">Pengalaman Belajar Mahasiswa</th>
          <th class="align-middle" rowspan="2">Media Pembelajaran</th>
          <th class="align-middle" rowspan="2">Fasilitator</th>
          @if (auth()->user()->level == 'dosen')
            <th rowspan="2">Aksi</th>
          @endif
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

          <td class="text-center">{{ $rc->week }}</td>

          @foreach ($cpmk->where('id',$rc->sub_cpmk) as $cpmkk)
            <td>({{ $cpmkk->kode_cpmk }}) {{ $cpmkk->ket_cpmk }}</td>
          @endforeach

          @foreach ($asesmen as $ases)
            <td>{{ $ases }}</td>
          @endforeach
          
          <td>{{ $rc->kajian }}</td>

          <td>{{ $rc->metode }}</td>
          <td class="text-center">{{ $rc->time }}</td>
          <td>{{ $rc->pengalaman }}</td>
          <td>{{ $rc->media }}</td>

          <td>
          @foreach ($dosen->whereIn('id',$fasilitator)->get() as $dsn)
          {{ $loop->iteration }}. 
          @if (isset($dsn->gelar_depan))
          {{$dsn->gelar_depan}}.    
          @endif

          {{$dsn->nama}}

          @if (isset($dsn->gelar_belakang))
              {{$dsn->gelar_belakang}}
          @endif<br>
          @endforeach
          </td>
          @if (auth()->user()->level == 'dosen')
            <td>
              <a href="{{url('/rps/'.$matkul->id.'/edit_rincian_rps')}}" class="btn btn-sm btn-outline-warning" title="Edit Rincian RPS Minggu ke-{{ $rc->week }}"><i class="fa fa-edit"></i></a>
            </td>
          @endif
        </tr>
          @endforeach    
        @endisset
      </tbody>

    </table>
    </div>
  </div>
</div>
@endsection
