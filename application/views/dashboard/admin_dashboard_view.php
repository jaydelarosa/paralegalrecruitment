<div class="sm-container">

    <div class="row">

        <div class="col-md-3">

            <div class="reviews-s-box" style="border-left: 5px solid #f0609d;padding:10px 20px;">
                <div class="reviews-s-box-info" style="margin-top: 15px;">
                    <h5>$<?php echo number_format($total_revenue[0]['total'],2) ?> <span>USD</span></h5>
                    <p>Total Revenue</p>
                </div>
                <div class="s-box-lbl text-center" style="margin-top: 20px;">
                    <i class="fa fa-heart"></i>
                </div>
                <div class="clearfix"></div>
            </div>

        </div>

        <div class="col-md-3">

            <div class="reviews-s-box" style="border-left: 5px solid #62edd8;padding:10px 20px;">
                <div class="reviews-s-box-info" style="margin-top: 15px;">
                    <h5><?php echo !empty($today_sale[0]['count']) ? $today_sale[0]['count'] : 0 ; ?></h5>
                    <p>Today's Sale</p>
                </div>
                <div class="s-box-lbl text-center" style="margin-top: 20px;">
                    <i class="fa fa-shopping-cart" style="color: #62edd8;"></i>
                </div>
                <div class="clearfix"></div>
            </div>
            
        </div>

        <!-- <div class="col-md-3">

            <div class="reviews-s-box" style="border-left: 5px solid #56bdde;padding:10px 20px;">
                <div class="reviews-s-box-info" style="margin-top: 15px;">
                    <h5>0.58%</h5>
                    <p>Convertion</p>
                </div>
                <div class="s-box-lbl text-center" style="margin-top: 20px;">
                    <i class="fa fa-bar-chart" style="color: #56bdde;"></i>
                </div>
                <div class="clearfix"></div>
            </div>
            
        </div> -->

        <!-- <div class="col-md-3">

            <div class="reviews-s-box" style="border-left: 5px solid #f0b652;padding:10px 20px;">
                <div class="reviews-s-box-info" style="margin-top: 15px;">
                    <h5>78.41k</h5>
                    <p>Today's Visit</p>
                </div>
                <div class="s-box-lbl text-center" style="margin-top: 20px;">
                    <i class="fa fa-eye" style="color: #f0b652;"></i>
                </div>
                <div class="clearfix"></div>
            </div>
            
        </div> -->

    </div>

    <!-- -->
    <div class="row">

        <!-- <div class="col-md-4">

            <div class="def-box-main dash-box-content">
            
                <div class="dash-box-content-body">
                    <h5>Total Revenue</h5>

                    <div class="chartJS-revenue" style="position: relative;">
                        <canvas id="donut-chart-js" height="240" width="100%" ></canvas>
                         <div class="text-centerx" style="position:absolute;bottom: 115px;right: 37%;font-size: 12px;">
                            Revenue 68%
                        </div>
                    </div>

                   

                    <div class="clearfix"></div>
                    <br/>

                    <div class="tr-sales text-center">
                        <h5>Total Sales Made Today</h5>
                        <h6>178 <span>USD</span></h6>
                    </div>


                    <table class="tbl-tr-sales" width="100%">
                        <tr>
                            <td>
                                <span>Target</span>
                                <h6><i class="fas fa-arrow-down" style="color: #dc3139;"></i> $7.8k</h6>
                            </td>
                            <td>
                                <span>Last Week</span>
                                <h6><i class="fas fa-arrow-up" style="color: #40b660;"></i> $1.4k</h6>
                            </td>
                            <td>
                                <span>Last Month</span>
                                <h6><i class="fas fa-arrow-down" style="color: #dc3139;"></i> $15k</h6>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>

        </div> -->

        <div class="col-md-12">

            <div class="def-box-main dash-box-content">
                
                <div class="dash-box-content-body">

                    <div class="row">
                        <div class="col-md-6">

                            <h5>Sale Analytics</h5>

                        </div>
                        <div class="col-md-6">
                            
                            <!-- <div class="btn-group pull-right analytics-btn-group" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-secondary">Today</button>
                              <button type="button" class="btn btn-secondary">Weekly</button>
                              <button type="button" class="btn btn-secondary active">Monthly</button>
                            </div>
                            <div class="clearfix"></div> -->
                        </div>
                    </div>


                    <div class="chartJS-analytics" style="margin-top: 10px;">
                        <canvas id="bar-chart-js" height="390" width="100%" ></canvas>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- -->
    <div class="row">

        <div class="col-md-4">

            <div class="def-box-main dash-box-content">

                <div class="dash-box-content-body">
                    <h5 class="has-sub-box">Top Countries</h5>
                    <h6 class="dash-sub-box-label">Sales performance revenue based by country</h6>

                    <br/>
                    <table class="tbl-tr-countries" width="100%">
                        <?php if( count($top_countries) > 0 ): ?>
                        <?php foreach($top_countries as $x): ?>
                        <tr>
                            <td><span class="flag"><img src="<?php echo base_url() ?>img/newhome/flags/<?php echo strtolower($x['iso2']) ?>.svg"></span></td>
                            <td>&nbsp; <?php echo $x['country_name'] ?></td>
                            <td><div class="amountusd"><?php echo number_format($x['total'],2) ?> <span>USD</span></div></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </table>

                </div>

            </div>

        </div>

        <div class="col-md-8">

            <div class="def-box-main dash-box-content">

                <div class="dash-box-content-body">
                    <h5 class="has-sub-box">Your Most Recent Earnings</h5>
                    <h6 class="dash-sub-box-label">This is yout most recent earnings</h6>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped tbl-recent-earning">
                      <thead>
                        <tr>
                          <th width="20%" scope="col">Date <!-- &nbsp;<i class="fas fa-chevron-down"></i> --></th>
                          <th width="20%" scope="col">Sales Count</th>
                          <th width="20%" scope="col">Earning</th>
                          <th width="20%" scope="col">Tax Withheld</th>
                          <th width="20%" scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if( count($recent_sales) > 0 ): ?>
                        <?php foreach($recent_sales as $x): ?>
                        <tr>
                          <th><?php echo date('M d, Y', strtotime($x['payment_date'])) ?></th>
                          <th><?php echo $x['count'] ?></th>
                          <th><div class="amountusd"><?php echo number_format($x['total'],2) ?> <span>USD</span></div></th>
                          <th><div class="amountusd" style="color: #dc3139">-<?php echo number_format($x['total']*.20,2) ?> <span>USD</span></div></th>
                          <th><div class="amountusd"><?php echo number_format($x['total']-($x['total']*.20),2) ?> <span>USD</span></div></th>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>

            </div>

        </div>

    </div>

</div>