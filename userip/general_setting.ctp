<style>
#flashMessage{
	width:80%;float:left;text-align:center;
}
</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-head">
            <div class="page-title">
                <h1>تنظیمات عمومی</h1>
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
                <a href="#" class="txt">تنظیمات عمومی</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-haze">
                            <i class="icon-list font-green-haze"></i>
                            <span class="caption-subject bold uppercase font-yekan"> مسدود کردن زمان</span>
                        </div>
                    </div>
                    <div class="portlet-body form font-yekan">
			            <?php echo $this->Form->create('BlockingTime',array('class'=>'form-horizontal'));?>
                        <div class="form-body">
                  
                            <div class="form-group form-md-line-input">
                                <label class="col-md-2 control-label" for="form_control_1">
                                    زمان برای مسدود کردن
                                </label>
                                <div class="col-md-10">
                                    <?php echo $this->Form->input('time',array('type'=>'text','id'=>'b_talk','label'=>false,'div'=>false,'class'=>'form-control','placeholder'=>'زمان در چند دقیقه...','value'=>@$time['BlockingTime']['blocking_time']));?>
                                    <div class="form-control-focus">
                                    </div>
                                    <span class="help-block"> زمان برای مسدود کردن.</span>
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
                        <?php echo $this->Form->end();?>
                    </div>
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
            <div class="col-md-6 col-lg-8 col-sm-6 col-xs-12">
                <p id="message2" style="display:none;color:red;text-align:center;"></p>
            </div>
        </div> 
    </div>
</div>
<script>
	$(".ui-colors").click(function () {
        $(this).toggleClass("active");
	
    });
    $('#BlockingTimeGeneralSettingForm').submit(function(e){
        $('.loader').show();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '<?php echo HTTP_ROOT;?>Users/ajaxBlockingTime',
            data: $("#BlockingTimeGeneralSettingForm").serialize(),
            success: function(msg){
	            $('.loader').hide();
                $('#message2').show();
                $('#message2').html(msg);
		        $('#view_model').modal({
                    show: 'true'
                });
			}
		
		});
		return false;
	});
</script>