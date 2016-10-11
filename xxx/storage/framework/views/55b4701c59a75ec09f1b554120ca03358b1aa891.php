<?php $__env->startSection('title'); ?>
Auto Viral Content - ATP Software Company
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
<style type="text/css">
    .dataTables_filter label input{
        width: 250px;
    }
    .dataTables_filter label{
        color: #b64645;
        font-weight: bold !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo e(url('')); ?>/public/css/bootstrap-datetimepicker.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>

<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-arrow-circle-o-left"></span>Discover</h2>
</div>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div id="conver" class="panel-body profile" style="background-size: 100% 100%;">
                    <div class="profile-image">
                        <img src="https://graph.facebook.com/<?php echo e($pageid); ?>/picture?"  class="img-circle" alt="Nadia Ali"/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-namez" style="font-weight: bold;"></div>
                        <div class="profile-data-titlez" style="color: #ECEFF1;"></div>
                    </div>
                    <div class="profile-controls">

                    </div>                                    
                </div>                                
                
                <div class="panel-body list-group border-bottom">
                    <a href="#" class="list-group-item active"><span class="fa fa-bar-chart-o"></span> Information:</a>
                    <a href="#" class="list-group-item"><span class="fa fa-thumbs-up"></span> Likes <span class="badge badge-default"></span></a>                                
                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> Talking about <span class="badge badge-danger">+9</span></a>
                    <a href="#" class="list-group-item"><span class="fa fa-folder"></span> 
                        <span class="bir"></span></a>
                        <a href="#" class="list-group-item"><span class="fa fa-share-square"></span> 
                            <span class="id"></span></a>
                            <a href="#" class="list-group-item"><span class="fa fa-cog"></span> 
                                <span class="viewpage"></span>
                            </a>
                            <a class="list-group-item"> 
                                <div class="bookmark"></div>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-md-9">
                    <!-- START DEFAULT DATATABLE -->
                    <div class="panel panel-default">
                        <div class="panel-heading">                                
                            <h3 class="panel-title">Trending Post:</h3>
                        </div>
                        <div class="panel-body">
                            <div class="btn-group">
                                <button type="button" onclick="runz(0)" class="btn btn-primary">All</button>
                                <button type="button" onclick="runz(1)" class="btn btn-primary">Photos</button>
                                <button type="button" onclick="runz(2)" class="btn btn-primary">Videos</button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="ptable" class="table datatable">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">STT</th>
                                        <th class="col-md-3">Picture / video</th>
                                        <th class="col-md-5">Content</th>
                                        <th class="col-md-2">Likes / Comments</th>
                                        <th class="col-md-1">Created</th>
                                        <th >Schedule</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- END PAGE CONTENT WRAPPER -->  

                <!-- START DASHBOARD CHART -->
                
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
                                    <textarea class="form-control" id="msg" rows="5" autocomplete="off"></textarea>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    <div class="form-group">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a type="button" onclick="postFB(1);" class="btn btn-primary">Schedule</a>
          </div>
      </div>
  </div>
</div>   

<!-- post now -->
<div class="modal fade" id="postnow" role="dialog">
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
                            <textarea class="form-control" id="msg2" rows="5" autocomplete="off"></textarea>
                        </div>
                    </div>

                </div>

            </div>
            <div class="form-group">

            </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <a type="button" onclick="postFB(0);" class="btn btn-primary">Post</a>
  </div>
</div>
</div>
</div>

<!-- preview -->
<div class="modal fade" id="preview" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Preview</h4>
      </div>
      <div class="modal-body">
          <div class="control-group" id="previewsrc">
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div>             
<!-- END DASHBOARD CHART -->                  
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
var pageid = '<?php echo e($pageid); ?>';
 var token = '<?php echo e($token); ?>';
 var t = $('#ptable').DataTable();
 var data = '';
 var getpageid;
 var getpagesrc;
 var pagename = '';
 var likes = '';
 var talk = '';
 var category = '';
 var birthday = '';
 var cover = '';
 runz(0);
$('#preview').on('hide.bs.modal', function(e) {    
    $('#previewsrc').html('<p></p>');
});
 //lay thong tin fanpage
 var url = 'https://graph.facebook.com/?id=' + pageid + '&access_token=' + token;
 $.getJSON(url, function(data) {
     if (data.name) {

         pagename = data.name;
         category = data.category;
         likes = formatNum(data.likes);
         talk = formatNum(data.talking_about_count);
         birthday = data.birthday;
         if (data.cover) {
             cover = data.cover.source;
         }
         $('span.id').text('ID: ' + pageid);
         $('#conver').css('background-image', 'url(' + cover + ')');
         $('div.profile-data-namez').text(pagename);
         $('z').text(category);
         $('span.badge-danger').text(talk);
         $('span.badge-default').text(likes);
         $('span.bir').text('Created: ' + birthday);
         $('span.viewpage').html('<a target="_blank" href="http://fb.com/' + pageid + '">View Fanpage</a>');
     } else {
         if (data.from) {
             pagename = data.from.name;
             category = data.from.category;
             talk = data.talking_about_count;
             likes = data.likes;
             cover = data.images;

             $('div.profile-data-namez').text(pagename);
             $('div.profile-data-titlez').text(category);
             $('#conver').css('background-image', 'url(' + cover[0].source + ')');
             $('span.id').text('ID: ' + pageid);
             $('span.badge-danger').text(talk);
             $('span.badge-default').text(likes);
             $('span.viewpage').html('<a onclick="()">View Fanpage</a>');
         }

     }
 });

 isbookmark();

 function isbookmark() {
     $.get('isbookmark/' + pageid, function(data) {
         if (data == '1') {
             $('div.bookmark').html('<button class="btn btn-warning" onclick="unbookmark(' + pageid + ');">Unbookmark</button>');
         } else {
             $('div.bookmark').html('<button class="btn btn-primary" onclick="bookmark(\'' + pageid + '\',\'' + pagename + '\',\'' + talk + '\',\'' + likes + '\');">Bookmark</button>');
         }
     });
 }


 function unbookmark(pageid) {
     $.get('unbookmark/' + pageid, function(data) {
         if (data == '1') {
             toastr.warning("Unbookmark success.", "Complete!");
             isbookmark();
         }
     });
 }

 function bookmark(pageid, name, talk, likes) {
     var arrdata = {
         '_token': $('meta[name=csrf-token]').attr('content'),
         task: 'comment_insert',
         pageid: pageid,
         talk: talk,
         likes: likes,
         pagename: name
     }
     $.post('bookmark', arrdata, function(thongbao) {
         toastr.success("You've bookmark this fanpage", "Notification!");
         isbookmark();
     });

 }

 function formatNum(num) {
     var p = num.toFixed(2).split(".");
     return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
         return num + (i && !(i % 3) ? "." : "") + acc;
     }, "");
 }

 //load kết quả tìm kiếm ra table
 function runz(c) {

     if (c == 0) {
         toastr.info("Loading ALL feed...", "Notification");

     } else if (c == 1) {
         toastr.info("Loading trending IMAGES...", "Notification");

     } else if (c == 2) {
         toastr.info("Loading trending VIDEO...", "Notification");

     }
     var t = $('#ptable').DataTable();
     t.clear().draw();
     urltable = 'https://graph.facebook.com/' + pageid + '/feed?access_token=' + token;
     if (data == '') {
         $.getJSON(urltable, function(mydata) {
             data = mydata;
             if (data.data) {
                 var dem = 0;
                 var myArray = [];
                 $.each(data.data, function(index, mydata) {
                     var idz = mydata.id;
                     var mesz = '';
                     var isvideo = '';
                     if (mydata.message) {
                         mesz = mydata.message;
                     }
                     var picz = '';

                     if (mydata.picture) {
                         picz = mydata.picture;
                         isvideo = '<div style="background:#e8e8e8;"><img src="' + picz + '" height="100px" style="display:block;margin:auto;max-width: 120px;"/></div>';
                         if (mydata.source) {
                             picz = mydata.source;
                         } else {
                             picz = '1';
                         }
                     }
                     var likes = '';
                     if (mydata.likes) {
                         likes = mydata.likes.count;
                     }
                     var comz = '';
                     if (mydata.comments) {
                         comz = mydata.comments.count;
                     }
                     var created = mydata.created_time;
                     var link = mydata.link;
                     if (isvideo != '') {
                         myArray.push([dem, isvideo, '<div style="max-width:300px;word-wrap: break-word;">'+mesz+'</div>', likes + ' / ' + comz, created.substring(0, 10), '<p><a onclick="postnow(' + dem + ',\'' + idz + '\',\'' + picz + '\')" class="btn btn-primary" data-toggle="modal" data-target="#postnow" style="width:90px">Post Now</a></p><p><a onclick="schedule(' + dem + ',\'' + idz + '\',\'' + picz + '\')" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="width:90px">Schedule</a><p/><a target="_blank" class="btn btn-default" data-toggle="modal" data-target="#preview" onclick="preview(\'' + idz + '\',\'' + picz + '\')" style="width:90px">Preview</a>']);
                         dem++;
                     }
                 });
                 t.rows.add(myArray).draw();
             }
         });
     }
     if (data.data) {
         var dem = 0;
         var myArray = [];
         $.each(data.data, function(index, mydata) {
             var idz = mydata.id;
             var mesz = '';
             var isvideo = '';
             if (mydata.message) {
                 mesz = mydata.message;
             }
             var picz = '';
             if (c == 0) {

                 if (mydata.picture) {
                     picz = mydata.picture;
                     isvideo = '<div style="background:#e8e8e8;"><img src="' + picz + '" height="100px" style="display:block;margin:auto;max-width: 120px;"/></div>';
                     if (mydata.source) {
                         picz = mydata.source;
                     } else {
                         picz = '1';
                     }
                 }
             } else if (c == 1) {
                 if (!mydata.source) {
                     picz = mydata.picture;
                     isvideo = '<div style="background:#e8e8e8;"><img src="' + picz + '" height="100px" style="display:block;margin:auto;max-width: 120px;"/></div>';
                     picz = '1';

                 } else {
                     isvideo = '';
                 }
             } else if (c == 2) {

                 if (mydata.source) {
                     picz = mydata.picture;
                     isvideo = '<div style="background:#e8e8e8;"><img src="' + picz + '" height="100px" style="display:block;margin:auto;max-width: 120px;"/></div>';
                     picz = mydata.source;
                 } else {
                     isvideo = '';
                 }
             }
             var likes = '';
             if (mydata.likes) {
                 likes = mydata.likes.count;
             }
             var comz = '';
             if (mydata.comments) {
                 comz = mydata.comments.count;
             }
             var created = mydata.created_time;
             var link = mydata.link;
             if (isvideo != '') {
                 myArray.push([dem, isvideo, '<div style="max-width:300px;word-wrap: break-word;">'+mesz+'</div>', likes + ' / ' + comz, created.substring(0, 10), '<p><a onclick="postnow(' + dem + ',\'' + idz + '\',\'' + picz + '\')" class="btn btn-primary" data-toggle="modal" data-target="#postnow" style="width:90px">Post Now</a></p><p><a onclick="schedule(' + dem + ',\'' + idz + '\',\'' + picz + '\')" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="width:90px">Schedule</a><p/><a target="_blank" class="btn btn-default" data-toggle="modal" data-target="#preview" onclick="preview(\'' + idz + '\',\'' + picz + '\')" style="width:90px">Preview</a>']);
                 dem++;
             }
         });
         t.rows.add(myArray).draw();
     }
 }

 function preview(idz, picz) {
     var preview = '';
     if (picz == '1') {
         var urlsrc = 'https://graph.facebook.com/' + idz + '/?fields=full_picture,picture';
         //lay anh full
         $.getJSON(urlsrc, function(data) {
             if (data.full_picture) {
                 var fullpic = data.full_picture;
                 preview = '<img src="'+fullpic+'" width="100%"/>';
                 $('#previewsrc').html(preview);
             }
         });
     } else {
         preview = '<video id="videoplay" width="80%" controls style="margin-left:10%">' +
             '<source src="' + picz + '" type="video/mp4">' +
             '</video>';
         $('#previewsrc').html(preview);
     }

 }

 function schedule(dem, idz, picz) {
     var today = new Date();
     var month = today.getUTCMonth() + 1; //months from 1-12
    var day = today.getUTCDate();
    var year = today.getUTCFullYear();
    var newdate = year + "/" + month + "/" + day;
     $('#pdate').val(newdate);
     h = (today.getHours() < 10 ? '0' : '') + today.getHours(),
         m = (today.getMinutes() < 10 ? '0' : '') + today.getMinutes();
     $('#ptime').val(h + ':' + m);
     getpageid = idz;
     getpagesrc = picz;
     var demz = parseInt(dem);
     demz = demz + 1;
     if (demz % 10 == 0) {
         demz = 10;
     } else {
         demz = demz % 10;
     }
     var dataz = document.getElementById("ptable").rows[demz].cells[2].innerHTML;
     var prev = document.getElementById("ptable").rows[demz].cells[1].innerHTML;
     document.getElementById('msg').value = dataz;
     $('div.pic').html(prev);
 }

 function postnow(dem, idz, picz) {
     getpageid = idz;
     getpagesrc = picz;
     var demz = parseInt(dem);
     demz = demz + 1;
     if (demz % 10 == 0) {
         demz = 10;
     } else {
         demz = demz % 10;
     }
     var dataz = document.getElementById("ptable").rows[demz].cells[2].innerHTML;
     var prev = document.getElementById("ptable").rows[demz].cells[1].innerHTML;
     document.getElementById('msg2').value = dataz;
     $('div.pic').html(prev);
 }

 function postFB(s) {
     if (s == 1) {

         var date = $('#pdate').val();
         var time = $('#ptime').val();
         date = date + ' ' + time;
         date = new Date(date);
         time = Math.round(date.getTime() / 1000);
         var now = Math.round(new Date().getTime() / 1000);
         var checktime = now + 605;
         console.log(checktime);
         if (checktime > time) {
             toastr.error("Scheduled publish time must more 10 minutes!", "Error!");
             return null;
         }
         var elt = document.getElementById('select01');
         var mypage = elt.options[elt.selectedIndex].value;
         var ptoken = elt.options[elt.selectedIndex].getAttribute("name");
         var msg = document.getElementById('msg').value
         var datapost = {
             "access_token": ptoken,
             "message": msg,
             "access_token": ptoken,
             "scheduled_publish_time": time,
             "published": false
         };

     } else if (s == 0) {
         var elt = document.getElementById('select02');
         var mypage = elt.options[elt.selectedIndex].value;
         var ptoken = elt.options[elt.selectedIndex].getAttribute("name");
         var msg = document.getElementById('msg2').value
         var datapost = {
             "access_token": ptoken,
             "message": msg,
             "access_token": ptoken
         }
     }
     toastr.success("Start posting...", "Notification!");
     // truong hop dang video: getpagesrc!=1
     if (getpagesrc != '1') {
         datapost["file_url"] = getpagesrc;
         datapost["description"] = msg;
         $.post("https://graph.facebook.com/" + mypage + "/videos?method=post", datapost,
             function(response) {

                 if (response && !response.error) {
                     toastr.success("<a target='_blank' href='http://fb.com/" + response.id + "'>View your post:  click link</a>", "Successful post");
                 } else {
                     toastr.error(response.error.message, "Error: " + response.error.code);
                 }

             }).error(function(response) {
             if (response.error) {
                 toastr.error(response.error.message, "Error: " + response.error.code);
             }
         });
     } else {
         var urlsrc = 'https://graph.facebook.com/' + getpageid + '/?fields=full_picture,picture';
         //lay anh full
         $.getJSON(urlsrc, function(data) {
             if (data.full_picture) {
                 getpagesrc = data.full_picture;
                 datapost["message"] = msg;
                 datapost["url"] = getpagesrc;
                 $.post("https://graph.facebook.com/" + mypage + "/photos", datapost,
                     function(response) {

                         if (response && !response.error) {
                             toastr.success("<a target='_blank' href='http://fb.com/" + response.id + "'>View your post:  click link</a>", "Successful post");
                         }else{
                         toastr.error(response.error.message, "Error:" + response.error.code);
                            
                         }
                     });
             }
         });
     }

 }
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>