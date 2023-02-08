@extends('layouts.app')

@section('content')
<main class="container">
    <!-- START FORM -->

     
     <!-- START DATA -->
     <div class="my-3 p-3 bg-body rounded shadow-sm">
            
             
            
       
             <table class="table table-striped">
                 <thead>
                     <tr>
                         <th class="col-md-1" id="no">No</th>
                         <th class="col-md-3">Nama</th>
                         <th class="col-md-4">jenis kelamin</th>
                         <th class="col-md-2">tanggal lahir</th>
                         <th class="col-md-2">Aksi</th>
                     </tr>
                 </thead>
                 @foreach($user as $item)
                 <tbody>
                     <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $item->nama }}</td>
                         <td>{{ $item->jenis_kelamin }}</td>
                         <td>{{ $item->tanggal_lahir }}</td>
                         <td>
                             <form action="{{ route('alluser.destory',$item->id) }}" method="post">
@csrf
@method('DELETE')
<button type="submit">Hapus</button>
                            </form>
                         </td>
                     </tr>
                 </tbody>
                 @endforeach
             </table>
            
       </div>
       <!-- AKHIR DATA -->
 </main>
@endsection