	<?php $paginator = $this->Paginator;?>
	 <div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-head">
        <div class="page-title">
          <h1>گزارش اپراتور ها<small> زمان مکالمه و تعداد مشتری ها</small></h1>
        </div>
        <a class="btn red-haze font-yekan btn-md pull-right" data-toggle="modal" href="#agent-modal">تغییر اپراتور</a>
        <a class="bg-green pull-right selectged-agent">
          اپراتور انتخاب شده : علی حسینی
        </a>
      </div>
      <ul class="page-breadcrumb breadcrumb">
        <li>
          <a href="#">داشبورد</a>
          <i class="fa fa-circle"></i>
        </li>
        <li>
          <a href="#">گزارش اپراتور ها</a>
        </li>
      </ul>
      <div id="report-section">
        <div class="row margin-top-10">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="dashboard-stat2 green-med">
              <div class="display">
                <div class="number">
                  <h3 class="font-green-med">4</h3>
                  <small> تعداد پاسخ دهی ها </small>
                </div>
                <div class="icon">
                  <i class="icon-bubbles"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="dashboard-stat2 red-med ">
              <div class="display">
                <div class="number">
                  <h3 class="font-red-med">2</h3>
                  <small> میزان فعالیت</small>
                </div>
                <div class="icon">
                  <i class="icon-earphones-alt"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="dashboard-stat2 blue-med">
              <div class="display">
                <div class="number">
                  <h3 class="font-blue-med">63</h3>
                  <small>امتیاز مشتریان</small>
                </div>
                <div class="icon">
                  <i class="icon-star"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption font-yekan">
                  <i class="fa fa-users"></i>گزارش ماهانه تعداد مشتریان
                </div>
              </div>
              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-12">
                    <form action="#" class="form-horizontal form-bordered">
                      <div class="form-body">
                        <div class="form-group">
                          <div class="col-md-5">
                            <label class="font-droid"><i class="fa fa-caret-left"></i> سال</label>
                            <select class="form-control edited font-droid" id="year1">
                              <option value="">---</option>
                              <option value="1394">1394</option>
                              <option value="1393">1393</option>
                              <option value="1392">1392</option>
                            </select>
                          </div>
                          <div class="col-md-5">
                            <label class="font-droid"><i class="fa fa-caret-left"></i> ماه </label>
                            <select class="form-control edited font-droid" id="month1">
                              <option value="">---</option>
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
                         
                          <div class="col-md-2 t_align_c">
                            <button type="button" class="btn red btn-draw-graph" id="reportCount">مشاهده نتایج</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div id="agent-users"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption font-yekan">
                  <i class="fa fa-clock-o"></i>گزارش ماهانه میزان گفتگو
                </div>
              </div>
              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-12">
                    <form action="#" class="form-horizontal form-bordered">
                      <div class="form-body">
                        <div class="form-group">
                          <div class="col-md-5">
                            <label class="font-droid"><i class="fa fa-caret-left"></i> سال</label>
                            <select class="form-control edited font-droid" id="year2">
                              <option value="">---</option>
                              <option value="1394">1394</option>
                              <option value="1393">1393</option>
                              <option value="1392">1392</option>
                            </select>
                          </div>
                          <div class="col-md-5">
                            <label class="font-droid"><i class="fa fa-caret-left"></i> ماه </label>
                            <select class="form-control edited font-droid" id="month2">
                              <option value="">---</option>
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

                          <div class="col-md-2 t_align_c">
                            <button type="button" class="btn red btn-draw-graph" id="reportTime">مشاهده نتایج</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div id="agent-time"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="agent-modal" class="modal fade" tabindex="-1" data-backdrop="add-shortcut" data-keyboard="false">
  <div class="modal-header shortcut-modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title font-yekan">انتخاب اپراتور</h4>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <form action="#">
          <div class="form-group">
            <select class="form-control font-droid" id="agent_selected">
            <?php 
              foreach ($name_list as $key => $value) {
                echo '<option value="'.$key.'">'.$value.'</option>';
              }
            ?>
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal-footer font-yekan">
    <a id="get-agent-report" data-dismiss="modal" class="btn red-haze">تأیید</a>
    <a data-dismiss="modal" class="btn btn-default">انصراف</a>
  </div>
</div>

<style>
  #agent-users, #agent-time {
    width: 100%;
    height: 300px;
    font-size: 11px;
    direction: ltr !important;
  }

    #agent-users text, #agent-time text {
      margin-left: -50px !important;
    }
