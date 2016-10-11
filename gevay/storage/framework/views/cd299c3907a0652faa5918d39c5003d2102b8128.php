<?php $__env->startSection('title'); ?>
Auto Viral Content - ATP Software Company
<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-arrow-circle-o-left"></span> Account</h2>
</div>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">


        <div class="col-md-11">

            <!-- START TIMELINE -->
            <div class="timeline timeline-right">

                <!-- START TIMELINE ITEM -->
                <div class="timeline-item timeline-main">
                    <div class="timeline-date">Facebook Fanpage</div>
                </div>
                <!-- END TIMELINE ITEM -->                                                  

                <!-- START TIMELINE ITEM -->
                <div class="timeline-item timeline-item-right">
                    <div class="timeline-item-icon"><span class="fa fa-users"></span></div>                                   
                    <div class="timeline-item-content">
                        <div class="timeline-heading" style="padding-bottom: 10px;">
                            <a href="#">Your Bookmarks Fanpage</a> 
                        </div>                                        
                        <div class="timeline-body comments">
                            <table id="ptable" class="table datatable">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">STT</th>
                                        <th class="col-md-6">Page Name </th>
                                        <th class="col-md-1">Page ID</th>
                                        <th class="col-md-1">Likes</th>
                                        <th class="col-md-2">Talking about</th>
                                        <th class="col-md-1">Active</th>
                                        <th>Active</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>                                    
                </div>       
                <!-- END TIMELINE ITEM -->

                <!-- START TIMELINE ITEM -->



            </div>
            <!-- END TIMELINE -->   

            <div class="timeline timeline-right">

                <!-- START TIMELINE ITEM -->
                <div class="timeline-item timeline-main">
                    <div class="timeline-date">Youtube Channel</div>
                </div>
                <!-- END TIMELINE ITEM -->                                                  

                <!-- START TIMELINE ITEM -->
                <div class="timeline-item timeline-item-right">
                    <div class="timeline-item-icon"><span class="fa fa-users"></span></div>                                   
                    <div class="timeline-item-content">
                        <div class="timeline-heading" style="padding-bottom: 10px;">
                            <a href="#">Your Bookmarks Channel</a> 
                        </div>                                        
                        <div class="timeline-body comments">
                            <table id="ytable" class="table datatable">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">STT</th>
                                        <th class="col-md-4">Name</th>
                                        <th class="col-md-1">View</th>
                                        <th class="col-md-1">Subscriber</th>
                                        <th class="col-md-2">published At</th>
                                        <th class="col-md-1">Active</th>
                                        <th class="col-md-2">Active</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>                                    
                </div>       
                <!-- END TIMELINE ITEM -->

                <!-- START TIMELINE ITEM -->
                <div class="timeline-item timeline-item-right">
                    <div class="timeline-item-icon"><span class="fa fa-reply"></span></div>                                   

                </div>       


            </div>                         

        </div>

    </div>

    <!-- END PAGE CONTENT WRAPPER -->  

    <!-- START DASHBOARD CHART -->
    <div class="block-full-width">
        <div id="dashboard-chart" style="height: 250px; width: 100%; float: left;"></div>
        <div class="chart-legend">
            <div id="dashboard-legend"></div>
        </div>                                                
    </div>      
