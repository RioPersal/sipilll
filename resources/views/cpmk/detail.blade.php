@extends('dashboard.master')
@section('judul','Detail Capaian Pembelajaran Mata Kuliah (CPMK)')
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
@php
  $total = 0;
@endphp
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-sm">
        <h3>{{ $matkul->nama_matkul }}</h3>
        <p>{{ $matkul->kode_matkul }} / {{ $matkul->sks }} sks / Semester {{ $matkul->semester }}</p>
        <a href="{{url('/sub-cpmk')}}" class="btn btn-sm btn-outline-primary">Kembali</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    @if ($matkul_ind->where('id_matkul',$matkul->id)->count() == 0)
      <div class="table-responsive">
        <table class="table table-sm table-bordered">
          <tr>
            <td class="text-center align-middle" colspan="10">Mohon maaf, data indikator untuk matkul ini belum tersedia. Harap untuk menginput data <b>Matkul vs Indikator CPL</b> terlebih dahulu</td>
          </tr>
        </table>
      </div>
    @else
      @foreach ($cepeel as $key => $value)
      <h5>{{ $value->kode_cpl }} ({{ $value->keterangan }})</h5>
        @foreach ($indikator->where('id_cpl',$value->id) as $item)
          <p>{{ $item->indikator }} ({{ $item->ket_indikator }})</p>
          <div class="mb-3">
            <a href="{{url('/sub-cpmk/'.$matkul->id.'/create/'.$item->id)}}" class="btn btn-sm btn-outline-success"><i class="fa fa-plus"></i>Tambah CPMK</a>
          </div>

          <div class="table-responsive">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th class="text-center align-middle col-1" rowspan="2">Kode CPMK</th>
                  <th class="text-center align-middle col-2" rowspan="2">Pernyataan CPMK</th>
                  <th class="text-center align-middle" colspan="6">Distribusi Bobot</th>
                  <th class="text-center align-middle" rowspan="2">Media Asesmen</th>
                  <th class="text-center align-middle" rowspan="2">Bobot CPMK</th>
                  <th class="text-center align-middle" rowspan="2">Aksi</th>
                </tr>
                <tr>
                  <th class="text-center">Quiz</th>
                  <th class="text-center">Tugas Mandiri</th>
                  <th class="text-center">Tugas Kelompok</th>
                  <th class="text-center" nowrap>Pratikum</th>
                  <th class="text-center">UTS</th>
                  <th class="text-center">UAS</th>
                </tr>
              </thead>
              <tbody>
                @if ($cpmk->where('id_indikator',$item->id)->where('id_matkul',$matkul->id)->count() == 0)
                  <tr>
                    <td class="text-center align-middle" colspan="10">Mohon maaf, data cpmk untuk indikator ini belum tersedia. Harap untuk menginput data cpmk terlebih dahulu</td>
                  </tr>
                @else
                  @php
                      $total2 = 0;
                  @endphp
                  @foreach ($cpmk->where('id_indikator',$item->id)->where('id_matkul',$matkul->id) as $data)
                    <tr>
                      <td class="text-center align-middle" nowrap>{{ $data->kode_cpmk }}</td>
                      <td class="text-center align-middle">{{ $data->ket_cpmk }}</td>
                      @if ($bobot_cpmk->where('id_cpmk', $data->id)->count() == 0)
                        <td class="text-center" colspan="8">Mohon maaf, data bobot untuk cpmk ini belum tersedia. Harap untuk menginput data bobot terlebih dahulu</td>
                      @else
                        @php
                          $quiz_bobot = $bobot_cpmk->where('id_cpmk', $data->id)->where('pilihan_asesmen', 'Quiz')->sum('bobot_cpmk');
                          $tugas_mandiri_bobot = $bobot_cpmk->where('id_cpmk', $data->id)->where('pilihan_asesmen', 'Tugas Mandiri')->sum('bobot_cpmk');
                          $tugas_kelompok_bobot = $bobot_cpmk->where('id_cpmk', $data->id)->where('pilihan_asesmen', 'Tugas Kelompok')->sum('bobot_cpmk');
                          $pratikum_bobot = $bobot_cpmk->where('id_cpmk', $data->id)->where('pilihan_asesmen', 'Pratikum')->sum('bobot_cpmk');
                          $uts_bobot = $bobot_cpmk->where('id_cpmk', $data->id)->where('pilihan_asesmen', 'UTS')->sum('bobot_cpmk');
                          $uas_bobot = $bobot_cpmk->where('id_cpmk', $data->id)->where('pilihan_asesmen', 'UAS')->sum('bobot_cpmk');
                          $asesmen_bobot = $bobot_cpmk->where('id_cpmk', $data->id)->pluck('pilihan_asesmen')->implode(', ');
                          $total_bobot = $bobot_cpmk->where('id_cpmk', $data->id)->sum('bobot_cpmk');
                          $total2= $total2 + $total_bobot;
                          $total = $total + $total_bobot;
                        @endphp

                        <td class="text-center align-middle">{{ $quiz_bobot }}</td>
                        <td class="text-center align-middle">{{ $tugas_mandiri_bobot }}</td>
                        <td class="text-center align-middle">{{ $tugas_kelompok_bobot }}</td>
                        <td class="text-center align-middle">{{ $pratikum_bobot }}</td>
                        <td class="text-center align-middle">{{ $uts_bobot }}</td>
                        <td class="text-center align-middle">{{ $uas_bobot }}</td>
                        <td class="text-center align-middle">{{ $asesmen_bobot }}</td>
                        <td class="text-center align-middle">{{ $total_bobot }}</td>
                      @endif
                      <td class="text-center align-middle">
                        <a href="{{url('/sub-cpmk/'.$matkul->id.'/edit/'.$data->id)}}" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i>Edit CPMK</a>
                        <form action="/sub-cpmk/{{ $matkul->id }}/{{$data->id}}" method="POST" class="d-inline">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-sm btn-outline-danger ml-1" onclick="return confirm('apa kamu yakin ingin menghapus data tersebut?')" type="submit"><i class = "fa fa-trash"></i>Hapus CPMK</button>
                        </form>
                        <a href="{{url('/sub-cpmk/'.$matkul->id.'/create_bobot/'.$data->id)}}" class="btn btn-sm btn-outline-success ml-1"><i class="fa fa-plus"></i>Tambah Bobot</a>
                        <a href="{{url('/sub-cpmk/'.$matkul->id.'/edit_bobot/'.$data->id)}}" class="btn btn-sm btn-outline-info ml-1"><i class="fa fa-edit"></i>Edit Bobot</a>
                      </td>
                    </tr>
                  @endforeach
                  <tr>
                    <td class="text-right align-middle" colspan="8">Total Bobot CPMK (%)</td>
                    <td class="text-center align-middle">{{ $total2 }} dari 100%</td>
                    <td class="text-center align-middle" colspan="2"></td>
                  </tr>
                @endif
              </tbody>
              
            </table>
          </div>
        @endforeach
      <hr>
      @endforeach
      <h5 class="text-center">Total bobot CPMK keseluruhan telah terisi sebesar {{ $total }}% dari 100%</h5>
    @endif
  </div>
</div>
@endsection
