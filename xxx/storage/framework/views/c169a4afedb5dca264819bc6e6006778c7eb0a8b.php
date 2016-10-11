<?php $__env->startSection('title'); ?>
Auto Viral Content - ATP Software Company
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Awesome videos!" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-arrow-circle-o-left"></span> YouTube Viral Search</h2>
</div>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="col-md-12">
        <div class="row">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title"><img src="<?php echo e(url('')); ?>/img/youtube.png" style="height:50px"> Trending Video:</h3>
                </div>
                <div class="panel-body">
                    <form action="#">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="input-group push-down-10">
                                <span class="input-group-addon"><span class="fa fa-search"></span></span>
                                <input id="search" placeholder="Type something..." autocomplete="off" type="text" class="form-control" />
                                <div class="input-group-btn">
                                    <input type="submit" value="Search" class="btn btn-primary"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel-body">
                                <table id="ptable" class="table datatable">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">STT</th>
                                            <th class="col-md-3">Video</th>
                                            <th class="col-md-4">Description</th>
                                            <th class="col-md-2">Channel</th>
                                            <th class="col-md-2">Info</th>
                                            <th >Avtive</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- END PAGE CONTENT WRAPPER -->  


        <!-- END DASHBOARD CHART -->    
    </div>
</div> 
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Posting schedule</h4>
      </div>
      <div class="modal-body">
          <div class="control-group">
            <div class="control-group">
                <label class="control-label" for="select01">Page: </label>
                <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                    <select id="select01" class="form-control col-md-6">
                        <?php 
                        foreach ($fan as $value) {
                            if($value->isdef==1)
                            {
                                $defname = $value->pagename;
                                $defid = $value->pageid;
                                $ptoken = $value->pagetoken;
                                $isfandef = 1;
                                ?>
                                <option name="<?php echo $ptoken;?>" value="<?php echo $defid;?>">
                                    1 - <?php echo $defname;?>
                                </option>
                                <?php
                            }
                        }

                        if($isfandef==1)
                        {
                            $i=1;
                        }else{
                            $i = 0;
                        }
                        foreach ($fan as $value) {
                          if($value->isdef==0)
                          {
                              $i++;
                              ?>
                              <option name="<?php echo e($value->pagetoken); ?>" value="<?php echo e($value->pageid); ?>"><?php echo e($i); ?> - <?php echo e($value->pagename); ?></option>

                              <?php }
                          }
                          ?>
                      </select>
                  </div>
              </div>
              <div class="form-group">
                <br/>
                <label>Scheduled publish time: </label>
                <div class="row">
                    <div class="col-md-4 ">
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" id="pdate" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                       <div class='input-group date' id='datetimepicker0'>
                            <input type='text' class="form-control" id="ptime" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>   
                </div>
                <div class="row">
                <br/>
                    <div class="col-md-4">
                        <label for="textarea">Picture: </label>
                        <div class="controls">
                            <div class="pic" ></div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="textarea">Edit Content: </label>
                        <div class="controls">
                            <textarea class="form-control" id="msg" rows="7" autocomplete="off"></textarea>
                        </div>
                    </div>

                </div>

            </div>
            <div class="form-group">
            </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button>
      <a type="button" onclick="postvideo(1);" data-dismiss="modal" class="btn btn-primary">Schedule</a>
  </div>
</div>

