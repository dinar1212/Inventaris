@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts._flash')
            <div class="card border-secondary">
                <div class="card-header mb-3">Data Edit</div>

                <div class="card-body">
                    <form action="{{ route('pengembalian.update', $pengembalian->id) }}" method="post">
                        @method('put')
                        @csrf
                       
                        <div class="mb-3">
                            <label for="">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" value="{{ $pengembalian->nama_peminjam }}" class="form-control @error('nama_peminjam') is-invalid @enderror">
                            @error('nama_peminjam')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                       
                        <div class="mb-3">
                        <label class="form-label">Name Barang</label>
                        <select name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror">
                            @foreach ($data_barangs as $data_barang)
                            @if (old('nama_barang', $data_barang->id) == $pengembalian->barang->id)
                            <option value="{{ $data_barang->id }}" selected hidden>{{ $data_barang->nama_barang }}</option>
                            @else
                            <option value="{{ $data_barang->id }}">{{ $data_barang->nama_barang }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('nama_barang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                        <div class="mb-3">
                            <label for="">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" value="{{ $pengembalian->tanggal_pinjam }}">
                            </input>
                            @error('tanggal_pinjam')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                       
                        <!-- <div class="mb-3">
                            <label for="">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror" value="{{ $pengembalian->tanggal_kembali }}">
                            </input>
                            @error('tanggal_kembali')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> -->
                      
                     
                        <div class="mb-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Kirim</button>
                                <a href="{{ route('pengembalian.index') }}" class="btn btn-danger" type="submit">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection