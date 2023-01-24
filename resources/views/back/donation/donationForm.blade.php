@extends('back.layouts.master')
@section('title', 'Create Donation Program')

@section('master')
<form action="{{route('back.donation.storeUpdate')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card border-light mt-3 shadow">
                <div class="card-header">
                    <a href="{{route('back.donation.index')}}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i>back</a>
                </div>

                <div class="card-body">
                    @if(isset($donation_form))
                    <donation-form :donation="{{ $donation_form }}"></donation-form>
                    @else
                        <donation-form></donation-form>
                    @endif
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-block">Create</button>
                    <small><b>NB: *</b> marked are required field.</small>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer')
    <script type="text/javascript" src="{{asset('back/js/app.js')}}"></script>
@endsection
