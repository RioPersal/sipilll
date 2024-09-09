@extends('dashboard.master')
@section('judul','Tambah Data Rincian SKS')
@section('content')

<div class="card">
    <form class="form-horizontal" form action="{{url ('/rps/{matkul:id}/create_rincian_rps')}}" method="POST">
        <div class="card-body">
            @csrf
            <input type="hidden" name="id_matkul" value="{{ old('id_matkul', $matkul->id) }}">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Matkul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $matkul->nama_matkul }}" disabled style="background-color: #ffffff; color: #333;">
                </div>
            </div>

            <div id="inputContainer" class="form-group row">
                <label class="col-sm-2 col-form-label">Minggu ke-</label>
                <div class="col-sm-2">
                        <select name="week[]" class="form-control @error('week') is-invalid  @enderror">
                            <option value="">- pilih -</option>
                            @for ($i = 1; $i < 17; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('week')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
            </div>

            <button type="button" id="addButton" class="btn btn-outline-success">Tambah Minggu ke-</button>

            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Sub CPMK</label>
                <div class="col-sm-10">
                    <select name="sub_cpmk" id="sub_cpmk" class="form-control @error('sub_cpmk') is-invalid @enderror">
                        <option value="">- pilih -</option>
                        @foreach ($cpmk as $item)
                            <option value="{{ $item->id }}">({{ $item->kode_cpmk }}) {{ $item->ket_cpmk }}</option>
                        @endforeach
                    </select>
                    @error('sub_cpmk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Metode Penilaian</label>
                <div class="col-sm-10">
                    <select name="bobot_cpmk" id="bobot_cpmk" class="form-control @error('bobot_cpmk') is-invalid @enderror">
                        <option value="">- pilih -</option>
                    </select>
                    @error('bobot_cpmk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Bahan Kajian</label>
                <div class="col-sm-10">
                    <select name="kajian" class="form-control @error('kajian') is-invalid @enderror">
                        <option value="">- pilih -</option>
                        @foreach ($kajian as $item2)
                            <option value="{{ $item2 }}">{{ $item2 }}</option>
                        @endforeach
                    </select>
                    @error('kajian')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div id="inputContainer2" class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Metode Pembelajaran</label>
                <div class="col-sm-2">
                    <select name="metode[]" class="form-control @error('metode') is-invalid @enderror">
                        <option value="">- pilih -</option>
                        <option value="Diskusi">Diskusi</option>
                        <option value="Presentasi">Presentasi</option>
                        <option value="Praktek">Praktek</option>
                        <option value="Tugas Mandiri">Tugas Mandiri</option>
                        <option value="Tugas Kelompok">Tugas Kelompok</option>
                        <option value="Belajar Mandiri">Belajar Mandiri</option>
                        <option value="Mengerjakan UTS">Mengerjakan UTS</option>
                        <option value="Mengerjakan UAS">Mengerjakan UAS</option>
                    </select>
                    @error('metode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <button type="button" id="addButton2" class="btn btn-outline-success">Tambah Metode Pembelajaran</button>

            <div class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Beban Waktu Pembelajaran</label>
                <div class="col-sm-2">
                    <select name="time" class="form-control @error('time') is-invalid @enderror">
                        <option value="">- pilih -</option>
                        @for ($i = 1; $i < $count+1; $i++)
                            <option value="{{ $i }}x50 menit">{{ $i }}x50 menit</option>    
                        @endfor
                    </select>
                    @error('time')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pengalaman Belajar Mahasiswa</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('pengalaman') is-invalid  @enderror" name="pengalaman" value="{{ old('pengalaman') }}" placeholder="Pengalaman Belajar Mahasiswa">
                    @error('pengalaman')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div id="inputContainer3" class="form-group row mt-3">
                <label class="col-sm-2 col-form-label">Media Pembelajaran</label>
                <div class="col-sm-2">
                    <select name="media[]" class="form-control @error('media') is-invalid @enderror">
                        <option value="">- pilih -</option>
                        <option value="Diskusi">Diskusi</option>
                        <option value="Presentasi">Presentasi</option>
                        <option value="Praktek">Praktek</option>
                        <option value="Tugas Mandiri">Tugas Mandiri</option>
                        <option value="Tugas Kelompok">Tugas Kelompok</option>
                        <option value="Belajar Mandiri">Belajar Mandiri</option>
                        <option value="Mengerjakan UTS">Mengerjakan UTS</option>
                        <option value="Mengerjakan UAS">Mengerjakan UAS</option>
                    </select>
                    @error('media')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <button type="button" id="addButton3" class="btn btn-outline-success">Tambah Media Pembelajaran</button>

            <div id="inputContainer4">
                <div class="form-group row mt-3">
                    <label class="col-sm-2 col-form-label">Fasilitator</label>
                    <div class="col-sm-10">
                        <select name="fasilitator[]" class="form-control @error('fasilitator') is-invalid  @enderror">
                            <option value="">- pilih -</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}">
                                    @if (isset($item->gelar_depan))
                                        {{$item->gelar_depan}}.    
                                    @endif
                
                                    {{$item->nama}}
                
                                    @if (isset($item->gelar_belakang))
                                        {{$item->gelar_belakang}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('fasilitator')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="button" id="addButton4" class="btn btn-outline-success">Tambah Fasilitator</button>

        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary">Tambah</button>
            <a href="{{url('/rps/'.$matkul->id)}}" class="btn btn-outline-secondary ml-1">Close</a>
        </div>
    </form>
</div>


@endsection
@section('js')
<script>
    document.getElementById('addButton').addEventListener('click', function() {
      var inputContainer = document.getElementById('inputContainer');
      var newInput = document.createElement('div');
      newInput.className = 'col-sm-2';
      newInput.innerHTML = `
        <select name="week[]" class="form-control @error('week') is-invalid  @enderror">
                            <option value="">- pilih -</option>
                            @for ($i = 1; $i < 17; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('week')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
      `;
      inputContainer.appendChild(newInput);
    });
</script>
<script>
    document.getElementById('addButton2').addEventListener('click', function() {
      var inputContainer = document.getElementById('inputContainer2');
      var newInput = document.createElement('div');
      newInput.className = 'col-sm-2';
      newInput.innerHTML = `
        <select name="metode[]" class="form-control @error('metode') is-invalid @enderror">
                        <option value="">- pilih -</option>
                        <option value="Diskusi">Diskusi</option>
                        <option value="Presentasi">Presentasi</option>
                        <option value="Praktek">Praktek</option>
                        <option value="Tugas Mandiri">Tugas Mandiri</option>
                        <option value="Tugas Kelompok">Tugas Kelompok</option>
                        <option value="Belajar Mandiri">Belajar Mandiri</option>
                        <option value="Mengerjakan UTS">Mengerjakan UTS</option>
                        <option value="Mengerjakan UAS">Mengerjakan UAS</option>
                    </select>
                    @error('metode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
      `;
      inputContainer.appendChild(newInput);
    });
</script>
<script>
    document.getElementById('addButton3').addEventListener('click', function() {
      var inputContainer = document.getElementById('inputContainer3');
      var newInput = document.createElement('div');
      newInput.className = 'col-sm-2';
      newInput.innerHTML = `
        <select name="media[]" class="form-control @error('media') is-invalid @enderror">
                        <option value="">- pilih -</option>
                        <option value="Diskusi">Diskusi</option>
                        <option value="Presentasi">Presentasi</option>
                        <option value="Praktek">Praktek</option>
                        <option value="Tugas Mandiri">Tugas Mandiri</option>
                        <option value="Tugas Kelompok">Tugas Kelompok</option>
                        <option value="Belajar Mandiri">Belajar Mandiri</option>
                        <option value="Mengerjakan UTS">Mengerjakan UTS</option>
                        <option value="Mengerjakan UAS">Mengerjakan UAS</option>
                    </select>
                    @error('media')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
      `;
      inputContainer.appendChild(newInput);
    });
</script>
<script>
    document.getElementById('addButton4').addEventListener('click', function() {
      var inputContainer = document.getElementById('inputContainer4');
      var newInput = document.createElement('div');
      newInput.className = 'form-group row mt-3';
      newInput.innerHTML = `
        <label class="col-sm-2 col-form-label">Fasilitator</label>
                    <div class="col-sm-10">
                        <select name="fasilitator[]" class="form-control @error('fasilitator') is-invalid  @enderror">
                            <option value="">- pilih -</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}">
                                    @if (isset($item->gelar_depan))
                                        {{$item->gelar_depan}}.    
                                    @endif
                
                                    {{$item->nama}}
                
                                    @if (isset($item->gelar_belakang))
                                        {{$item->gelar_belakang}}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('fasilitator')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
      `;
      inputContainer.appendChild(newInput);
    });
</script>
<script>
    document.getElementById('sub_cpmk').addEventListener('change', function() {
    var subCpmkId = this.value;
    var bobotCpmkSelect = document.getElementById('bobot_cpmk');
    
    // Clear previous options
    bobotCpmkSelect.innerHTML = '<option value="">- pilih -</option>';
    
    if (subCpmkId) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/get-bobot-cpmk/' + subCpmkId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
                console.log(data);  // Tambahkan ini untuk debugging
                data.forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = [item.indikator_asesmen, item.pilihan_asesmen, item.bobot_cpmk].join(',');
                    option.text = '(' +item.pilihan_asesmen + ' ' + item.bobot_cpmk + '%) ' + item.indikator_asesmen;
                    bobotCpmkSelect.appendChild(option);
                });
            }
        };
        xhr.send();
    }
});


</script>
@endsection