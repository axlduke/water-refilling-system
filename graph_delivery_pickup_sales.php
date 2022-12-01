<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="graph/jquery.js"></script>
		<script type="text/javascript">
$(function () {
    // On document ready, call visualize on the datatable.
    $(document).ready(function() {

        Highcharts.visualize = function(table, options) {
            // the categories
            options.xAxis.categories = [];
            $('tbody th', table).each( function(i) {
                options.xAxis.categories.push(this.innerHTML);
            });
    
            // the data series
            options.series = [];
            $('tr', table).each( function(i) {
                var tr = this;
                $('th, td', tr).each( function(j) {
                    if (j > 0) { // skip first column
                        if (i == 0) { // get the name and init the series
                            options.series[j - 1] = {
                                name: this.innerHTML,
                                data: []
                            };
                        } else { // add values
                            options.series[j - 1].data.push(parseFloat(this.innerHTML));
                        }
                    }
                });
            });
    
            var chart = new Highcharts.Chart(options);
        }
    
        var table = document.getElementById('datatable'),
        options = {
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Sales report: Delivery over Pickup Year: <?php echo date("Y");?>'
            },
            xAxis: {
            },
            yAxis: {
                title: {
                    text: 'Total Sales'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                         this.x.toUpperCase() +': Php '+ this.y;
                }
            }
        };
    
        Highcharts.visualize(table, options);
    });
    
});
		</script>
	</head>
	<body>
		<script src="graph/highcharts.js"></script>
		<script src="graph/exporting.js"></script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

<table id="datatable">
	<thead>
		<tr>
			<th></th>
			<th>Delivery</th>
			<th>Pick-up</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>MAY</th>
			<td>3000.00</td>
			<td>4000.00</td>
		</tr>
		<tr>
			<th>JUNE</th>
			<td>2000.00</td>
			<td>0</td>
		</tr>
		<tr>
			<th>JULY</th>
			<td>500</td>
			<td>1120</td>
		</tr>
		
	</tbody>
</table>
	</body>
</html>
