<?php
/*
Template Name: Mobile Tailor page (theme)
*/

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-92309701-1"></script>
	<script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-92309701-1');
	</script>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PW77M7K');
	</script>
	<!-- End Google Tag Manager -->
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="initial-scale=1, minimum-scale=1, maximum-scale=1">
	
	<!--Shortcut icon-->
	<?php if(!empty($options['favicon']) && !empty($options['favicon']['url'])) { ?>
		<link rel="shortcut icon" href="<?php echo nectar_options_img($options['favicon']); ?>" />
	<?php } ?>
	<title>Mobile Tailor | 3DLOOK</title>
	
	<meta name="keywords" content="">
	<meta name="description" content="">
	<!-- Open Graph -->
	<meta name="og:type" content="website">
	<meta name="og:title" content="3DLook">
	<meta name="og:description" content="">
	<meta name="og:url" content="">
	<meta name="og:site_name" content="3DLook">
	<meta name="og:locale" content="uk_UA">
	<!-- <meta name="og:image" content="url"> -->
	<!-- Open Graph -->
	<!-- <meta name="theme-color" content="#000000"> -->
	<!-- <link rel="shortcut icon" href=""> -->
	<title>3DLook</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/smbassets/fonts/Mark/font.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/smbassets/icons/fontello/style.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/smbassets/icons/fontellosocial/style.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/smbassets/styles/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/smbassets/styles/desc.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/smbassets/styles/media.css">
	<!-- This script is used for DomContentLoaded -->
	<!-- Example to use: onLoaded.push({ YOUR_CODE }); -->
	<script>var onLoaded=[],onResize=[];</script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PW77M7K"
				  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- mobile top menu -->
<div id="mob-top" class="white">
	<button type="button" class="cross" id="close-mob-top"></button>
	<span id="mob-top-title">Homescreen</span>
	<nav id="mob-top-nav">
		<div class="mob-top-link hidden">
			<div class="hider-row">
				<a class="mt-link" href="">Solutions</a>
				<div class="icon-arr-t"></div>
			</div>
			<ul class="hider">
				<li><a class="mt-sublink" href="">Human Body Measuring</a></li>
				<li><a class="mt-sublink" href="">Size and Fit Recommendations</a></li>
				<li><a class="mt-sublink" href="">3d Model Generation</a></li>
			</ul>
		</div>
		<div class="mob-top-link hidden">
			<div class="hider-row">
				<a class="mt-link" href="">Technology</a>
				<div class="icon-arr-t"></div>
			</div>
			<ul class="hider">
				<li><a class="mt-sublink" href="">1Human Body Measuring</a></li>
				<li><a class="mt-sublink" href="">1Size and Fit Recommendations</a></li>
				<li><a class="mt-sublink" href="">13d Model Generation</a></li>
			</ul>
		</div>
		<div class="mob-top-link hidden">
			<div class="hider-row">
				<a class="mt-link" href="">Resources</a>
				<div class="icon-arr-t"></div>
			</div>
			<ul class="hider">
				<li><a class="mt-sublink" href="">2Human Body Measuring</a></li>
				<li><a class="mt-sublink" href="">2Size and Fit Recommendations</a></li>
				<li><a class="mt-sublink" href="">33d Model Generation</a></li>
			</ul>
		</div>
		<div class="mob-top-link hidden">
			<div class="hider-row">
				<a class="mt-link" href="">Careers</a>
				<div class="icon-arr-t"></div>
			</div>
			<ul class="hider">
				<li><a class="mt-sublink" href="">3Human Body Measuring</a></li>
				<li><a class="mt-sublink" href="">3Size and Fit Recommendations</a></li>
				<li><a class="mt-sublink" href="">33d Model Generation</a></li>
			</ul>
		</div>
		<div class="mob-top-link hidden">
			<div class="hider-row">
				<a class="mt-link" href="">About</a>
				<div class="icon-arr-t"></div>
			</div>
			<ul class="hider">
				<li><a class="mt-sublink" href="">4Human Body Measuring</a></li>
				<li><a class="mt-sublink" href="">4Size and Fit Recommendations</a></li>
				<li><a class="mt-sublink" href="">43d Model Generation</a></li>
			</ul>
		</div>
	</nav>
	<button type="button" class="btn red">Request a Demo</button>