</div>
</div> 
<!-- Modal -->
<div class="modal fade" id="postnow" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Post Now</h4>
      </div>
      <div class="modal-body">
          <div class="control-group">
            <div class="control-group">
                <label class="control-label" for="select01">Page: </label>
                <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                    <select id="select02" class="form-control col-md-6">
                        <?php 
                        foreach ($fan as $value) {
                            if($value->isdef==1)
                            {
                                $defname = $value->pagename;
                                $defid = $value->pageid;
                                $ptoken = $value->pagetoken;
                                $isfandef = 1;
                                ?>
                                <option name="<?php echo $ptoken;?>" value="<?php echo $defid;?>">
                                    1 - <?php echo $defname;?>
                                </option>
                                <?php
                            }
                        }

                        if($isfandef==1)
                        {
                            $i=1;
                        }else{
                            $i = 0;
                        }
                        foreach ($fan as $value) {
                          if($value->isdef==0)
                          {
                              $i++;
                              ?>
                              <option name="<?php echo e($value->pagetoken); ?>" value="<?php echo e($value->pageid); ?>"><?php echo e($i); ?> - <?php echo e($value->pagename); ?></option>

                              <?php }
                          }
                          ?>
                      </select>
                  </div>
              </div>
              <div class="form-group">
                <br/>
                <div class="row">
                    <div class="col-md-4">
                        <label for="textarea">Preview: </label>
                        <div class="controls">
                            <div class="pic" ></div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="textarea">Edit Content: </label>
                        <div class="controls">
                            <textarea class="form-control" id="msg2" rows="6" autocomplete="off"></textarea>
                        </div>
                    </div>

                </div>

            </div>
            <div class="form-group">

            </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" onclick="postvideo(0)" class="btn btn-primary"  data-dismiss="modal">Share Link</button>
      <a type="button" onclick="postvideo(2);" data-dismiss="modal" class="btn btn-primary">Post Now</a>
  </div>
</div>

</div>
</div>                  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(url('')); ?>/public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo e(url('')); ?>/public/js/moment-with-locales.js"></script>
<script type="text/javascript" src="<?php echo e(url('')); ?>/public/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
   $(function () {
        $('#datetimepicker0').datetimepicker({
            format: 'LT'
        });
    });
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY/MM/DD'
        });
    });
</script>
<script type="text/javascript">

</script>
<script type="text/javascript">
    var getvideosrc;
    var idvideoArr = '';

    // update info video
    var table = $('#ptable').DataTable();
    table.on( 'draw', function () {
         updateInfoVideo(idvideoArr);
    } );
    $('#preview').on('hide.bs.modal', function(e) {    
        $('#previewsrc').html('<p></p>');
    });

   function schedule(dem, videoid) {
    var today = new Date();
    var month = today.getUTCMonth() + 1; 
    var day = today.getUTCDate();
    var year = today.getUTCFullYear();
    var newdate = year + "/" + month + "/" + day;
     $('#pdate').val(newdate);
     h = (today.getHours() < 10 ? '0' : '') + today.getHours(),
         m = (today.getMinutes() < 10 ? '0' : '') + today.getMinutes();
     $('#ptime').val(h + ':' + m);
    dem = dem%10;
    var demz = parseInt(dem);
    demz = demz + 1;
    if(demz%10==0)
        {
            demz=10;
        }else{
            demz = demz%10;
        }
    var dataz = document.getElementById("ptable").rows[demz].cells[2].innerHTML;
    var prev = '<iframe width="169" src="https://www.youtube.com/embed/' + videoid + '" frameborder="0" allowfullscreen></iframe>';
    document.getElementById('msg').value = dataz;
    $('div.pic').html(prev);
    getvideosrc = videoid;
}

