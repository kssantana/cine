<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="includes/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="includes/css/customnex.css" rel="stylesheet" type="text/css" media="all" />
<link href="includes/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
<link href="includes/css/iconbt.css" rel="stylesheet" type="text/css" media="all" />
<link href="includes/css/iconic.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="includes/js/bootstrap.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
#container, #sliders {
	min-width: 310px; 
	max-width: 800px;
	margin: 0 auto;
}
#container {
	height: 400px; 
}
		</style>
		<script type="text/javascript">
$(function () {
    // Set up the chart
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },
        title: {
            text: 'Chart rotation demo'
        },
        subtitle: {
            text: 'Test options by dragging the sliders below'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [{
            data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
        }]
    });

    function showValues() {
        $('#R0-value').html(chart.options.chart.options3d.alpha);
        $('#R1-value').html(chart.options.chart.options3d.beta);
    }

    // Activate the sliders
    $('#R0').on('change', function () {
        chart.options.chart.options3d.alpha = this.value;
        showValues();
        chart.redraw(false);
    });
    $('#R1').on('change', function () {
        chart.options.chart.options3d.beta = this.value;
        showValues();
        chart.redraw(false);
    });

    showValues();
});
		</script>
</head>
<body>
<script src="hcgraf/js/highcharts.js"></script>
<script src="hcgraf/js/highcharts-3d.js"></script>
<script src="hcgraf/js/modules/exporting.js"></script>

<div id="container"></div>
<div id="sliders">

</div>
</body>
</html>