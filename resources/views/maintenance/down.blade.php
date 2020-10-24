<!DOCTYPE html>
<html lang="en">
<head>
	<title>Coming Soon 12</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/mantenimiento/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/mantenimiento/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/mantenimiento/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/mantenimiento/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/mantenimiento/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/mantenimiento/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/mantenimiento/css/util.css">
	<link rel="stylesheet" type="text/css" href="/mantenimiento/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
	<!-- Bootstrap --><link rel="stylesheet" href="/css/bootstrap.css">
<!--===============================================================================================-->

<style media="screen">
.container {max-width: 1200px;}


/*//////////////////////////////////////////////////////////////////
[ Form ]*/
.contact100-form {
max-width: 100%;
}
/*------------------------------------------------------------------
[ Input ]*/

.wrap-input100 {
width: 500px;
max-width: 100%;
position: relative;
background-color: transparent;
height: 80px;
}

/*---------------------------------------------*/
.input100 {
display: block;
width: 100%;
height: 100%;
padding: 0 90px 0 35px;
background-color: #fff;

box-shadow: 0 10px 15px 0px rgba(0,0,0,0.1);
-moz-box-shadow: 0 10px 15px 0px rgba(0,0,0,0.1);
-webkit-box-shadow: 0 10px 15px 0px rgba(0,0,0,0.1);
-o-box-shadow: 0 10px 15px 0px rgba(0,0,0,0.1);
-ms-box-shadow: 0 10px 15px 0px rgba(0,0,0,0.1);
}

.input100:focus {
box-shadow: 0 10px 15px 0px rgba(0,0,0,0.2);
-moz-box-shadow: 0 10px 15px 0px rgba(0,0,0,0.2);
-webkit-box-shadow: 0 10px 15px 0px rgba(0,0,0,0.2);
-o-box-shadow: 0 10px 15px 0px rgba(0,0,0,0.2);
-ms-box-shadow: 0 10px 15px 0px rgba(0,0,0,0.2);
}


/*------------------------------------------------------------------
[ Alert validate ]*/

.validate-input {
position: relative;
}

.alert-validate::before {
content: attr(data-validate);
position: absolute;
max-width: 70%;
background-color: #fff;
border: 1px solid #c80000;
border-radius: 0px;
padding: 4px 25px 4px 10px;
top: 50%;
-webkit-transform: translateY(-50%);
-moz-transform: translateY(-50%);
-ms-transform: translateY(-50%);
-o-transform: translateY(-50%);
transform: translateY(-50%);
right: 82px;
pointer-events: none;

font-family: Poppins-Medium;
color: #c80000;
font-size: 14px;
line-height: 1.4;
text-align: left;

visibility: hidden;
opacity: 0;

-webkit-transition: opacity 0.4s;
-o-transition: opacity 0.4s;
-moz-transition: opacity 0.4s;
transition: opacity 0.4s;
}

.alert-validate::after {
content: "\f071";
font-family: FontAwesome;
display: block;
position: absolute;
color: #c80000;
font-size: 14px;
top: 50%;
-webkit-transform: translateY(-50%);
-moz-transform: translateY(-50%);
-ms-transform: translateY(-50%);
-o-transform: translateY(-50%);
transform: translateY(-50%);
right: 88px;
}

.alert-validate:hover:before {
visibility: visible;
opacity: 1;
}

@media (max-width: 992px) {
.alert-validate::before {
  visibility: visible;
  opacity: 1;
}
}


/*//////////////////////////////////////////////////////////////////
[ Simple slide100 ]*/
.simpleslide100-parent {
position: relative;
z-index: 1;
}

.simpleslide100 {
display: block;
position: absolute;
z-index: -1;
width: 100%;
height: 100%;
top: 0;
left: 0;
}

.simpleslide100-item {
display: block;
position: absolute;
width: 100%;
height: 100%;
top: 0;
left: 0;
}



/*==================================================================
  TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT
==================================================================*/

