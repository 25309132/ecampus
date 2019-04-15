<div class="header-top-area ptb-10 hidden-sm hidden-xs">
  <div class="container">
      <div class="row">
        <?php if($_SESSION['UID']) { ?>
            <div class="col-md-4">
              <div class="account-usd text-left">
                  <ul>
                      <li><a href="javascript:void();"> <i class="fa fa-user"></i> My Account <i class="fa fa-angle-down"></i></a>
                          <ul class="submenu-mainmenu">
                              <li><a href="javascript:void();"><i class="fa fa-envelope"></i> Messages </a></li>
                              <li><a href="javascript:void();"><i class="fa fa-envelope"></i> info </a></li>
                          </ul>
                      </li>
                  </ul>
              </div>
         </div>
         <div class="col-md-4">
             <div class="social-icons text-center">
                 <ul>
                     <!-- <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                     <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                     <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                     <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                     <li><a href="#"><i class="fa fa-instagram"></i></a></li> -->
                 </ul>
             </div>
        </div>
        <?php } else { } ?>
         <div class="col-md-4 pull-right">
              <div class="top-right">
                  <div class="top-login-cart">
                      <ul>
                        <?php if($_SESSION['UID']) { ?>
                              <li class="hidden-xs"><a href="logout"> <i class="fa fa-sign-out"></i> Logout </a>
                          <?php } else { ?>
                              <li class=" hidden-xs"><a href="javascript:void();"> <i class="fa fa-unlock-alt"></i> Login To Your Student Area</a>
                              <ul class="submenu-mainmenu">
                                  <form id="login" name="login" role="form" action="" method="POST">
                                      <li class="single-cart-item clearfix ptb-0">
                                        <div id="wrongOTPMsg" class="row d_none">
                                          <div class="col-md-12 alert alert-danger" role="alert">
                                              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only"> Close </span></button>
                                              <strong><i class="fa fa-recycle"></i> </strong> <span id="ErrorTxt">Invalid Credentials</span>
                                          </div>
                                        </div>
                                        <div class="row">
                                            <input type="text" class="form-control"  placeholder="Enter Email / Username" value="<?php if(isset($_REQUEST['mx'])){ echo $_REQUEST['mx']; } elseif (isset( $_COOKIE['emailyako'])) { echo $yasavedemail; } ?>" name="LoginUsername" id="LoginUsername" autocomplete="OFF" required>

                                            <input type="hidden" name="PostSignIn" id="PostSignIn"  class="form-control" value="1" autocomplete="OFF">

                                            <div class="col-md-12 ptb-10">
                                                <input type="password" class="form-control"  name="LoginPassword"  id="LoginPassword" autocomplete="OFF" required placeholder="Enter Password" value="<?php if (isset($_COOKIE['ingiamsee'])) { echo $yasavedepassword; } ?>">
                                            </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label class="check">
                                                    <input type="checkbox" class="icheckbox" checked="checked" name="autologin" value="1"/>  Remember Me
                                                  </label> 
                                              </div>
                                              <div class="col-md-6 ptb-10">
                                                <button type="submit" class="btn btn-danger pull-right"> <i class="fa fa-unlock-alt"></i> Login </button>
                                              </div>
                                          </div>
                                      </li>
                                  </form>
                                  <!--Processing Submission -->
                                      <center  id="Loading_ID" class="d_none">
                                        <h4 class="ptb-35">Please wait... Logging you In </h4>
                                        <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                                      </center>
                                  <!--End Submission Processing -->
                              </ul>
                          </li>
                          <?php } ?>
                      </ul>
                  </div>
             </div>    
         </div>
      </div>
  </div>   
</div>