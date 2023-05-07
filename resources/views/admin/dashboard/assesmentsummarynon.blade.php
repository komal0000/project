<div class="card shadow">
    <div class="card-header">Non Scholostic Assessment Summary Gradient</div>
    <div class="card-body">
        <div style="overflow-x: auto;">
            <canvas id="assessment_non_summary" ></canvas>
        </div>
    </div>
</div>


<script>
    labels['assessment_non_summary'] = [
       "Games And Sport",
       "library Activity",
       "Project Activity",
       "Modeling",
       "Visual and Performing Art"
    ];

    datasets['assessment_non_summary'] = {
        labels: labels['assessment_non_summary'],
        datasets: [{
            label: 'Average Assessment Percentile',
            data: datas_random(labels['assessment_non_summary'].length, [50, 75]),
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }, {
            label: 'Maximum Assessment Percentile',
            data: datas_random(labels['assessment_non_summary'].length, [80, 100]),
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            pointBackgroundColor: 'rgb(54, 162, 235)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(54, 162, 235)'
        }, {
            label: 'minimum Assessment Percentile',
            data: datas_random(labels['assessment_non_summary'].length, [30, 50]),
            fill: true,
            backgroundColor: 'rgba(253, 216, 0, 0.2)',
            borderColor: 'rgb(253, 216, 0)',
            pointBackgroundColor: 'rgb(253, 216, 0)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(253, 216, 0)'
        }]
    };


    configs['assessment_non_summary'] = {
        type: 'radar',
        data: datasets['assessment_non_summary'],
        options: {
           
        }
    };
</script>