</div>

<!-- eclipse -->
<div id="eclipse"></div>

<header class="top active">
	<div class="wrap">
		<a class="logo" href="">
			<img src="<?php echo get_template_directory_uri() ?>/smbassets/img/logo.svg">
		</a>
		<div id="top-center">
			<nav id="top-nav">
				
				<div class="htdiv hsdiv">
					<a style="cursor: pointer" href="<?php echo home_url(); ?>/#solutions">Solutions</a>
					<div class="hsulo">
						<ul class="hsul">
							<li><a href="<?php echo home_url(); ?>/saia-mtm/">Human Body Measuring</a></li>
							<li><a href="<?php echo home_url(); ?>/saia/">Size and Fit Recommendations</a></li>
							<li><a href="<?php echo home_url(); ?>/virtual-dressing/">3D Model Generation</a></li>
						</ul>
					</div>
				</div>
				
				<div class="htdiv">
					<a style="cursor: pointer" href="<?php echo home_url(); ?>/3dlook-technology/">Technology</a>
				</div>
				
				<div class="htdiv hsdiv">
					<a style="cursor: pointer" href="#">Resources</a>
					<div class="hsulo">
						<ul class="hsul">
							<li><a href="<?php echo home_url(); ?>/blog/">Blog</a></li>
							<li><a href="https://saia.3dlook.me/docs/">Documentation</a></li>
						</ul>
					</div>
				</div>
				
				<div class="htdiv hsdiv">
					<a style="cursor: pointer" href="#">Careers</a>
					<div class="hsulo">
						<ul class="hsul">
							<li><a href="<?php echo home_url(); ?>/careers/">Careers</a></li>
							<li><a href="<?php echo home_url(); ?>/our-culture/">Our Culture</a></li>
						</ul>
					</div>
				</div>
				
				<div class="htdiv hsdiv">
					<a style="cursor: pointer" href="#">About</a>
					<div class="hsulo">
						<ul class="hsul">
							<li><a href="<?php echo home_url(); ?>/about_3dlook/">About 3DLOOK</a></li>
							<li><a href="<?php echo home_url(); ?>/partners/">Partners</a></li>
						</ul>
					</div>
				</div>
			
			</nav>
			<a id="smb-header-btn" class="btn purple">Request a Demo</a>
		</div>
		<div id="header-mob">
			<!-- <a class="icon-googleplay" href=""></a>
			<a class="icon-appstore" href=""></a> -->
			<button type="button" class="burger" id="open-mob-top">
				<span class="burger-el bel1"></span>
				<span class="burger-el bel2"></span>
				<span class="burger-el bel3"></span>
			</button>
		</div>
		
		<!-- SMB -->
	</div>
</header>

<!-- begin-smb---------------------------------------- -->

<section class="smbmain smb">
	<div class="bg">
		<div class="bg1 desc" style="background-image: url(<?php echo get_template_directory_uri() ?>/smbassets/img/smb/mainbg.svg);"></div>
		<div class="bg1 mob" style="background-image: url(<?php echo get_template_directory_uri() ?>/smbassets/img/smb/mainbgmob.svg);"></div>
	</div>
	<div class="wrap">
		<div class="col">
			<h5>For made-to-measure businesses</h5>
			<h1>Mobile Tailor</h1>
			<h4>Get precise body measurement of your customers remotely — with just 2 photos. Easy as 1, 2, 3.</h4>
			<a class="btn white icon-arr-r" href="https://mtm.3dlook.me/accounts/signup">Get my 7-day free trial</a>
		</div>
		<img src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/smb1.png">
	</div>
</section>

