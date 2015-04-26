<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>HomePage</title>
	<link rel="stylesheet" type="text/css" href="javascript.fullPage.css" />

	<style>
		/* Reset CSS
		 * --------------------------------------- */
		body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,
		form,fieldset,input,textarea,p,blockquote,th,td {
		    padding: 0;
		    margin: 0;
		}
		a{
			text-decoration:none;
		}
		table {
		    border-spacing: 0;
		}
		fieldset,img {
		    border: 0;
		}
		address,caption,cite,code,dfn,em,strong,th,var {
		    font-weight: normal;
		    font-style: normal;
		}
		strong{
			font-weight: bold;
		}
		ol,ul {
		    list-style: none;
		    margin:0;
		    padding:0;
		}
		caption,th {
		    text-align: left;

		}
		h1,h2,h3,h4,h5,h6 {
		    font-weight: normal;
		    font-size: 100%;
		    margin:0;
		    padding:0;
		}
		q:before,q:after {
		    content:'';
		}
		abbr,acronym { border: 0;
		}


		/* Custom CSS
		 * --------------------------------------- */
		body{
			background-image: url(http://i.imgur.com/48wh8Ab.jpg);
			color: black;
			no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		h1{
			font-size: 6em;
		}
		p{
			font-size: 2em;
		}
		.content{
			position: relative;
			top: 50%;
			transform: translateY(-50%);
			text-align: center;
			background-color:rgba(255,255,255,0.5);
		}

		/* Section 2
		 * --------------------------------------- */
		#section1{
		}
		#section1 h1{
		}
		#section1 p{
			opacity: 0.8;
		}
	</style>
</head>
<body>


<div id="fullpage">
	<div class="section" id="section1">
		<div class="slide" id="slide1">
			<div class="content">
				<h1>Welcome to my Homepage</h1>
				<form>
				<p>Team Activities:
				<br>
				<a href="team0/testrun.html">Team Activity 0</a>
				</p>
				<br>
				<p>Assignments:
				<br>
				<a href="helloWorld.html">Hello World</a>
				<br>
				<a href="ls02/phpSurvey.html">PHP Survey</a>
				<br>
				<a href="ls04/phpDataBase.html">PHP Database Access</a>
				<br>
				<a href="ls05/phpDataBase.html">PHP Database Modification</a>
				<br>
				<a href="ls06/phpDataBase.html">Individual PHP Project</a>
				</p>
				<br>
				<p>The main reason I got this working is thanks to this site:
				<a href="http://alvarotrigo.com/fullPage/">alvarotrigo.com</a>
				</form>
			</div>
		</div>
		<div class="slide" id="slide2">
			<div class="content">
				<h1>Slides too!</h1>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="javascript.fullPage.js"></script>
<script type="text/javascript">
	fullpage.initialize('#fullpage', {
		anchors: ['into/assignments'],
		menu: '#menu',
		css3:true
	});
</script>

</body>
</html>
