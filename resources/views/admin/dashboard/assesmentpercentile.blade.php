<div class="card shadow mt-4">
    <div class="card-header">
      Student Grade Percentile Summary
    </div>
    <div class="card-body">
      <div  style="overflow-x: auto;" >
          <canvas id="assessment_percentile" ></canvas>
      </div>
    </div>
</div>


<script>
datas['assessment_percentile']=[10,15,30,50,60,70,83,15,15,8];
labels['assessment_percentile']= [
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

datasets['assessment_percentile'] = {
    labels: labels['assessment_percentile'],
    datasets: [{
        label: ' Student Grade Percentile',
        backgroundColor:colors[10],
        data: datas['assessment_percentile'],
    }]
};


configs['assessment_percentile']={
    type: 'bar',
    data: datasets['assessment_percentile'],
    options:{}
};

</script>