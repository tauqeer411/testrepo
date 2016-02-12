<div class="page-content-wrapper">
    
	<div class="page-content">
      <div class="page-head">
	  <div style="padding:0px 20px;width:70%;text-align:center;float:left;">   
      <?php echo $this->Session->flash();?>
       </div>
        <div class="page-title">
          <h1>داشبورد </h1>
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
      <div class="row margin-top-10">
	  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat2 green-med">
            <div class="display">
              <div class="number">
                <h3 class="font-green-med"><?php echo isset($totaloperator)?$totaloperator:"N/A";?></h3>
                <small> اپراتور فعال </small>
              </div>
              <div class="icon">
                <i class="icon-pie-chart"></i>
              </div>
            </div>
            
          </div>
        </div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat2 red-med ">
            <div class="display">
              <div class="number">
                <h3 class="font-red-med"><?php echo isset($active)?$active:"N/A";?></h3>
                <small> گفتگوی فعال</small>
              </div>
              <div class="icon">
                <i class="icon-check"></i>
              </div>
            </div>
            
          </div>
        </div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat2 blue-med">
            <div class="display">
              <div class="number">
                <h3 class="font-blue-med"><?php echo isset($all_conversation)?$all_conversation:"N/A";?></h3>
                <small>گفتگوی جدید</small>
              </div>
              <div class="icon">
                <i class="icon-bubbles"></i>
              </div>
            </div>
            
          </div>
        </div>
       <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat2 purple-med">
            <div class="display">
              <div class="number">
                <h3 class="font-purple-med"><?php echo isset($visitor_online)?$visitor_online:"N/A";?></h3>
                <small>تعداد مشتری ها</small>
              </div>
              <div class="icon">
                <i class="icon-user"></i>
              </div>
            </div>
            
          </div>
        </div>
         
        
        
        
       
       
      </div>
      <div class="row">
	  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat yellow-lemon">
            <div class="visual">
              <i class="fa fa-magic"></i>
            </div>
            <div class="details">
              <div class="desc">
                چت باکس خود را سفارشی کنید
              </div>
            </div>
            <a class="more" href="<?php echo HTTP_ROOT;?>users/visual">
              تم و رنگ ها <i class="m-icon-swapright m-icon-white"></i>
            </a>
          </div>
        </div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat cabaret">
            <div class="visual">
              <i class="fa fa-thumbs-up"></i>
            </div>
            <div class="details">
              <div class="desc">
                به استقبال مشتری بروید
              </div>
            </div>
            <a class="more" href="/Profile/Home/Texts">
              متن و جمله ها <i class="m-icon-swapright m-icon-white"></i>
            </a>
          </div>
        </div>
       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="dashboard-stat ecstasy">
            <div class="visual">
              <i class="fa fa-info-circle"></i>
            </div>
            <div class="details">
              <div class="desc">
                <div class="row">
                  <div class="col-md-5 col-sm-5 col-xs-4">
                    <p>شرکت:<span><?php echo isset($company_name)?$company_name:"N/A";?></span></p>
                    <p>تعداد اپراتورها : <span><?php echo isset($online_operator)?$online_operator:"N/A";?>/<?php echo isset($totaloperator)?$totaloperator:"N/A";?></span></p>
                    <p>تعداد دپارتمان ها : <span><?php echo isset($active_department)?$active_department:"N/A";?>/<?php echo isset($total_department)?$total_department:"N/A";?></span></p>
                  </div>
                  <div class="col-md-7 col-sm-7 col-xs-8">
                    <p>نوع سرویس : <span><?php echo isset($plan_name)?$plan_name:"N/A";?></span></p>
                    <p>تاریخ شروع : <span><?php echo isset($plan_start_date)?$this->requestAction(array('controller'=>'Cpanels','action'=>'gregorian_to_jalali'),array('named'=>array('date'=>$plan_start_date))):"N/A";?></span></p>
                    <p>تاریخ پایان این دوره : <span> <?php echo isset($plan_end_date)?$this->requestAction(array('controller'=>'Cpanels','action'=>'gregorian_to_jalali'),array('named'=>array('date'=>$plan_end_date))):"N/A";?></span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
        
      
       
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="portlet box green-haze">
            <div class="portlet-title">
              <div class="caption font-yekan">
                <i class="fa fa-globe"></i>فعالیت اپراتورها
              </div>
            </div>
            <div class="portlet-body" style="direction:ltr;">
              <div id="live-chart-index" style="min-width: 310px; height: 400px; margin: 0 auto" data-highcharts-chart="0">
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"> 
    var API_SECRET ="<?php echo bin2hex($this->Session->read('User.username')) ;?>"; 
  </script>
  <script src="http://159.203.137.94/realGraph.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function () {
      $(document).ready(function () {
        Highcharts.setOptions({
          global: {
            useUTC: false
          }
        });

        $('#live-chart-index').highcharts({
          chart: {
            type: 'spline',
            animation: Highcharts.svg, // don't animate in old IE
            marginRight: 10,
            events: {
              load: function () {

                // set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function () {
                  var x = (new Date()).getTime(), // current time
                      y = testGraph2();
                  series.addPoint([x,y], true, true);
                }, 1000);
              }
            }
          },
          title: {
            text: ''
          },
          xAxis: {
            type: 'datetime',
            tickPixelInterval: 150
          },
          yAxis: {
            title: {
              text: 'تعداد کاربران آنلاین'
            },
            plotLines: [{
              value: 0,
              width: 1,
              color: '#808080'
            }]
          },
          tooltip: {
            enabled:false
          },
          legend: {
            enabled: false
          },
          exporting: {
            enabled: false
          },
          series: [{
            name: '',
            data: (function () {
              // generate an array of random data
              var data = [],
                  time = (new Date()).getTime(),
                  i;
				
              //for (i = -19; i <= 0; i += 1) {
                data.push({
                  x: time + 1 * 1000,
                  y: Math.random()
                });
              //}
            
			  return data;
            }())
          }]
        });
      });
    });
  </script>