@extends('admin.layout.app')
@section('css')
  <style>
    .nav>.nav-item>.nav-link{
      padding: 10px 25px;
      border-radius: 10px!important;
      font-size: 25px;
      font-weight: 700;
      color: #6C757D;

    }
    .nav>.nav-item>.nav-link.active{
      color: #5FD0A5;
      border:1px #5FD0A5 solid;
    }
    .nav-tabs{
      border-bottom: none;
      cursor: pointer;

    }
    .nav-tabs>.nav-item{
      flex:1;
      text-align: center;
    }
    .tab-show{
      height: 0px;
      transition: 1s all;
    }
    .tab-show.active{
      height: auto;
    }
  </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    
@endsection
@section('content')
<script>
   const _data={!!json_encode($data)!!};
  var data=getDataSpecific(_data,['caste_data','religions','castes','religion_data','category_data','categories']);
  var datas=[];
  var labels=[];
  var configs=[];
  var datasets=[];
  var colors =['#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', 
		  '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',
		  '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', 
		  '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
		  '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', 
		  '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
		  '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', 
		  '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933',
		  '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', 
		  '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF'];

    //random number array generator
      datas_random=function(num,range){
        let d=[];
        distance=range[1]-range[0];
        for (let index = 0; index < num; index++) {
            d.push(range[0]+(Math.floor(Math.random() * distance)));
        }
        return d;
    };
</script>

<div class="row stats-row">
  @include('admin.dashboard.card',['count'=>233,'icon'=>'history_edu','title'=>'Scholastic Score'])
  @include('admin.dashboard.card',['count'=>237,'icon'=>'history_edu','title'=>'Non Scholastic Score'])
  @include('admin.dashboard.card',['count'=>235,'icon'=>'history_edu','title'=>'Median School Score'])
  @include('admin.dashboard.card',['count'=>mt_rand(1,45),'icon'=>'arrow_upward','title'=>'School Position'])
</div>
<hr>
<div class="row stats-row">
  @include('admin.dashboard.card',['count'=>$data->students,'icon'=>'perm_identity','title'=>'Student Count'])
  @include('admin.dashboard.card',['count'=>$data->employees,'icon'=>'supervisor_account','title'=>'Staff Count'])
  @include('admin.dashboard.card',['count'=>135,'icon'=>'supervisor_account','title'=>'Average Assessment Point'])
  @include('admin.dashboard.card',['count'=>(int)$data->attendance,'icon'=>'supervisor_account','title'=>'Average Attendance'])
</div>
<hr>
<div class="row stats-row">
  @include('admin.dashboard.card',['count'=>$data->bpl,'icon'=>'supervisor_account','title'=>'Students Below Poverty Line'])
  @include('admin.dashboard.card',['count'=>$data->handicapped,'icon'=>'supervisor_account','title'=>'Handicapped Students'])
  @include('admin.dashboard.card',['count'=>$data->mentally_chalanged,'icon'=>'supervisor_account','title'=>'Mentally Chalanged Students'])
  @include('admin.dashboard.card',['count'=>$data->genetic_disorder,'icon'=>'supervisor_account','title'=>'Student With Genetic Disorder'])
</div>
@include('admin.dashboard.attendance')
<div class="row">
  {{-- @include('admin.dashboard.category') --}}
  {{-- @include('admin.dashboard.religion')
  @include('admin.dashboard.caste') --}}
</div>
{{-- <div>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#scholastic"  >
          Scholastic Record
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#non-scholastic" >NonScholastic Record</a>
      </li>
    </ul>
</div>
<div id="scholastic" class="tab-show">
  sadfasfsda asdfasdfas
</div>
<div id="non-scholastic" class="tab-show">
  asd sdfasdf asdfasdf asdfsd
</div> --}}


    {{-- <div class="bg-white shadow mb-3">
      <h4 class="card-header card-title bg-white">
        Scholastic Record
      </h4>
      <div class="card-body">
        @include('admin.dashboard.assesmentpercentile')
        @include('admin.dashboard.assesmentsummary')
      </div>
    </div> --}}

