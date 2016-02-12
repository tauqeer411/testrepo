 <div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-head">
        <div class="page-title">
          <h1>میانبر ها <small>افزودن، ویرایش و حذف میانبر ها</small></h1>
        </div>
      </div>
      <ul class="page-breadcrumb breadcrumb">
        <li>
          <a href="#">داشبورد</a>
          <i class="fa fa-circle"></i>
        </li>
        <li>
          <a href="#">میانبر ها</a>
        </li>
      </ul>
        <div class="row">
          <div class="col-md-6">
            <div class="btn-group">
              <button id="sample_editable_1_new" class="btn red-flamingo btn-add-new font-yekan" data-target="#add-shortcut" data-toggle="modal">
                <i class="fa fa-plus"></i> افزودن میانبر جدید
              </button>
            </div>
          </div>
        </div>
      <div class="row">
        <div class="col-md-12">
          <div class="portlet box red-haze">
            <div class="portlet-title">
              <div class="caption font-yekan">
                <i class="icon-note"></i>میانبر ها
              </div>
            </div>
            <div class="portlet-body">

              <table class="table table-striped table-hover table-action table-bordered font-droid" id="sample_editable_1">
                <thead>
                  <tr>
                    <th>
                     هیچ
                    </th>
                    <th>
                      کد کوتاه شده
                    </th>
                    <th>
                      متن کامل
                    </th>
                    <th>
                      عملیات
                    </th>
                  </tr>
                </thead>
                <tbody>
				<?php if(isset($view)){
					$i=0;
					foreach($view as $res){?>
                  <tr>
                    <td>
                     <?php echo ++$i;?>
                    </td>
                    <td class="td_0<?php echo $res['Shortcut']['id'];?>" style="direction:ltr">
                      <?php echo isset($res['Shortcut']['short_code'])?$res['Shortcut']['short_code']:"N/A";?>
                    </td>
                    <td class="td_1<?php echo $res['Shortcut']['id'];?>">
                       <?php echo isset($res['Shortcut']['full_text'])?$res['Shortcut']['full_text']:"N/A";?>
                  
                    </td>

                    <td>
					
                      <button  data-placement="top" data-target="#edit-shortcut"  data-id="<?php echo base64_encode($res['Shortcut']['id']);?>"data-toggle="modal" title="ویرایش" class="btn btn-icon-only btn-warning edit">
                        <i class="fa fa-edit"></i>
						</button>
                      <button data-placement="top" data-id="<?php echo base64_encode($res['Shortcut']['id']);?>" data-toggle="tooltip" title="حذف" class="btn btn-icon-only btn-danger delete">
                        <i class="fa fa-trash-o"></i>
						</button>
                    </td>
                  </tr>
                  
				<?php }}?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Add Shortcuts Model Box -->
<div id="add-shortcut" class="modal fade" tabindex="-1" data-backdrop="add-shortcut" data-keyboard="false">
  <div class="modal-header shortcut-modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title font-yekan">افزودن میانبر</h4>
  </div>
  
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?php echo $this->Form->create('Shortcut');?> 
		<p id="message2" style="display:none;color:red;font-face:bold;">
	</p>
          <div class="form-group">
		 
		  <?php echo $this->form->input('short_code',array('type'=>'text','id'=>'s_code','value'=>'','label' => false,'div'=>false, 'class' => 'form-control font-droid','placeholder'=>'متن کوتاه شده (با ! شروع شود' ));?>
           </div>
          <div class="form-group">
             <?php echo $this->form->input('full_text',array('type'=>'text','id'=>'f_text','label' => false,'div'=>false, 'class' => 'form-control font-droid','placeholder'=>'متن کامل'));?>
          
			</div>
        
      </div>
    </div>
  </div>
  <div class="modal-footer font-yekan">
    <input type="submit"  class="btn red-haze" value="ذخیره">
    <input type="reset" data-dismiss="modal" class="btn btn-default" value="انصراف">
  </div>
  </form>
</div>
<!-- Edit Shortcuts Model Box -->
<div id="edit-shortcut" class="modal fade" tabindex="-1" data-backdrop="edit-shortcut" data-keyboard="false">
  <div class="modal-header shortcut-modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title font-yekan">ویرایش میانبر</h4>
  </div>
  
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?php echo $this->Form->create('Short');?> 
		<p id="message" style="display:none;color:red;font-face:bold;">
	</p>
          <div class="form-group">
		 <?php echo $this->form->input('id',array('type'=>'hidden','id'=>'ide','label' => false,'div'=>false, 'class' => 'form-control font-droid','placeholder'=>'متن کوتاه شده (با ! شروع شود'));?>
		  <?php echo $this->form->input('short_code',array('type'=>'text','id'=>'short_code','label' => false,'div'=>false, 'class' => 'form-control font-droid','placeholder'=>'متن کوتاه شده (با ! شروع شود','style'=>'direction:ltr;text-align:right'));?>
           </div>
          <div class="form-group">
             <?php echo $this->form->input('full_text',array('type'=>'text','id'=>'full_text','label' => false,'div'=>false, 'class' => 'form-control font-droid','placeholder'=>'متن کامل'));?>
			</div>
      </div>
    </div>
  </div>
  <div class="modal-footer font-yekan">
    <input type="submit"  class="btn red-haze" value="به روز رسانی">
    <input type="reset" data-dismiss="modal" class="btn btn-default" value="انصراف">
  </div>
  </form>