/*==================================================================
[ Color ]*/
.cl0 {color: #fff;}
.cl1 {color: #333;}




/*//////////////////////////////////////////////////////////////////
[ S-Text 0 - 15 ]*/

/*---------------------------------------------*/
.s2-txt1 {
font-family: Poppins-Medium;
font-size: 15px;
color: #333;
line-height: 1.2;
}



/*//////////////////////////////////////////////////////////////////
[ M-Text 16 - 25 ]*/

/*---------------------------------------------*/
.m2-txt1 {
font-family: Poppins-Regular;
font-size: 24px;
color: #999;
line-height: 1.2;
}



/*//////////////////////////////////////////////////////////////////
[ L-Text >= 26 ]*/
.l1-txt1 {
font-family: PlayfairDisplay-BlackItalic;
font-size: 90px;
color: #333;
line-height: 1.1;
}


/*==================================================================
 SHAPE SHAPE SHAPE SHAPE SHAPE SHAPE SHAPE SHAPE SHAPE SHAPE SHAPE
==================================================================*/
/*//////////////////////////////////////////////////////////////////
[ Size ]*/
.size1 {
width: 100%;
min-height: 100vh;
}

.size2 {
width: 90px;
height: 80px;
}

.size3 {
width: 36px;
height: 36px;
}

/*//////////////////////////////////////////////////////////////////
[ Width ]*/
.wsize1 {
width: 50%;
}

.wsize2 {
max-width: 100%;
}

/*//////////////////////////////////////////////////////////////////
[ Height ]*/




/*//////////////////////////////////////////////////////////////////
[ Background ]*/
.bg0 {background-color: #fff;}

.bg-img1 {
background-position: center;
background-repeat: no-repeat;
background-size: cover;
}




/*//////////////////////////////////////////////////////////////////
[ Border ]*/





/*==================================================================
 WHERE WHERE WHERE WHERE WHERE WHERE WHERE WHERE WHERE WHERE WHERE
==================================================================*/




/*==================================================================
HOW HOW HOW HOW HOW HOW HOW HOW HOW HOW HOW HOW HOW HOW HOW HOW HOW
==================================================================*/
.placeholder0::-webkit-input-placeholder { color: #999999;}
.placeholder0:-moz-placeholder { color: #999999;}
.placeholder0::-moz-placeholder { color: #999999;}
.placeholder0:-ms-input-placeholder { color: #999999;}


/*---------------------------------------------*/
.overlay1 {
position: relative;
z-index: 1;
}
.overlay1::after {
content: "";
display: block;
position: absolute;
z-index: -1;
width: 100%;
height: 100%;
top: 0;
left: 0;
background: rgba(0,0,0,0.5);
}

/*---------------------------------------------*/
.wrappic1 {
display: block;
}

.wrappic1 img {
max-width: 100%;
}

/*---------------------------------------------*/
.how-btn1 {
padding: 0 15px;
background-color: #fff;
border-radius: 25px;
}

.how-btn1:hover {
background-color: #555555;
color: #fff;
}

/*---------------------------------------------*/
.how-social {
color: #fff;
font-size: 22px;
background-color: #ccc;
border-radius: 50%;
}

.how-social:hover {
background-color: #333;
color: #fff;
}


/*//////////////////////////////////////////////////////////////////
[ Pseudo ]*/

/*------------------------------------------------------------------
[ Focus ]*/
.focus-in0:focus::-webkit-input-placeholder { color:transparent; }
.focus-in0:focus:-moz-placeholder { color:transparent; }
.focus-in0:focus::-moz-placeholder { color:transparent; }
.focus-in0:focus:-ms-input-placeholder { color:transparent; }


/*------------------------------------------------------------------
[ Hover ]*/
.hov-cl0:hover {color: #fff;}
.hov-bg0:hover {background-color: #fff;}

/*---------------------------------------------*/
.hov1:hover i {
-webkit-transform: translateX(10px);
-moz-transform: translateX(10px);
-ms-transform: translateX(10px);
-o-transform: translateX(10px);
transform: translateX(10px);
}






/*==================================================================
RESPONSIVE RESPONSIVE RESPONSIVE RESPONSIVE RESPONSIVE RESPONSIVE
==================================================================*/


/*//////////////////////////////////////////////////////////////////
[ XL ]*/
@media (max-width: 1200px) {
.m-0-xl {margin: 0;}
.m-lr-0-xl {margin-left: 0; margin-right: 0;}
.m-lr-15-xl {margin-left: 15px; margin-right: 15px;}
.m-l-0-xl {margin-left: 0;}
.m-r-0-xl {margin-right: 0;}
.m-l-15-xl {margin-left: 15px;}
.m-r-15-xl {margin-right: 15px;}

.p-0-xl {padding: 0;}
.p-lr-0-xl {padding-left: 0; padding-right: 0;}
.p-lr-15-xl {padding-left: 15px; padding-right: 15px;}
.p-l-0-xl {padding-left: 0;}
.p-r-0-xl {padding-right: 0;}
.p-l-15-xl {padding-left: 15px;}
.p-r-15-xl {padding-right: 15px;}

.w-full-xl {width: 100%;}

/*---------------------------------------------*/
.respon1 {
  width: 60%;
}

/*---------------------------------------------*/
.respon2 {
  width: 40%;
}

}


/*//////////////////////////////////////////////////////////////////
[ LG ]*/
@media (max-width: 992px) {
.dis-none-lg {display: none;}
.m-0-lg {margin: 0;}
.m-lr-0-lg {margin-left: 0; margin-right: 0;}
.m-lr-15-lg {margin-left: 15px; margin-right: 15px;}
.m-l-0-lg {margin-left: 0;}
.m-r-0-lg {margin-right: 0;}
.m-l-15-lg {margin-left: 15px;}
.m-r-15-lg {margin-right: 15px;}

.p-0-lg {padding: 0;}
.p-lr-0-lg {padding-left: 0; padding-right: 0;}
.p-lr-15-lg {padding-left: 15px; padding-right: 15px;}
.p-l-0-lg {padding-left: 0;}
.p-r-0-lg{padding-right: 0;}
.p-l-15-lg {padding-left: 15px;}
.p-r-15-lg {padding-right: 15px;}

.w-full-lg {width: 100%;}

/*---------------------------------------------*/
.respon1 {
  width: 100%;
  padding-left: 15px;
  padding-right: 15px;
}

/*---------------------------------------------*/
.respon2 {
  width: 100%;
  height: 500px;
}


}


/*//////////////////////////////////////////////////////////////////
[ MD ]*/
@media (max-width: 768px) {
.m-0-md {margin: 0;}
.m-lr-0-md {margin-left: 0; margin-right: 0;}
.m-lr-15-md {margin-left: 15px; margin-right: 15px;}
.m-l-0-md {margin-left: 0;}
.m-r-0-md {margin-right: 0;}
.m-l-15-md {margin-left: 15px;}
.m-r-15-md {margin-right: 15px;}

.p-0-md {padding: 0;}
.p-lr-0-md {padding-left: 0; padding-right: 0;}
.p-lr-15-md {padding-left: 15px; padding-right: 15px;}
.p-l-0-md {padding-left: 0;}
.p-r-0-md{padding-right: 0;}
.p-l-15-md {padding-left: 15px;}
.p-r-15-md {padding-right: 15px;}

.w-full-md {width: 100%;}
/*---------------------------------------------*/

}


/*//////////////////////////////////////////////////////////////////
[ SM ]*/
@media (max-width: 576px) {
.dis-none-sm {display: none;}
.m-0-sm {margin: 0;}
.m-lr-0-sm {margin-left: 0; margin-right: 0;}
.m-lr-15-sm {margin-left: 15px; margin-right: 15px;}
.m-l-0-sm {margin-left: 0;}
.m-r-0-sm {margin-right: 0;}
.m-l-15-sm {margin-left: 15px;}
.m-r-15-sm {margin-right: 15px;}

.p-0-sm {padding: 0;}
.p-lr-0-sm {padding-left: 0; padding-right: 0;}
.p-lr-15-sm {padding-left: 15px; padding-right: 15px;}
.p-l-0-sm {padding-left: 0;}
.p-r-0-sm{padding-right: 0;}
.p-l-15-sm {padding-left: 15px;}
.p-r-15-sm {padding-right: 15px;}

.w-full-sm {width: 100%;}

/*---------------------------------------------*/
.respon3 {
  font-size: 60px;
}


}


/*//////////////////////////////////////////////////////////////////
[ SSM ]*/
@media (max-width: 480px) {
.m-0-ssm {margin: 0;}
.m-lr-0-ssm {margin-left: 0; margin-right: 0;}
.m-lr-15-ssm {margin-left: 15px; margin-right: 15px;}
.m-l-0-ssm {margin-left: 0;}
.m-r-0-ssm {margin-right: 0;}
.m-l-15-ssm {margin-left: 15px;}
.m-r-15-ssm {margin-right: 15px;}

.p-0-ssm {padding: 0;}
.p-lr-0-ssm {padding-left: 0; padding-right: 0;}
.p-lr-15-ssm {padding-left: 15px; padding-right: 15px;}
.p-l-0-ssm {padding-left: 0;}
.p-r-0-ssm{padding-right: 0;}
.p-l-15-ssm {padding-left: 15px;}
.p-r-15-ssm {padding-right: 15px;}

.w-full-ssm {width: 100%;}
/*---------------------------------------------*/

}
</style>
</head>
<body>



	<div class="flex-w flex-str size1 overlay1">
		<div class="flex-w flex-col-sb wsize1 bg0 p-l-65 p-t-37 p-b-50 p-r-80 respon1">
			<div class="wrappic1">
					<img src="images/logoemailgizza.png" style="width: 200px;"alt="IMG">
			</div>

			<div class="w-full flex-c-m p-t-80 p-b-90">
				<div class="wsize2">
					<h3 class="bold blueSlate">
						Estamos mejorando nuestro servicio,
					</h3>
          <br>
					<h2 class="bold blueSlate">
						Ya volvemos!
					</h2>

					{{-- <form class="contact100-form validate-form m-t-10 m-b-10">
						<div class="wrap-input100 validate-input m-lr-auto-lg" data-validate = "Email is required: ex@abc.xyz">
							<input class="s2-txt1 placeholder0 input100 trans-04" type="text" name="email" placeholder="Email Address">

							<button class="flex-c-m ab-t-r size2 hov1">
								<i class="zmdi zmdi-long-arrow-right fs-30 cl1 trans-04"></i>
							</button>
						</div>
					</form> --}}
				</div>
			</div>

			<div class="flex-w">
				<a href="https://www.facebook.com/gizza.joyas" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-10" target="_blank">
					<i class="fa fa-facebook"></i>
				</a>

				<a href="https://api.whatsapp.com/send?phone=" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-10" target="_blank">
					<i class="fa fa-whatsapp"></i>
				</a>

				<a href="https://www.instagram.com/gizzajoyas" class="size3 flex-c-m how-social trans-04 m-r-15 m-b-10" target="_blank">
					<i class="fa fa-instagram"></i>
				</a>
			</div>
		</div>


		<div class="wsize1 simpleslide100-parent respon2">
			<!--  -->
			<div class="simpleslide100">
				<div class="simpleslide100-item bg-img1" style="background-image: url('/img/extras/gardie-design-social-media-marketing-WIM6IMeihwA-unsplash.jpg');"></div>
				{{-- <div class="simpleslide100-item bg-img1" style="background-image: url('images/bg02.jpg');"></div> --}}
				{{-- <div class="simpleslide100-item bg-img1" style="background-image: url('images/bg03.jpg');"></div> --}}
			</div>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="/mantenimientovendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/mantenimientovendor/bootstrap/js/popper.js"></script>
<!--===============================================================================================-->
	<script src="/mantenimientovendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/mantenimientovendor/tilt/tilt.jquery.min.js"></script>
<!--===============================================================================================-->
	<script src="/mantenimientojs/main.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>
</html>
