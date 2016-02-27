<style>
#flashMessage{
	width:80%;float:left;text-align:center;
}
</style>
<div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-head">
        <div class="page-title">
         <h1>متن ها و جمله ها <small>انتخاب جملات خوش آمد گویی، عنوان و ...</small></h1>
        </div>
        <div class="page-toolbar">

        </div>
      </div>
      <ul class="page-breadcrumb breadcrumb hide">
        <li>
          <a href="javascript:;">Home</a><i class="fa fa-circle"></i>
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
          <!-- BEGIN SAMPLE FORM PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption font-green-haze">
                <i class="icon-list font-green-haze"></i>
                <span class="caption-subject bold uppercase font-yekan"> متن ها و جمله ها</span>
              </div>
			  
			 
              
            </div>
            <div class="portlet-body form font-yekan">
             
			  <?php echo $this->Form->create('Text',array('class'=>'form-horizontal'));?>
                <div class="form-body">
                  
                  <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">سربرگ پیش از گفتگو</label>
                    <div class="col-md-10">
					 
                      <?php echo $this->Form->input('before_talk',array('type'=>'text','id'=>'b_talk','label'=>false,'div'=>false,'class'=>'form-control','placeholder'=>'متن خود را وارد کنید...' ,'value'=>@$oldValue['before_talk']));?>
					  <div class="form-control-focus">
                      </div>
                      <span class="help-block"> جمله ای است که در سربرگ باکس گفتگو، قبل از شروع آن نمایش داده می شود.</span>
                    </div>
                  </div>
                  
                  <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">پیام خوش آمد گویی</label>
                    <div class="col-md-10">
                      <?php echo $this->Form->input('welcome_message',array('type'=>'text','id'=>'w_message','label'=>false,'div'=>false,'class'=>'form-control','placeholder'=>'متن خود را وارد کنید...' ,'value'=>@$oldValue['welcome_message']));?>
					  
					  <div class="form-control-focus">
                      </div>
                      <span class="help-block">پیش از شروع گفتگو، این پیام برای کاربر نمایش داده می شود.</span>
                    </div>
                  </div>
                  <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">پیام اتمام گفتگو</label>
                    <div class="col-md-10">
					<?php echo $this->Form->input('closing_message',array('type'=>'text','id'=>'c_message','label'=>false,'div'=>false,'class'=>'form-control','placeholder'=>'متن خود را وارد کنید...' ,'value'=>@$oldValue['closing_message']));?>
					  
					<div class="form-control-focus">
                      </div>
                      <span class="help-block">هنگامی که اپراتور، گفتگو را ترک کند، این پیام برای کاربر نمایش داده می شود.</span>
                    </div>
                  </div>
                  
                </div>
				 <div class="form-actions">
                  <div class="row">
                    <div class="col-md-offset-2 col-md-10">
                      <input type="submit" class="btn btn-lg green-jungle" value="ذخیره">
					  
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!--<div class="portlet-title">
              <div class="caption font-green-haze">
                <i class="icon-user font-green-haze"></i>
                <span class="caption-subject bold uppercase font-yekan"> اطلاعات پیش از شروع گفتگو</span>
              </div>
            </div>
            <div class="portlet-body form font-yekan">
              <form role="form" class="form-horizontal">
                <div class="form-body">
                  <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label" for="form_control_1">چه اطلاعاتی از کاربر قبل از شروع گفتگو دریافت شود؟</label>
                    <div class="col-md-10">
                      <div class="md-checkbox-list">
                        <div class="md-checkbox">
                          <input id="checkbox30" class="md-check" type="checkbox">
                          <label for="checkbox30">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            نام
                          </label>
                        </div>
                        <div class="md-checkbox">
                          <input id="checkbox31" class="md-check" type="checkbox">
                          <label for="checkbox31">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            ایمیل
                          </label>
                        </div>
                        <div class="md-checkbox">
                          <input id="checkbox32" class="md-check" type="checkbox">
                          <label for="checkbox32">
                            <span></span>
                            <span class="check"></span>
                            <span class="box"></span>
                            شماره تماس
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </form>
            </div>-->
          </div>
        </div>
      </div>
         
    </div>
  </div>
  <!-- Model Box -->
  <div id="view_model" class="modal fade" tabindex="-1" data-backdrop="edit-dept" data-keyboard="false">
  <div class="modal-header dept-modal-header" style="background-color:green;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title font-yekan">وزارت ویرایش</h4>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
		 
		<p id="message2" style="display:none;color:red;text-align:center;">
	</p>

        
      </div>
    </div>
	
 </div>
  
   
</div>
  <!-- --------------------------End Model Box------------------------------------- -->
      
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>

	$(".ui-colors").click(function () {
    $(this).toggleClass("active");
	
  });
  $('#TextTextsForm').submit(function(e){
	$('.loader').show();
		e.preventDefault();
		$.ajax({
		type: "POST",
		url: '<?php echo HTTP_ROOT;?>Users/texts',
		data: $("#TextTextsForm").serialize(),
		success: function(msg){
			if(msg==1)
			{
			$('.loader').hide();
			$('.modal-title font-yekan').html('پیغام خطا');
			$('#message2').show();
			$('#message2').css('color','green');
			$('#message2').html('سوابق ذخیره شده با موفقیت');
			$('#view_model').modal({
        show: 'true'
		
    });
	//$("#view_model").text(msg);
			}
			else{
			$('.loader').hide();
			$('.modal-title font-yekan').html('پیغام خطا');
			$('#message2').show();
			$('#message2').css('color','red');
			$('#message2').html('لطفا فیلدهای خالی را پر کنید');
			$('#view_model').modal({
        show: 'true'
		
    });
	//$("#view_model").text(msg);
			}
			}
		
		
	
		});
		 return false;
		
	});
	
		
  
</script>