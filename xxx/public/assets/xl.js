

toastr.options = {

  "closeButton": false,

  "debug": false,

  "newestOnTop": false,

  "progressBar": true,

  "positionClass": "toast-top-right",

  "preventDuplicates": false,

  "onclick": null,

  "showDuration": "300",

  "hideDuration": "1000",

  "timeOut": "5000",

  "extendedTimeOut": "1000",

  "showEasing": "swing",

  "hideEasing": "linear",

  "showMethod": "fadeIn",

  "hideMethod": "fadeOut"

}









var thongbaotime = 0;



function updateRange(ts) {

    var t = $('#dtable').dataTable();

    t = t.fnGetData().length;

    if (t != document.getElementById('ketthuc').value && document.getElementById('batdau').value == 0) {

        $("#slider-range").slider({

            range: true,

            min: 0,

            max: t,

            values: [0, t],

            slide: function(event, ui) {

                $("#amount").val("bắt đầu: " + (ui.values[0]+1) + " - kết thúc: " + ui.values[1]);

                document.getElementById('batdau').value = ui.values[0];

                document.getElementById('ketthuc').value = ui.values[1];

                $('#slider-range .ui-slider-handle:first').html('<div class="tooltip top slider-tip"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + ui.values[0] + '</div></div>');

                $('#slider-range .ui-slider-handle:last').html('<div class="tooltip top slider-tip"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + ui.values[1] + '</div></div>');

            }

        });

        $("#amount").val("bắt đầu: " + $("#slider-range").slider("values", 0) + " - kết thúc: " + $("#slider-range").slider("values", 1));

        document.getElementById('batdau').value = 0;

        document.getElementById('ketthuc').value = t;

    }

}



function getUID(s) {

    var b = document.getElementById('ididid').value;

    if (b.length > 0) {

        var get = "friends";

        if (s == 1)

            get = "members";

        var elt = document.getElementById('select01');

        var value = elt.options[elt.selectedIndex].value;

        if (value != 0) {

            var t = $('#dtable').DataTable();

           toastr.info('Bắt đầu xử lý');

            $.getJSON('https://graph.facebook.com/' + b + '/' + get + '?limit=5000&access_token=' + value, function(mydata) {

                if (mydata.data) {

                    var dem = 0;

                    var myArray = [];

                    $.each(mydata.data, function(index, friend) {

                        myArray.push(["<input checked type='checkbox' id='checkbox-" + friend.id + "'>", dem, friend.name, friend.id, "<a target='_blank' href='http://fb.com/" + friend.id + "'>Xem thành viên</a>"]);

                        dem++;

                    });

                    t.rows.add(myArray).draw();

                    updateRange(mydata.data.length);

                    toastr.success("Lấy danh sách thành công", 'Thành công!');

                } else {

                    alert("Error!");

                };

            }).error(function(mydata) {

                if (mydata) {

                    var jsonResponseText = $.parseJSON(mydata.responseText);

                    $.each(jsonResponseText, function(name, err) {

                        toastr.error("Mô tả: " + err.message, 'Loại Lỗi: ' + err.code);

                    });

                }

            });

        } else {

            toastr.warning("Bạn chưa lựa chọn tài khoản gửi", 'Chú ý!');

        }

    }

}



function getListUID() {

    var table = $('#dtable').DataTable();

    table.clear().draw();

    toastr.success("Xóa danh sách thành công", 'Thành công!');

    document.getElementById('batdau').value = 0;

    document.getElementById('ketthuc').value = 0;

}



function requestFriend() {

    var elt = document.getElementById('select01');

    var value = elt.options[elt.selectedIndex].value;

    var uid = "";

    try {

        uid = document.getElementById('ididid').value;

         $.post('https://graph.beta.facebook.com/v1.0/me/friends/' + uid, 'access_token=' + value + '&format=json&method=post&pretty=0&suppress_http_code=1', function(mydata) {

            if (mydata)

                toastr.success("Gửi yêu cầu kết bạn thành công cho: " + uid, 'Thành công!');

            else

                toastr.warning("Gửi yêu cầu kết bạn không thành công cho: " + uid, 'Không thành công!');

        });

        

    } catch (e) {

        if (uid == "")

            toastr.warning("UID cần kéo nhóm không được để trống", 'Không thành công!');

    }

}



function requestSearch() {

    var elt = document.getElementById('select01');

    var value = elt.options[elt.selectedIndex].value;

    if(value==0)

    {

        toastr.warning("Vui Lòng chọn tài khoản.", "Thao tác thất bại!")

    }else{

        toastr.info("Bắt đầu tìm kiếm", "Thông báo!")

    }

    var keyword = "";

    try {

        var t = $('#dtable').DataTable();

        keyword = document.getElementById('ididid').value;

        $.getJSON('https://graph.facebook.com/search?q=' + keyword + '&type=group&access_token=' + value, function(mydata) {

            if (mydata.data) {

                var dem = 0;

                var myArray = [];

                $.each(mydata.data, function(index, group) {

                    myArray.push(["<input checked type='checkbox' id='checkbox-" + group.id + "'>", dem, group.name, group.id, "<a target='_blank' href='http://fb.com/" + group.id + "'>Xem nhóm</a>"]);

                    dem++;

                });

                t.rows.add(myArray).draw();

                updateRange(mydata.data.length);

            } else {

                alert("Error!");

            };

        }).error(function(mydata) {

            if (mydata) {

                var jsonResponseText = $.parseJSON(mydata.responseText);

                $.each(jsonResponseText, function(name, err) {

                    toastr.error("Mô tả: " + err.message, 'Loại lỗi: ' + err.code);

                });

            }

        });

    } catch (e) {

        if (keyword == "")

            toastr.warning("Từ khóa không được để trống", 'Không thành công!');

    }

}

var i = 0;

var timerr = 100;



function myLoop(s) {

    timerr = 100 +  document.getElementById('timerstep').value * 1000;

    setTimeout(function() {

        var b = document.getElementById('break').value;

        var msg = "";

        var batdau = 0;

        var elt = document.getElementById('select01');

        var value = "";

        var poster = "";

        try {

            value = elt.options[elt.selectedIndex].value;

            poster = elt.options[elt.selectedIndex].getAttribute("name");

        } catch (err) {

            console.log("No poster:" + err.message);

        }

        var t = $('#dtable').dataTable();

        t = t.fnGetData().length;

        var ketthuc = t;

        var style = Math.floor((i * 100) / t);

        document.getElementById('barinbox').setAttribute("style", "width:" + style + "%");

        document.getElementById('barinbox').innerHTML = (i + 1);

        var table = $('#dtable').DataTable();

        try {

            batdau = document.getElementById('batdau').value;

        } catch (err) {

            console.log("No value:" + err.message);

        }

        try {

            ketthuc = document.getElementById('ketthuc').value;

        } catch (err) {

            console.log("No value:" + err.message);

        }

        var vcl = parseInt(batdau) + i;

        

        if (ketthuc > vcl) {

            var data = table.row(vcl).data();

            var uid = data[3];

            var idcheckbox = "checkbox-" + uid;

            

            var x = true;

            try {

                x = document.getElementById(idcheckbox).checked;

            } catch (err) {

                var dtable = $('#dtable').dataTable();

                var page = Math.floor((vcl + 9) / 10);

                dtable.fnPageChange(page, true);

                try {

                    x = document.getElementById(idcheckbox).checked;

                } catch (err) {}

            }

            var fullname = data[2];

            try {

                msg = document.getElementById('msg').value;

                msg = randomtext(msg, fullname);

                msg = encodeURIComponent(msg);

            } catch (err) {

                console.log("No value:" + err.message);

            }

            i++;

            if (x) {

                

                if (s == 0) {

                     var laySoLuong = document.getElementById('selectInbox');

                        var soLuong = "";

                        try {

                            soLuong = laySoLuong.options[laySoLuong.selectedIndex].value;

                        } catch (err) {

                            console.log("No poster:" + err.message);

                        }

                    var nhay = vcl;

                    if(nhay>0)

                    {

                        if(nhay==1)

                        {

                            var ThongMinh = 100;

                            nhay = vcl + (soLuong*1) -1;

                        }else{

                            nhay = vcl + (soLuong*i) - i +1;

                        }

                    }

                    var arrUID = [];

                    for (var demMuoi = 0; demMuoi < soLuong; demMuoi++) {

                        var data = table.row(nhay+demMuoi).data();

                        var uidz = data[3];

                        var idcheckbox = "checkbox-" + uidz;

                        arrUID[demMuoi] = uidz;

                    }
                    var style2 = Math.floor((nhay * 100) / t);
                    document.getElementById('barinbox').setAttribute("style", "width:" + style2 + "%");
                    document.getElementById('barinbox').innerHTML = (nhay + 1);
                    var x = true;

                    try {

                        x = document.getElementById(idcheckbox).checked;

                    } catch (err) {

                        var dtable = $('#dtable').dataTable();

                        if (soLuong>1) {

                            var page = Math.floor((nhay + 9) / 10);

                            dtable.fnPageChange(page, true);

                        }

                        try {

                            x = document.getElementById(idcheckbox).checked;

                        } catch (err) {}

                    }

                    var postArr = {

                                '_token': $('meta[name=csrf-token]').attr('content'),

                                's': s,

                                'arrUID': arrUID,

                                'msg': msg,

                                'token': value,

                            }



                    $.post("myLoop",postArr, function(mydata) {

                        var data = $.parseJSON(mydata);

                        if (data.id)

                            if (soLuong==1) {

                                toastr.success("Gửi tin nhắn " + fullname + " thành công", 'Thành công!');

                            }else{

                                toastr.success("Gửi tin nhắn thành công", 'Thành công!');

                            }

                        else {

                            var error = data.error;

                            toastr.warning("Mô tả: " + error.message, "Loại lỗi: " + error.code);

                        }

                    });

                }

                if (s == 1) {

                    var linklink = "";

                    try {

                        linklink = document.getElementById('url').value;

                        linklink = encodeURIComponent(linklink);

                    } catch (err) {

                        console.log("No value linklink:" + err.message);

                    }

                    var postArr = {

                        '_token': $('meta[name=csrf-token]').attr('content'),

                        's': s,

                        'uid': uid,

                        'msg': msg,

                        'token': value,

                        'linklink': linklink,

                        'poster':poster,

                    }



                    $.post('myLoop', postArr, function(mydata) {

                        var data =  $.parseJSON(mydata);

                        var code = data[0];

                        if (code[0].code != 200) {

                            var body = code[1];

                            toastr.warning("Mô tả: " + body.body.error.message,"Loại lỗi: " + code[0].code);

                        } else {

                            var postid = code[1].body;

                            postid = postid.id;

                            toastr.success("Đăng bài thành công vào: <a target='_blank' href='http://fb.com/" + postid + "'>" + fullname + "</a>", 'Thành công!');

                        }

                    });

                      

                }

                if (s == 2) {

                    $.post('https://graph.beta.facebook.com/v1.0/me/friends/' + uid, 'access_token=' + value + '&format=json&method=post&pretty=0&suppress_http_code=1', function(mydata) {

                        if (mydata)

                            toastr.success("Gửi yêu cầu kết bạn thành công cho: " + fullname, 'Thành công!');

                        else

                            toastr.warning("Gửi yêu cầu kết bạn không thành công cho: " + fullname, 'Không thành công!');

                    });

                }

                if (s == 3) {

                    try {

                        var uid2 = document.getElementById('ididid').value;

                        $.getJSON('https://graph.facebook.com/graphql?method=post&query_id=10153110853401729&query_params={%220%22:{%22group_id%22:%22' + uid + '%22,%22user_ids%22:[%22' + uid2 + '%22],%22client_mutation_id%22:%227771f214-2cec-44b2-b51e-2a537bc73e7e%22,%22actor_id%22:%22' + poster + '%22}}&locale=vi_VN&client_country_code=VN&fb_api_req_friendly_name=GroupAddMembersMutation&fb_api_caller_class=com.facebook.groups.treehouse.members.protocol.GroupAddMembersMutationModels%24GroupAddMembersMutationModel&access_token=' + value, function(mydata) {

                            if (!mydata.error)

                                toastr.success("Kéo nhóm " + fullname + " thành công", 'Thành công!');

                            else {

                                var error = mydata.error;

                                toastr.warning(error.description, error.summary);

                            }

                        }).error(function(mydata) {

                            if (mydata) {

                                var jsonResponseText = $.parseJSON(mydata.responseText);

                                $.each(jsonResponseText, function(name, err) {

                                    toastr.error("Mô tả: " + err.message, 'Loại lỗi: ' + err.code);

                                });

                            }

                        });

                    } catch (e) {

                        toastr.warning("Không nhận diện được UID cần kéo nhóm", 'Không thành công!');

                    }

                }

                if (s == 4) {
                    try {
                        $.getJSON('https://graph.facebook.com/graphql?method=post&query_id=10152756326766729&query_params={%220%22:{%22group_id%22:%22' + uid + '%22,%22source%22:%22mobile_group_join%22,%22client_mutation_id%22:%22b2f4f5c0-fb35-4195-b732-e436405718fe%22,%22actor_id%22:%22' + poster + '%22}}&strip_nulls=true&strip_defaults=true&locale=vi_VN&client_country_code=VN&fb_api_req_friendly_name=GroupRequestToJoinCoreMutation&fb_api_caller_class=com.facebook.groups.mutations.protocol.GroupMutationsModels$GroupRequestToJoinCoreMutationModel&access_token=' + value, function(mydata) {
                            if (!mydata.error)
                                toastr.success("Tham gia " + fullname + " thành công", 'Thành công!');
                            else {
                                var error = mydata.error;
                                toastr.warning(error.description, error.summary);
                            }
                        }).error(function(mydata) {
                            if (mydata) {
                                var jsonResponseText = $.parseJSON(mydata.responseText);
                                $.each(jsonResponseText, function(name, err) {
                                    toastr.error("Mô tả: " + err.message, 'Loại lổi: ' + err.code);
                                });
                            }
                        });
                    } catch (e) {
                        toastr.warning("Không nhận diện được UID cần kéo nhóm", 'Không thành công!');
                    }
                }

                if (s == 5) {

                    $.get('api_hide.php?poster=' + poster + '&msg=' + msg + '&uid=' + uid + '&action=5', function(mydata) {

                        if (mydata.length == 2)

                            toastr.success("Gửi tin nhắn thành công cho: " + fullname, 'Thành công!');

                        else

                            toastr.warning("Gửi tin nhắn không thành công cho: " + fullname + "(" + mydata + ")", 'Không thành công!');

                    });

                }

                

                if (s == 7) {

                    try {

                        var uid2 = document.getElementById('ididid').value;

                        $.post('https://graph.facebook.com/v1.0/' + uid2 + '/members/' + uid, 'access_token=' + value + '&format=json&method=post&pretty=0&suppress_http_code=1', function(mydata) {

                            if (!mydata.error)

                                toastr.success("Kéo " + fullname + " vào nhóm " + uid2 + " thành công", 'Thành công!');

                            else

                                toastr.warning("Kéo " + fullname + " vào nhóm " + uid2 + " không thành công", 'Không thành công!');

                        });

                    } catch (e) {

                        toastr.warning("Không nhận diện được UID cần kéo nhóm", 'Không thành công!');

                    }

                }

                if (s == 8) {

                    try {

                        var uid2 = document.getElementById('ididid').value;

                        $.get('https://graph.beta.facebook.com/v1.0/' + uid2 + '/invited/' + uid + '?method=post&access_token=' + value, function(mydata) {

                            if (mydata)

                                toastr.success("Mời vào sự kiện thành công", 'Thành công!');

                            else

                                toastr.warning("Mời vào sự kiện không thành công", 'Không thành công!');

                        });

                    } catch (e) {

                        toastr.warning("Không nhận diện được UID", 'Không thành công!');

                    }

                }

                if (s == 9) {

                    try {

                        var uid2 = document.getElementById('ididid').value;

                        if(uid2=="")

                        {

                            toastr.warning("Bạn chưa nhập ID Fanpage", "Không thành công!");

                        }

                        $.post('https://graph.beta.facebook.com/v1.0/' + uid2 + '/invited?method=post&invitee_id=' + uid + '&access_token=' + value, function(mydata) {

                            if (mydata)

                                toastr.success("Mời vào thích trang thành công", 'Thành công!');

                            else

                                toastr.warning("Mời vào thích trang không thành công", 'Không thành công!');

                        }).error(function(mydata) {

                            if (mydata)

                                toastr.success("Mời " + fullname + "  thích trang thành công", 'Thành công!');

                            else

                                toastr.warning("Mời vào thích trang không thành công", 'Không thành công!');

                        });

                    } catch (e) {

                        toastr.warning("Không nhận diện được UID", 'Không thành công!');

                    }

                }

                if (s == 10) {

                    $.getJSON('https://graph.facebook.com/' + uid + '/comments?method=post&message=' + msg + '&access_token=' + value, function(mydata) {

                        postid = mydata.id;

                        if (postid.length > 5) {

                            $.get('count.php?uid=' + poster + '&action=10&postid=' + postid + '&memo=' + encodeURI("úp bài vào " + fullname));

                            toastr.success("Úp bài thành công vào: <a target='_blank' href='http://fb.com/" + postid + "'>" + fullname + "</a>", 'Thành công!');

                        } else

                            toastr.warning("Úp bài không thành công vào: " + fullname, 'Không thành công!');

                    }).error(function(mydata) {

                        if (mydata) {

                            var jsonResponseText = $.parseJSON(mydata.responseText);

                            $.each(jsonResponseText, function(name, err) {

                                toastr.error("Mô tả: " + err.message, 'Loại lỗi: ' + err.code);

                            });

                        }

                    });

                }

                if (s == 11) {

                    $.get('https://graph.beta.facebook.com/v1.0/me/friends?method=delete&uid=' + uid + '&access_token=' + value, function(mydata) {

                        if (mydata)

                            toastr.success("Hủy kết bạn thành công cho: " + fullname, 'Thành công!');

                        else

                            toastr.warning("Hủy kết bạn không thành công cho: " + fullname, 'Không thành công!');

                    });

                }

                

                if (s == 13) {

                    var linklink = "";

                    try {

                        linklink = document.getElementById('url').value;

                        linklink = encodeURIComponent(linklink);

                    } catch (err) {

                        console.log("No value linklink:" + err.message);

                    }

                    $.get('https://api.facebook.com/method/stream.publish?message=' + msg + '&target_id=' + uid + '&format=json&access_token=' + value, function(mydata) {

                        toastr.success("Đăng bài thành công vào: <a target='_blank' href='http://fb.com/" + mydata + "'>" + fullname + "</a>", 'Thành công!');

                    }).error(function(mydata) {

                        if (mydata) {

                            var jsonResponseText = $.parseJSON(mydata.responseText);

                            $.each(jsonResponseText, function(name, err) {

                                toastr.error("Mô tả: " + err.message, 'Loại lỗi: ' + err.code);

                            });

                        }

                    });

                }

            } else {

                toastr.warning("ID này bị loại bỏ khỏi danh sách", 'Không thành công!');

            }

            if (b == "run") {

                myLoop(s);

            }

        } else {

            document.getElementById('barinbox').setAttribute("style", "width: 100%");

            document.getElementById('barinbox').innerHTML = i;

            if (s == 0)

                toastr.info("Gửi tin nhắn cho toàn bộ danh sách thành công", 'Hoàn thành!');

            if (s == 1)

                toastr.info("Đăng bài vào toàn bộ danh sách thành công", 'Hoàn thành!');

            if (s == 2)

                toastr.info("Gửi yêu cầu toàn bộ danh sách thành công", 'Hoàn thành!');

            if (s == 3)

                toastr.info("Kéo nhóm toàn bộ danh sách thành công", 'Hoàn thành!');

            if (s == 4)

                toastr.info("Tham gia toàn bộ danh sách thành công", 'Hoàn thành!');

            if (s == 5)

                toastr.info("Gửi tin nhắn cho toàn bộ danh sách thành công", 'Hoàn thành!');

            if (s == 6)

                toastr.info("Gửi tin nhắn cho toàn bộ danh sách thành công", 'Hoàn thành!');

            if (s == 7)

                toastr.info("Thêm toàn bộ bạn bè vào nhóm hoàn thành", 'Hoàn thành!');

            if (s == 8)

                toastr.info("Mời toàn bộ bạn bè tham gia sự kiện hoàn thành", 'Hoàn thành!');

            if (s == 9)

                toastr.info("Mời toàn bộ bạn bè thích trang hoàn thành", 'Hoàn thành!');

            if (s == 10)

                toastr.info("Úp bài bộ danh sách hoàn thành", 'Hoàn thành!');

            if (s == 11)

                toastr.info("Hủy bạn toàn bộ danh sách hoàn thành", 'Hoàn thành!');

            if (s == 12)

                toastr.info("Gửi toàn bộ danh sách hoàn thành", 'Hoàn thành!');

        }

    }, timerr)

}



function myPause() {

    document.getElementById('break').value = "pause";

    toastr.info('Tạm dừng', 'Thông báo!');

}



function myRun(s) {

	
    var t = $('#dtable').dataTable();

    t = t.fnGetData().length;

    if (i < t && t > 0) {

        if (s == 0)

            toastr.info('Bắt đầu gửi tin nhắn', 'Thông báo!');

        if (s == 1)

            toastr.info('Bắt đầu đăng bài', 'Thông báo!');

        if (s == 2)

            toastr.info('Bắt đầu gửi yêu cầu kết bạn', 'Thông báo!');

        if (s == 3)

            toastr.info('Bắt đầu kéo nhóm', 'Thông báo!');

        if (s == 4)

            toastr.info('Bắt đầu tham gia nhóm', 'Thông báo!');

        if (s == 5)

            toastr.info('Bắt đầu gửi tin nhắn ẩn danh', 'Thông báo!');

        if (s == 6)

            toastr.info('Bắt đầu gửi tin nhắn vào SĐT', 'Thông báo!');

        if (s == 7)

            toastr.info('Bắt đầu thêm bạn bè vào nhóm', 'Thông báo!');

        if (s == 8)

            toastr.info('Bắt đầu mời bạn bè tham gia sự kiện', 'Thông báo!');

        if (s == 9)

            toastr.info('Bắt đầu mời bạn bè thích trang', 'Thông báo!');

        if (s == 10)

            toastr.info('Bắt đầu úp bài', 'Thông báo!');

        if (s == 11)

            toastr.info("Bắt đầu hủy bạn bè", 'Hoàn thành!');

        if (s == 12)

            toastr.info("Bắt đầu gửi tin nhắn cho fanpage", 'Hoàn thành!');

        document.getElementById('break').value = "run";

        myLoop(s);

    } else {

        if (i > t && t > 0) {

            if (s == 0)

                toastr.success('Đã gửi xong danh sách', 'Thông báo!');

            if (s == 1)

                toastr.success('Đã đăng xong danh sách', 'Thông báo!');

            if (s == 2)

                toastr.success('Đã gửi xong danh sách', 'Thông báo!');

            if (s == 3)

                toastr.success('Đã kéo nhóm xong', 'Thông báo!');

            if (s == 4)

                toastr.success('Tham gia nhóm xong', 'Thông báo!');

            if (s == 5)

                toastr.success('Đã gửi xong danh sách', 'Thông báo!');

            if (s == 6)

                toastr.success('Đã gửi xong danh sách', 'Thông báo!');

            if (s == 7)

                toastr.success('Đã gửi xong danh sách', 'Thông báo!');

            if (s == 8)

                toastr.success('Đã mời xong danh sách', 'Thông báo!');

            if (s == 9)

                toastr.success('Đã mời xong danh sách', 'Thông báo!');

            if (s == 10)

                toastr.success('Đã úp xong danh sách', 'Thông báo!');

            if (s == 11)

                toastr.success('Đã hủy xong danh sách', 'Thông báo!');

            if (s == 12)

                toastr.success('Đã gửi xong danh sách', 'Thông báo!');

        } else {

            if (t == 0) {

                if (s == 0)

                    toastr.warning('Danh sách người gửi trống', 'Thông báo!');

                if (s == 1)

                    toastr.warning('Danh sách đăng bài trống', 'Thông báo!');

                if (s == 2)

                    toastr.warning('Danh sách cần kết bạn trống', 'Thông báo!');

                if (s == 3)

                    toastr.warning('Danh sách nhóm rỗng', 'Thông báo!');

                if (s == 4)

                    toastr.warning('Danh sách nhóm rỗng', 'Thông báo!');

                if (s == 5)

                    toastr.warning('Danh sách người gửi trống', 'Thông báo!');

                if (s == 6)

                    toastr.warning('Danh sách người gửi trống', 'Thông báo!');

                if (s == 7)

                    toastr.warning('Danh sách bạn bè trống', 'Thông báo!');

                if (s == 8)

                    toastr.warning('Danh sách bạn bè trống', 'Thông báo!');

                if (s == 9)

                    toastr.warning('Danh sách bạn bè trống', 'Thông báo!');

                if (s == 10)

                    toastr.warning('Danh sách POST_ID trống', 'Thông báo!');

                if (s == 11)

                    toastr.warning('Danh sách cần hủy trống', 'Thông báo!');

                if (s == 12)

                    toastr.warning('Danh sách cần gửi trống', 'Thông báo!');

            }

        }

    }

}



function delAcc(uid, name) {

    bootbox.confirm("Bạn chắc chắn muốn xóa tài khoản " + name, function(result) {

        if (result) {

            $.get('delAcc/' + uid, function(data) {

                toastr.success(data);

                setTimeout(function() {

                    window.location.reload(1);

                }, 1000);

            });

        }

    });

}



function getAcc(s) {
    var elt = document.getElementById('select01');
    var value = elt.options[elt.selectedIndex].value;
    if (value != 0) {
        var t = $('#dtable').DataTable();
        if (s == 0) {
            $.getJSON('https://graph.facebook.com/me/friends?limit=5000&access_token=' + value, function(mydata) {
                if (mydata.data) {
                    toastr.success('Lựa chọn tài khoản thành công', 'Thông báo!');
                    var dem = 0;
                    var myArray = [];
                    $.each(mydata.data, function(index, friend) {
                        myArray.push(["<input checked type='checkbox' id='checkbox-" + friend.id + "'>", dem, friend.name, friend.id, "<a target='_blank' href='http://fb.com/" + friend.id + "'>Xem thành viên</a>"]);
                        dem++;
                    });
                    t.rows.add(myArray).draw();
                    updateRange(mydata.data.length);
                } else {
                    alert("Error!");
                };
            }).error(function(mydata) {
                if (mydata) {
                    var jsonResponseText = $.parseJSON(mydata.responseText);
                    $.each(jsonResponseText, function(name, err) {
                        toastr.error("Mô tả: " + err.message, 'Loại lổi: ' + err.code);
                    });
                }
            });
        }
        if (s == 1) {
            $.getJSON('https://graph.facebook.com/me/groups?fields=id,name,icon&limit=5000&access_token=' + value, function(mydata) {
                if (mydata.data) {
                    toastr.success('Lựa chọn tài khoản thành công', 'Thông báo!');
                    var dem = 0;
                    var myArray = [];
                    $.each(mydata.data, function(index, group) {
                        myArray.push(["<input checked type='checkbox' id='checkbox-" + group.id + "'>", dem, group.name, group.id, "<a target='_blank' href='http://fb.com/" + group.id + "'>Xem nhóm</a>"]);
                        dem++;
                    });
                    t.rows.add(myArray).draw();
                    updateRange(mydata.data.length);
                } else {
                    alert("Error!");
                };
            }).error(function(mydata) {
                if (mydata) {
                    var jsonResponseText = $.parseJSON(mydata.responseText);
                    $.each(jsonResponseText, function(name, err) {
                        toastr.error("Mô tả: " + err.message, 'Loại lổi: ' + err.code);
                    });
                }
            });
        }
        if (s == 100) {
            $.getJSON('https://graph.facebook.com/me?access_token=' + value, function(mydata) {
                toastr.success('Lựa chọn tài khoản thành công', 'Thông báo!');
            }).error(function(mydata) {
                if (mydata) {
                    var jsonResponseText = $.parseJSON(mydata.responseText);
                    $.each(jsonResponseText, function(name, err) {
                        toastr.error("Mô tả: " + err.message, 'Loại lổi: ' + err.code);
                    });
                }
            });
        }
    }
}



function randomtext(text, name) {

    var replacements = '✢ ✣ ✤ ✥ ❋ ✦ ✧ ✱ ✶ ✷  ✸ ✺ ✻ ❈ ❉ ❊ ✽ ✾ ✿ ❁ ❃ ❋ ❀ ♚ ♛ ♜ ♝ ♞ ♟ ♔ ♕ ♖ ♗ ♘ ♙ ✪ ✩ ✰ ✫ ✬ ✭ ★ ⋆ ✢ ✣ ✤ ✥ ❋ ✦ ✧ ✱ ✶ ✷  ✸ ✺ ✻  ❈ ❉ ❊ ✽ ✾ ✿ ❁ ❃ ❋ ❀ ☻ ♦ ♣ ♠ ♥ ♂ ♀ ♪ ♫ ☼  ✿ ⊰ ⊱ ✪ ✣ ✤ ✥ ✦ ✧ ✩ ✫ ✬ ✭ ✯ ✰ ✱ ✲  ❃ ❂ ❁ ❀ ✿ ✶   ❉ ❋ ❖ ⊹⊱✿ ✿⊰⊹ ♧ ✿ ♂ ♀ ∞ ☆'.split(' ');

    var paragraphs = text.split('|');

    return paragraphs[Math.floor(Math.random() * paragraphs.length)].replace(/\{r\}/g, function() {

        return replacements[Math.floor(Math.random() * replacements.length)]

    }).replace(/{name}/g, name).replace(/\{(.*?)\}/g, function(x, match) {

        var options = match.split(',');

        return options[Math.floor(Math.random() * options.length)];

    });

}



function addAcc2() {

    bootbox.prompt("Bạn hãy copy Access_Token của tài khoản cần thêm vào đây.", function(result) {

        $.get('access2.php?add_access=' + result, function(data) {

            if (data.length > 10) {

                setTimeout(function() {

                    window.location.reload(1);

                }, 1000);

                toastr.success(data);

            } else {

                if (data.length == 1)

                    toastr.warning("Hệ thống không thể thêm tài khoản này.", 'Thông báo!');

                if (data.length == 2)

                    toastr.warning("Lỗi tài khoản hoặc mật khẩu không đúng.", 'Thông báo!');

                if (data.length == 3)

                    toastr.warning("Hệ thống chỉ cho phép bạn thêm 10 tài khoản", 'Thông báo!');

            }

        });

    });

}



function scan() {

    bootbox.prompt("Bạn hãy nhập UID cần tìm số điện thoại vào đây.", function(result) {

        $.get('scan.php?uid=' + result, function(data) {

            if (data.length > 6) {

                bootbox.dialog({

                    title: 'Hệ thống đã tìm thấy số điện thoại ủa UID: ' + result,

                    message: '<div class="col-md-12"><h1>' + data + '</h1></div>',

                    buttons: {

                        success: {

                            label: "Thoát"

                        }

                    }

                });

            } else {

                if (data.length == 3)

                    toastr.warning("Hệ thống không tim thấy số điện thoại từ UID này.", 'Thông báo!');

                if (data.length == 1)

                    toastr.warning("Tính năng này chỉ sử dụng cho tài khoản kích hoạt 1 tháng trở lên.", 'Thông báo!');

            }

        });

    });

}



function addAcc(s) {

    var namebt = "Thêm tài khoản!";

    bootbox.dialog({

        title: namebt,

        message: '<div class="col-md-12"> ' + '<form class="form-horizontal"> ' + '<div class="form-group"> ' + '<label class="col-md-4 control-label" for="name">Tài khoản</label> ' + '<div class="col-md-4"> ' + '<input id="namefb" name="name" type="text" placeholder="email hoặc sđt" class="form-control input-md"> ' + '</div> </div>' + '<div class="form-group"> ' + '<label class="col-md-4 control-label" for="name">Mật khẩu</label> ' + '<div class="col-md-4"> ' + '<input id="passfb" name="pass" type="password" placeholder="Mật khẩu" class="form-control input-md"> ' + '</div> </div>' + '</form> </div>',

        buttons: {

            success: {

                label: namebt,

                className: "btn-success",

                callback: function() {

                    var name = $('#namefb').val();

                    var pass = $('#passfb').val();

                    $.get('access.php?email=' + name + "&pass=" + pass, function(data) {

                        if (data.length > 10) {

                            if (data.length < 80) {

                                setTimeout(function() {

                                    window.location.reload(1);

                                }, 1000);

                                toastr.success(data, "Thông báo");

                            } else {

                                toastr.warning(data, "Thông báo");

                            }

                        } else {

                            if (data.length == 3)

                                toastr.warning("Hệ thống chỉ cho phép bạn thêm 10 tài khoản", "Thông báo");

                            else

                                toastr.warning("Tài khoản hoặc mật khẩu không chính xác", "Thông báo");

                        }

                    });

                }

            }

        }

    });

}







function hisAcc(uid, name) {

    toastr.warning('Tính năng đang hoàn thiện.', 'Thông báo!');

}



function changepass() {

    bootbox.dialog({

        title: 'Đổi mật khẩu',

        message: '<div class="col-md-12"> ' + '<form class="form-horizontal"> ' + '<div class="form-group"> ' + '<label class="col-md-4 control-label" for="name">Mật khẩu mới</label> ' + '<div class="col-md-4"> ' + '<input id="passfb1" name="name" type="password" placeholder="Mật khẩu mới" class="form-control input-md"> ' + '</div> </div>' + '<div class="form-group"> ' + '<label class="col-md-4 control-label" for="name">Nhập lại</label> ' + '<div class="col-md-4"> ' + '<input id="passfb2" name="pass" type="password" placeholder="Nhập lại" class="form-control input-md"> ' + '</div> </div>' + '</form> </div>',

        buttons: {

            success: {

                label: "Đổi mật khẩu",

                className: "btn-success",

                callback: function() {

                    var passfb1 = $('#passfb1').val();

                    var passfb2 = $('#passfb2').val();

                    if (passfb1 == passfb2 && passfb1.length >= 6) {

                        $.get('changepass.php?pass=' + passfb1, function(data) {

                            if (data.length > 10) {

                                setTimeout(function() {

                                    window.location.href = "logout.php";

                                }, 3000);

                                toastr.success(data);

                            } else {

                                toastr.warning("Access_Token bạn nhập có thể không chính xác.");

                            }

                        });

                    } else {

                        toastr.warning("Nhập lại mật khẩu không đúng hoặc độ dài dưới 6 ký tự");

                    }

                }

            }

        }

    });

}



function getPostid() {

    var t = $('#dtable').DataTable();

    var timebatdau = document.getElementById('timebatdau').value;

    var timeketthuc = document.getElementById('timeketthuc').value;

    var elt = document.getElementById('select01');

    var poster = elt.options[elt.selectedIndex].getAttribute("name");

    if (poster) {

        $.getJSON('lay-ds-bai/' + poster + '/' + timeketthuc + '/' + timebatdau, function(mydata) {

            if (mydata) {

                var dem = 0;

                var myArray = [];

                $.each(mydata, function(index, group) {

                    myArray.push(["<input checked type='checkbox' id='checkbox-" + group + "'>", dem+1, "Đăng bài vào nhóm chưa xát định" , group.postid, group.timeadd]);

                    dem++;

                });

                t.rows.add(myArray).draw();

                updateRange(mydata.length);

            } else {

                alert("Error!");

            };

        });

    } else {

        toastr.error('Có thể bạn chưa chọn tài khoản.', 'Thông báo Lỗi');

    }

}



function getPostidonline() {

    toastr.info('Tính năng đang được hoàn thiện.', 'Thông báo');

}



function fix() {

    toastr.error('Tính năng đang được bảo trì.', 'Thông báo');

}







function checkpoint() {

    setTimeout(function() {

        $.get('checkpoint/' + Math.random(), function(data) {

           if (data == 0) {

                setTimeout(function() {

                    window.location.href = "logout";

                }, 5000);

                toastr.error('Chúng tôi nhận ra tài khoản này vừa mới đăng nhập một nơi khác. Điều này được hệ thống ghi nhận và xử lý.', "Thông báo đăng nhập")

            }

            if(data==3){

                setTimeout(function() {

                    window.location.href = "login-error";

                }, 3000);

                toastr.error('Tài khoản của bạn đã hết bản quyền. Vui lòng liên hệ nhân viên chăm sóc khách hàng.', "Thông báo hết bản quyền")

            }

        });

        checkpoint();

    }, 15000);

}

checkpoint();