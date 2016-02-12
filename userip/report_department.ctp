<?php 
$bar = $this->requestAction(array('controller'=>'Users','action'=>'BarchartDept'),array('named'=>array('date'=>date('F Y'),'dept'=>@array_keys(@$name_list,@current($name_list)))));
$bar = json_decode($bar, true);
if(!empty($bar)){
  //debug($bar);
  $barchart = array();
  foreach ($bar['data'] as $key => $value) {
     $barchart[mb_substr($value[0]['ti'],8,2)] =$value[0]['c'];
  } 
  echo '<script>
  var i;
  var chart = AmCharts.makeChart("dept-users", {
    "type": "serial",
    "theme": "light",
    autoMargins: false,
    marginTop: 10,
    marginBottom: 30,
    marginLeft: 40,
    marginRight: 0,
    pullOutRadius: 0,
    "dataProvider": [';
  for ($i=01; $i < $bar['et']; $i++) { 
     $i = (strlen($i)==2) ? $i : '0'.$i; 
     if(isset($barchart[$i])){
        echo '{
        "day": "'.$i.'",
        "customer": '.$barchart[$i].'
        },';
     }else{
         echo '{
        "day": "'.$i.'",
        "customer": 0
        },';
     }
   } 
   echo ' ],
    "valueAxes": [{
      "gridColor": "#FFFFFF",
      "gridAlpha": 0.2,
      "dashLength": 0
    }],
    "gridAboveGraphs": true,
    "startDuration": 1,
    "graphs": [{
      "balloonText": "[[category]]: <b>[[value]]</b>",
      "fillAlphas": 0.8,
      "lineAlpha": 0.2,
      "type": "column",
      "valueField": "customer"
    }],
    "chartCursor": {
      "categoryBalloonEnabled": false,
      "cursorAlpha": 0,
      "zoomable": false
    },
    "categoryField": "day",
    "categoryAxis": {
      "gridPosition": "start",
      "fontSize": 9,
      "gridCount": 0,
      "ignoreAxisWidth": true,
      "labelOffset": -2,
      "minHorizontalGap": 5,
      "titleFontSize": 0
    },
    "export": {
      "enabled": true
    }

  });
</script>';
}
echo '<script>
  var chart = AmCharts.makeChart("chartdiv2", {
    "type": "pie",
    "theme": "light",
    autoMargins: false,
    marginTop: 0,
    marginBottom: 0,
    marginLeft: 10,
    marginRight: 10,
    pullOutRadius: 0,
    "dataProvider": ['; 
foreach ($name_list as $key => $value) {
  if(isset($depart_report[$key])){
      echo '{
      "department": "'.$value.'",
      "talktime": '.$depart_report[$key].'
      },';
  }
}
echo '],
    "valueField": "talktime",
    "titleField": "department",
    "balloon": {
      "fixedPosition": true
    },
    "export": {
      "enabled": true
    }
  });';

echo 'var chart = AmCharts.makeChart("chartdiv3", {
    "type": "pie",
    "theme": "light",
    autoMargins: false,
    marginTop: 0,
    marginBottom: 0,
    marginLeft: 10,
    marginRight: 10,
    pullOutRadius: 0,
    "dataProvider": [';
foreach ($name_list as $key => $value) {
  if(isset($duration_report[$key])){
      echo '{
      "department": "'.$value.'",
      "talktime": '.$duration_report[$key].'
      },';
  }
}
echo '],
    "valueField": "talktime",
    "titleField": "department",
    "balloon": {
      "fixedPosition": true
    },
    "export": {
      "enabled": true
    }
  });</script>';
?>

<style>
#chartdiv2, #chartdiv3 {
    display: inline-block;
    width: 100%;
    height: 300px;
    direction: ltr !important;
  }

    #chartdiv2 text, #chartdiv3 text {
      direction: ltr !important;
      font-family: 'Yekan' !important;
      font-weight: bold !important;
    }

  #dept-users {
    width: 100%;
    height: 300px;
    font-size: 11px;
    direction: ltr !important;
  }

    #dept-users text {
      margin-left: -50px !important;
    }
