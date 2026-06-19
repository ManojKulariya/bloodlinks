<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<style>canvas {
    max-width: 100%;  /* Allow the chart to scale with the container */
    height: auto;     /* Ensure the height is responsive */
}</style>
<section class="content-header">
    <div class="container">
        <div class="timeline">
            <div class="card">
                <div class="card-body">
                    <?php if($_SESSION['admin_type'] != 5){ ?>
                    <div style="margin-bottom:20px;">
                        <lable>Select BloodBank</lable> 
                        <select  id="bloodBankSelect" style="margin-left:25px;">
                            <?php foreach($bloodbank as $row): ?>
                                <option value="<?= $row['blood_bank_id'] ?>" data-name="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- Display the selected blood bank -->
                    <h6 id="bloodBankNameLabel" style="color: blue;margin-top:5px;"></h6>

                    </div>
                    <?php } ?>
                    

                    <div class="container-fluid pb-3">
                        <div class="row">
                            <div class="col-lg-8">
                                <h4>Blood Stocks</h4><br>
                                <canvas id="myBarChart"></canvas>
                            </div>
                            <div class="col-lg-4">
                                <h4>Blood Request </h4><br>
                                <canvas id="myPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</section>
<?php if($_SESSION['admin_type'] != 5){ ?>
<!--<section class="content" style="margin-top:-25px;">-->
<!--        <div class="container-fluid">-->

<!--          <div class="row">-->
<!--            <div class="col-lg-3 col-6">-->

<!--              <div class="small-box bg-info">-->
<!--                <div class="inner">-->
<!--                  <h3><?= $hospital ?></h3>-->
<!--                  <p>Hospitals</p>-->
<!--                </div>-->
<!--                <div class="icon">-->
<!--                    <i class="fa-solid fa-hospital"></i>-->
<!--                </div>-->
<!--                <a href="<?php echo base_url('admin/hospitals')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="col-lg-3 col-6">-->

<!--              <div class="small-box bg-success">-->
<!--                <div class="inner">-->
<!--                  <h3><?= count($bloodbank) ?></h3>-->
<!--                  <p>Blood Bank</p>-->
<!--                </div>-->
<!--                <div class="icon">-->
<!--                  <i class="fa-solid fa-droplet"></i>-->
<!--                </div>-->
<!--                <a href="<?php echo base_url('admin/bloodbanks')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="col-lg-3 col-6">-->

<!--              <div class="small-box bg-warning">-->
<!--                <div class="inner">-->
<!--                  <h3><?= $labs ?></h3>-->
<!--                  <p>Labs</p>-->
<!--                </div>-->
<!--                <div class="icon">-->
<!--                  <i class="fa-solid fa-vials"></i>-->
<!--                </div>-->
<!--                <a href="<?php echo base_url('admin/labs')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
<!--              </div>-->
<!--            </div>-->


<!--          </div>-->


<!--        </div>-->
<!--      </section>-->
<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    var selectedBloodBankId = $('#bloodBankSelect').val()
    let selectedBloodBankName = $('#bloodBankSelect option:selected').data('name');  // Get selected blood bank name

    $('#bloodBankNameLabel').text("Showing data for :" + selectedBloodBankName);

    Getdata(selectedBloodBankId);
    $('#bloodBankSelect').change(function() {
      var selectedBloodBankId = $(this).val()
      let selectedBloodBankName = $('#bloodBankSelect option:selected').data('name');  // Get selected blood bank name

      $('#bloodBankNameLabel').text("Showing data for " + selectedBloodBankName);

        Getdata(selectedBloodBankId);  
    });
});
// Initial data from PHP
let initialData = <?php echo json_encode($BloodStock); ?>;

// Extract component data for charts
let componentLabels = ['Whole Blood', 'FFP', 'RDP/SDP','RBC/Packed Cell'];
let componentData = [
    initialData[0].whole_blood_unit_count,
    initialData[0].Fresh_Frozen_Plasma_unit_count,
    initialData[0].Red_blood_cell_unit_count,
    initialData[0].Platelet_rich_concentrate_unit_count
];
let totalComponentCount = initialData[0].total_component_count;

// Bar Chart
const barCtx = document.getElementById('myBarChart').getContext('2d');
let myBarChart = new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: componentLabels,
        datasets: [{
            label: 'Component Units',
            data: componentData,
            backgroundColor: createBarGradient(barCtx),
            hoverBackgroundColor: 'rgba(54, 162, 235, 0.9)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            borderRadius: 10,
            hoverBorderWidth: 3,
            hoverBorderColor: 'rgba(153, 102, 255, 1)',
            barPercentage: 0.5,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Total Components Count: ' + totalComponentCount,
                font: { size: 18 },
                color: '#333',
                padding: { top: 10, bottom: 30 }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                bodyFont: { size: 13 }
            },
            datalabels: {
                color: 'blue',  // Set the color of the data labels to red
                anchor: 'end',
                align: 'end',
                formatter: (value, context) => {
                    return value > 0 ? value : ''; // Display the value only if it's greater than 0
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#ddd', borderDash: [5, 5] },
                ticks: { color: '#555', font: { size: 13 } }
            },
            x: {
                grid: { display: false },
                ticks: { color: '#555', font: { size: 13 } }
            }
        },
        animation: { duration: 1500, easing: 'easeInOutBounce' }
    },
    plugins: [ChartDataLabels] // Include the plugin here
});
// Pie Chart
const pieCtx = document.getElementById('myPieChart').getContext('2d');
let myPieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['Whole Blood', 'FFP', 'RBC/Packed Cell', 'RDP/SDP'], // Labels in the correct order
        datasets: [{
            label: 'Component Units',
            data: componentData,
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',   // Color for Whole Blood
                'rgba(54, 162, 235, 0.8)',   // Color for FFP
                'rgba(255, 206, 86, 0.8)',   // Color for RBC/Packed Cell
                'rgba(75, 192, 192, 0.8)'    // Color for RDP/SDP
            ],
            hoverOffset: 22,
            hoverBorderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: getPieChartOptions()  // Ensure the options are configured properly
});

