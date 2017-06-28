//////// PARTE HTML ////////

<div id="menu" class="containerTop containerTransition">
	<ul>
    	<li onClick="actionMenu()">
    		<i class="close"></i>
    	</li>
        <li><a href="#"></a><li>
        <li><a href="#">SERVICIOS</a><li>
        <li><a href="#">TRABAJOS</a><li>
        <li><a href="#">CONTACTO</a><li>
    </ul>
</div>

//////// PARTE LESS ////////

#menu{
	position:absolute;
	background: rgba(0, 0, 0, 0.6);
	width:100%;
	height:100vh;
	z-index:9999;
	ul{
		li{
			a{
				text-decoration:none !important;
				color:#fff;
				padding:0px;
				margin:0px;
				float:left;
				list-style:none;
				width:100%;
				line-height:50px;
				font-size:24px;
				text-align:center;	
			}
		}
	}
	
	.close{
		margin-top:30px;
		margin-right:30px;
		float:right;
		color:#fff;
		font-size:40px;
	}
	
	
#menu.containerCenter{
	transform: 			translate3d(0, 0, 0);
	-o-transform: 		translate3d(0, 0, 0);
	-ms-transform: 		translate3d(0, 0, 0);
	-moz-transform: 	translate3d(0, 0, 0);
	-webkit-transform: 	translate3d(0, 0, 0);
	
	}

#menu.containerTop{
	transform: 			translate3d(0, -100%, 0);
	-o-transform: 		translate3d(0, -100%, 0);
	-ms-transform: 		translate3d(0, -100%, 0);
	-moz-transform: 	translate3d(0, -100%, 0);
	-webkit-transform: 	translate3d(0, -100%, 0);
	
}

#menu.containerTransition {
	transition-duration: 			.25s;
	-o-transition-duration: 		.25s;
	-ms-transition-duration: 		.25s;
	-moz-transition-duration: 		.25s;
	-webkit-transition-duration: 	.25s;
	
}



/////// PARTE JS ////////

var openMenu = false;
function actionMenu(){
	if(openMenu == false){
		document.getElementById('menu').classList.add('containerCenter');
		document.getElementById('menu').classList.remove('containerTop');
		openMenu = true;
	}else{
		document.getElementById('menu').classList.add('containerTop');
		document.getElementById('menu').classList.remove('containerCenter');
		openMenu = false;
	}
}