<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../../web/default/header', TEMPLATE_INCLUDEPATH)) : (include template('../../web/default/header', TEMPLATE_INCLUDEPATH));?>
	<!----- start-header---->
			<div id="home" class="header">
			<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../../web/default/top', TEMPLATE_INCLUDEPATH)) : (include template('../../web/default/top', TEMPLATE_INCLUDEPATH));?>
	  		<script src="<?php echo MODULE_URL;?>/web/default/js/responsiveslides.min.js"></script>
			 <script>
			    $(function () {
			      $("#slider4").responsiveSlides({
			        auto: true,
			        pager: true,
			          nav:false,
			        speed: 500,
			        namespace: "callbacks",
			        before: function () {
			          $('.events').append("<li>before event fired.</li>");
			        },
			        after: function () {
			          $('.events').append("<li>after event fired.</li>");
			        }
			      });
			    });
			  </script>
			    <div  id="top" class="callbacks_container">
			      <ul class="rslides" id="slider4">
			        <li>
			          <div class="slider-top">
			          		<h2>Knowledge is Power</h2>
										<p>
											 Knowledge is power. You can't begin a career, for that matter even a relationship, 
											 unless you know everything there is to know about it  You can't begin a career, 
											 for that matter even a relationship, unless you know everything there is to know about it..
										</p>
										<h6>Welcoming for every Child</h6>
			          </div>
			        </li>
			      </ul>
			    </div>
			    <div class="clearfix"> </div>
		</div>

	<!----start-slide-bottom--->
		<div class="slide-bottom">
			<div class="slide-bottom-grids">
				 <div class="container">
					 <div class="col-md-6 slide-bottom-grid">
							<h3>Welcome!</h3>
							<p>Ruelloribus eget elemetum vel curleif end elit. for that matter even a relationship, for that matter even a relationship, Aean auctoetnliir pis terios. ante ipsummis fauulet utrice posere cubtsed leo pharetu nec augue. dui bibendum ornare elementum. In vel mi pellentesque.</p>
					 </div>
					 <div class="col-md-6 slide-bottom-grid">
					       <h3>Our Mission</h3>
						   <p>Ruelloribus eget elemetum vel curleif end elit. for that matter even a relationship, for that matter even a relationship, Aean auctoetnliir pis terios. ante ipsummis fauulet utrice posere cubtsed leo pharetu nec augue. dui bibendum ornare elementum. In vel mi pellentesque.</p>
					 </div>
					   <div class="clearfix"></div>
				 </div>
			 </div>
		</div>
        <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >免费网站模板</a></div>
<!--services-->
	 <div class="service-section">
				<div class="col-md-7 service-section-grids">
						<div class="container">
						  <div class="serve-head">
							  <h3>Our Activities</h3>
							  <h6>Our Bestservices for your Kids</h6>
						  </div>
					 </div>
						<div class="service-grid">
							<div class="service-section-grid">
								<div class="icon">
									<i class="book"> </i>
								</div>
								<div class="icon-text">
									<h4>BOOKS STATIONARY</h4>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.</p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="service-section-grid">
								<div class="icon">
									<i class="pencil"> </i>
								</div>
								<div class="icon-text">
									<h4>BOOKS STATIONARY</h4>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.</p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="service-section-grid">
								<div class="icon">
									<i class="award"> </i>
								</div>
								<div class="icon-text">
									<h4>Lorem Ipsum dolor</h4>
									<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.</p>
								</div>
								<div class="clearfix"> </div>
							</div>
							<div class="clearfix"> </div>
						</div>
						</div>
					<div class="col-md-5 service-text">
						  <p></p>
					</div>
				 <div class="clearfix"> </div>
			</div>
