<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title_for_page; ?></title>
        <!-- Bootstrap CSS -->
        <link href="<?php echo HTTP_ROOT;?>css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo HTTP_ROOT;?>css/docs.min.css" rel="stylesheet">
        <link href="<?php echo HTTP_ROOT;?>css/bootstrap2.css" rel="stylesheet" />
        <link rel="shortcut icon" href="<?php echo HTTP_ROOT;?>img/fav.ico">
        <!-- Font Awesome CSS -->
        <link href="<?php echo HTTP_ROOT;?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo HTTP_ROOT;?>fonts/themify-icons.css" rel="stylesheet">
        <link href="<?php echo HTTP_ROOT;?>css/Custom.css" rel="stylesheet" />

        <!-- Owl Carousel CSS -->
        <link href="<?php echo HTTP_ROOT;?>css/owl.carousel.css" rel="stylesheet">

        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo HTTP_ROOT;?>css/magnific-popup.css">

        <!-- Animate CSS -->
        <link rel="stylesheet" href="<?php echo HTTP_ROOT;?>css/animate.css">


        <!-- Theme CSS -->
        <link href="<?php echo HTTP_ROOT;?>css/m-style.css" rel="stylesheet">

        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
    </head>
<body>
    <!-- Passpartu -->
    <div class="passpartu passpartu_left"></div>
    <div class="passpartu passpartu_right"></div>
    <div class="passpartu passpartu_top"></div>
    <div class="passpartu passpartu_bottom"></div>
    <!-- Passpartu End -->
    <div class="page" id="page">

        <!--Intro-->
        <section class="intro">
            <div class="intro_item">
                <!-- Over -->
                <div class="over" data-opacity="0.4" data-color="#000"></div>
                <div class="into_back image_bck" data-image="<?php echo HTTP_ROOT;?>img/white.jpg"></div>
                <div class="inside_intro_block  class-top">
                    <div class="ins_int_item white_txt bordered_wht_border text-center">
                        <div class="simple_block simple_block_sml login-form">
                            <img class="top-mrg padding-bg" src="<?php echo HTTP_ROOT;?>img/logo-dachat2.png" />
                            <?php echo $this->Form->create('User', array('class'=>'form-signin')); ?>
						    <?php echo  $this->Session->flash(); ?>
						    <?php echo $this->Form->input('username', array('label' => false,'div'=>false, 'class' => 'form-control form-opacity','placeholder'=>'نام کاربری','required'=>true));?> 
						    <?php echo $this->Form->input('password', array('label' => false,'div'=>false, 'class' => 'form-control form-opacity','placeholder'=>'رمز ورود','required'=>true));?>
						    <input type="submit" value="ورود" class="btn btn-white btn-block no-margin login-submit">
						    
						    <?php echo $this->Form->end(); ?>
               
                            <p class="p-login">
                                <a href="<?php echo HTTP_ROOT;?>Users/Signup" class="left-a">ثبت نام</a>

								<a data-toggle="modal" class="right-a" href="#myModal">بازیابی رمز عبور</a>
                                <!--<a href="" class="right-a">تنظیم مجدد رمز عبور</a>-->
                            </p>


                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Intro End -->
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="top:31%!important">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title">بازیابی رمز عبور</h4>
                    </div>
                    <div class="modal-body">
                        <p id="error" style="display:none;color:red;">لطفا آدرس ایمیل را وارد کنید</p>
                        <p id="invalid" style="display:none;color:red;">ایمیل می کند وجود ندارد</p>
                        <p id="success" style="display:none;color:green;">رمز عبور ارسال موفقیت</p>
                        <p>آدرس ایمیل خود را در زیر رمز عبور خود را برای تنظیم مجدد را وارد کنید.</p>
                        <?php echo $this->Form->input('email', array('label' => false,'div'=>false, 'class' => 'form-control  placeholder-no-fix','id'=>'forgetemail','placeholder'=>'ایمیل','autocomplete'=>'off'));?> 
                        <div id="loader" style="display:none;">
                            <?php echo $this->Html->image('loader.png');?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                        <button class="btn btn-success" id="pop_up" type="button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
    </div>

    <!-- Page End -->
    <!-- JQuery -->
    <script src="<?php echo HTTP_ROOT;?>js/jquery-1.11.3.min.js"></script>
    <!-- WL Carousel JS -->
    <script src="<?php echo HTTP_ROOT;?>js/owl.carousel.min.js"></script>
    <!-- PrefixFree -->
    <script src="<?php echo HTTP_ROOT;?>js/prefixfree.min.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="<?php echo HTTP_ROOT;?>js/jquery.magnific-popup.min.js"></script>
    <!-- Textillate -->
    <script src="<?php echo HTTP_ROOT;?>js/jquery.lettering.js"></script>
    <!-- Countdown -->
    <script src="<?php echo HTTP_ROOT;?>js/jquery.plugin.min.js"></script>
    <script src="<?php echo HTTP_ROOT;?>js/jquery.countdown.min.js"></script>
    <!-- JQuery UI -->
    <script src="<?php echo HTTP_ROOT;?>js/jquery-ui.js"></script>
    <!-- Wow -->
    <script src="<?php echo HTTP_ROOT;?>js/wow.js"></script>
    <!-- Masonry -->
    <script src="<?php echo HTTP_ROOT;?>js/masonry.pkgd.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo HTTP_ROOT;?>js/bootstrap.min.js"></script>
    <!-- Theme JS -->
    <script src="<?php echo HTTP_ROOT;?>js/script.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#pop_up').click(function(){
                $('#error').hide();
                $('#invalid').hide();
                $('#success').hide();
                console.log($('#forgetemail').val());
                if($('#forgetemail').val() !=''){
                    $('.loader').show();
                    $.ajax({
                        url: '<?php echo HTTP_ROOT;?>Users/ForgotPassword',
                        type: 'POST',
                        data: 'mail='+$('#forgetemail').val(),
                        success: function(result){
                          $('.loader').hide();
                          if(result==1){
                             $('#success').show();
                          }else{
                             $('#invalid').show();
                          }
                        }
                    });
                }else{
                    $('#error').show();
                }
            });
        })  ;  
    </script>

</body>
</html>