<section class="smbsecond">
	<div class="wrap">
		<div class="smbsecond-1">
			<img src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/map.png" alt="map">
			<div class="col">
				<div class="smbbg" style="background-image: url(<?php echo get_template_directory_uri() ?>/smbassets/img/smb/triangle-dots.svg);"></div>
				<h3>Contactless and safe</h3>
				<h3>Expand your global reach</h3>
				<p>Since no physical presence of your customer is needed right in front of you, the measurement process is totally safe and superbly fast. What's more, with 3DLOOK you can serve customers no matter where they are and which time zone they have.</p>
			</div>
		</div>
		
		<div class="smbsecond-2">
			<div class="col">
				<div class="smbbg" style="background-image: url(<?php echo get_template_directory_uri() ?>/smbassets/img/smb/triangle-dots.svg);"></div>
				<h3>Easy for your customers</h3>
				<h3>Easy for you</h3>
				<p>Send a personal measurement link to your customers directly from your 3DLOOK workspace or from your website via widget. Your customer then takes 2 photos with any smartphone on any background, and in under a minute—you get the customer body data. Can't get any easier than that.</p>
			</div>
			<img class="desc" src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/Group418.png" alt="laptop">
			<img class="mob" src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/Group403m.png" alt="laptop">
		</div>
		
		<div class="smbsecond-3">
			<img src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/Group403.png" alt="laptop">
			<div class="col">
				<h3>Precision at its finest</h3>
				<h3>Accurate customer body data</h3>
				<p>You get all the measurements of your customers on your own personal dashboard. Our sophisticated technology extracts up to 65 measurements, most of which are ISO 8559-1 compatible. Need more? You can also export your customer's 3D body avatar into leading fashion design software!</p>
			</div>
		</div>
	</div>
</section>

<section class="sect7trial">
	<div class="bg">
		<div class="bg1" style="background-image: url(<?php echo get_template_directory_uri() ?>/smbassets/img/smb/bg2.svg);"></div>
	</div>
	<div class="wrap">
		<h4>Get rid of the extra costs and time needed to manually measure your customers while providing a safe personalized service and an amazing client experience</h4>
		<a href="https://mtm.3dlook.me/accounts/signup" class="btn extrared icon-arr-r">Get my 7-day free trial</a>
	</div>
</section>

<section class="smbsimple">
	<h3>Simple as 1-2-3</h3>
	<div class="wrap">
		
		<div class="smbsimple-item">
			<div class="smbsimple-item-img">
				<img  src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/rocket.svg" alt="">
			</div>
			<h4>Register for a free trial</h4>
			<p>Register for a completely risk-free trial and you'll be all set!  After that, you can start sending measurement links to your customers by email or phone directly from your dashboard, or use a widget at your website. Ready to go!</p>
		</div>
		
		<div class="smbsimple-item">
			<div class="smbsimple-item-img phone">
				<img src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/phone.svg" alt="">
			</div>
			<h4>Measure your customers</h4>
			<p>Your customers measure themselves so you don't have to. Instantly, with only 2 photos, avoiding any physical contact. All they need is a smartphone and the link you've sent them.</p>
		</div>
		
		<div class="smbsimple-item">
			<div class="smbsimple-item-img dashboardsvg">
				<img src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/dashboard.svg" alt="">
			</div>
			<h4>Check your dashboard</h4>
			<p>View your customer's measurements in your personal easy-to-navigate dashboard in less than a minute. From here you can start creating the fittest custom clothing for all your clients. </p>
		</div>
	
	</div>
</section>