{{--   
    <div class="bg-white shadow">
      <h4 class="card-header card-title bg-white">
        Non Scholastic Record
      </h4>
      <div class="card-body">
        <div class="row">
          <div class="col-md-9">

          </div>
          <div class="col-md-3">
            
          </div>
        </div>

      </div>
    </div> --}}
 
    <style>
      #data11 a.active {
        border: none;
        border-radius: 0px;
          border-bottom: 2px solid #55c57a
      }

      #data11 .nav-link {
          color: rgb(110, 110, 110);
          font-weight: 500;
          border-radius: 0px !important;

      }

      .nav-link:hover {
          color: #55c57a
      }

      #data11 .nav-pills .nav-link.active {
          color: black;
          background-color: white;
          border-radius: 0.5rem 0.5rem 0 0;
          font-weight: 600
      }

      #data11 .tab-content {
          /* padding-bottom: 1.3rem */
      }
      #data11.card {
          padding: 0;
          border: none;
          border-radius: 0.5rem
      }

      #data11 .nav-pills{
        display: flex;
        justify-content: space-evenly;
      }
    </style>
    <div id="data11" class="container card shadow mt-5">
      <!-- nav options -->
      <ul class="nav nav-pills mb-3 shadow-sm" id="pills-tab" role="tablist">
          <li class="nav-item"> <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-sc" role="tab" aria-controls="pills-home" aria-selected="true">Scholastic Module Sumary</a> </li>
          <li class="nav-item"> <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-nonsc" role="tab" aria-controls="pills-profile" aria-selected="false">Non Scholastic Module Summary</a> </li>
      </ul> <!-- content -->
      <div class="tab-content" id="pills-tabContent p-3">
          <!-- 1st card -->
          <div class="tab-pane fade show active p-2" id="pills-sc" role="tabpanel" aria-labelledby="pills-home-tab">
            @include('admin.dashboard.assesmentpercentile')
            @include('admin.dashboard.assesmentsummary')
          </div> <!-- 2nd card -->
          <div class="tab-pane fade p-2" id="pills-nonsc" role="tabpanel" aria-labelledby="pills-profile-tab">
            @include('admin.dashboard.assesmentsummarynon')

          </div> <!-- 3nd card -->
          
      </div>
  </div>




@endsection 
@section('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js" integrity="sha256-Y26AMvaIfrZ1EQU49pf6H4QzVTrOI8m9wQYKkftBt4s=" crossorigin="anonymous"></script>
<script>
 
  console.log(mapData(data.religions,data.religion_data));
  console.log(data);
  var year,month,day;
  var curdate;
  var cardData;
  $(function () {
      date=new Date();
      year=date.getFullYear();
      month=date.getMonth()+1;
      day=date.getDate();
      curdate=year+'-'+(month<10?('0'+month):month)+'-'+(day<10?('0'+day):day);
      console.log(curdate);
      axios.post('{{route('admin.dashboard.index')}}',{
        today:curdate
      })
      .then((res)=>{
        cardData=res.data.cardData;
      })

      for (const key in configs) {
          if (Object.hasOwnProperty.call(configs, key)) {
            const config = configs[key];
            new Chart(
            document.getElementById(key),
            config
          );
        }
      }
  });

//     _data_assessment=[10,15,30,50,60,70,80,15,15,8];
//     const labels = [
//     '1st Percentile',
//     '2nd Percentile',
//     '3rd Percentile',
//     '4th Percentile',
//     '5th Percentile',
//     '6th Percentile',
//     '7th Percentile',
//     '8th Percentile',
//     '9th Percentile',
//     '10th Percentile',
//   ];

//   const data_assessment = {
//     labels: labels,
//     datasets: [{
//       label: 'No Of Student',
//       backgroundColor: 'rgb(255, 99, 132)',
//       borderColor: 'rgb(255, 99, 132)',
//       data: _data_assessment,
//     }]
//   };

//   const config = {
//     type: 'bar',
//     data: data_assessment,
//     options: {
//       indexAxis: 'y',
//     }
//   };

//   const myChart = new Chart(
//     document.getElementById('myChart'),
//     config
//   );

//     const _label_assesment=[
//       @foreach (\App\Data::assesments as $assesment)
//         @foreach ($assesment['options'] as $option)
//             "{{$option[0]}}",
//         @endforeach
//       @endforeach
//     ];

//     _data_assessment_single=function(){
//       let d=[];
//       for (let index = 0; index < 20; index++) {
//           d.push(Math.floor(Math.random() * 100));
//       }
//       return d;
//     };

//     const _data_assessment_new = {
//     labels: _label_assesment,
//     datasets: [{
//       label: 'Average Percentile',
//       backgroundColor: 'rgb(255, 99, 132)',
//       borderColor: 'rgb(255, 99, 132)',
//       data:_data_assessment_single(),
//     },{
//       label: 'Max Percentile',
//       backgroundColor: '#0062AC',
//       borderColor: 'rgb(255, 99, 132)',
//       data:_data_assessment_single(),
//     }]
//   };

//     const config_assessment = {
//       type: 'horizontalBar',
//       data: _data_assessment_new,
//       options: {}
//     };
//     const myChart1 = new Chart(
//     document.getElementById('myChart1'),
//     config_assessment
//   );
//     console.log(_data_assessment_single(),_label_assesment,'single');
  
 </script>
@endsection
