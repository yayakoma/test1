<html>

<head>
    <title>RÚT LÌ XÌ 2021</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, maximum-scale=1.0">
    <link type="icon/x-icon" href="favicon.ico" rel="shortcut icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <iframe src="https://www.nhaccuatui.com/mh/background/KTpIOEABzL" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
    <script type='text/javascript'>
        //<![CDATA[
        var pictureSrc = "hoamai.png"; //Link ảnh hoa muốn hiển thị trên web
        var pictureWidth = 10; //Chiều rộng của hoa mai or đào
        var pictureHeight = 10; //Chiều cao của hoa mai or đào
        var numFlakes = 10; //Số bông hoa xuất hiện cùng một lúc trên trang web
        var downSpeed = 0.01; //Tốc độ rơi của hoa
        var lrFlakes = 10; //Tốc độ các bông hoa giao động từ bên trai sang bên phải và ngược lại


        if (typeof(numFlakes) != 'number' || Math.round(numFlakes) != numFlakes || numFlakes < 1) {
            numFlakes = 10;
        }

        //draw the snowflakes
        for (var x = 0; x < numFlakes; x++) {
            if (document.layers) { //releave NS4 bug
                document.write('<layer id="snFlkDiv' + x + '"><imgsrc="' + pictureSrc + '" height="' + pictureHeight + '"width="' + pictureWidth + '" alt="*" border="0"></layer>');
            } else {
                document.write('<div style="position:absolute; z-index:9999;"id="snFlkDiv' + x + '"><img src="' + pictureSrc + '"height="' + pictureHeight + '" width="' + pictureWidth + '" alt="*"border="0"></div>');
            }
        }

        //calculate initial positions (in portions of browser window size)
        var xcoords = new Array(),
            ycoords = new Array(),
            snFlkTemp;
        for (var x = 0; x < numFlakes; x++) {
            xcoords[x] = (x + 1) / (numFlakes + 1);
            do {
                snFlkTemp = Math.round((numFlakes - 1) * Math.random());
            } while (typeof(ycoords[snFlkTemp]) == 'number');
            ycoords[snFlkTemp] = x / numFlakes;
        }

        //now animate
        function flakeFall() {
            if (!getRefToDivNest('snFlkDiv0')) {
                return;
            }
            var scrWidth = 0,
                scrHeight = 0,
                scrollHeight = 0,
                scrollWidth = 0;
            //find screen settings for all variations. doing this every time allows for resizing and scrolling
            if (typeof(window.innerWidth) == 'number') {
                scrWidth = window.innerWidth;
                scrHeight = window.innerHeight;
            } else {
                if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
                    scrWidth = document.documentElement.clientWidth;
                    scrHeight = document.documentElement.clientHeight;
                } else {
                    if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
                        scrWidth = document.body.clientWidth;
                        scrHeight = document.body.clientHeight;
                    }
                }
            }
            if (typeof(window.pageYOffset) == 'number') {
                scrollHeight = pageYOffset;
                scrollWidth = pageXOffset;
            } else {
                if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
                    scrollHeight = document.body.scrollTop;
                    scrollWidth = document.body.scrollLeft;
                } else {
                    if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
                        scrollHeight = document.documentElement.scrollTop;
                        scrollWidth = document.documentElement.scrollLeft;
                    }
                }
            }
            //move the snowflakes to their new position
            for (var x = 0; x < numFlakes; x++) {
                if (ycoords[x] * scrHeight > scrHeight - pictureHeight) {
                    ycoords[x] = 0;
                }
                var divRef = getRefToDivNest('snFlkDiv' + x);
                if (!divRef) {
                    return;
                }
                if (divRef.style) {
                    divRef = divRef.style;
                }
                var oPix = document.childNodes ? 'px' : 0;
                divRef.top = (Math.round(ycoords[x] * scrHeight) + scrollHeight) + oPix;
                divRef.left = (Math.round(((xcoords[x] * scrWidth) - (pictureWidth / 2)) + ((scrWidth / ((numFlakes + 1) * 4)) * (Math.sin(lrFlakes * ycoords[x]) - Math.sin(3 * lrFlakes * ycoords[x])))) + scrollWidth) + oPix;
                ycoords[x] += downSpeed;
            }
        }

        //DHTML handlers
        function getRefToDivNest(divName) {
            if (document.layers) {
                return document.layers[divName];
            } //NS4
            if (document[divName]) {
                return document[divName];
            } //NS4 also
            if (document.getElementById) {
                return document.getElementById(divName);
            } //DOM (IE5+, NS6+, Mozilla0.9+, Opera)
            if (document.all) {
                return document.all[divName];
            } //Proprietary DOM - IE4
            return false;
        }

        window.setInterval('flakeFall();', 100);
        //]]>
    </script>
