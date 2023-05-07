<div class="col-lg-4 pt-3">
    <div class="card shadow h-100">
      <div class="card-header">
        Religion Based Distribution
      </div>
        <ul class="list-group list-group-flush">
          <script>
              mapData(data.religions,data.religion_data).forEach(ele => {
                  document.write("<li class='list-group-item d-flex justify-content-between'><span>"+ele[0]+ "</span><span class='badge badge-primary'>"+ele[1]+"</span></li>")
              });
          </script>
        </ul>
        <div class="p-2">
            <canvas id="religion_data"></canvas>
        </div>
    </div>
  </div>

<script>
    datas['religion_data']=[];
    labels['religion_data']=[];
    mapData(data.religions,data.religion_data).forEach(ele => {
        datas['religion_data'].push(ele[1]);
        labels['religion_data'].push(ele[0]);
    })

   datasets['religion_data'] = {
    labels: labels['religion_data'],
    datasets: [{
      label: 'religion Distribution',
      backgroundColor:colors.slice(0,data.categories.length),
      data: datas['religion_data'],
    }]
  };

  
    configs['religion_data']={
        type: 'pie',
        data: datasets['religion_data'],
        hoverOffset: 4

  };

</script>