</style>
<script type="text/javascript">
  $(window).load(function () {
    $('#agent-modal').modal('show');
  });
  $("#get-agent-report").click(function(){
    $("#report-section").slideDown();
    if(parseInt($('#agent_selected').val()) !='NaN'){
      //console.log(parseInt($('#agent_selected').val()));
      $.ajax({
        url: '<?php echo HTTP_ROOT;?>Users/BarchartAgent/',
        type: 'POST',
        data: 'agent='+parseInt($('#agent_selected').val())+'&type=1',
        success: function(result){
          $('.loader').hide();
          result = $.parseJSON(result);
          if(result.month <=6){
            var c =31;
          }else if(result.month >6 && result.month <=11){
            var c =30;
          }else{
            var c =28;
          }
          jsonObj = [];
          var jsonData2 =[];
          for (var i = 1; i <= c; i++) {
               item = {}

            if(typeof result.data[i] != 'undefined'){
              item['day'] = i;
              item['customer'] = result.data[i];
            }else if(typeof result.data['0'+i] != 'undefined'){
              item['day'] = i;
              item['customer'] = result.data['0'+i];
            }else{
              item['day'] = i;
              item['customer'] = 0;
            }
              jsonObj.push(item);
          };
          var chart = AmCharts.makeChart("agent-users", {
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
              "lineColor": "#7aebdb",
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
          
        }
      });
  $.ajax({
        url: '<?php echo HTTP_ROOT;?>Users/BarchartAgent/',
        type: 'POST',
        data: 'agent='+parseInt($('#agent_selected').val())+'&type=3&month='+$('#month2').val()+'&year='+$('#year2').val(),
        success: function(result){
          $('.loader').hide();
          result = $.parseJSON(result);
          if(result.month <=6){
            var c =31;
          }else if(result.month >6 && result.month <=11){
            var c =30;
          }else{
            var c =28;
          }
          jsonObj = [];
          var jsonData2 =[];
          for (var i = 1; i <= c; i++) {
               item = {}
            if(typeof result.data[i] != 'undefined'){
              item['day'] = i;
              item['customer'] = parseInt(result.data[i]/60);
            }else if(typeof result.data['0'+i] != 'undefined'){
              item['day'] = i;
              item['customer'] = parseInt(result.data['0'+i]/60);
            }else{
              item['day'] = i;
              item['customer'] = 0;
            }
              jsonObj.push(item);
          };
          var chart = AmCharts.makeChart("agent-time", {
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
              "lineColor": "#7aebdb",
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
        }
      });
    }
  });
  $('#reportCount').click(function(){
      //1
    if( (parseInt($('#agent_selected').val()) !='NaN') && ($('#year1').val() != '') && ($('#month1').val() !='')) {
      console.log($('#year1').val());
      console.log($('#month1').val());
      console.log(parseInt($('#agent_selected').val()));
      $.ajax({
        url: '<?php echo HTTP_ROOT;?>Users/BarchartAgent/',
        type: 'POST',
        data: 'agent='+parseInt($('#agent_selected').val())+'&type=2&month='+$('#month1').val()+'&year='+$('#year1').val(),
        success: function(result){
          $('.loader').hide();
          result = $.parseJSON(result);
          if(result.month <=6){
            var c =31;
          }else if(result.month >6 && result.month <=11){
            var c =30;
          }else{
            var c =28;
          }
          jsonObj = [];
          var jsonData2 =[];
          for (var i = 1; i <= c; i++) {
               item = {}
            if(typeof result.data[i] != 'undefined'){
              item['day'] = i;
              item['customer'] = result.data[i];
            }else if(typeof result.data['0'+i] != 'undefined'){
              item['day'] = i;
              item['customer'] = result.data['0'+i];
            }else{
              item['day'] = i;
              item['customer'] = 0;
            }
              jsonObj.push(item);
          };
          var chart = AmCharts.makeChart("agent-users", {
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
              "lineColor": "#7aebdb",
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
        }
      });
    }
  });
  $('#reportTime').click(function(){
      //2
    if((parseInt($('#agent_selected').val()) !='NaN') && ($('#year2').val() !='') && ($('#month2').val() !='')){
      console.log($('#year2').val());
      console.log($('#month2').val());
      console.log(parseInt($('#agent_selected').val()));
      $.ajax({
        url: '<?php echo HTTP_ROOT;?>Users/BarchartAgent/',
        type: 'POST',
        data: 'agent='+parseInt($('#agent_selected').val())+'&type=3&month='+$('#month2').val()+'&year='+$('#year2').val(),
        success: function(result){
          $('.loader').hide();
          result = $.parseJSON(result);
          if(result.month <=6){
            var c =31;
          }else if(result.month >6 && result.month <=11){
            var c =30;
          }else{
            var c =28;
          }
          jsonObj = [];
          var jsonData2 =[];
          for (var i = 1; i <= c; i++) {
               item = {}
            if(typeof result.data[i] != 'undefined'){
              item['day'] = i;
              item['customer'] = parseInt(result.data[i]/60);
            }else if(typeof result.data['0'+i] != 'undefined'){
              item['day'] = i;
              item['customer'] = parseInt(result.data['0'+i]/60);
            }else{
              item['day'] = i;
              item['customer'] = 0;
            }
              jsonObj.push(item);
          };
          var chart = AmCharts.makeChart("agent-time", {
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
              "lineColor": "#7aebdb",
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
        }
      });
    }
  });
</script>