<section class="smbswitch">
	<div class="bg">
		<div class="bg1" style="background-image: url(<?php echo get_template_directory_uri() ?>/smbassets/img/smb/bgswitch.svg);"></div>
	</div>
	<div class="trigger-wrap white">
		<span>Monthly</span>
		<div class="trigger-bg">
			<div class="icon-check"></div>
		</div>
		<span>Yearly (2 months free)</span>
	</div>
	<h2>Mobile Tailor</h2>
	<div class="smbswitch-wrap">
		
		<div class="smbsw-i">
			<div class="smbsw-i-red" style="display: none;"><span>2 month free</span></div>
			<span class="smbsw-i-title">Starter</span>
			<div class="smbsw-i-img">
				<img class="c025" src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/circle1-4.svg" alt="25%">
				<span class="smbsw-i-num">50</span>
				<span class="smbsw-i-subnum">Measured Customers per Month</span>
			</div>
			<span class="smbsw-i-price" data-mprice="$99" data-yprice="$990">$99</span>
			<span class="smbsw-i-subprice">Monthly</span>
			<a class="btn extrared icon-arr-r" href="https://mtm.3dlook.me/accounts/signup">Try for free</a>
			<ul class="smbsw-i-ul">
				<li><b>Up to 50</b> measured customers per month</li>
				<li><b>65</b> measurements</li>
				<li>Sending measurement links by email or phone</li>
				<li>Simple and clean dashboard</li>
				<li>Data Export CSV</li>
			</ul>
		</div>
		
		<div class="smbsw-i">
			<div class="smbsw-i-red" style="display: none;"><span>2 month free</span></div>
			<span class="smbsw-i-title">Business</span>
			<div class="smbsw-i-img">
				<img class="c075" src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/circle3-4.svg" alt="75%">
				<span class="smbsw-i-num">250</span>
				<span class="smbsw-i-subnum">Measured Customers per Month</span>
			</div>
			<span class="smbsw-i-price" data-mprice="$499" data-yprice="$4990">$499</span>
			<span class="smbsw-i-subprice">Monthly</span>
			<a class="btn extrared icon-arr-r" href="https://mtm.3dlook.me/accounts/signup">Try for free</a>
			<ul class="smbsw-i-ul">
				<li><b>Up to 250</b> measured customers per month</li>
				<li><b>65</b> measurements</li>
				<li>Sending measurement links by email, phone or via the widget</li>
				<li>Simple and clean dashboard</li>
				<li>Data Export CSV</li>
				<li>Web widget integration with your website</li>
				<li>3D Body Avatars</li>
			</ul>
		</div>
		
		<div class="smbsw-i">
			<span class="smbsw-i-title">Enterprise</span>
			<div class="smbsw-i-img c100">
				<img class="c100" src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/circle4-4.svg" alt="100%">
				<span class="smbsw-i-num">>250</span>
				<span class="smbsw-i-subnum">Measured Customers per Month</span>
			</div>
			<span class="smbsw-i-noprice">Are you measurig more than <b>250 customers</b> per month, or do you need additional features?</span>
			<a class="btn extrared icon-arr-r" href="<?php echo home_url(); ?>/request-a-quote">Contact our sales team</a>
			<ul class="smbsw-i-ul">
				<li><b>More than 250</b> measured customers per month</li>
				<li><b>65+</b> measurements</li>
				<li>Sending measurement links by email, phone or via the widget</li>
				<li>Simple and clean dashboard</li>
				<li>Data Export CSV</li>
				<li>Web widget integration with your website</li>
				<li>3D Body Avatar compatible with any fashion design software</li>
				<li>Custom integration options</li>
				<li>API access</li>
				<li>Dedicated support</li>
			</ul>
		</div>
	
	</div>
</section>

<section class="smbbenefits">
	<h3>Benefits</h3>
	<div class="smbben-wrap">
		<div class="smbben-item">
			<img class="smbben-img" src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/hand.svg" alt="hand">
			<h4>Contactless and safe</h4>
		</div>
		<div class="smbben-item">
			<img class="smbben-img" src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/time.svg" alt="time">
			<h4>Saves time and cost</h4>
		</div>
		<div class="smbben-item">
			<img class="smbben-img" src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/dasnboard2.svg" alt="dashboard2">
			<h4>Simple dashboard</h4>
		</div>
		<div class="smbben-item">
			<img class="smbben-img" src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/person.svg" alt="person">
			<h4>3D body model generation</h4>
		</div>
		<div class="smbben-item">
			<img class="smbben-img" src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/chat.svg" alt="chat">
			<h4>Friendly for your customers</h4>
		</div>
	</div>
</section>