function postvideo(s) {
        if (s == 0) {
            var elt = document.getElementById('select02');
            var mypage = elt.options[elt.selectedIndex].value;
            var ptoken = elt.options[elt.selectedIndex].getAttribute("name");
            var msg = document.getElementById('msg2').value
            var linklink = 'https://www.youtube.com/embed/' + getvideosrc;
            var data = 'batch=' + encodeURIComponent('[{"method":"POST","body":"is_super_emoji_post=false&message=' + msg + '&link=' + linklink + '&nectar_module=group_composer&audience_exp=true&time_since_original_post=413&attach_place_suggestion=true&format=json&connection_class=EXCELLENT&source_type=group&checkin_entry_point=BRANDING_OTHER&locale=vi_VN&client_country_code=VN&fb_api_req_friendly_name=graphObjectPosts","name":"graphObjectPosts","omit_response_on_success":false,"relative_url":"' + mypage + '/feed"}]') + '&fb_api_caller_class=com.facebook.composer.publish.ComposerPublishServiceHandler&fb_api_req_friendly_name=publishPost&access_token=' + ptoken;

            $.post('https://graph.facebook.com/?include_headers=false&decode_body_json=false&streamable_json_response=true&locale=vi_VN&client_country_code=VN', data, function(mydata) {
                var datas = mydata[0];
                var data = datas[1];
                var postid = data.body;
                postid = postid.id;
                toastr.success("<a target='_blank' href='http://fb.com/" + postid + "'>View your share: click link</a>", "Successful post");
            }).error(function(mydata) {
                if (mydata) {
                    var jsonResponseText = $.parseJSON(mydata.responseText);
                    $.each(jsonResponseText, function(name, err) {
                        toastr.error("Mô tả: " + err.message, 'Loại lổi: ' + err.code);
                    });
                }
                toastr.warning("Please choose the share button, or upload another video", 'Can not post this video!');
            });
        } else if (s == 1) {
            var elt = document.getElementById('select01');
            var mypage = elt.options[elt.selectedIndex].value;
            var ptoken = elt.options[elt.selectedIndex].getAttribute("name");
            var msg = document.getElementById('msg').value;
            var date = $('#pdate').val();
             var time = $('#ptime').val();
             date = date + ' ' + time;
             date = new Date(date);
            time = Math.round(date.getTime() / 1000);
            var now = Math.round(new Date().getTime() / 1000);
            var checktime = now + 605;
            var datapost = {
                "access_token": ptoken
            };
            if (checktime > time) {
                toastr.error("Scheduled publish time must more 10 minutes!", "Cann't Post");
                return null;
            } else {
                
                datapost = {
                    "message": msg,
                    "access_token": ptoken,
                    "scheduled_publish_time": time,
                    "published": false
                };
            }
            toastr.success("Start posting...", "Notification!");
            var idvideo = getvideosrc;
            $.get('getvideourl/' + getvideosrc, function(videoid) {
                getvideosrc = videoid;
                datapost["file_url"] = getvideosrc;
                datapost["description"] = msg;
                $.post("https://graph.facebook.com/" + mypage + "/videos?method=post", datapost,
                    function(response) {
                        if (response && !response.error) {
                            toastr.success(" <a target='_blank' href='http://fb.com/" + response.id + "'>View your post: click link</a>", "Successful post");
                        } else {
                            toastr.error(response.error.message, "Error: " + response.error.code);
                        }

                    }).error(function(response) {
                        if (response.error) {
                            toastr.error("Please choose the share button, or upload another video", 'Can not post this video!');
                        }
                    });
                });
        }else if(s == 2)
        {
            var elt = document.getElementById('select02');
            var mypage = elt.options[elt.selectedIndex].value;
            var ptoken = elt.options[elt.selectedIndex].getAttribute("name");
            var msg = document.getElementById('msg2').value
            var datapost = {
                    "message": msg,
                    "access_token": ptoken
                 }
            var idvideo = getvideosrc;
            $.get('getvideourl/' + getvideosrc, function(videoid) {
                toastr.success("Start posting...", "Notification!");
                getvideosrc = videoid;
                datapost["file_url"] = getvideosrc;
                datapost["description"] = msg;
                $.post("https://graph.facebook.com/" + mypage + "/videos?method=post", datapost,
                    function(response) {
                        if (response && !response.error) {
                            toastr.success("<a target='_blank' href='http://fb.com/" + response.id + "'> View your post: click link</a>", "Successful post");
                        } else {
                            toastr.error(response.error.message, "Error: " + response.error.code);
                        }

                    }).error(function(response) {
                        toastr.error("Please choose the share button, or upload another video", 'Can not post this video!');
                    });
                });
        }

    }

function postnowyt(dem, videoid) {
        dem = dem%10;
    var demz = parseInt(dem);
    demz = demz + 1;
    if(demz%10==0)
        {
            demz=10;
        }else{
            demz = demz%10;
        }
    var dataz = document.getElementById("ptable").rows[demz].cells[2].innerHTML;
    var prev = '<iframe width="169" src="https://www.youtube.com/embed/' + videoid + '" frameborder="0" allowfullscreen></iframe>';
    document.getElementById('msg2').value = dataz;
    $('div.pic').html(prev);
    getvideosrc = videoid;
    }