</div>
<!-- END DASHBOARD CHART -->                  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
    var t = $('#ptable').DataTable();
    var y = $('#ytable').DataTable();

    getBook();
    getBookyt();

    function getBook()
    {
     $.getJSON('getbookmark', function(data) {
        var dem = 0;
        var myArray = [];
        
        $.each(data, function(index, mydata){
            var namez = mydata.pagename;
            var n = namez.length;
            if(n>23)
            {
                var res = namez.substring(0, 19);
                namez = res + '  ...'
            }
            myArray.push([ dem, '<img src="https://graph.facebook.com/'+mydata.pageid+'/picture?"  class="img-circle"/>' + ' ' +namez,mydata.pageid,  mydata.likes, mydata.talk, '<button class="btn btn-success" onclick="unbookmark('+mydata.pageid+');">Unbookmark</button>' ,'<a class="btn btn-primary" href="discover/' + mydata.pageid +'">Discover</a>']);
            dem++;
        });
        t.rows.add(myArray).draw();
    });
 }

 function getBookyt()
 {
     $.getJSON('getbookmarkyt', function(data) {
        var dem = 0;
        var myArray = [];
        var idArray = [];
        $.each(data, function(index, mydata){
            var namez = mydata.name;
            var n = namez.length;
            if(n>23)
            {
                var res = namez.substring(0, 18);
                namez = res + '  ...'
            }
            // youtube table
            idArray.push(mydata.cid);
            myArray.push([ dem, '<img src="'+mydata.avar+'" class="img-circle" style="height:35px"/>' + ' ' +namez, '<div id="view'+mydata.cid+'"></div>','<div id="sub'+mydata.cid+'"></div>',mydata.public, '<button id="btn'+mydata.cid+'" class="btn btn-success" style="width:105px" onclick="bookmarkyt(\''+mydata.cid+'\',\''+namez+'\');">Unbookmark</button>', '<a class="btn btn-primary" href="discoveryt/' + mydata.cid + '">Discover</a>']);
            dem++;
        });
        y.rows.add(myArray).draw();
        updateSubscriber(idArray);
    });
 }
// caap nhat luong view va subscriber
function updateSubscriber(idArray) {
    var dem = 0;
    $.each(idArray, function(index, myid){
        $.getJSON('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='+myid+'&key=AIzaSyBBiTQxeXNe7lJzy0Dp6o_iC1Y0_WH0lug', function(sdata){
            $("#view"+myid).text(formatNum(parseInt(sdata.items[0].statistics.viewCount)));
            $("#sub"+myid).text(formatNum(parseInt(sdata.items[0].statistics.subscriberCount)));
        });
        dem++;
    });
    
}

function formatNum(num) {
    var p = num.toFixed(2).split(".");
    return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "." : "") + acc;
    }, "");
}

function unbookmark(pageid)
{
    $.get('unbookmark/'+pageid, function(data){
        if(data=='1')
        {
            toastr.warning("Remove success.","Complete!");
            t.clear().draw();
            getBook();
        }
    });
}

function bookmarkyt(idchannel, name) {
    var check = $("#btn"+idchannel).text();
    if(check=='Bookmark')
    {
        urlinfo = 'https://www.googleapis.com/youtube/v3/channels?part=snippet&id='+idchannel+'&key=AIzaSyBBiTQxeXNe7lJzy0Dp6o_iC1Y0_WH0lug';
        $.getJSON(urlinfo, function(datai){
            if(datai.items[0])
            {
                var avar = datai.items[0].snippet.thumbnails.default.url;
                var public = datai.items[0].snippet.publishedAt;
                public = public.substring(0,10);
                var data = {
                   '_token': $('meta[name=csrf-token]').attr('content'),
                   task: 'comment_insert',
                   idchannel: idchannel,
                   name: name,
                   avar: avar,
                   public: public
               }

           }else{
            // trường hợp có một số channel không lấy được thông tin avartar, ngày tạo...
            var data = {
                '_token': $('meta[name=csrf-token]').attr('content'),
                task: 'comment_insert',
                idchannel: idchannel,
                name: name,
                avar: '',
                public: ''
            }
        }
        $.post('bookmarkyt', data, function(data) {
            $("#btn"+idchannel).text('Unbookmark');
            $("#btn"+idchannel).removeClass('btn btn-primary').addClass('btn btn-success');
            if (data == '1') {
               toastr.success("You've bookmark this channel.", "Notification!");
           }else{
            toastr.warning("You did bookmark this fanpage", "Warning!"); 
        }
    });
    });
    }else{
        $.get('unbookmarkyt/' + idchannel, function(data) {
            if (data == '1') {
                toastr.warning("Unbookmark success.", "Complete!");
                $("#btn"+idchannel).text('Bookmark');
                $("#btn"+idchannel).removeClass('btn btn-success').addClass('btn btn-primary');
            }
        });
    }
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>