@extends('layouts.app') 
@section('content') 
@include('blocks.sub-header')
@include('blocks.left-menu') 
<!-- Edit form -->
<div class="center-content-area table-set">




    <div class="table-responsive">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    
    

    <table class="table">
            <tbody class="table">
                <thead>
                    </tr>
                    <tr>
                        
                        <th>Ranking</th>
                        <th>User Name</th>
                        <th>Level</th>
                        <th>Regular Points</th>
                        <th>Super Points</th>

                    </tr>
                </thead>
                <?php $a = 1; ?>
                @if(count($reports)) 

                @foreach ($reports as $report)
                <tr>
                    <th>{{ $a }}</th>
                    <td>{{ $report->username }}</td>
                    <td>@if(empty($report->user_level)) 1 @else {{$report->user_level}} @endif</td>
                    <td>{{ $regular_points[$report->user_id] }}</td>
                    <td><?php echo floor($regular_points[$report->user_id]/100); ?></td>
                                        
                    
                </tr>
                <?php $a++?>
                @endforeach @else
                <tr>
                    <th colspan="6" class="error">No results found</th>
                </tr>
                @endif
                
            </tbody>
        </table>
        
    
    </div>
    
   
</div>
@endsection @section('js_libraries')
<script type="text/javascript" src="{{ asset('js/report.js')}}"></script>
@endsection