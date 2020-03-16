@extends('admin.layouts.default')

@section('admin.breadcrumb')
<li class='breadcrumb-item'>Stores</li>
@endsection

@section('admin.stats')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Stores Details</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S N0.</th>
                    <th>Store Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                @foreach($stores as $allstores)
                <tr>
                    <td>{{$number}}</td>
                    <td>{{$allstores->store_name}}</td>
                    <td>{{$allstores->email}}</td>
                    <td>{{$allstores->address}}</td>
                    <td>
                        @if($allstores->logo)
                        <img width="100" height="50" src="{{asset('images')}}/{{$allstores->logo}}">
                        @else
                        <p>NA</p>
                        @endif
                    </td>
                    <td>
                        <input data-id="{{$allstores->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $allstores->verified == 'yes' ? 'checked' : '' }}>
                    </td>
                    <?php $number++; ?>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<div class="card">

</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/js/chart.js') }}"></script>
<script src="{{ asset('vendor/js/dashboard.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<!-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->
<script>
  $(function() {
    $('.toggle-class').change(function() {
        var verified = $(this).prop('checked') == true ? 'yes' : 'no'; 
        var user_id = $(this).data('id'); 

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{url("account/stores-verify")}}',
            data: {'verified': verified, 'user_id': user_id},
            success: function(data){
              // console.log(data.success)
              if (data.success) {
                alert('Account has been verified. ');
            }
            if (data.successNo) {
                alert('Account status has been changed. ');
            }
        }
    });
    })
})
</script>

@endsection