<div class="app-view-header">Dashboard<small> Naut - Bootstrap + AngularJS</small></div>
<div class="row">
    <!-- START dashboard content-->
    <div class="col-lg-9 fw-boxed">
        <!-- START Tabbed panel-->
        <div class="panel panel-default">
            <div class="row">
                <div class="col-md-4">
                    <div class="row row-flush text-center text-muted m0">
                        <div data-ripple="" class="col-xs-3 col-md-6 bb br pv-xxl clickable bg-primary"><em class="icon-pie-graph fa-2x mv"></em></div>
                        <div data-ripple="" class="col-xs-3 col-md-6 bb br pv-xxl clickable"><em class="icon-head fa-2x mv"></em></div>
                        <div data-ripple="" class="col-xs-3 col-md-6 bb-lg br pv-xxl clickable"><em class="icon-share fa-2x mv"></em></div>
                        <div data-ripple="" class="col-xs-3 col-md-6 bb-lg br pv-xxl clickable"><em class="icon-briefcase fa-2x mv"></em></div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row row-table">
                        <div class="col-sm-6 col-xs-12">
                            <div class="p">
                                <div class="row row-flush text-center">
                                    <div class="col-xs-6">
                                        <p class="mt-lg">Monthly Income</p>
                                        <div data-percent="75" class="easypie"><span>75</span></div>
                                    </div>
                                    <div class="col-xs-6">
                                        <p class="mt-lg">Total Income</p>
                                        <div data-percent="50" class="easypie"><span>50</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="p">Hourly
                                <div class="progress progress-xs">
                                    <div style="width: 35%" class="progress-bar progress-bar-warning"></div>
                                </div>Last Month
                                <div class="progress progress-xs">
                                    <div style="width: 10%" class="progress-bar progress-bar-info"></div>
                                </div>Last Year
                                <div class="progress progress-xs m0">
                                    <div style="width: 35%" class="progress-bar progress-bar-danger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Tabbed panel-->
        <!-- START Panel-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"> <em class="icon-signal fa-lg text-muted pull-right"></em>Analytics</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9">
                        <p class="text-center"><em>Proin vulputate neque non turpis pellentesque mattis. </em></p>
                        <!-- Flot chart-->
                        <div id="spline-chart" class="flot"></div>
                    </div>
                    <div class="col-md-3">
                        <table class="table table-hover mb-lg">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-right">Show</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Campaing 1</td>
                                    <td class="text-right">
                                        <label class="switch m0 switch-primary">
                                            <input type="checkbox" checked="checked"><span></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Campaing 2</td>
                                    <td class="text-right">
                                        <label class="switch m0 switch-primary">
                                            <input type="checkbox"><span></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Campaing 3</td>
                                    <td class="text-right">
                                        <label class="switch m0 switch-primary">
                                            <input type="checkbox"><span></span>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p><em>Etiam ultrices mollis placerat. Proin ullamcorper lectus ut libero blandit pretium. </em></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!-- START Panel-->
                <div class="panel panel-default">
                    <div class="panel-body"><em class="pull-right icon-bar-graph-2 text-muted"></em>
                        <div class="text-center">
                            <div class="text-lg">31.2 ms</div>
                            <p class="text-muted">Average response time</p>
                            <div class="label label-success">
                                20% <em class="fa fa-angle-up"></em>
                            </div>
                        </div>
                        <div id="small-line-chart1" class="flot flot-sm mt-lg"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- START Panel-->
                <div class="panel bg-purple">
                    <div class="panel-body"><em class="pull-right icon-thermometer text-muted"></em>
                        <div class="text-center">
                            <div class="text-lg">30,300</div>
                            <p class="text-muted">Total Visits</p>
                        </div>
                    </div>
                    <div class="lead text-center mb">Devices</div>
                    <div class="list-group">
                        <a href="" class="bg-purple list-group-item clearfix bg-light b0">
                            <div class="pull-left"><em class="fa fa-fw fa-desktop mr"></em>Desktop</div>
                            <div class="pull-right">10,200</div>
                        </a>
                        <a href="" class="bg-purple list-group-item clearfix b0">
                            <div class="pull-left"><em class="fa fa-fw fa-tablet mr"></em>Tablet</div>
                            <div class="pull-right">9,040</div>
                        </a>
                        <a href="" class="bg-purple list-group-item clearfix bg-light b0">
                            <div class="pull-left"><em class="fa fa-fw fa-mobile mr"></em>Mobile</div>
                            <div class="pull-right">3,900</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- START Panel-->
                <div class="panel panel-default">
                    <div class="panel-body"><em class="pull-right icon-bar-graph text-muted"></em>
                        <div class="text-center">
                            <div class="text-lg">70%</div>
                            <p class="text-muted">Consumed resources</p>
                            <div class="label label-warning">5% <em class="fa fa-angle-down"></em></div>
                        </div>
                        <div id="small-line-chart2" class="flot flot-sm mt-lg"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- START Responsive table-->
        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th class="text-center">Code</th>
                            <th class="text-center">Files</th>
                            <th class="text-center">Transactions</th>
                            <th class="text-center">Request</th>
                            <th class="text-center">Income</th>
                            <th class="text-center">Outcome</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-bold">#1234</td>
                            <td>1,232</td>
                            <td>523</td>
                            <td>-</td>
                            <td>
                                <div class="label label-success text-bold">$ 1,548.00<em class="fa fa-fw fa-caret-up"></em></div>
                            </td>
                            <td>
                                <div class="label label-danger text-bold">$ 0.00<em class="fa fa-fw fa-caret-down"></em></div>
                            </td>
                            <td>$ 1,548.00</td>
                        </tr>
                        <tr>
                            <td class="text-bold">#548</td>
                            <td>1,232</td>
                            <td>-</td>
                            <td>300</td>
                            <td>
                                <div class="label label-success text-bold">$ 3,548.00<em class="fa fa-fw fa-caret-up"></em></div>
                            </td>
                            <td>
                                <div class="label label-danger text-bold">$ 1000.00<em class="fa fa-fw fa-caret-down"></em></div>
                            </td>
                            <td>$ 2,548.00</td>
                        </tr>
                        <tr>
                            <td class="text-bold">#654</td>
                            <td>1,232</td>
                            <td>523</td>
                            <td>57889</td>
                            <td>
                                <div class="label label-success text-bold">$ 10,256.00<em class="fa fa-fw fa-caret-up"></em></div>
                            </td>
                            <td>
                                <div class="label label-danger text-bold">$ 10,000.00<em class="fa fa-fw fa-caret-down"></em></div>
                            </td>
                            <td>$ 256.00</td>
                        </tr>
                        <tr>
                            <td class="text-bold">#3266</td>
                            <td>-</td>
                            <td>523</td>
                            <td>1200</td>
                            <td>
                                <div class="label label-success text-bold">$ 11,100.50<em class="fa fa-fw fa-caret-up"></em></div>
                            </td>
                            <td>
                                <div class="label label-danger text-bold">$ 100.00<em class="fa fa-fw fa-caret-down"></em></div>
                            </td>
                            <td>$ 11,000.50</td>
                        </tr>
                        <tr>
                            <td class="text-bold">#548</td>
                            <td>1,232</td>
                            <td>-</td>
                            <td>300</td>
                            <td>
                                <div class="label label-success text-bold">$ 3,548.00<em class="fa fa-fw fa-caret-up"></em></div>
                            </td>
                            <td>
                                <div class="label label-danger text-bold">$ 1000.00<em class="fa fa-fw fa-caret-down"></em></div>
                            </td>
                            <td>$ 2,548.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        <div class="input-group input-group-sm">
                            <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn">
              <button type="button" class="btn btn-sm btn-default">Search</button></span>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-xs-6">
                        <div class="input-group input-group-sm pull-right">
                            <select class="form-control">
                                <option value="0">Bulk action</option>
                                <option value="1">Delete</option>
                                <option value="2">Clone</option>
                                <option value="3">Export</option>
                            </select><span class="input-group-btn">
              <button class="btn btn-sm btn-default">Apply</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Responsive table-->
    </div>
    <!-- END dashboard content-->
    <!-- START dashboard sidebar-->
    <aside class="col-lg-3 fw-boxed">
        <div class="row">
            <div class="col-lg-6 col-sm-3 col-xs-6">
                <div data-ripple="" class="panel panel-default">
                    <div class="panel-body bg-primary">
                        <h1 class="text-thin mt">150</h1>
                        <div class="text-right text-sm text-muted">Transactions</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-3 col-xs-6">
                <div data-ripple="" class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="text-thin mt">700</h1>
                        <div class="text-right text-sm text-muted">Users</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-3 col-xs-6">
                <div data-ripple="" class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="text-thin mt">699</h1>
                        <div class="text-right text-sm text-muted">Views</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-3 col-xs-6">
                <div data-ripple="" class="panel panel-default">
                    <div class="panel-body bg-primary">
                        <h1 class="text-thin mt">96</h1>
                        <div class="text-right text-sm text-muted">Downloads</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body bg-primary">
                        <h2 class="text-thin mt">New contacts</h2>
                        <div class="clearfix">
                            <div class="pull-right">
                                <ul class="list-inline m0">
                                    <li class="p0">
                                        <a href=""><img src="images/user/02.jpg" alt="Follower" class="img-responsive img-circle thumb24"></a>
                                    </li>
                                    <li class="p0">
                                        <a href=""><img src="images/user/01.jpg" alt="Follower" class="img-responsive img-circle thumb24"></a>
                                    </li>
                                    <li class="p0">
                                        <a href=""><img src="images/user/03.jpg" alt="Follower" class="img-responsive img-circle thumb24"></a>
                                    </li>
                                    <li class="p0">
                                        <a href=""><img src="images/user/04.jpg" alt="Follower" class="img-responsive img-circle thumb24"></a>
                                    </li>
                                    <li class="p0"><a href="" class="v-middle"><strong>+7</strong></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title bg-primary"><em class="icon-clock fa-lg pull-right text-muted"></em>Activity</div>
                    </div>
                    <div class="panel-body pt0">
                        <div class="smoothy">
                            <div data-scrollable="" class="pt">
                                <!-- START timeline-->
                                <ul class="timeline-alt">
                                    <li data-datetime="14 Oct" class="timeline-separator"></li>
                                    <!-- START timeline item-->
                                    <li>
                                        <div class="timeline-badge timeline-badge-sm thumb-32 bg-purple"><em class="fa fa-users"></em></div>
                                        <div class="timeline-date">
                                            <time datetime="10m"></time>
                                        </div>
                                        <div class="timeline-panel"><strong>Client Meeting</strong>
                                            <div class="text-muted">Green Offfice - Av 123 St Floor 2</div>
                                        </div>
                                    </li>
                                    <!-- END timeline item-->
                                    <!-- START timeline item-->
                                    <li>
                                        <div class="timeline-badge timeline-badge-sm bg-amber"><em class="fa fa-phone"></em></div>
                                        <div class="timeline-date">
                                            <time datetime="1h"></time>
                                        </div>
                                        <div class="timeline-panel"><strong>Call</strong>
                                            <div class="text-muted">From: <a href="tel:+011231987">Michael</a>. <em> No message left.</em></div>
                                        </div>
                                    </li>
                                    <!-- END timeline item-->
                                    <!-- START timeline item-->
                                    <li>
                                        <div class="timeline-badge timeline-badge-sm bg-info"><em class="fa fa-envelope"></em></div>
                                        <div class="timeline-date">
                                            <time datetime="3h"></time>
                                        </div>
                                        <div class="timeline-panel"><strong>New invitation</strong>
                                            <div class="text-muted">From: <strong>UX Design Team</strong></div>
                                        </div>
                                    </li>
                                    <!-- END timeline item-->
                                    <li data-datetime="13 Oct" class="timeline-separator"></li>
                                    <!-- START timeline item-->
                                    <li>
                                        <div class="timeline-badge timeline-badge-sm bg-warning"><em class="fa fa-upload"></em></div>
                                        <div class="timeline-date">
                                            <time datetime="9am"></time>
                                        </div>
                                        <div class="timeline-panel"><strong>File upload</strong>
                                            <a href="">
                                                <div class="text-bold">angular+bs.zip</div>
                                            </a>
                                        </div>
                                    </li>
                                    <!-- END timeline item-->
                                </ul>
                                <!-- END timeline-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title bg-primary"><em class="icon-speech-bubble fa-lg pull-right text-muted"></em>Team chat</div>
                    </div>
                    <div class="panel-body pt0">
                        <div class="smoothy">
                            <div data-scrollable="" class="pt">
                                <ul class="chat">
                                    <li class="left clearfix"><span class="chat-img pull-left"><img src="images/user/01.jpg" alt="Image" class="img-circle thumb48"></span>
                                        <div class="chat-body clearfix">
                                            <div class="chat-header"><a href="" class="text-inverse"><strong>Florence Douglas</strong></a><small class="pull-right text-muted"><span class="fa fa-time"></span>12m</small></div>
                                            <div class="chat-msg">Suspendisse nisl nulla, interdum at fermentum eget, adipiscing in elit. </div>
                                        </div>
                                    </li>
                                    <li class="right clearfix"><span class="chat-img pull-right"><img src="images/user/03.jpg" alt="Image" class="img-circle thumb48"></span>
                                        <div class="chat-body clearfix">
                                            <div class="chat-header"><small class="text-muted"><span class="fa fa-time"></span>13m</small><a href="" class="text-inverse"><strong class="pull-right">Jon Elliott</strong></a></div>
                                            <div class="chat-msg">Donec consequat venenatis orci, et sagittis risus pretium eget. </div>
                                        </div>
                                    </li>
                                    <li class="left clearfix"><span class="chat-img pull-left"><img src="images/user/02.jpg" alt="Image" class="img-circle thumb48"></span>
                                        <div class="chat-body clearfix">
                                            <div class="chat-header"><a href="" class="text-inverse"><strong>Joel Miles</strong></a><small class="pull-right text-muted"><span class="fa fa-time"></span>14m</small></div>
                                            <div class="chat-msg">Mauris eleifend, libero nec cursus lacinia, tellus est pharetra orci, et pretium urna felis eget neque. </div>
                                        </div>
                                    </li>
                                    <li class="right clearfix"><span class="chat-img pull-right"><img src="images/user/03.jpg" alt="Image" class="img-circle thumb48"></span>
                                        <div class="chat-body clearfix">
                                            <div class="chat-header"><small class="text-muted"><span class="fa fa-time"></span>15m</small><a href="" class="text-inverse"><strong class="pull-right">Jon Elliott</strong></a></div>
                                            <div class="chat-msg">Sed semper diam vitae purus tristique at scelerisque massa ultricies. Aliquam non eros dui. </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="input-group input-group-sm">
                            <input type="text" placeholder="Type a message ..." class="form-control"><span class="input-group-btn">
              <button type="button" class="btn btn-info"><small>Post</small></button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>
