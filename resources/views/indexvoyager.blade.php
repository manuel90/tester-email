@extends('voyager::master')

@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
        <h1 class="page-title"><i class="voyager-treasure-open"></i> Sending Email</h1>
        <div class="page-content edit-add container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <form class="form1" action="{{ route('testeremail.sending') }}" method="post">
                            <div class="panel-body">
                                {{ csrf_field() }}
                                <div class="form-group  col-md-12">              
                                    <label class="control-label">Email</label>
                                    <input required="" type="text" class="form-control" name="email" placeholder="Email" value="" required/>
                                </div>
                                <button class="btn btn-primary save">@lang('testeremail::general.submit')</button>
                                @if($message)
                                    <br/>
                                    <h4 class="text-danger">@lang("testeremail::general.$message")</h4>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop