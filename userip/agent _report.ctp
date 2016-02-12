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
          <a href="@Url.Action("Index","Home")">داشبورد</a>
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
                            <select class="form-control edited font-droid" id="form_control_1">
                              <option value="">---</option>
                              <option value="1394">1394</option>
                              <option value="1393">1393</option>
                              <option value="1392">1392</option>
                            </select>
                          </div>
                          <div class="col-md-5">
                            <label class="font-droid"><i class="fa fa-caret-left"></i> ماه </label>
                            <select class="form-control edited font-droid" id="form_control_1">
                              <option value="">---</option>
                              <option value="01">فروردین</option>
                              <option value="1393">اردیبهشت</option>
                              <option value="1392">خرداد</option>
                              <option value="1392">تیر</option>
                              <option value="1392">مرداد</option>
                              <option value="1392">شهریور</option>
                              <option value="1392">مهر</option>
                              <option value="1392">آبان</option>
                              <option value="1392">آذر</option>
                              <option value="1392">دی</option>
                              <option value="1392">بهمن</option>
                              <option value="1392">اسفند</option>
                            </select>
                          </div>
                         
                          <div class="col-md-2 t_align_c">
                            <button type="button" class="btn red btn-draw-graph">مشاهده نتایج</button>
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
                            <select class="form-control edited font-droid" id="form_control_1">
                              <option value="">---</option>
                              <option value="1394">1394</option>
                              <option value="1393">1393</option>
                              <option value="1392">1392</option>
                            </select>
                          </div>
                          <div class="col-md-5">
                            <label class="font-droid"><i class="fa fa-caret-left"></i> ماه </label>
                            <select class="form-control edited font-droid" id="form_control_1">
                              <option value="">---</option>
                              <option value="01">فروردین</option>
                              <option value="1393">اردیبهشت</option>
                              <option value="1392">خرداد</option>
                              <option value="1392">تیر</option>
                              <option value="1392">مرداد</option>
                              <option value="1392">شهریور</option>
                              <option value="1392">مهر</option>
                              <option value="1392">آبان</option>
                              <option value="1392">آذر</option>
                              <option value="1392">دی</option>
                              <option value="1392">بهمن</option>
                              <option value="1392">اسفند</option>
                            </select>
                          </div>

                          <div class="col-md-2 t_align_c">
                            <button type="button" class="btn red btn-draw-graph">مشاهده نتایج</button>
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
            <select class="form-control font-droid">
              <option>محمد</option>
              <option>علی</option>
              <option>حسین</option>
              <option>فاطمه</option>
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
<script>
  var chart = AmCharts.makeChart("agent-users", {
    "type": "serial",
    "theme": "light",
    autoMargins: false,
    marginTop: 10,
    marginBottom: 30,
    marginLeft: 40,
    marginRight: 0,
    pullOutRadius: 0,
    "dataProvider": [
       @{
         Random rnd = new Random();
  }
      @for (int i = 1; i < 31; i++)
      {
			  <text> {
        "day": @i,
        "customer": @(rnd.Next(5, 15) * rnd.Next(2, 9))
        },
    </text>
			}
    
    ],
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
</script>
<script>
  var chart = AmCharts.makeChart("agent-time", {
    "type": "serial",
    "theme": "light",
    autoMargins: false,
    marginTop: 10,
    marginBottom: 30,
    marginLeft: 40,
    marginRight: 0,
    pullOutRadius: 0,
    "dataProvider": [

       {
        "day": 1,
        "customer":  @(rnd.Next(2, 8) * rnd.Next(7,12))
        },
		
	
    ],
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
      "lineColor": "#f14c39",
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
</script>
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
  });
</script>