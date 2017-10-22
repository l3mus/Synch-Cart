<html>
  <head>
    <title>SynchCart</title>
	<?php include 'header.php';?>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="cart.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3mobile.css">
   <script type="text/javascript" src="jquery.min.js"></script>     
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
  <body style="max-width:600px">


	<header class="w3-bar w3-card w3-theme">
	  <h1 class="w3-bar-item">SynchCart</h1>
	  <h1 class="w3-bar-item float-right"><img class="w3-square" src="profile.png" style="width: 55px;height: 35px;"></h1>
	</header>

	<h3 id="scan-text">Scan your items</h3>
    <div class="preview-container">
      <video id="preview"></video>
    </div>
	<div class="w3-container" id="cart">
		<hr>
		<h2 id="first-item">Scan your first item to add it to the cart.</h2>
		<div class="w3-cell-row" style="display:none;">
		  <div class="w3-cell" style="width:30%">
			<img class="w3-square" src="img_avatar.jpg" style="width:100%">
		  </div>
		  <div class="w3-cell w3-container">
			<h3>Item Name</h3>
			<p id="price">$599.99</p>
			<p id="loyalty">Super sweet loyalty deal.</p>
			<a id="add-to-list">Add to list</a> | 
			<a id="add-to-list">Save for later</a>
		  </div>
		</div>  
		
		
		<p id="loyalty-text"></p>
		
		<h2 id="total">Cart subtotal (0 items): $0.00</h2>
		
		<button id="pay">Continue to checkout</button>
		<hr>
	</div>
	<div class="w3-container" id ="suggestions">
		<h2 id="first-item">Recommendation from items across our store.</h2>
		<div class="sugg-item" style="display:none;">
		  <div  style="width:60%">
			<img class="w3-square" src="img_avatar.jpg" style="width:100%">
		  </div>
		  <div class="sugg-little">
		  
			<p id="name2">Item Name</p>
			<p id="price">$599.99</p>
		  </div>
		</div>  
	</div>

	<footer class="w3-container w3-theme w3-margin-top">
	  <div class="footer">Footer</div>
	</footer>

    </div>
    <script type="text/javascript" src="accounting.min.js"></script>
	
	<script type="text/javascript">var accountNum = "<?= $arr["accountNum"]; ?>";</script>
    <script type="text/javascript" src="app.js"></script>
  </body>
</html>