</head>

<body style="background: #D64937;">
    <style type="text/css">
        .flip-box-inner {
            position: relative;
            width: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .flip-box-inner-flip {
            transform: rotateY(180deg);
        }

        .flip-box-front {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            top: 0;
            left: 15;
        }

        .transparent {
            opacity: 0 !important;
        }

        .flip-card {
            background-color: transparent;
            width: 100%;
            height: 300px;
            perspective: 1000px;
        }

        .flip-card:hover {
            animation-name: spaceboots;
            animation-duration: .8s;
            transform-origin: 50% 50%;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
            cursor: pointer;
        }


        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        .flip-card-front {
            color: black;
        }

        .flip-card-back {
            color: transparent;
            transform: rotateY(180deg);
        }

        .flip-box-inner {
            transition: 0.6s;
            transform-style: preserve-3d;
            position: relative;
        }

        .flipimg {}

        .flip-box-inner img {
            backface-visibility: hidden;
        }
    </style>

    <img style="width:550px;position:fixed;z-index:9999;bottom:0px;left:0px" src="bottom.png" />
    <center><img id="upthe" style="width:400px;height: 300px;" src="lixi.jpg"></center>
    <div class="row">

        <div class="latthe col-md-3">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img data-inner="inner0" style="width:360px;" class="flip-box-front imgqua inner0" src="50k.png">
                    </div>
                    <br /><br /><br />
                    <div class="flip-card-back">
                        <img class='imgnen' style="width:210px;" src="nen.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="latthe col-md-3">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img data-inner="inner1" style="width:360px;" class="flip-box-front imgqua inner1" src="10k.png">
                    </div>
                    <br /><br /><br />
                    <div class="flip-card-back">
                        <img class='imgnen' style="width:210px;" src="nen.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="latthe col-md-3">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img data-inner="inner2" style="width:360px;" class="flip-box-front imgqua inner2" src="200k.png">
                    </div>
                    <br /><br /><br />
                    <div class="flip-card-back">
                        <img class='imgnen' style="width:210px;" src="nen.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="latthe col-md-3">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img data-inner="inner3" style="width:360px;" class="flip-box-front imgqua inner3" src="100k.png">
                    </div>
                    <br /><br /><br />
                    <div class="flip-card-back">
                        <img class='imgnen' style="width:210px;" src="nen.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="latthe col-md-3">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img data-inner="inner4" style="width:360px;" class="flip-box-front imgqua inner4" src="500k.png">
                    </div>
                    <br /><br /><br />
                    <div class="flip-card-back">
                        <img class='imgnen' style="width:210px;" src="nen.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="latthe col-md-3">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img data-inner="inner4" style="width:360px;" class="flip-box-front imgqua inner4" src="20k.png">
                    </div>
                    <br /><br /><br />
                    <div class="flip-card-back">
                        <img class='imgnen' style="width:210px;" src="nen.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="latthe col-md-3">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img data-inner="inner5" style="width:360px;" class="flip-box-front imgqua inner5" src="50k.png">
                    </div>
                    <br /><br /><br />
                    <div class="flip-card-back">
                        <img class='imgnen' style="width:210px;" src="nen.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="latthe col-md-3">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img data-inner="inner6" style="width:360px;" class="flip-box-front imgqua inner6" src="100k.png">
                    </div>
                    <br /><br /><br />
                    <div class="flip-card-back">
                        <img class='imgnen' style="width:210px;" src="nen.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .
    </style>
    <script>
        $(document).ready(function() {
            $('#upthe').click(function() {
                $('.flip-card-inner').css('transform', 'rotateY(180deg)');
                setTimeout(function() {
                    $('.imgqua').hide();
                }, 300);
            });
            $('.imgnen').click(function() {
                self = $(this);
                $.ajax({
                    type: 'POST',
                    data: {
                        type: 'test'
                    },
                    url: 'latthe.php',
                    success: function(result) {
                        json = JSON.parse(result);
                        img = json.img;
                        $(self.parent()).parent().find('.imgqua').attr('src', img);
                        $(self.parent()).parent().css('transform', 'none');
                        $(self.parent()).parent().find('.imgqua').show();
                        self.parent().find('.imgnen').hide();

                        setTimeout(function() {
                            $('.imgqua').show();
                            $('.flip-card-inner').css('transform', 'none');
                            $('.imgnen').hide();
                            $('#upthe').show();
                        }, 1000);
                        setTimeout(function() {
                            swal("Thông Báo!", json.msg, "success");
                            $("*").click(function() {
                                window.location.reload();
                            });
                        }, 2000);
                    }
                })
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>