<section class="smbwhat">
	<div class="bg">
		<div class="bg1" style="background-image: url(<?php echo get_template_directory_uri() ?>/smbassets/img/smb/amorphic-gray.svg);"></div>
	</div>
	<h3>What our customers are saying</h3>
	<div class="smbwhat-wrap">
		<div class="smbbg" style="background-image: url(<?php echo get_template_directory_uri() ?>/smbassets/img/smb/triangle-dots.svg);"></div>
		
		<div class="smbwhat-i">
			<img src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/o1.jpg">
			<a class="smb-i-content" href="">
				<span class="smb-i-title">RedThread</span>
				<span class="smb-i-text">The 3DLOOK mobile scanning technology enables us to so scale on-demand manufacturing and deliver a perfect fit to our customer's door without an in-person visit or measuring tape! The team is incredible to work with - they are responsive, curious, and committed to creating the world's best mobile scanning measurement technology.</span>
				<span class="smb-i-name">Meghan Litchfield</span>
				<span class="smb-i-pos">CEO & Founder</span>
			</a>
		</div>
		
		<div class="smbwhat-i">
			<img src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/o2.jpg">
			<a class="smb-i-content" href="">
				<span class="smb-i-title">Hiploose</span>
				<span class="smb-i-text">3DLOOK has significantly improved the Hiploose client engagement model by not only streamlining the measurement process & record management but also by overcoming several challenges whether it be scheduling for face-to-face meetings or removing social distancing challenges with respect to the current COVID-19 pandemic. 3DLOOK customer service, professionalism, innovation, and their interface with our staff has been nothing short of top-notch!</span>
				<span class="smb-i-name">Brian Walker</span>
				<span class="smb-i-pos">CEO</span>
			</a>
		</div>
		
		<div class="smbwhat-i">
			<img src="<?php echo get_template_directory_uri() ?>/smbassets/img/smb/o3.jpg">
			<a class="smb-i-content" href="">
				<span class="smb-i-title">Go Custom NYC</span>
				<span class="smb-i-text">In the past, we used both body scans and hand measuring just to be on the safe side. But one day my stylist came to our client sans a measuring tape, and the 3DLOOK technology was our only hope. We made our first shirt solely upon the 3DLOOK scan, and it came out PERFECT. Now my stylists collect scans with every single set of measurements.</span>
				<span class="smb-i-name">Candace Jones</span>
				<span class="smb-i-pos">Founder</span>
			</a>
		</div>
	
	</div>
</section>

<section class="smblafmf">
	<div class="bg">
		<div class="bg1" style="background-image: url(<?php echo get_template_directory_uri() ?>/smbassets/img/smb/Group397.svg);"></div>
	</div>
	<h3>Ready to get started?</h3>
	<a href="https://mtm.3dlook.me/accounts/signup" class="btn white icon-arr-r">Get my 7-day free trial</a>
</section>

<!-- end-smb---------------------------------------- -->

<footer>
	<div class="footer1">
		<div class="wrap">
			
			<div class="footercol footercol1">
				<a class="logo"><img src="<?php echo get_template_directory_uri() ?>/smbassets/img/logo.svg" alt="3DLOOK"></a>
				<address>
					<span class="fcol2a">55 East 3rd Avenue</span>
					<span class="fcol2a">San Mateo, CA 94401</span>
					<a class="fcol2a" href="mailto:hello@3dlook.me">Email: hello@3dlook.me</a>
				</address>
			</div>
			
			<div class="footercol footercol2">
				<h4>Additional Links</h4>
				<a class="fcol2a" href="<?php echo home_url(); ?>/privacy-policy/">Privacy policy</a>
				<a class="fcol2a" href="<?php echo home_url(); ?>/terms-of-service/">Terms and Conditions</a>
				<a class="fcol2a" href="<?php echo home_url(); ?>/refund-policy/">Refund Policy</a>
				<a class="fcol2a" href="https://drive.google.com/open?id=1xHKxEt_qXwJvyFepiB_emcKKBL6rsA-l">Media Kit</a>
				<h4>GDPR INFORMATION</h4>
				<strong>Information according to Art. 27 EU GDPR</strong>
				<span class="fcol2a">3DLOOK INC. is a company located outside of the European Union. In order to comply with Art. 27 EU GDPR, GDPR-Rep.eu has been nominated as our represenative in the European Union. If you want to make use of your data privacy rights, please visit: <a href="https://gdpr-rep.eu/q/12970373">Our public Privacy dashboard.</a></span>
			</div>
			
			<div class="footercol footercol3">
				<h4>READ OUR BLOG!</h4>
				<a class="fblog-elem" href="<?php echo home_url(); ?>/blog/top-3-ways-for-made-to-measure-businesses-to-thrive-in-a-covid-world/">
					<img class="fblog-img">
					<span class="fblog-title">Top 3 Ways for Made-to-Measure Businesses to Thrive in a COVID World</span>
					<span class="fblog-date">June 11, 2020</span>
				</a>
			</div>
			
			<div class="footercol footercol4">
				<h4>SUBSCRIBE TO OUR MAILING LIST</h4>
				<form action="https://3dlook.us18.list-manage.com/subscribe/post?u=f5e2e5a53238438f033ff3908&amp;id=bcf85f75db" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
					<div class="finput">
						<span class="finput-top">Your Email (required)</span>
						<input type="email" name="EMAIL">
						<span class="finput-back">Your Email (required)</span>
						<button type="submit" class="btn blue">Subscribe</button>
					</div>
				</form>
			</div>
		
		
		</div>
	</div>
	<div class="footer2">
		<div class="wrap">
			<span id="copyright">© 2020 3DLOOK Inc.</span>
			<div class="footer2col">
				<a class="icon-tw" href="https://twitter.com/3dlook_me"></a>
				<a class="icon-fb" href="https://www.facebook.com/3DLOOK.me/"></a>
				<a class="icon-in" href="https://www.linkedin.com/company/3dlook/"></a>
				<a class="icon-youtube" href="https://www.youtube.com/channel/UCPQIzvlU_Ht0b1g1oV7s3gQ"></a>
			</div>
		</div>
	</div>
