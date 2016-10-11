var pageid = '{{$pageid}}';
 var token = '{{$token}}';
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
                         comz = mydata.comments.data.length;
                     }
                     var created = mydata.created_time;
                     var link = mydata.link;
                     if (isvideo != '') {
                         myArray.push([dem, isvideo, mesz, likes + ' / ' + comz, created.substring(0, 10), '<p><a onclick="postnow(' + dem + ',\'' + idz + '\',\'' + picz + '\')" class="btn btn-primary" data-toggle="modal" data-target="#postnow" style="width:90px">Post Now</a></p><p><a onclick="schedule(' + dem + ',\'' + idz + '\',\'' + picz + '\')" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="width:90px">Schedule</a><p/><a target="_blank" class="btn btn-default" data-toggle="modal" data-target="#preview" onclick="preview(\'' + idz + '\',\'' + picz + '\')" style="width:90px">Preview</a>']);
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
                 myArray.push([dem, isvideo, mesz, likes + ' / ' + comz, created.substring(0, 10), '<p><a onclick="postnow(' + dem + ',\'' + idz + '\',\'' + picz + '\')" class="btn btn-primary" data-toggle="modal" data-target="#postnow" style="width:90px">Post Now</a></p><p><a onclick="schedule(' + dem + ',\'' + idz + '\',\'' + picz + '\')" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="width:90px">Schedule</a><p/><a target="_blank" class="btn btn-primary" data-toggle="modal" data-target="#preview" onclick="preview(\'' + idz + '\',\'' + picz + '\')" style="width:90px">Preview</a>']);
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
                 preview = '<img src="https://fbcdn-photos-a-a.akamaihd.net/hphotos-ak-xpa1/v/t1.0-0/p480x480/13241128_1197847873582794_2145420999948718708_n.jpg?oh=21fcb19ce82c8ef933da75516936f7d4&oe=57D26741&__gda__=1473412740_bb6c2ec03f7af81d0cdb74552306072e" width="100%"/>';
                 $('#previewsrc').html(preview);
             }
         });
     } else {
         preview = '<video width="80%" controls style="margin-left:10%">' +
             '<source src="' + picz + '" type="video/mp4">' +
             '<source src="movie.ogg" type="video/ogg">' +
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