// Event Listener for Dropdown Change
function Getdata(selectedBloodBankId){
    var url = '<?php echo $base_url; ?>/overview_get';
    $.ajax({
        url: url, // Replace with your actual controller method URL
        method: 'POST',
        data: { blood_bank_id: selectedBloodBankId },
        success: function(response) {
         
           let BloodIssued = JSON.parse(response)['BloodIssued'];
             console.log('response->'+response);
           if (!BloodIssued || BloodIssued.length === 0) {
                clearChartsBloodIssued();
            }else{
                updateBloodIssuedCharts(BloodIssued);
            }
         
            // Assuming 'response' returns the new data for the blood bank
            let updatedData = JSON.parse(response)['BloodStock'][0];
            if (!updatedData || updatedData.length === 0) {
                clearCharts();
            }else{
                updateCharts(updatedData);
            }
            
        }
    });
}
function clearCharts() {
    // Clear bar chart data
    myBarChart.data.datasets[0].data = [0, 0, 0, 0];
    myBarChart.options.plugins.title.text = 'Total Components Count: 0';
    myBarChart.update();
}
function clearChartsBloodIssued() {
    // Clear pie chart data
    myPieChart.data.datasets[0].data = [0, 0, 0, 0];
    myPieChart.update();
}


function updateCharts(data) {
    let updatedComponentData = [
        data.whole_blood_unit_count,
        data.Fresh_Frozen_Plasma_unit_count,
        data.Red_blood_cell_unit_count,
        data.Platelet_rich_concentrate_unit_count
    ];

    let updatedTotalComponentCount = data.total_component_count;
    // Update Bar Chart
    myBarChart.data.datasets[0].data = updatedComponentData;
    myBarChart.options.plugins.title.text = 'Total Components Count: ' + updatedTotalComponentCount;
    myBarChart.update();

}

function updateBloodIssuedCharts(data) {
    let updatedComponentData = [
        parseInt(data.whole_blood_unit_count),                // Whole Blood
        parseInt(data.Fresh_Frozen_Plasma_unit_count),        // FFP
        parseInt(data.Platelet_rich_concentrate_unit_count),  // RBC/Packed Cell
        parseInt(data.Red_blood_cell_unit_count)              // RDP/SDP
    ];

    // Update Pie Chart with correct labels and data
    myPieChart.data.datasets[0].data = updatedComponentData;
    myPieChart.update();
}



// Helper functions
function createBarGradient(ctx) {
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(75, 192, 192, 1)');
    gradient.addColorStop(1, 'rgba(153, 102, 255, 0.6)');
    return gradient;
}

function createPieGradients(ctx) {
    const gradient1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradient1.addColorStop(0, 'rgba(255, 99, 132, 1)');
    gradient1.addColorStop(1, 'rgba(255, 159, 64, 0.7)');

    const gradient2 = ctx.createLinearGradient(0, 0, 0, 300);
    gradient2.addColorStop(0, 'rgba(54, 162, 235, 1)');
    gradient2.addColorStop(1, 'rgba(75, 192, 192, 0.7)');

    const gradient3 = ctx.createLinearGradient(0, 0, 0, 300);
    gradient3.addColorStop(0, 'rgba(255, 205, 86, 1)');
    gradient3.addColorStop(1, 'rgba(153, 102, 255, 0.7)');

    const gradient4 = ctx.createLinearGradient(0, 0, 0, 300);
    gradient4.addColorStop(0, 'rgba(75, 192, 192, 1)');
    gradient4.addColorStop(1, 'rgba(255, 99, 132, 0.7)');

    return [gradient1, gradient2, gradient3, gradient4];
}

function getBarChartOptions(total) {
    return {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Total Components Count: ' + total,
                font: { size: 18 },
                color: '#333',
                padding: { top: 10, bottom: 30 }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                bodyFont: { size: 13 }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#ddd', borderDash: [5, 5] },
                ticks: { color: '#555', font: { size: 13 } }
            },
            x: {
                grid: { display: false },
                ticks: { color: '#555', font: { size: 13 } }
            }
        },
        animation: { duration: 1500, easing: 'easeInOutBounce' }
    };
}

function getPieChartOptions() {
    return {
        responsive: true,
        plugins: {
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#fff',
                bodyColor: '#fff',
                bodyFont: { size: 12 }
            },
            title: {
                display: true,
                text: 'Blood Request Count',
                font: { size: 18 },
                color: '#333',
                padding: { top: 10, bottom: 20 }
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: { color: '#555', font: { size: 13 } }
            }
        },
        animation: { duration: 1500, easing: 'easeInOutBounce' }
    };
}
</script>
