@extends('adminlte::page')

@section('title', 'CVCS | আবেদনসমূহ')

@section('css')

@stop

@section('content_header')
    <h1>
      ত্রুটিপূর্ণ আবেদনসমূহ ({{ bangla($applicationscount) }}টি)
      <div class="pull-right">
        {{-- <a class="btn btn-success" href="{{ route('index.application') }}" target="_blank"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> সদস্য যোগ করুন</a> --}}
      </div>
    </h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-6">
      <input type="text" id="search" class="form-control" placeholder="&#xF002; খুঁজুন (কমপক্ষে ৫ টি সংখ্যা বা অক্ষর লিখুন)" style="font-family:Arial, FontAwesome"><br/>
    </div>
    <div class="col-md-6">
      <span style="color: #008D4C;" id="total_records"></span>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered" id="searchTable">
      <thead>
        <tr>
          <th>নাম</th>
          <th>যোগাযোগের নম্বর ও ইমেইল এড্রেস</th>
          <th>অফিস তথ্য</th>
          <th>পরিশোধ তথ্য</th>
          <th>ছবি</th>
          <th width="18%">Action</th>
        </tr>
      </thead>
     <tbody id="searchtbody">

     </tbody>
    </table>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered" id="mainTable">
      <thead>
        <tr>
          <th>নাম</th>
          <th>যোগাযোগের নম্বর ও ইমেইল এড্রেস</th>
          <th>অফিস তথ্য</th>
          <th>পরিশোধ তথ্য</th>
          <th>ছবি</th>
          <th width="18%">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($applications as $application)
        <tr>
          <td>
            <a href="{{ route('dashboard.singleapplication', $application->unique_key) }}" title="আবেদনটি দেখুন">
              {{ $application->name_bangla }}<br/>{{ $application->name }}
            </a>
          </td>
          <td>{{ $application->mobile }}<br/>{{ $application->email }}</td>
          <td>{{ $application->office }}<br/>{{ $application->profession }} ({{ $application->designation }})</td>
          <td>৳ {{ $application->application_payment_amount }}<br/>{{ $application->application_payment_bank }} ({{ $application->application_payment_branch }})</td>
          <td>
            @if($application->image != null)
              <img src="{{ asset('images/users/'.$application->image)}}" style="height: 50px; width: auto;" />
            @else
              <img src="{{ asset('images/user.png')}}" style="height: 50px; width: auto;" />
            @endif
          </td>
          <td>
            <a class="btn btn-sm btn-success" href="{{ route('dashboard.singleapplication', $application->unique_key) }}" title="আবেদনটি দেখুন"><i class="fa fa-eye"></i></a>
            <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#sendToApplicationsFromDefectiveModal" data-backdrop="static" title="আবেদনের তালিকায় পাঠান"><i class="fa fa-fw fa-hourglass-o" aria-hidden="true"></i></a>
            <a class="btn btn-sm btn-primary" href="{{ route('dashboard.singleapplicationedit', $application->unique_key) }}" title="আবেদনটি সম্পাদনা করুণ"><i class="fa fa-edit"></i></a>
            {{-- <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteMemberModal{{ $application->id }}" data-backdrop="static"><i class="fa fa-trash-o"></i></button> --}}

            <!-- Send To Applications From Defective List Modal -->
            <!-- Send To Applications From Defective List Modal -->
            <div class="modal fade" id="sendToApplicationsFromDefectiveModal" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header modal-header-info">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-hourglass-o"></i> আবেদন তালিকায় প্রেরণ</h4>
                  </div>
                  <div class="modal-body">
                    আপনি কি এই আবেদনটি <b>আবেদন তালিকায়</b> পাঠাতে চান?
                  </div>
                  <div class="modal-footer">
                    {!! Form::model($application, ['route' => ['dashboard.makedefectivetopending', $application->id], 'method' => 'PATCH', 'class' => 'form-default']) !!}
                        {!! Form::submit('দাখিল করুন', array('class' => 'btn btn-info')) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">ফিরে যান</button>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
            <!-- Send To Applications From Defective List Modal -->
            <!-- Send To Applications From Defective List Modal -->
            
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div id="mainLink">
    {{ $applications->links() }}
  </div>
@stop

@section('js')
  <script>
    $(document).ready(function(){
     $('#searchTable').hide();
     function searchMember(query = '')
     {
      $.ajax({
       url:"{{ route('dashboard.defectiveapplicationsearchapi') }}",
       method:'GET',
       data:{query:query},
       dataType:'json',
       success:function(data)
       {
        $('#searchtbody').html(data.table_data);
        $('#total_records').text(data.total_data);
       }
      })
     }

     $(document).on('keyup', '#search', function(){
      var query = $(this).val();
      if(query.length == 0) {
        $('#searchTable').hide();
        $('#total_records').hide();
        $('#mainTable').show();
        $('#mainLink').show();
      } else {
        if(query.length < 5) {

        } else {
          $('#mainTable').hide();
          $('#mainLink').hide();
          $('#searchTable').show();
          $('#total_records').show();
          searchMember(query);
        }
      }
      
     });
    });
  </script>
@stop