<!--/services-->
	<div class="news-section">
		<div class="container">
					<div class="news-head">
		               <h3>Current News</h3>
					   <p>Follow our Most Important News</p>
					</div>
			<div class="news">
				<div class="col-md-4 test-right01 test1">
					<img src="<?php echo MODULE_URL;?>/web/default/images/n1.jpg" class="img-responsive" alt="" />
						<div class="textbox textbox1">
							<h4 class="col-md-4 date">14<br> <span>Jun</span><br><lable>0 <img src="<?php echo MODULE_URL;?>/web/default/images/comment.png" class="img-responsive" alt="" /></lable></h4>
							<p class="col-md-8 news">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit...</p>
								<div class="clearfix"> </div>
						</div>
				</div>
				<div class="col-md-4 test-right01 test1">
					<img src="<?php echo MODULE_URL;?>/web/default/images/n2.jpg" class="img-responsive" alt="" />
						<div class="textbox textbox1">
							<h4 class="col-md-4 date">15<br> <span>July</span><br><lable>0 <img src="<?php echo MODULE_URL;?>/web/default/images/comment.png" class="img-responsive" alt="" /></lable></h4>
							<p class="col-md-8 news">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit...</p>
								<div class="clearfix"> </div>
						</div>
				</div>
				<div class="col-md-4 test-right01 test1">
					<img src="<?php echo MODULE_URL;?>/web/default/images/n3.jpg" class="img-responsive" alt="" />
						<div class="textbox textbox1">
						<h4 class="col-md-4 date">30<br> <span>Agu</span><br><lable>0 <img src="<?php echo MODULE_URL;?>/web/default/images/comment.png" class="img-responsive" alt="" /></lable></h4>
							<p class="col-md-8 news">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit...</p>
								<div class="clearfix"> </div>
						</div>
				</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<div class="culture-section">
		<div class="container">
				<div class="culture-head">
					<h3>Our Events</h3>
					<p>Don'T Miss our Events</p>
				</div>
				 <div class="culture">
					        <div class="col-md-6 culture-grids">
                              <a href="single.html"> <img src="<?php echo MODULE_URL;?>/web/default/images/event1.jpg" class="img-responsive" alt="" /></a>
								<div class="e_date">
                                     <h4>15<br> <span>July</span></h4>
                                </div>
								  <a href="single.html"><h5>ART SESSION</h5></a>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							</div>
							<div class="col-md-6 culture-grids">
								 <a href="single.html"> <img src="<?php echo MODULE_URL;?>/web/default/images/event2.jpg" class="img-responsive" alt="" /></a>
								<div class="e_date">
                                    <h4>15<br> <span>July</span></h4>
                                </div>
								  <a href="single.html"><h5>ART SESSION</h5></a>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

							</div>
							<div class="col-md-6 culture-grids">
								  <a href="single.html"> <img src="<?php echo MODULE_URL;?>/web/default/images/event3.jpg" class="img-responsive" alt="" /></a>
								<div class="e_date">
                                    <h4>15<br> <span>July</span></h4>
                                </div>
								  <a href="single.html"><h5>ART SESSION</h5></a>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							</div>
							<div class="col-md-6 culture-grids">
								   <a href="single.html"> <img src="<?php echo MODULE_URL;?>/web/default/images/event4.jpg" class="img-responsive" alt="" /></a>
								<div class="e_date">
                                   <h4>15<br> <span>July</span></h4>
                                </div>
								  <a href="single.html"><h5>ART SESSION</h5></a>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							</div>
							<div class="clearfix"> </div>
					   </div>
				 </div>
			</div>
			<div class="mid-bg">
		<div class="container">
			<div class="mid-section">
				 <h3>First Day at School!</h3>
				 <h4>ARE YOU READY ?</h4>
				 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text  and typesetting industry. Lorem Ipsum has been the industry's standard dummy  ever since the 1500s,</p>
			</div>
		</div>
	</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../../web/default/footer', TEMPLATE_INCLUDEPATH)) : (include template('../../web/default/footer', TEMPLATE_INCLUDEPATH));?>