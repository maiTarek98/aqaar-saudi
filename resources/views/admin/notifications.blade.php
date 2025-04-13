@extends('admin.index')
@push('custom-css')
<style>
  
  .dropdown-item:focus, .dropdown-item:hover {
    color: #fff !important;
    background: #2576ae;}
    .dropdown-item:focus, .dropdown-item:hover p{
    color: #fff !important;
    }
</style>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-5 fw-bold" style="color: var(--main)">@lang('main.Notifications')</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 card">
          <div class="card-body notofications px-1">
            @foreach($data as $note)
            <a href="{{url('/admin/'.$note->data['redirect'])}}" class="news" id="{{$note->id}}">
                <div class="circle"></div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="text-con">
                        <div class="time">
                            @php
                                $now = \Carbon\Carbon::now();
                                $created = $note->created_at;
                                $x = $created->diffForHumans($now);
                                echo $x;
                            @endphp
                        </div>
                        <div class="description">
                           {{$note->data['title']}} 
                          {{ $note->data['title'] }}
                        </div>
                    </div>
                    @if($note->read_at == null)
                    <form action="{{route('read_notify',$note->id)}}" class="" method="post">
                        @method('PUT') @csrf
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-eye p-0"></i></button>
                    </form>
                    @endif
                    
                </div>
            </a>
            
            {{--<div class="">
                <div class="dropdown-divider"></div>
                <a href="{{url('/admin/'.$note->data['redirect'])}}" class="dropdown-item" style="width: 90%" id="{{$note->id}}">
                    <i class="fas fa-envelope me-2"></i>{{$note->data['title']}}
                    <p>{{$note->data['text']}}</p>
                </a> 
                @if($note->read_at == null)
                <form action="{{route('read_notify',$note->id)}}" class="" method="post" style="width: 85%;display: flex;justify-content: space-between;    padding: 0.25rem 1.5rem;">
                    @method('PUT') @csrf
                    <p class=" text-muted text-sm"> @php 
                      $now = \Carbon\Carbon::now();
                      $created= $note->created_at;
                      $x= $created->diffForHumans($now);
                      echo $x;
                    @endphp</p>
                    <button type="submit" class="btn btn-info"><i class="fa fa-eye p-0"></i></button>
                </form>
                @endif
            </div>--}}
         

          @endforeach
            {{ $data->links() }}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
