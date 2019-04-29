<footer class="footer-area">
    <div class="footer-bottom-area ptb-25">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="copyright">
                        Contact Us
                        
                        <p><b>Country:</b>
<b>City:</b>Kenya<br>
<b>Address:</b>Kisumu 40100<br>
The eCampus of Maseno University,<br>
P.O BOX 3275<br>

<b>Email:</b>ecampus@maseno.ac.ke<br>
<b>Tel.:</b>+254 711 432 244,  +25457-2021013
</p>
<br>
 


                    </div>
                </div>
                
                Social
                <div class="row">
                <div class="col-md-6 col-sm-6">
                                                            <div class="widget widget_socialsharing_widget">

                    <ul class="social-icons">
                                                <li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="fa fa-facebook"></i></a></li>
                                                <li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="fa fa-twitter"></i></a></li>
                                                <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="fa fa-pinterest"></i></a></li>
                                                <li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>


                    </div>
                </div>
               
                
                
                
                <!--div class="social-sharing">
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title-modal">Share this product</h3>
                                            <ul class="social-icons">
                                                <li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="fa fa-facebook"></i></a></li>
                                                <li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="fa fa-twitter"></i></a></li>
                                                <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="fa fa-pinterest"></i></a></li>
                                                <li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div-->
                
                
                
                
                    
                <div class="col-md-6 col-sm-6">
                    <div class="footer-menu text-center">
                        <nav>
                            <ul>
                                <!--li><a href="javascript:void();">Contact Us</a></li-->
                                <li><a href="javascript:void();">eCampus Programmes</a></li>
                                <li><a href="javascript:void();">Admissions</a></li>
                                <li><a href="javascript:void();">eLearning Portal</a></li>
                                <li><a href="http://www.maseno.ac.ke/index/" target="_blank">Maseno University</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- <div class="col-md-4 hidden-sm">
                    <div class="payment text-right">
                        <img src="img/payment/1.png" alt="">
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    jQuery().ready(function () {
        var v = jQuery("#login").validate({
            rules: {   
                LoginUsername: {
                    required: true
                },
                LoginPassword: {
                    required: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });
    });
    
    $("form#login").submit(function(e){
        e.preventDefault();
        if($("#login").valid()){
            $("#Loading_ID").removeClass('d_none'); 
            $("#login").addClass('d_none');  
            var OTPdata = $("#login").serialize(); 
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "auth",
                data: OTPdata,
                success: function(data) {
                if( data["type"] == "error"){
                        $("#wrongOTPMsg").removeClass('d_none');
                        $("#ErrorTxt").text(data["OTPmsg"]); 
                        $("#Loading_ID").addClass('d_none');
                        $("#login").removeClass('d_none');    
                    } 
                else {   
                        $("#wrongOTPMsg").removeClass('d-none');
                        $("#ErrorTxt").text(data["OTPVmsg"]);
                        var usergroup = data["UGroup"]
                        window.setTimeout(function(){
                            if(usergroup == 3) {
                                window.location.replace("studentarea");
                            }
                            else {
                                window.location.replace("admin/index");
                            }
                        }, 1000);
                      }    
                },
                  error: function(xhr, textStatus, errorThrown) {
                }
            });
          return false;
        }
    });

    /*--------------------------
        Document Ready function make sticky menu navbar
    ---------------------------- */
    
    $(document).ready(function() {
        var stickyHeaderTop = $('.mainmenu').offset().top;
        var stickyNav = function(){
            var scrollTop = $(window).scrollTop();
            if (scrollTop > stickyHeaderTop) { 
                $('.mainmenu').addClass('sticky-menu');
            } else {
                $('.mainmenu').removeClass('sticky-menu'); 
            }
        };

        stickyNav();

        $(window).scroll(function() {
            stickyNav();
        });
    });
    
</script>