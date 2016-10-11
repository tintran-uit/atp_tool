<?php $__env->startSection('title'); ?>
Auto Viral Content - ATP Software Company
<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-arrow-circle-o-left"></span>Trending Post</h2>
</div>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
<div class="row">
    <div class="col-md-12">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">List Fanpage:</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="input-group push-down-10">
                            <span class="input-group-addon"><span class="fa fa-search"></span></span>
                            <input id="keyword" type="text" class="form-control" placeholder="Keywords..." value=""/>
                            <div class="input-group-btn">
                                <button onclick="getDataP()" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="ptable" class="table datatable">
                            <thead>
                                <tr>
                                    <th class="col-md-1">STT</th>
                                    <th class="col-md-6">Page Name </th>
                                    <th class="col-md-1">Page ID</th>
                                    <th class="col-md-1">Likes</th>
                                    <th class="col-md-2">Talking about</th>
                                    <th class="col-md-1">Active</th>
                                    <th >Active</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>    
    <!-- END PAGE CONTENT WRAPPER -->  

    
</div>

    <!-- END DASHBOARD CHART -->                  
<?php $__env->stopSection(); ?>

    <?php $__env->startSection('script'); ?>

    <script type="text/javascript">
        var token = '<?php echo e($token); ?>';
        var idzd = '<?php echo e($uid); ?>'
        var getpid;

        document.querySelector('#keyword').addEventListener('keypress', function (e) {
            var key = e.which || e.keyCode;
            if (key === 13) { 
              getDataP();
            }
        });

        function getDataP() {
            var keyword = document.getElementById('keyword').value;
            var url = 'https://graph.facebook.com/?method=post&batch=%5B%7B%20%22method%22%3A%22GET%22%2C%22name%22%3A%22search-pages%22%2C%20%22relative_url%22%3A%22search/%3Fq%3D'+keyword+'%26type%3Dpage%26limit%3D200%22%2C%20%22omit_response_on_success%22%3Afalse%2C%7D%2C%20%7B%20%22method%22%3A%22GET%22%2C%20%22relative_url%22%3A%22%3Fids%3D%7Bresult%3Dsearch-pages%3A%24.data.*.id%7D%22%7D%5D&access_token='+token+'&include_headers=false';
            var t = $('#ptable').DataTable();
            t.clear().draw();
            toastr.info("Start searching...","Notification!");
            $.getJSON(url, function(data) {

                var mydata = data[0];
                var mydata2 = data[1];
                if(mydata.code==200)
                {
                    var text = $.parseJSON(mydata.body);
                    var text2 = $.parseJSON(mydata2.body);
                    var dem = 0;
                    var myArray = [];
                    $.each(text.data, function(index, mytext) {
                        var idz = mytext.id;
                        var likes = '';
                        var talk = '';

                        var dem1=0;
                        $.each(text2, function(index, mytext2) {
                            if (dem1==dem) {
                                likes = mytext2.likes;
                                talk = mytext2.talking_about_count;
                                return false;  
                            }
                            dem1++;
                        });
                        myArray.push([ dem, '<a target="_blank" href="http://fb.com/'+idz+'"><img src="https://graph.facebook.com/'+idz+'/picture?"  class="img-circle"/>' + ' ' +mytext.name+'</a>', idz, formatNum(likes), formatNum(talk), '<button id="btn-'+idz+'" class="btn btn-primary" onclick="bookmark(\''+idz+'\',\''+mytext.name+'\',\''+formatNum(talk)+'\',\''+formatNum(likes)+'\');" style="width:122px">Bookmark</button>' ,'<a class="btn btn-primary" href="discover/' + idz +'">Discover</a>']);

                        dem++;
                    });
                    t.rows.add(myArray).draw();
                }else{
                    toastr.error("Descrition: ", 'Error: ');
                }
                
            });
        }

        // het funtion

        function formatNum(num) {
            var p = num.toFixed(2).split(".");
            return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
                return  num + (i && !(i % 3) ? "." : "") + acc;
            }, "");
        }

        function bookmark(pageid,name,talk,likes)
        {
            var check = $("#btn-"+pageid).text();
            if(check=='Bookmark')
            {
                var arrdata = {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    task: 'comment_insert',
                    pageid: pageid,
                    talk: talk,
                    likes: likes,
                    pagename: name
                }
                $.post('bookmark', arrdata, function(thongbao){
                    $("#btn-"+pageid).text('Unbookmark');
                    $("#btn-"+pageid).removeClass('btn btn-primary').addClass('btn btn-success');
                    if(thongbao==1)
                    {
                        toastr.success("You've bookmark this fanpage","Notification!");

                    }
                    if(thongbao==0)
                        toastr.warning("You did bookmark this fanpage", "Warning!");                    
                });

            }else{
                $.get('unbookmark/' + pageid, function(data) {
                    if (data == '1') {
                        toastr.warning("Unbookmark success.", "Complete!");
                        $("#btn-"+pageid).text('Bookmark');
                        $("#btn-"+pageid).removeClass('btn btn-success').addClass('btn btn-primary');
                    }
                });
            }
            
        }

        
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>