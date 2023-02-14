<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN PERBAIKAN || UIN SGD BANDUNG</title>
</head>
<center> 
<body style="width: auto; font-family: 'Times New Roman', Times, serif">
    <div>
        <table>
            <td>
                <img src="{{asset('assets/images/uin1.png')}}" alt="" width="200" height="150">

            </td>
            <td>
                <div style="text-align: right; text-align: center; font-size: 14pt; margin-top:10px;">
                    KEMENTERIAN AGAMA <br>
                    UNIVERSITAS ISLAM NEGERI <br>
                    SUNAN GUNUNG DJATI BANDUNG <br>
                    PUSAT TEKNOLOGI INFORMASI DAN
                    PANGKALAN DATA
                </div>
                <div style="text-align: center; font-size: 11pt;">
                    Jl. A.H. Nasution No. 105 Cibiru Bandung 40614 🕿 (022) 7800525 <br>
                    Fax.(022)7803936 Website: http://ptipd.uinsgd.ac.id
                    E-mail: ptipd@uinsgd.ac.id
                </div>
            </td>
        </table>


        <hr size="5px" style="background-color: black; margin-bottom: 5px;">
    </div>

    </div>
    <div>
        <div style="text-align: center; font-size: 13pt; margin-top:20px; margin-bottom: 10px;">
            <div class="text-center">
                LAPORAN PERBAIKAN BARANG
                PUSAT TEKNOLOGI INFORMASI DAN PANGKALAN DATA
            </div>
            <div>
                UIN SUNAN GUNUNG DJATI BANDUNG
            </div>
        </div>
        
                    
        <div class="card-body">
            <div class="card-header ">
               
             
            </div>
            
            <div class="table table-hover table-striped">
                <table class="table-border" id="Table" border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Perbaikan</th>
                            <th>Nama Barang</th>
                            <th>Kerusakan</th>
                            {{-- <th>Penanganan</th> --}}
                            <th>Level </th>
                            {{-- <th>Hasil</th> --}}
                            <th>Keterangan</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($laporan_perbaikan as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->tanggal_perbaikan }}</td>
                                <td>{{ $data->barang->nama_barang }}</td>
                                <td>{{ $data->kerusakan }}</td>
                                {{-- <td>{{ $data->penanganan }}</td> --}}
                                <td>{{ $data->kebutuhan_komputer }}</td>
                                {{-- <td>{{ $data->hasil }}</td> --}}
                                <td>{{ $data->ket }}</td>
                              
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </center>
    <div class="float-start" style="margin-top: 65%">
        <div style="margin-bottom: 75px">
            Mengetahui <br>
            Kepala PTIPD, <br>
        </div>
        <div>
            Undang Syaripudin, M.Kom <br>
            NIP. 197909302009121002
        </div>
    </div>
</div>
    </div>

<script type="text/javascript">
    window.print();
    </script>
</body>
</html>