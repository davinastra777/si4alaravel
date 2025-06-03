@extends('layout.main')
@section('title', 'Jadwal')
@section('content')
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Ubah Jadwal</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form action={{ route('jadwal.update',$jadwal->id) }} method="POST">
                        @csrf
                        @method('PUT')
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                                <input type="text" class="form-control" name="tahun_akademik" value="{{ old('tahun_akademik') ? old('tahun_akademik'):$jadwal->tahun_akademik }}">
                            </div>
                            @error('tahun_akademik')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" name="kelas" value="{{ old('kelas') ? old('kelas'):$jadwal->kelas}}">
                            </div>
                            @error('kode_mk')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="kode_smt" class="form-label">Kode Semester</label>
                                <input type="radio" name="kode_smt" value="Gasal" {{ old('kode_smt') == 'Gasal' ? 'checked' : ($jadwal->kode_smt == 'Gasal' ? 'checked' : '') }}> Gasal
                                <input type="radio" name="kode_smt" value="Genap" {{ old('kode_smt') == 'Genap' ? 'checked' : ($jadwal->kode_smt == 'Genap' ? 'checked' : '') }}> Genap 
                                @error('kode_smt')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            <div class="mb-3">
                                <label for="sesi_id" class="form-label">Sesi</label>
                                <select class="form-control" name="sesi_id">
                                    @foreach($sesi as $item)
                                    <option value="{{ $item->id }}" {{ old('sesi_id') == $item->id ? 'selected' : ($jadwal->sesi_id == $item->id ? 'selected' : null)  }}> {{ $item->nama}} </option>
                                    @endforeach
                                </select>
                            @error('sesi_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="mb-3">
                                <label for="matakuliahid" class="form-label">Sesi</label>
                                <select class="form-control" name="matakuliahid">
                                    @foreach($matakuliah as $item)
                                    <option value="{{ $item->id }}" {{ old('matakuliahid') == $item->id ? 'selected' : ($jadwal->matakuliah_id == $item->id ? 'selected' : null)  }}> {{ $item->nama}} </option>
                                    @endforeach
                                </select>
                            @error('matakuliahid')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="mb-3">
                                <label for="dosen_id" class="form-label">Dosen</label>
                                <select class="form-control" name="dosen_id">
                                    @foreach($users as $item)
                                    <option value="{{ $item->id }}" {{ old('dosen_id') == $item->id ? 'selected' : ($jadwal->dosen_id == $item->id ? 'selected' : null)  }}> {{ $item->user->name ?? 'N/A' }} </option>
                                    @endforeach
                                </select>
                        </div>                        

                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <!--end::Footer-->
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!-- /.card -->
        </div>
    @endsection