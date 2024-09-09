@extends('dashboard.master')
@section('judul','Rekap CPL Mahasiswa')
@section('content')
<form class="form-horizontal" form action="/rekap-nilai-mahasiswa" method="GET">
  <div class="row g-3 align-items-center ml-1">
    <div class="col-4">
      <div class="row">
        <input type="search" name="search" class="form-control" placeholder="Masukkan Nama atau NIM Mahasiswa">
      </div>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-outline-primary">Search</button>
    </div>
  </div>
</form>

@if (isset($mahasiswa))
  <div class="card mt-3">
      <div class="card-header">
        <div class="row">
        <div class="col">
          <h5 class="text-bold mt-2">Rekap CPL Mahasiswa</h5>
          <a href="/cetak-rekap-mahasiswa/{{$mahasiswa->id}}" class="btn btn-sm btn-outline-info" target="_blank"><i class="fa-solid fa-print mr-1"></i>CETAK PDF</a>
        </div>
        <right>
          <div class="col text-right">
            <h5 class="text-bold mt-2">
              {{ $mahasiswa->nama }}
            </h5>
            <p>{{ $mahasiswa->nim }}</p>
          </div>
          </right>
        </div>
      </div>
      <div class="card-body">
          <table class="table table-bordered">
              <thead>
                  <tr>
                    <th class="text-center align-middle" width="20px" rowspan="2">NO</th>
                    <th class="text-center align-middle" width="100px" rowspan="2">MATAKULIAH</th>
                    <th class="text-center align-middle" rowspan="2">SKS</th>
                    <th class="text-center align-middle" rowspan="2">SEMESTER</th>
                    <th class="text-center" colspan="11">CAPAIAN PEMBELAJARAN LULUSAN</th>
                  </tr>

                  <tr>
                    @php
                        $header = array();
                    @endphp

                    @foreach ($cepeel as $cpl)
                    @php
                        array_push($header, $cpl->kode_cpl);
                    @endphp
                      <th class="text-center align-middle" rowspan="5">{{ $cpl->kode_cpl }}</th>
                    @endforeach
                    
                  </tr>
              </thead>
              <tbody>
                
                @php
                    $total_cpl = array();
                @endphp
                @foreach ($matkuls as $kuy => $matkul)
                @php
                    $total_cpl_mk = array();
                @endphp
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $matkul->nama_matkul }}</td>
                    <td class="text-center">{{ $matkul->sks }}</td>
                    <td class="text-center">{{ $matkul->semester }}</td>
                    @if($kelass->where('id_matkul', $matkul->id)->count() == 0)
                      <td class="text-center align-middle bg-light" colspan="{{ $cepeel_count }}" style="white-space: nowrap;">
                        Data kelas tidak ditemukan. Silahkan buat kelas terlebih dahulu!
                      </td>
                    @else
                    @foreach ($kelass->where('id_matkul',$matkul->id) as $kelas)
                      @foreach ($peserta->where('id_kelas',$kelas->id)->where('id_mahasiswa',$mahasiswa->id) as $pesertaa)
                        @foreach ($cepeel as $key => $cpl)
                          @php
                            $jumlah_rata_rata = 0;
                            $jumlah_nilai_cpl = 0;
                            $jumlah_nilai_ind_final = 0;
                            $jumlah_hasil_rata_rata = 0;
                            $s = 0;
                          @endphp

                          @foreach ($indikator->where('id_cpl',$cpl->id) as $ind)
                            @php
                              $jumlah_nilai_ind = 0;
                            @endphp

                            @foreach ($mtkl as $mk)
                              @foreach ($mtnd->where('id_matkul', $mk->id)->where('id_indikator', $ind->id) as $mi)
                                  
                                  @php
                                      $x = 100/$mk->sks;
                                      $s += $x*$mi->bobot_indikator;
                                  @endphp
                              @endforeach
                            @endforeach

                            @foreach ($cpmk->where('id_indikator',$ind->id)->where('id_matkul',$matkul->id) as $cpm)
                              @foreach ($bobot_cpmk->where('id_cpmk',$cpm->id) as $bobot)
                                @if ($penilaian->where('id_mahasiswa',$mahasiswa->id)->where('id_kelas',$kelas->id)->where('id_asesmen',$bobot->id)->count() == 0)
                                  @php
                                    $jumlah_nilai_ind = 0;
                                  @endphp
                                @else
                                  @foreach ($penilaian->where('id_mahasiswa',$mahasiswa->id)->where('id_kelas',$kelas->id)->where('id_asesmen',$bobot->id) as $nilai)
                                    @php
                                      $jumlah_nilai_ind += $nilai->nilai*($bobot->bobot_cpmk/100);
                                    @endphp
                                  @endforeach
                                @endif
                              @endforeach
                            @endforeach

                            @foreach ($mat_ind->where('id_matkul',$matkul->id)->where('id_indikator',$ind->id) as $matdin)
                              @php
                                $rata_rata_ind = 100/$matkul->sks;
                                $rata_rata_mat_ind = $rata_rata_ind*$matdin->bobot_indikator;
                                $jumlah_rata_rata += $rata_rata_mat_ind;
                                $jumlah_hasil_rata_rata = $rata_rata_mat_ind/$jumlah_rata_rata;
                                $jumlah_nilai_ind_final += $jumlah_nilai_ind;
                              @endphp
                            @endforeach
                          @endforeach

                          @php
                            $jumlah_nilai_cpl = $jumlah_nilai_cpl+($jumlah_nilai_ind_final*$jumlah_hasil_rata_rata);
                            if ($jumlah_nilai_ind_final == 0 || $s == 0 || $jumlah_rata_rata == 0) {
                              $hasil = 0;
                            } else {
                              $hasil = $jumlah_nilai_ind_final * $jumlah_rata_rata / $s;
                            }
                            
                            $total_cpl_mk[$key] = $hasil;
                            
                            
                            
                          @endphp
                          
                          <td class="text-center align-middle" style="font-size: 12px">{{ round($hasil, 2) }}</td>
                        @endforeach
                          @php
                              $total_cpl[$kuy] = $total_cpl_mk;
                          @endphp
                      @endforeach
                    @endforeach

                    
                    @endif
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                  <tr>
                    <th class="text-center" width="20px" colspan="4">TOTAL</th>

                    @php
                        $totalSumArray = [];

                        // Looping untuk mengakses setiap elemen dari array dua dimensi
                        foreach ($total_cpl as $rowIndex => $row) {
                            foreach ($row as $colIndex => $value) {
                                // Jika indeks array baru belum ada, inisialisasi dengan 0
                                if (!isset($totalSumArray[$colIndex])) {
                                    $totalSumArray[$colIndex] = 0;
                                }

                                // Tambahkan nilai dari array dua dimensi ke array baru
                                $totalSumArray[$colIndex] += $value;
                            }
                        }
                    @endphp

                    @foreach ($totalSumArray as $result)
                    @if (round($result, 2) <= 50)
                    <th class="text-center bg-danger">{{ round($result, 2) }}</th>
                    @else
                    <th class="text-center">{{ round($result, 2) }}</th>
                    @endif
                    
                    @endforeach
                    
                  </tr>
              </tfoot>
          </table>
      </div>
  </div>

  <div class="card">
      <div class="card-header">
          <div class="row">
              <h5 class="text-bold mt-2">Grafik Rekap CPL Mahasiswa</h5>
          </div>
      </div>
      <div class="card-body">
        <center>
          <div class="chart" style="width: 85%">
              <canvas id="barChart"></canvas>
            </div>
        </center>
      </div>
  </div>
