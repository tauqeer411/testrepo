<div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-head">
	  <div style="padding:0px 20px;width:70%;text-align:center;float:left;">   
      
       </div>
        <div class="page-title">
         <h1>تم و رنگ ها <small> انتخاب جلوه های بصری </small></h1>
        </div>
        <div class="page-toolbar">

        </div>
      </div>
      <ul class="page-breadcrumb breadcrumb hide">
        <li>
          <a href="javascript:;"><?php debug($code);?>Home</a><i class="fa fa-circle"></i>
        </li>
        <li class="active">
          Dashboard
        </li>
      </ul>
      <ul class="page-breadcrumb breadcrumb portlet-body" style="background:none !important;">
        <li>
          <a href="/Profile/Home" class="txt">داشبورد</a>
          <i class="fa fa-circle" style="font-size: 8px !important;"></i>
        </li>
        <li>
          <a href="#" class="txt">تم و رنگ ها</a>
        </li>
      </ul>
      <div class="row">
        <div class="col-md-12">
            <div class="row mix-grid thumbnails">
            <div class="col-md-3 col-sm-6 margin-top-10">
			<!-- Red color -->
              <a  class="ui-colors <?php echo $code=='#ef4836'? 'active': ''?>"><img class="img-responsive" data-id="<?php echo base64_encode('#ef4836');?>" src="<?php echo HTTP_ROOT;?>img/chat-color-red.png" alt="">
              </a>
            </div>
             <div class="col-md-3 col-sm-6 margin-top-10">
              <!-- Pink color -->
			  <a  class="ui-colors"><img class="img-responsive" data-id="<?php echo base64_encode('#d2527f');?>" src="<?php echo HTTP_ROOT;?>img/chat-color-pink.png" alt="">
              </a>
            </div>
             <div class="col-md-3 col-sm-6 margin-top-10">
                <a  class="ui-colors <?php echo $code=='#8e44ad'? 'active': ''?>"><img class="img-responsive" data-id="<?php echo base64_encode('#8e44ad');?>" src="<?php echo HTTP_ROOT;?>img/chat-color-purple.png" alt="">
              </a>
            </div>
              <div class="col-md-3 col-sm-6 margin-top-10">
              <a  class="ui-colors <?php echo $code=='#22a7f0'? 'active': ''?>"><img class="img-responsive"  data-id="<?php echo base64_encode('#22a7f0');?>" src="<?php echo HTTP_ROOT;?>img/chat-color-blue.png" alt="">
                </a>
              </div>
             
           
            
            
            
            <div class="col-md-3 col-sm-6 margin-top-10">
              <a  class="ui-colors <?php echo $code=='#f96311'? 'active': ''?>"><img class="img-responsive" data-id="<?php echo base64_encode('#f96311');?>" src="<?php echo HTTP_ROOT;?>img/chat-color-orange.png" alt="">
              </a>
            </div>
             <div class="col-md-3 col-sm-6 margin-top-10">
             <a  class="ui-colors <?php echo $code=='#f7ca18'? 'active': ''?>"> <img class="img-responsive" data-id="<?php echo base64_encode('#f7ca18');?>" src="<?php echo HTTP_ROOT;?>img/chat-color-yellow.png" alt="">
              </a>
            </div>
             <div class="col-md-3 col-sm-6 margin-top-10">
             <a  class="ui-colors <?php echo $code=='#6c7a89'? 'active': ''?>">
                <img class="img-responsive" data-id="<?php echo base64_encode('#6c7a89');?>" src="<?php echo HTTP_ROOT;?>img/chat-color-grey.png" alt="">
              </a>
            </div>
            
            <div class="col-md-3 col-sm-6 margin-top-10">
             <a  class="ui-colors <?php echo $code=='#4ecdc4'? 'active': ''?>">
                <img class="img-responsive" data-id="<?php echo base64_encode('#4ecdc4');?>" src="<?php echo HTTP_ROOT;?>img/chat-color-green.png" alt="">
              </a>
            </div>
           
           
            
          </div>
      </div>
    </div>
	<div id="view-model" class="modal fade" tabindex="-1" data-backdrop="view-model" data-keyboard="false">
  <div class="modal-header dept-modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title font-yekan">پیام گفت و گو</h4>
  </div>
  <div class="modal-body">
    <div class="row">
     <div id="message" style="color:green;text-align:center;">
	 
    </div>
 </div>
  
  
   
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>

	$(".ui-colors").click(function () {
    $('.ui-colors').removeClass("active");
    $(this).toggleClass("active");
  });
  $('body').on('click', '.img-responsive', function(){
		var id = $(this);
		var ide=id.data('id');
		
		//console.log(id.data('id'));
		$('.loader').show();
		$.ajax({
		  url: '<?php echo HTTP_ROOT;?>Users/save_color/'+id.data('id'),
		  type: 'GET',
		  success: function(result){
  			$('.loader').hide();
  			$('#view-model').modal({
          show: 'true'
  		  });
      if(result==1){
  			$('#message').html('تم به روز شده موفقیت');
  			$('#message').show();
  			//$('.ui-colors').removeClass("active");
        $(this).parent('a').addClass('active');
			  return false;
			}if(result==2){
  			$('#message').html('تم به روز شده موفقیت');
  			$('#message').show();
  			//$('.ui-colors').removeClass("active");
        $(this).parent('a').addClass('active');
  			return false;
			}else{
  			$('#message').show('خطا رخ می دهد');
  			$('#message').css('background-color:red');
  			$('#message').show();
  			//$('.ui-colors').removeClass("active");
			}
				
				
				
			}
			
			
		});
	})
	
		
		
	
  
</script>