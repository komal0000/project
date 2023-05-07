<div class="col-lg-4 pt-3">
    <div class="card shadow h-100">
      <div class="card-header">
        Caste Based Distribution
      </div>
        <ul class="list-group list-group-flush">
          <script>
              mapData(data.castes,data.caste_data).forEach(ele => {
                  document.write("<li class='list-group-item d-flex justify-content-between'><span>"+ele[0]+ "</span><span class='badge badge-primary'>"+ele[1]+"</span></li>")
              });
          </script>
        </ul>
        <div class="p-2">
            <canvas id="caste_data"></canvas>
        </div>
    </div>
  </div>

<script>
    datas['caste_data']=[];
    labels['caste_data']=[];
    mapData(data.castes,data.caste_data).forEach(ele => {
        datas['caste_data'].push(ele[1]);
        labels['caste_data'].push(ele[0]);
    })

   datasets['caste_data'] = {
    labels: labels['caste_data'],
    datasets: [{
      label: 'caste Distribution',
      backgroundColor:colors.slice(0,data.categories.length),
      data: datas['caste_data'],
    }]
  };

  
    configs['caste_data']={
        type: 'pie',
        data: datasets['caste_data'],
        hoverOffset: 4

  };

</script>