</div>
<script>
var code = new Array();

$('body').on('keypress','#short_code', function(e){
	if(e.which != 8 && ((e.which >= 48 && e.which <= 57) || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122))){
		var testvalue= 	$('#short_code').val();
		if(e.ctrlKey ){
			testvalue += '[ctrl]';
		}
		if(e.altKey){
			testvalue += '[alt]';
		}
		if(e.shiftKey){
			testvalue += '[shift]';
		}
		testvalue += e.key;
		$('#short_code').val(testvalue);
		$('#short_code').css('direction','ltr');
		$('#short_code').css('text-align','right');
		e.preventDefault();
	}else if((e.which == 8) || (e.which == 0)){
		var testvalue = $('#short_code').val();
		if(testvalue.substr(testvalue.length - 1) == ']'){
			$('#short_code').val(testvalue.substr(0,testvalue.lastIndexOf("["))) ;
			e.preventDefault();
		}
		if($('#short_code').val() ==''){
			$('#short_code').css('direction','rtl');
		}
	}
});
$('body').on('keypress','#s_code', function(e){
	if(e.which != 8 && ((e.which >= 48 && e.which <= 57) || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122))){
		var testvalue= 	$('#s_code').val();
		if(e.ctrlKey ){
			testvalue += '[ctrl]';
		}
		if(e.altKey){
			testvalue += '[alt]';
		}
		if(e.shiftKey){
			testvalue += '[shift]';
		}
		testvalue += e.key;
		$('#s_code').val(testvalue);
		$('#s_code').css('direction','ltr');
		$('#s_code').css('text-align','right');
		e.preventDefault();
	}else if((e.which == 8) || (e.which == 0)){
		var testvalue = $('#s_code').val();
		if(testvalue.substr(testvalue.length - 1) == ']'){
			$('#s_code').val(testvalue.substr(0,testvalue.lastIndexOf("["))) ;
			e.preventDefault();
		}
		if($('#s_code').val() ==''){
			$('#s_code').css('direction','rtl');
		}
	}
});

$('#ShortcutShortcutsForm').submit(function(e) {
		$('.loader').show();
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: '<?php echo HTTP_ROOT;?>Users/shortcuts',
			data: $("#ShortcutShortcutsForm").serialize(),
			
			success: function(msg){
				var res = $.parseJSON(msg);
				$('.loader').hide();
				if(res.code==1){
					$('#message2').css("color","green");
					$('#s_code').val('');
					$('#f_text').val('');
					$('#sample_editable_1').find('tbody').append(res.html);
					var count = $('#sample_editable_1').find('tbody').children('tr').length;
					$('tbody tr:last-child td:first-child').html(count);
				}else if(res.code==0){
					$('#message2').css("color","red");
				}
				$('#message2').html(res.msg);
				$('#message2').show();
				setTimeout(function(){
					$('#message2').html('');
					$('#message2').hide();
				},3000)
			}
		});
		return false;
	});
	$('body').on('click', '.delete', function(){
		var id = $(this);
		
		$('.loader').show();
		$.ajax({
		   url: '<?php echo HTTP_ROOT;?>Users/DeleteShortcut/'+id.data('id'),
		   type: 'GET',
		   success: function(result){
			   
				if(result==1)
				{
				$('.loader').hide();	
				$(id).closest('tr').remove();
				
				
				
				}
				 
			}
			
			
		});
	})
	$('body').on('click', '.edit', function(){
		var id = $(this);
		//alert(id);
		$('.loader').show();
		$.ajax({
		   url: '<?php echo HTTP_ROOT;?>Users/EditShortcut/'+id.data('id'),
		   type: 'GET',
		   success: function(result){
			   	var obj = $.parseJSON(result);
				$('.loader').hide();
				$('#short_code').val(obj.Shortcut.short_code.replace(',',''));
				$('#full_text').val(obj.Shortcut.full_text);
				$('#ide').val(obj.Shortcut.id);

		   },
		   async: false			
		});
	});
	$('#ShortShortcutsForm').submit(function(e){
		$('.loader').show();
		e.preventDefault();
		
		$.ajax({
		type: "POST",
		url: '<?php echo HTTP_ROOT;?>Users/EditShortcut',
		data: $("#ShortShortcutsForm").serialize(),
		
		success: function(msg){
			var res = $.parseJSON(msg);
				$('.loader').hide();
				$('#message').html(res.msg);
				$('#message').show();
			if(res.code==1){
				$('#message').css("color","green");
				$('.td_0'+$('#ide').val()).html(res.html);
				$('.td_1'+$('#ide').val()).html($('#full_text').val());
			}else if(res.code==0){
				$('#message').css("color","red");
			}

			setTimeout(function(){
				$('#message').html('');
				$('#message').hide();
			},3000)
		
		}
	
		});
		 return false;
	});

</script>