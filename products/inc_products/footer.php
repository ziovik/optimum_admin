 <!-- FOOTER -->
      <footer id="footer" class="section section-grey">
         <!-- container -->
         <div class="container">
            <!-- row -->
            <div class="row">
               <!-- footer widget -->
               <div class="col-md-3 col-sm-6 col-xs-6">
                  <div class="footer">
                     <!-- footer logo -->
                     <div class="footer-logo" style=" padding-left: 50px;">
                        <a class="logo" href="#">
                        <img src="../img/logo.png" alt="">
                        </a>
                     </div>
                     <!-- /footer logo -->
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna
                     </p>
                     <!-- footer social -->
                     <ul class="footer-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                     </ul>
                     <!-- /footer social -->
                  </div>
               </div>
               <!-- /footer widget -->
               <!-- footer widget -->
               <div class="col-md-3 col-sm-6 col-xs-6">
                  <div class="footer">
                     <h3 class="footer-header">My Account</h3>
                     <ul class="list-links">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">Compare</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Login</a></li>
                     </ul>
                  </div>
               </div>
               <!-- /footer widget -->
               <div class="clearfix visible-sm visible-xs"></div>
               <!-- footer widget -->
               <div class="col-md-3 col-sm-6 col-xs-6">
                  <div class="footer">
                     <h3 class="footer-header">Customer Service</h3>
                     <ul class="list-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Shiping & Return</a></li>
                        <li><a href="#">Shiping Guide</a></li>
                        <li><a href="#">FAQ</a></li>
                     </ul>
                  </div>
               </div>
               <!-- /footer widget -->
               <!-- footer subscribe -->
               <div class="col-md-3 col-sm-6 col-xs-6">
                  <div class="footer">
                     <h3 class="footer-header">Stay Connected</h3>
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                     <form>
                        <div class="form-group">
                           <input class="input" placeholder="Enter Email Address">
                        </div>
                        <button class="primary-btn">Join Newslatter</button>
                     </form>
                  </div>
               </div>
               <!-- /footer subscribe -->
            </div>
            <!-- /row -->
            <hr>
            <!-- row -->
            <div class="row">
               <div class="col-md-8 col-md-offset-2 text-center">
                  <!-- footer copyright -->
                  <div class="footer-copyright">
                     <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                     Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                     All rights reserved | Designed <i class="fa fa-heart-o" aria-hidden="true"></i> by 
                     <a href="#" target="_blank">Daniel</a>
                     <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                  </div>
                  <!-- /footer copyright -->
               </div>
            </div>
            <!-- /row -->
         </div>
         <!-- /container -->
      </footer>
      <!-- /FOOTER -->
      <!-- jQuery Plugins -->
      <script src="../js/jquery.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/slick.min.js"></script>
      <script src="../js/nouislider.min.js"></script>
      <script src="../js/jquery.zoom.min.js"></script>
      <script src="../js/main.js"></script>
      <script src="../js/checkout.js"></script>
      <script src="../js/intro.js"></script>
      <script src="../js/jquery.confirm.js"></script>
      <script src="../js/jquery.confirm.min.js"></script>
      <script src="../js/rwd-table.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!--<script src="js/global.js"></script>-->
      <script>
         $(function () {
         	$('#bs-deps').on('hide.bs.collapse show.bs.collapse', function () {
         		$('#bs-deps-toggle').children('span').toggleClass('fa-chevron-down').toggleClass('fa-chevron-up');
         	})
         });
      </script>
     
     </body>
     </html>
      

      <script >
         var table = '#mytable'
         $('#maxRows').on('change', function(){
         	$('.pagination').html('')
         	var trnum = 0
         	var maxRows = parseInt($(this).val())
         	var totalRows = $(table+' tbody tr').length
         	$(table+' tr:gt(0)').each(function(){
         		trnum++
         		if(trnum > maxRows){
         			$(this).hide()
         		}
         		if (trnum <= maxRows) {
         			$(this).show()
         		}
         	})
         	if (totalRows > maxRows) {
         		var pagenum = Math.ceil(totalRows/maxRows)
         		for (var i=1; i<=pagenum;) {
         			$('.pagination').append('<li data-page="'+i+'"> \ <span>'+ i++ +'<span class="sr-only">(current)</span></span> \ </li>').show()
         		}
         	}
         	$('.pagination li:first-child').addClass('active')
         	$('.pagination li').on('click', function(){
         		var pageNum = $(this).attr('data-page')
         		var trIndex = 0;
         		$('.pagination li').removeClass('active')
         		$(this).addClass('active')
         		$(table+' tr:gt(0)').each(function(){
         			trIndex++
         			if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)) {
         				$(this).hide()
         			}else{
         				$(this).show()
         			}
         		})
         	})
         })
         $(function(){
         	$('table tr:eq(0)').prepend('<th>ID</th>')
         	var id = 0;
         	$('table tr:gt(0)').each(function(){
         		id++
         		$(this).prepend('<td>'+id+'</td>')
         	})
         })
      </script>
     