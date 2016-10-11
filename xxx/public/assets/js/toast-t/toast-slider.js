var numaccount = 2;
              $('#slider-range').slider({
                range: true,
                values: [0, 100]
            });
            $("#slider-range-min").slider({
                range: "min",
                value: 60,
                min: 10,
                max: 200,
                slide: function(event, ui) {
                    $("#timerstep").val(ui.value);
                    if (ui.value < 60 && thongbaotime < 1) {
                        thongbaotime++;
                        toastr.warning("Tốc độ an toàn của đăng bài là trên 100 giây và gửi tin là trên 10 giây!", 'Cảnh báo!');
                    }
                    if (ui.value < 10 && thongbaotime < 2) {
                        thongbaotime++;
                        toastr.error("Tốc độ an toàn của đăng bài là trên 100 giây và gửi tin là trên 10 giây!", 'Cảnh báo nguy hiểm!');
                    }
                    $('#slider-range-min .ui-slider-handle:first').html('<div class="tooltip top slider-tip"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + ui.value + '</div></div>');
                }
            });
            if (numaccount == 0)
                toastr.info('Bạn chưa thêm bất cứ tài khoản nào. Vui lòng nhấn vào thêm tài khoản để thêm mới!.')
            var ismobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
            if (!ismobile) {

                /** ONLY EXECUTE THESE CODES IF MOBILE DETECTION IS FALSE **/

                /* REQUIRED: Datatable PDF/Excel output componant */


                document.write('<script src="js/include/ZeroClipboard.min.js"><\/script>');
                document.write('<script src="js/include/TableTools.min.js"><\/script>');
                document.write('<script src="js/include/jquery.uniform.min.js"><\/script>');
                document.write('<script src="js/include/jquery.excanvas.min.js"><\/script>');
                document.write('<script src="js/include/jquery.placeholder.min.js"><\/script>');

                /** DEMO SCRIPTS **/

                /** end DEMO SCRIPTS **/

            } else {

                /** ONLY EXECUTE THESE CODES IF MOBILE DETECTION IS TRUE **/

                document.write('<script src="js/include/selectnav.min.js"><\/script>');
                document.write('<script src="js/include/responsive-tables.min.js"><\/script>');
            }