function bookmarkyt(idchannel, name) {
    var check = $(".btn" + idchannel).text();
    // trường hợp tìm đc nhiều kết quả là cùng một channel, khi get sẽ đc chuỗi 'BookmarkBookmark...'
    check = check.slice(0, 2);
    if (check == 'Bo' ) {
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
            $(".btn" + idchannel).text('Unbookmark');
            $(".btn" + idchannel).removeClass('btn btn-primary').addClass('btn btn-success');
            if (data == '1') {
             toastr.success("You've bookmark this channel.", "Notification!");
         }else{
            toastr.warning("You did bookmark this fanpage", "Warning!"); 
        }
    });
    });

    } else if('Un'){
        $.get('unbookmarkyt/' + idchannel, function(data) {
            if (data == '1') {
                toastr.warning("Unbookmark success.", "Complete!");
                $(".btn" + idchannel).text('Bookmark');
                $(".btn" + idchannel).removeClass('btn btn-success').addClass('btn btn-primary');
            }
        });
    }
}


function tplawesome(e, t) {
    res = e;
    for (var n = 0; n < t.length; n++) {
        res = res.replace(/\{\{(.*?)\}\}/g, function(e, r) {
            return t[n][r]
        })
    }
    return res
}

$(function() {
    $("form").on("submit", function(e) {
        e.preventDefault();
        // prepare the request
        var request = gapi.client.youtube.search.list({
            part: "snippet",
            type: "video",
            q: $("#search").val(),
            maxResults: 30,
            order: "viewCount",
            publishedAfter: "2015-01-01T00:00:00Z"
        });
        // execute the request
        toastr.info("Start searching...", "Notification!");
        request.execute(function(response) {
            var results = response.result;
            var t = $('#ptable').DataTable();
            t.clear().draw();
            var dem = 0;
            var myArray = [];
            $.each(results.items, function(index, item) {
                myArray.push([dem, '<iframe width="260" src="https://www.youtube.com/embed/' + item.id.videoId + '" frameborder="0" allowfullscreen></iframe>',item.snippet.title, '<p><b>Name:</b> ' + item.snippet.channelTitle + '</p>', '<div id="info'+dem+'"></div>' ,'<p><a onclick="postnowyt(' + dem + ',\'' + item.id.videoId + '\');" class="btn btn-primary" style="width:105px" data-toggle="modal" data-target="#postnow">Post Now</a></p><p><a onclick="schedule(' + dem + ',\'' + item.id.videoId + '\');" class="btn btn-primary" style="width:105px" data-toggle="modal" data-target="#myModal">Schedule</a></p><p><a style="width:105px" class="btn btn-primary btn' + item.snippet.channelId + '" onclick="bookmarkyt(\'' + item.snippet.channelId + '\',\'' + item.snippet.channelTitle + '\');">Bookmark</a></p><a style="width:105px" class="btn btn-primary" href="discoveryt/' + item.snippet.channelId + '">Discover</a>']);
                idvideoArr = idvideoArr + item.id.videoId + ",";
                dem++;
            });
            t.rows.add(myArray).draw();
            updateInfoVideo(idvideoArr);
            resetVideoHeight();
        });
    });

    $(window).on("resize", resetVideoHeight);
});

function updateInfoVideo(idvideoArr)
    {
        urlupdatevideo = 'https://www.googleapis.com/youtube/v3/videos?part=contentDetails,statistics&id='+idvideoArr+'&key=AIzaSyBBiTQxeXNe7lJzy0Dp6o_iC1Y0_WH0lug';
        $.getJSON(urlupdatevideo, function(vdata){
            // alert(vdata.items[0].statistics.viewCount);
            var dem = 0;
            $.each(vdata.items, function(index, vmydata){
                $("#info"+dem).html('<b>View:</b></br/>'+formatNum(parseInt(vmydata.statistics.viewCount))+'<br/><b>Likes:</b><br/>'+formatNum(parseInt(vmydata.statistics.likeCount))+'<br/><b>Dislikes:</b><br/>'+formatNum(parseInt(vmydata.statistics.dislikeCount))+'<br/><b>Comment:</b><br/>'+formatNum(parseInt(vmydata.statistics.commentCount)));
                dem++;
            });

        });
    }

function formatNum(num) {
    var p = num.toFixed(2).split(".");
    return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "." : "") + acc;
    }, "");
}

function resetVideoHeight() {
    $(".video").css("height", $("#results").width() * 9 / 16);
}

function init() {
    gapi.client.setApiKey("AIzaSyBBiTQxeXNe7lJzy0Dp6o_iC1Y0_WH0lug");
    gapi.client.load("youtube", "v3", function() {
        // yt api is ready
    });
}
</script>
<script src="https://apis.google.com/js/client.js?onload=init"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>