</style>
<div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-head">
        <div class="page-title">
         <h1>تم و رنگ ها <small> انتخاب جلوه های بصری </small></h1>
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
          <a href="/" class="txt">داشبورد</a>
          <i class="fa fa-circle" style="font-size: 8px !important;"></i>
        </li>
        <li>
          <a href="#" class="txt">تم و رنگ ها</a>
        </li>
      </ul>
      
      <div class="row">
        <div class="col-md-6">
          <div class="portlet box blue">
            <div class="portlet-title">
              <div class="caption font-yekan">
                <i class="fa fa-users"></i>درصد مشتریان
              </div>
            </div>
            <div class="portlet-body">
              <div style="overflow: hidden; text-align: left;" id="chartdiv2"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="portlet box blue">
            <div class="portlet-title">
              <div class="caption font-yekan">
                <i class="fa fa-clock-o"></i>زمان گفتگو
              </div>
            </div>
            <div class="portlet-body">
              <div style="overflow: hidden; text-align: left;" id="chartdiv3"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="portlet box blue">
            <div class="portlet-title">
              <div class="caption font-yekan">
                <i class="fa fa-gift"></i>گزارش ماهانه
              </div>
            </div>
            <div class="portlet-body">
              <div class="row">
                <div class="col-md-12">
                  <form action="#" class="form-horizontal dept-chart-label form-bordered">
                    <div class="form-body">
                      <div class="form-group">
                        <div class="col-md-3">
                          <label class="font-droid"><i class="fa fa-caret-left"></i> سال</label>
                          <select class="form-control edited font-droid" id="form_year">
                            <option value="0" selected="selected">---</option>
                            <?php 
                            $p = $this->requestAction(array('controller'=>'Cpanels','action'=>'gregorian_to_jalali'),array('named'=>array('date'=>date('Y-m-d'))));
                            for ($i=mb_substr($p, 0, 4); $i > mb_substr($p, 0, 4)-5 ; $i--) { 
                              echo '<option value="'.$i.'">'.$i.'</option>';
                              } ?>
                            
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label class="font-droid"><i class="fa fa-caret-left"></i> ماه </label>
                          <select class="form-control edited font-droid" id="form_month">
                            <option value="0" selected="selected">---</option>
                            <option value="01">فروردین</option>
                            <option value="02">اردیبهشت</option>
                            <option value="03">خرداد</option>
                            <option value="04">تیر</option>
                            <option value="05">مرداد</option>
                            <option value="06">شهریور</option>
                            <option value="07">مهر</option>
                            <option value="08">آبان</option>
                            <option value="09">آذر</option>
                            <option value="10">دی</option>
                            <option value="11">بهمن</option>
                            <option value="12">اسفند</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label for="form_control_1" class="font-droid"><i class="fa fa-caret-left"></i> دپارتمان</label>
                           <?php 
                          $name_list[0]= '---';
                          ksort($name_list);
                          echo $this->Form->input('department', array('type'=>'select','label' => false,'div'=>false, 'class' => 'form-control edited font-droid','id'=>'dept_id','options'=>$name_list ,'selected'=>'00'));?>
 				<!-- <select class="form-control edited font-droid" id="form_control_1">
                            <option value="">---</option>
                            <option value="1">فروش</option>
                            <option value="2">بازاریابی</option>
                            <option value="3">پشتیبانی</option>
                          </select> -->
                        </div>
                        <div class="col-md-3 t_align_c">
                          <button type="button" class="btn red btn-draw-graph">مشاهده نتایج</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div style="overflow: hidden; text-align: left;" id="dept-users"> 
               </div>
            </div>
          </div>
        </div>
      </div>
         
    </div>
  </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>

	$(".ui-colors").click(function () {
    $(this).toggleClass("active");
	
  });	
		$('body').on('click','.btn-draw-graph', function(){
      if($('#dept_id :selected').val() == 0 ||
        $('#form_month :selected').val() ==0 ||
        $('#form_year :selected').val()==0 ){
        $('#msg_title').html('پیام شکست');
        $('#msg_des').html('<span style="color:red">لطفا انتخاب کنید ضوابط جستجو</span>');
        $('#view-model').modal({
          show: 'true'
        }); 
        return false;
      }
      var d_id = $('#dept_id :selected').val();
      var month = $('#form_month :selected').val(); 
      var year = $('#form_year :selected').val();
      var stringurl = year+'-'+month+'-01'+'/dept%5B0%5D:'+d_id;
      $('.loader').show();
      $.ajax({
        url: '<?php echo HTTP_ROOT;?>Users/BarchartDept/date:'+stringurl,
        type: 'GET',
        data: 'date=123',
        success: function(result){
          $('.loader').hide();
          jsonObj = [];
          result = $.parseJSON(result);
          $.each( result.data, function( key, value ) {
            item = {}
            item ["day"] = value[0].ti.substr(8, 2);
            item ["customer"] = value[0].c;
            jsonObj.push(item);
          });
            var i;
            var chart = AmCharts.makeChart("dept-users", {
              "type": "serial",
              "theme": "light",
              autoMargins: false,
              marginTop: 10,
              marginBottom: 30,
              marginLeft: 40,
              marginRight: 0,
              pullOutRadius: 0,
              "dataProvider": jsonObj,
            "valueAxes": [{
              "gridColor": "#FFFFFF",
              "gridAlpha": 0.2,
              "dashLength": 0
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
              "balloonText": "[[category]]: <b>[[value]]</b>",
              "fillAlphas": 0.8,
              "lineAlpha": 0.2,
              "type": "column",
              "valueField": "customer"
            }],
            "chartCursor": {
              "categoryBalloonEnabled": false,
              "cursorAlpha": 0,
              "zoomable": false
            },
            "categoryField": "day",
            "categoryAxis": {
              "gridPosition": "start",
              "fontSize": 9,
              "gridCount": 0,
              "ignoreAxisWidth": true,
              "labelOffset": -2,
              "minHorizontalGap": 5,
              "titleFontSize": 0
            },
            "export": {
              "enabled": true
            }

          });
          /*$('#msg_title').html('Testssssss');
          $('#msg_des').html('dahctasafads');
          $('#view-model').modal({
            show: 'true'
          });  */
        }
      });
    });
  
</script>