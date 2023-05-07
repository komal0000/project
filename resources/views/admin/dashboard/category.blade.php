<div class="col-lg-4 pt-3">
    <div class="card shadow h-100">
      <div class="card-header">
        Category Based Distribution
      </div>
        <ul class="list-group list-group-flush">
          <script>
              mapData(data.categories,data.category_data).forEach(ele => {
                  document.write("<li class='list-group-item d-flex justify-content-between'><span>"+ele[0]+ "</span><span class='badge badge-primary'>"+ele[1]+"</span></li>")
              });
          </script>
        </ul>
        <div class="p-2">
            <canvas id="category_data"></canvas>
        </div>
    </div>
  </div>

<script>
    datas['category_data']=[];
    labels['category_data']=[];
    mapData(data.categories,data.category_data).forEach(ele => {
        datas['category_data'].push(ele[1]);
        labels['category_data'].push(ele[0]);
    })

   datasets['category_data'] = {
    labels: labels['category_data'],
    datasets: [{
      label: 'Category Distribution',
      backgroundColor:colors.slice(0,data.categories.length),
      data: datas['category_data'],
    }]
  };

  
    configs['category_data']={
        type: 'pie',
        data: datasets['category_data'],
        hoverOffset: 4

  };

</script>