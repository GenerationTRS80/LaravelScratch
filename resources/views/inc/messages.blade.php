
{{-- Check 3 things: 1) Errors array 2) Session success 3) Session error failure--}}
@if(count($errors)>0)
  @foreach($errors->all() as $error)
    <div class="alert alert-danger">
      {{$error}}
    </div>
  @endforeach
@endif

{{-- Check Sessions --}}
@if(session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
@endif


@if(session('error'))
    <div class="alert alert-danger">
      {{session('error')}}
    </div>
@endif