@else
<div class="card mt-3">
  <div class="card-body">
    <h3 class="text-center">Data tidak ditemukan!</h3>
    <h6 class="text-center">Harap melakukan pencarian pada kolom "search" terlebih dahulu!</h6>
  </div>
</div>
@endif
@endsection

@section('js')
@if (isset($mahasiswa))
<script>
  var header = {!! json_encode($header) !!};
  var hasil = {!! json_encode($totalSumArray) !!};
  // Fungsi untuk membulatkan angka
  function roundNumber(number, decimalPlaces) {
    return Number(number.toFixed(decimalPlaces));
  }

  // Memperoleh hasil pembulatan pada setiap angka dalam array hasil
  var roundedHasil = hasil.map(function(data) {
    return roundNumber(data, 2);
  });

    $(function () {

    var barChartCanvas = $('#barChart').get(0).getContext('2d');

    var backgroundColors = hasil.map(function(data) {
        return data <= 50 ? 'rgba(255, 0, 0, 0.9)' : 'rgba(60, 141, 188, 0.9)';
    });

    var barChartData = {
      labels  : header,
      datasets: [
        {
          label               : 'Capaian Pembelajaran Lulusan',
          backgroundColor     : backgroundColors,
          borderColor         : 'rgba(60,141,188,0.8)',
          borderWidth         : 1,
          data                : roundedHasil
        }
      ]
    };

        var barChartOptions = {
          responsive              : true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    max: 100,
                }
            }]
        }
      };

        new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions,
        });
    });
</script>
@endif
@endsection
