@extends('admin.layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('admin/plugins/drophify/css/dropify.min.css')}}">
<style>
    .col-md-3{
        margin-bottom:10px;
    }
    .square{
        padding-bottom: 100%;
        position: relative;
    }
    .overlay{
        position: absolute;
        top:0px;
        left: 0px;
        right: 0px;
        bottom: 0px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        <a href="{{route('admin.exam.index')}}">Exams</a>
    </li>
    <li class="breadcrumb-item active">
        {{$exam->name}}
    </li>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <a target="_blank" href="{{route('admin.exam.subject.index',['exam'=>$exam->id])}}" class="btn-primary btn mr-2" >
                Manage Exam  Subjects
            </a>
            <hr>
            <table class="table " id="datatable">
                <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Academic Year
                        </th>
                        <th>
                            Start Date
                        </th>
                        <th>
                            End Date
                        </th>
                        <th></th>
                       
                        
                    </tr>
                </thead>
                <tbody>

                        <tr id="exam-{{$exam->id}}">
                            <td>
                                {{$exam->name}}
                            </td>
                            <td>
                                {{$exam->ac}}
                            </td>
                            <td>
                                {{$exam->start}}
                            </td>
                            <td>
                                {{$exam->end}}
                            
                            <td>
                                <a class="btn btn-table text-success" href="{{route('admin.exam.update',['exam'=>$exam->id])}}"><i class="material-icons">edit</i></a>
                                <span class="btn btn-table  text-danger" onclick="del({{$exam->id}})"><i class="material-icons">delete</i></span>
                            </td>
                        </tr>
                </tbody>
            </table>
            {{-- <hr> --}}
           
            {{-- <a href="" class="btn-primary btn mr-2" >
                Enter Marks Subjects
            </a> --}}
        </div>
        
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="col-md-2">
               
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="text-center">
                Marks Report By Percentile
            </h5>
            <div class="p-5" style="overflow-x: auto;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script  src="{{asset('admin/plugins/chartjs/chart.min.js')}}"></script>
<script>
    _data=[10,15,30,50,60,70,80,15,15,8];
    const labels = [
    '1st Percentile',
    '2nd Percentile',
    '3rd Percentile',
    '4th Percentile',
    '5th Percentile',
    '6th Percentile',
    '7th Percentile',
    '8th Percentile',
    '9th Percentile',
    '10th Percentile',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'No Of Student',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: _data,
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
@endsection
