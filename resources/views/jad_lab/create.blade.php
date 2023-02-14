@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 ">
                @include('layouts._flash')
                <div class="card border-secondary">
                    <div class="card-header mb-3">Jadwal Lab</div>

                    <div class="card-body">
                        <form action="{{ route('jad_lab.store') }}" method="post">
                            @csrf
                            <div class="mb-1">
                                <label for="">Nama</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"></input>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="">Hari</label>
                                <input type="text" name="hari" class="form-control @error('hari') is-invalid @enderror"></input>
                                @error('hari')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="">Kegiatan</label>
                                <textarea type="text" name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror"></textarea>
                                @error('kegiatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Kegiatan</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="kegiatan" rows="3"></textarea>
                              </div>
                            </form> --}}
                            <div class="mb-1">
                                <label for="">Tanggal Mulai</label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"></input>
                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                           <div class="mb-1">
                                <label for="">Lantai</label>
                                <select name="ket_id"  id="ket_lab"
                                 class="form-control @error('ket_id') is-invalid @enderror">
                                    @foreach ($ket_labs as $ket_lab)
                                    <option value="" hidden>pilih kategori
                                    <option value="{{ $ket_lab->id }}">{{ $ket_lab->lantai }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('ket_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                              <div class="mb-1">
                                <label for="">Ruangan</label>
                                <select name="kel_id" id="kel_lab" 
                                class="form-control @error('kel_id') is-invalid @enderror">
                                    {{-- @foreach ($kel_labs as $kel_lab) --}}
                                    <option value="" hidden>Pilih Lantai lebih dulu
                                    </option>
                                    {{-- @endforeach --}}
                                </select>
                                @error('kel_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-1">
                              <label for="">Tanggal Berakhir</label>
                              <input type="date" name="tanggal_berakhir" class="form-control @error('tanggal_berakhir') is-invalid @enderror"></input>
                              @error('tanggal_berakhir')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                              
                          <div class="mb-3">
                            <label for="">Keterangan</label>
                            <select class="form-control" name="keterangan" id="">
                              <option value="digunakan">digunakan</option>
                              <option value="selesai">selesai</option>
                            </select>
                            @error('Keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                            <div class="mb-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Kirim</button>
                                    <a href="{{ route('jad_lab.index') }}" class="btn btn-danger" type="submit">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
    <script>
        $(document).ready(function() {
            $('#ket_lab').on('change', function() {
                var ket_id = $(this).val();
                if (ket_id) {
                    $.ajax({
                        url: '/getkel/' + ket_id,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#kel_lab').empty();
                                $('#kel_lab').append(
                                    '<option hidden>Pilih Ruangan</option>');
                                $.each(data, function(key, kel_lab) {
                                    $('select[name="kel_id"]').append(
                                        '<option value="' + kel_lab.id + '">' +
                                        kel_lab.no_lab + '</option>');
                                });
                            } else {
                                $('#kel_lab').empty();
                            }
                        }
                    });
                } else {
                    $('#kel_lab').empty();
                }
            });
        });
    </script>