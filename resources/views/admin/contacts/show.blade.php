@extends('admin.index')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>        
            <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="form-group col-sm-10">
                                    <label> @lang('main.contacts.name')</label>
                                    <span>{{ $contact->name }}</span>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label> @lang('main.contacts.email')</label>
                                    <input type="text" name="name"
                                        value="{{ $contact->email }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label> @lang('main.contacts.message')</label>
                                    <textarea class="form-control" readonly>{{ $contact->message}}</textarea>
                                </div>
                                <hr class="mb-3">
                                <p>@lang('main.contacts.send email for') :{{$contact->email}} </p>
                                           
                                           
                            <form method="post" action="{{route('contacts.send_email',$contact->id)}}">
                            @csrf
                            <textarea name="body" rows="5" id="body"
                                    class="form-control summernote "></textarea>
                            <button type="submit" class="form-control btn btn-success mt-3">
                                @lang('main.send')
                            </button>
                        </form>
                        
                        <hr class="my-3">
                        
                        <h5 class="fw-bold mb-3">@lang('main.contacts.show all replys') <span>{{$contact->name}}</span>
                        </h5>
                        @forelse($contact->contact_replys as $key => $value)
                            <div class="card">
                                <div class="card-header">
                                    #{{$key+1}}
                                </div>
                                <div class="card-body">
                                    <p>@lang('main.body of msg') : {!! $value->body !!}</p>
                                </div>
                            </div>
                        @empty
                            <h5 class="empty">@lang('main.contacts.no replys')</h5>
                            <style>
                                .empty{
                                    background: #2BB67350;
                                    padding: .75rem 1rem;
                                    border-radius: 8px;
                                    border-inline-start: 6px solid #2BB673;
                                }
                            </style>
                        @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
        </div>
@endsection
