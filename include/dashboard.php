		<div id="content" "="">
	<h2>Dashboard <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">

	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Introduction</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 100px; padding: 0px; position: relative;">
				<p>Hi <?php echo $chauser; ?> <br>Student Academic Record Information System is an Open Source system based on the Google Cloud Technology for Managing and administrating students in a higher academic institution, it has extensive modules, from admission, examination, to integration with major Finance packages, Library Packages and Elearning platforms Like Moodle</p>
				
				</div>
				
		</div>
	</div>
	<!-- // Intro Message END -->
	<?php
	
	switch($module)
	{
		case 3 :
			studentindex($username);
			break;
		case 8 :
			admino_o();
			break;
		default :
			
			break;
			
	}
	
	?>
	<br>
	
	<div class="tickertape">
		<strong class="title">News Flash</strong>
		<span class="marquee">
			<span><strong>Examination Results Out</strong> Year one and Year two examination Out..</span>
			<span><Strong>Supplimentary Dates </strong>Students writing supplementary should get on campus by 30th October 2013</span>
		</span>
	</div>
	
	
	<div class="separator bottom"></div>
	
</div>

