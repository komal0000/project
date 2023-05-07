<div class="card shadow">
    <div class="card-header">Student Assessment Summary Gradient</div>
    <div class="card-body">
        <div style="overflow-x: auto;">
            <canvas id="assessment_summary" ></canvas>
        </div>
    </div>
</div>


<script>
    labels['assessment_summary'] = [
        @foreach (\App\Data::assesments as $assesment)
            @foreach ($assesment['options'] as $option)
                "{{ $option[0] }}",
            @endforeach
        @endforeach
    ];

    datasets['assessment_summary'] = {
        labels: labels['assessment_summary'],
        datasets: [{
            label: 'Average Assessment Percentile',
            data: datas_random(labels['assessment_summary'].length, [50, 75]),
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }, {
            label: 'Maximum Assessment Percentile',
            data: datas_random(labels['assessment_summary'].length, [80, 100]),
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            pointBackgroundColor: 'rgb(54, 162, 235)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(54, 162, 235)'
        }, {
            label: 'minimum Assessment Percentile',
            data: datas_random(labels['assessment_summary'].length, [30, 50]),
            fill: true,
            backgroundColor: 'rgba(253, 216, 0, 0.2)',
            borderColor: 'rgb(253, 216, 0)',
            pointBackgroundColor: 'rgb(253, 216, 0)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(253, 216, 0)'
        }]
    };


    configs['assessment_summary'] = {
        type: 'radar',
        data: datasets['assessment_summary'],
        options: {
           
        }
    };
</script>