</footer>
<!--b-scripts-->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        smbf1();
        smbf2();
        smbf3();
        smbf4();
    });
    var smbSwitchData = undefined;
    function smbf1() {
        var checked = false;
        var triggerWrap = document.getElementsByClassName("trigger-wrap")[0];
        var trigger = document.getElementsByClassName("trigger-bg")[0];
        var pricesTime = document.getElementsByClassName("smbsw-i-subprice");
        var prices = document.getElementsByClassName("smbsw-i-price");
        var red = document.getElementsByClassName("smbsw-i-red");
        smbSwitchData = new Array(pricesTime.length);
        for (var i = 0; i < pricesTime.length; i++) {
            const ci = i;
            smbSwitchData[ci] = [prices[ci].dataset.mprice, prices[ci].dataset.yprice]
        }
        trigger.onclick = function() {
            if (checked) {
                triggerWrap.classList.remove("active");
                for (var i = 0; i < pricesTime.length; i++) {
                    const ci = i;
                    pricesTime[ci].innerHTML = "Monthly";
                    prices[ci].innerHTML = smbSwitchData[ci][0];
                    red[ci].style.display = "none";
                }
                checked = false;
            } else {
                triggerWrap.classList.add("active");
                for (var i = 0; i < pricesTime.length; i++) {
                    const ci = i;
                    pricesTime[ci].innerHTML = "Yearly";
                    prices[ci].innerHTML = smbSwitchData[ci][1];
                    red[ci].style.display = "flex";
                }
                checked = true;
            }
        }
    };
    function smbf2() {
        if (window.innerWidth > 768) return;
        var elems = document.getElementsByClassName("smbwhat-i");
        for (var i = 0; i < elems.length; i++) {
            const ci = i;
            elems[ci].onclick = function() {
                this.classList.toggle("active");
                for (var j = 0; j < elems.length; j++) {
                    const cj = j;
                    if (ci == cj) continue;
                    elems[cj].classList.remove("active")

                }
            }
        }
    };
    function smbf3() {
        // var hsdiv = document.getElementsByClassName("hsdiv");
        var hsulo = document.getElementsByClassName("hsulo");
        var hsul = document.getElementsByClassName("hsul");
        var hsuloA = new Array(hsul.length).fill(false);
        for (var i = 0; i < hsul.length; i++) {
            const ci = i;
            hsulo[ci].style.height = hsul[ci].getBoundingClientRect().height + 20 + "px";
        }
    }
    var prevscrollsmb = 0;
    function smbf4() {
        var elem = document.getElementsByTagName("header")[0];
        window.addEventListener('scroll', function() {
            console.log(pageYOffset)
            if (pageYOffset < 10) {
                elem.classList.add("top");
            } else {
                elem.classList.remove("top");
            }
            if (prevscrollsmb > pageYOffset) {
                elem.classList.add("active");
            } else {
                elem.classList.remove("active");
            }
            prevscrollsmb = pageYOffset
        })
    }
</script>
<!--e-scripts-->
</body>
</html>