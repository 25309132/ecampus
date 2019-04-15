<footer class="footer-area">
    <div class="footer-bottom-area ptb-25">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="copyright">
                        <p>Copyright @ <?php echo date('Y'); ?><span><a href="index"> eCampus, Maseno University</a></span>. All rights reserved. </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="footer-menu text-center">
                        <nav>
                            <ul>
                                <li><a href="javascript:void();">Contact Us</a></li>
                                <li><a href="javascript:void();">Our Courses</a></li>
                                <li><a href="javascript:void();">eCampus Programmes</a></li>
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