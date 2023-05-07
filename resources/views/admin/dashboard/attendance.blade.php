<div class="card shadow mt-4">
    <div class="card-header" id="month-name">
        
    </div>
    <div class="card-body">
        <div style="overflow-x: auto;">
            <canvas id="attendance"></canvas>
        </div>
    </div>
</div>


<script>
    var monthNames = [
        "January", "February", "March",
        "April", "May", "June",
        "July", "August", "September",
        "October", "November", "December"
    ];
    var dt = new Date();
    var month = dt.getMonth();
    var year = dt.getFullYear();
    var daysInMonth = new Date(year, month, 0).getDate();
    datas['attendance'] = [];
    for (let index = 0; index < daysInMonth; index++) {
        const element = daysInMonth;
        datas['attendance'].push(420 + (Math.floor(Math.random() * 100)));
    }
    labels['attendance'] = [];
    mname = monthNames[month];
    document.getElementById('month-name').innerHTML ="Student Attendance for "+ mname;
    for (let index = 1; index <= daysInMonth; index++) {
        labels['attendance'].push(mname + " " + index);

    }
    datasets['attendance'] = {
        labels: labels['attendance'],
        datasets: [{
            label: ' Student Attendance',
            backgroundColor: colors[10],
            data: datas['attendance'],
            
        }]
    };


    configs['attendance'] = {
        type: 'bar',
        data: datasets['attendance'],
        options: {
            scales: {
                y: {
                    min: 0,
                }
            }
        }
    };
</script>
