<html>
<head>
	<title>PO Pdf</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="../js/jspdf.min.js"></script>
	<style type="text/css">
		.container-fluid{
			font-size: 12px;
			margin: 5px;
			padding: 10px;
			/*border: 1px solid #000;*/
		}
	</style>
	<script>
	    function demoFromHTML() {
		    var pdf = new jsPDF('p', 'pt', 'letter');
		    // source can be HTML-formatted string, or a reference
		    // to an actual DOM element from which the text will be scraped.
		    source = $('.container')[0];

		    // we support special element handlers. Register them with jQuery-style 
		    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
		    // There is no support for any other type of selectors 
		    // (class, of compound) at this time.
		    specialElementHandlers = {
		        // element with id of "bypass" - jQuery style selector
		        '#bypassme': function (element, renderer) {
		            // true = "handled elsewhere, bypass text extraction"
		            return true
		        }
		    };
		    margins = {
		        top: 00,
		        bottom: 00,
		        left: 00,
		        width: 1000
		    };
		    // all coords and widths are in jsPDF instance's declared units
		    // 'inches' in this case
		    pdf.fromHTML(
		    source, // HTML string or DOM elem ref.
		    margins.left, // x coord
		    margins.top, { // y coord
		        'width': margins.width, // max width of content on PDF
		        'elementHandlers': specialElementHandlers
		    },

		    function (dispose) {
		        // dispose: object with X, Y of the last line add to the PDF 
 				pdf.save('Test.pdf');
 				}, margins);
			}
	</script>
</head>
<body>
	<div class="container">
		<table width="100%">
			<tr>
				<td>
					<img src="../img/neco.jpg" width="100px">
				</td>
				<td>
					<h3>JAYASWAL NECO INDUSTRIES LIMITED</h3>
					<p>
						Regd. Office : F-8, MIDC Industrial Area, Hingna Road, Nagpur - 400 016</br>
						PH : +91 7104 237276 / 237471, Fax : +91 7104 237583 / 236255</br>
						E-Mail: contact@necoindia.com website : www.necoindia.com
					</p>
				</td>
			</tr>
		</table>
	  </div>
	</div>
	<button onclick="javascript:demoFromHTML();">PDF</button>
</body>
</html>