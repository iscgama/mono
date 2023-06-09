<?php
class Nicsx{
	public function _get($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'User-Agent: Mozilla/5.0 (Linux; Android 10; Redmi Note 8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.210 Mobile Safari/537.36'
		));
		$nako = curl_exec($ch);
		curl_close($ch);
		return $nako;
	}
	public function article_generator(){
  		return array(
         'satu' => 'Online slot games are one of the most popular online gambling games and are favored by the people of Indonesia. Especially during the pandemic and a lot of people are WFH from home because during the pandemic the offices are closed so a lot of people feel bored and try to find interesting games on google. One of them is this online slot gambling game, actually not much different from other types of online gambling. Online slots are very popular gambling games throughout 2020-2021 and are still hits and popular. The difference is that online slot gambling is packaged in a practical form and can be played from an Android or iOS cellphone and is also one of the types of games that provide the biggest jackpot bonus.<br><br>

You can find spontaneous elements in online slot gambling from all games on the <a href="https://139.162.43.183/">BALAKENAM88</a> site. You can find various kinds of original slot providers on the slot gambling site <a href="https://139.162.43.183/">BALAKENAM88</a> which we will discuss after this one by one. There are many variations of the games in online slots whose ideas are taken from peoples daily lives so that it is hoped that players will easily understand playing these slot gambling games.<br><br>

If you are a fan of online qq, of course there are several online slot sites that you are familiar with. Or even you have tried to register on several slot sites and choose one of these gambling sites as your favorite. However, if you are still confused, we can introduce some of the most popular and newest online slot gambling site recommendations. Some of these sites are also interesting choices and provide a row of convenience for you to get a slot jackpot bonus that is easy to win and uses real money. So that this one slot gambling game can be enjoyed alone or with your family or office friends.',
         'dua' => '<a href="https://139.162.43.183/">BALAKENAM88</a> is the most trusted and best Indonesian online soccer agent site. As an <a href="https://139.162.43.183/">BALAKENAM88</a> site that has been established for more than 5 years, of course, there is no need to doubt the experience and extensive knowledge in running online soccer betting agents. 24-hour online soccer agent service guarantee is provided <a href="https://139.162.43.183/">BALAKENAM88</a> to help each member in making transactions and helping every difficulty when betting easily and quickly. Thats why <a href="https://139.162.43.183/">BALAKENAM88</a> is currently the top recommendation and the most appropriate choice for online gambling in every 24-hour online soccer agent bet.',
         'tiga' => 'This internet marketing-based site makes its members as media affiliate marketers, as well as publishers and a product being promoted. Your task is to fill out the form prepared to be sent to the company, then you will get the task of submitting product information on your account.<br><br>

Visit the Clickbooth website: https://www.performcb.com/clickbooth/',
         'empat' => 'If you want to win easy online slot games and get the jackpot, all you need to do is find and play slot games on the best Indonesian slot machines. In this way, you have the opportunity to win. Come on! play slot machines with high RTP and choose the right official slot provider and agent. The slots provider that has the largest RTP and slot gambling jackpots so that your chances of winning are even greater.<br><br>

Among them you can choose to play on a pragmatic slot agent gambling site which has become one of the worlds best slot providers. We have provided Pragmatic Slots Online Gambling games with the best quality and favorites for trusted online slot lovers, so of course it will make you happy and give you benefits every time you play bets at this provider and will give you the advantage with the various jackpots you get. Therefore, there is nothing wrong if you enter and register at a slot agent to play trusted slot gambling games so that you can increase the income that can be obtained and enjoyed more easily. It is also guaranteed that you will definitely feel at home when you choose to play slots with this leading gambling agent <a href="https://139.162.43.183/">BALAKENAM88</a>.',
         'lima' => 'If you gamble you deposit capital to bet and when you place a gambling position you lose control of your money entirely, where when you lose all the capital you deposited will disappear, but on the contrary if you win your capital can be doubled.<br>< br>

If you trade you deposit capital to bet, where you alone can determine whether you win or lose.<br><br>

In trading you are in full control of your money, you decide when you want to sell or buy. because even if your trading is a loss, you will not lose all of the capital you deposited in the trade because the losses and profits are calculated based on the difference between the buying and selling prices which is a percentage of capital.',
         'enam' => '<a href="https://139.162.43.183/">BALAKENAM88</a> is the best online slot gambling site in Indonesia so that the satisfaction of playing online casino will be created especially if you join qqstar88 which is one of the online casino 88 agents the best in 2020, of course you will be lucky and spoiled with the various services provided. For members, you will get the latest game from us, namely 1gaming, with a new look and interesting features, as well as a large Indonesian casino jackpot bonus. Other benefits of the Trusted Online Slot Site qqstar88, namely: 1. Easy to play, register anywhere and anytime. 2. Easy and practical transactions. 3. have a demo game that makes it easy for members. 4. Winning must be paid. 5. So many and interesting slot promos',
         'tujuh' => 'Sitting and watching videos can you earn money? I can. You do this by using the Swagbucks site. <br><br>

Swagbucks is a site that rewards points for filling out surveys, watching videos, playing games, and selling affiliate products. These Swagbucks points can later be redeemed in the form of PayPal balances or products on Amazon and Walmart. <br><br>

How to register is also easy. You just need to create an account at Swagbucks then wait for verification and start collecting points. <br><br>

The easiest and most fun way is to watch advertising videos. There are many categories of videos that you can watch, ranging from entertainment, traveling, and much more. <br><br>

Each video of about 2 minutes will get 2 SB. If a day you can collect up to 430 SB or the equivalent of 4 dollars. <br><br>

You can also use the point multiplier feature provided to earn more points. However, if you want to use the feature, you need to pay around 4.99 – 9.99 dollars.'
      );
	}
	public function konten(){
		$title[] = "Pragmatic Online Slot Games";
		$title[] = "Online Football Betting Site";
		$title[] = "Money Making Game Site";
		$title[] = "Online Casino & Slots Apps";
		$title[] = "Similarities and differences between Casino and Trading Apps";
		$title[] = "Trusted Casino Game Site";
		$title[] = "Fast Money Making Site";
		srand ((double) microtime() * 1000000);
  		$random_number = rand(0,count($title)-1);

	  	return ($title[$random_number]);
	}
	public function main(){
		$data = '
<!DOCTYPE html>
<html lang="id">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=0.30, maximum-scale=1.0, user-scalable=0">
      <title>BTS Slot - '.$this->konten().'</title>
      <meta content="BTSSlot merupakan situs judi online terpercaya, casino online dan agen bola SBOBET terpercaya di Indonesia dengan Permainan Judi Slot Online Terlengkap." name="description" />
      <meta content="Judi Slot, Judi Slot Online, Judi Bola, Judi Bola Online, Slot Online, Agen Judi, Agen Judi Online, Agen Slot, Agen Slot Online, Game Slot, Game Slot Online" name="keywords" />
      <meta content="id_ID" property="og:locale" />
      <meta content="website" property="og:type" />
      <meta content="BTS Slot - Slot Online | Judi Online" property="og:title" />
      <meta content="BTSSlot merupakan situs judi online terpercaya, casino online dan agen bola SBOBET terpercaya di Indonesia dengan Permainan Judi Slot Online Terlengkap." property="og:description" />
      <meta content="https://btsslot.id/" property="og:url" />
      <meta content="BTS Slot - Slot Online | Judi Online" property="og:site_name" />
      <meta content="DarkGold" name="theme-color" />
      <meta content="id-ID" name="language" />
      <meta content="ID" name="geo.region" />
      <meta content="Indonesia" name="geo.placename" />
      <meta content="website" name="categories" />
      <meta content="index, follow" name="robots" />
      <link rel="preload" href="https://139.162.43.183/fonts/glyphicons-halflings-regular.woff" as="font" type="font/woff" crossorigin>
      <link rel="preload" href="https://139.162.43.183/fonts/Lato-Regular.woff2" as="font" type="font/woff2" crossorigin>
      <link rel="preload" href="https://139.162.43.183/fonts/lato-bold.woff2" as="font" type="font/woff2" crossorigin>
      <link rel="preload" href="https://139.162.43.183/fonts/Open24DisplaySt.woff2" as="font" type="font/woff2" crossorigin>
      <link href="https://balakenam88.com" rel="canonical" />
      <link href="https://api2-bkn.tr8ngames.com/images/favicon_dc124875-757b-49a7-9aa2-733afd3b2846_1625914236090.png" rel="shortcut icon" type="image/x-icon" />
      <link href="https://139.162.43.183/Content/nexus-beta-desktop-css?v=nUafKvO0XMj4WJsjZtPUYI06TiMxoXWw5i6V_FwPl3s1" rel="stylesheet"/>
      <link href="https://139.162.43.183/Content/Home/nexus-beta-desktop-css?v=QZt5CCBsaq6MG7aD1VUk3oe3wL3pttQ18xwnMWd4EcY1" rel="stylesheet"/>
      <link href="https://139.162.43.183/Content/Theme/nexus-beta-desktop-dark-red-css?v=SA__JBOaklJGrjUQ336YoA-v6XAK7_4eXEXOM4M8E8A1" rel="stylesheet"/>
      <!-- Start of LiveChat (www.livechatinc.com) code -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script>
         window.__lc = window.__lc || {};
         window.__lc.license = 12946659;
         ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You cant use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
      </script>
      <noscript><a href="https://www.livechatinc.com/chat-with/12946659/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
      <!-- End of LiveChat code -->
      <div style="position:fixed;top: 15%; left: -30px;margin-left: 1%;">
         <style type="text/css">
            ul#EmoneyIcon {
            width:auto;
            padding:5px;
            position:fixed;
            bottom: 82px;
            left: 10px;
            z-index:9999;
            color: #fff;
            font-weight: normal;
            font-family: "Roboto", "Arial", sans-serif;
            }
            #EmoneyIcon li {
            cursor:pointer;
            height:62px;
            position:relative;
            list-style-type:none;
            }
            #EmoneyIcon .icon {
            background-color:rgba(217,30,118,.42);
            border-radius:2px;
            display:block;
            color:#ffd200;
            float:none;
            height:62px;
            line-height:62px;
            margin:5px 0;
            position:relative;
            text-align:left;
            text-indent:50px;
            text-shadow:#333 0 1px 0;
            white-space:nowrap;
            width:62px;
            z-index:9999;
            -webkit-transition:width .25s ease-in-out,background-color .25s ease-in-out;
            -moz-transition:width .25s ease-in-out,background-color .25s ease-in-out;
            -o-transition:width .25s ease-in-out,background-color .25s ease-in-out;
            transition:width .25s ease-in-out,background-color .25s ease-in-out;
            -webkit-box-shadow:rgba(0,0,0,.28) 0 2px 3px;
            -moz-box-shadow:rgba(0,0,0,.28) 0 2px 3px;
            -o-box-shadow:rgba(0,0,0,.28) 0 2px 3px;
            box-shadow:rgba(0,0,0,.28) 0 2px 3px;
            text-decoration:none;
            }
            #EmoneyIcon span:hover {
            visibility:hidden;
            }
            #EmoneyIcon span {
            display:block;
            top: 15px;
            position:absolute;
            left: 90px;
            }
            #EmoneyIcon .icon {
            color:#000000;
            overflow:hidden;
            }
            #EmoneyIcon .ovo {
            background:#999 url("https://i.imgur.com/ZnJeMv3.png") 0 0 no-repeat;
            background-color: transparent;
            }
            #EmoneyIcon li:hover .icon {
            width: 168px;
            height: 168px;
            }
            #EmoneyIcon li:hover .icon {
            / background-color:#000; /
            }
            #EmoneyIcon li:hover .ovo{
            background:#999 url(https://1.bp.blogspot.com/-TM1XpirjQo8/XwvP7sDZvbI/AAAAAAAACOk/nNZXG_1Mm-Q-UFVRx9yW8qwefNNKXZRFgCLcBGAsYHQ/s1600/OVO150X150.jpg) 0 0 no-repeat;
            position: relative;
            top: -130px;
            background-color: transparent;
            }
            #EmoneyIcon .icon:active {
            bottom:-2px;
            -webkit-box-shadow:none;
            -moz-box-shadow:none;
            -o-box-shadow: none;
            }
         </style>
         <ul id="EmoneyIcon">
            <li>
               <a href="https://https://1.bp.blogspot.com/-TM1XpirjQo8/XwvP7sDZvbI/AAAAAAAACOk/nNZXG_1Mm-Q-UFVRx9yW8qwefNNKXZRFgCLcBGAsYHQ/s1600/OVO150X150.jpg" class="icon ovo"></a>
            </li>
         </ul>
      </div>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-6KV9D7GPV8"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag("js", new Date());

         gtag("config", "G-6KV9D7GPV8");
      </script>
   </head>
   <body style="--expand-icon-src: url(https://nx-cdn.trgwl.com/Images/icons/expand.gif?v=202012041507);
      --collapse-icon-src: url(https://nx-cdn.trgwl.com/Images/icons/collapse.gif?v=202012041507);
      --play-icon-src: url(https://nx-cdn.trgwl.com/Images/icons/play.png?v=202012041507);
      --jquery-ui-444444-src: url(https://nx-cdn.trgwl.com/Images/jquery-ui/ui-icons_444444_256x240.png?v=202012041507);
      --jquery-ui-555555-src: url(https://nx-cdn.trgwl.com/Images/jquery-ui/ui-icons_555555_256x240.png?v=202012041507);
      --jquery-ui-ffffff-src: url(https://nx-cdn.trgwl.com/Images/jquery-ui/ui-icons_ffffff_256x240.png?v=202012041507);
      --jquery-ui-777620-src: url(https://nx-cdn.trgwl.com/Images/jquery-ui/ui-icons_777620_256x240.png?v=202012041507);
      --jquery-ui-cc0000-src: url(https://nx-cdn.trgwl.com/Images/jquery-ui/ui-icons_cc0000_256x240.png?v=202012041507);
      --jquery-ui-777777-src: url(https://nx-cdn.trgwl.com/Images/jquery-ui/ui-icons_777777_256x240.png?v=202012041507);">
      <div class="navbar navbar-fixed-top">
         <div class="topbar-container">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12 topbar-inner-container">
                     <div class="topbar-left-section">
                        <div class="topbar-item language-selector-container" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/flags.png?v=202012041507);">
                           <div id="language_selector_trigger" data-toggle="dropdown" class="language-selector-trigger" data-language="id">
                              <i data-language="id"></i>
                           </div>
                           <ul class="dropdown-menu language-selector">
                              <li class="language_selector" data-language="en">
                                 <i data-language="en"></i>
                                 BHS INGGRIS
                              </li>
                              <li class="language_selector" data-language="id">
                                 <i data-language="id"></i>
                                 BHS INDONESIA
                              </li>
                           </ul>
                        </div>
                        <div class="topbar-item">
                           <a href="javascript:void(0)" class="js_live_chat_link">
                           <i data-icon="live-chat" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/live-chat.svg?v=202012041507);"></i>
                           Live Chat
                           </a>
                        </div>
                        <div class="topbar-item">
                           <a href="https://139.162.43.183/mobile/home" rel="nofollow">
                           <i data-icon="mobile" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/mobile.svg?v=202012041507);"></i>
                           Versi Mobile
                           </a>
                        </div>
                     </div>
                     <form action="https://139.162.43.183/Account/Login" method="post">
                        <input name="__RequestVerificationToken" type="hidden" value="1jOEnjIZGscZksIAUHqGE7k_haHj85M0trRJ4S2yDDiAO2e7hjFCUdliT-nA1qbyAsrrA516vnqUlkz0ALFLUBl23Iy3XUdWjDrCWOSVQHc1" />    
                        <div class="login-panel">
                           <div class="login-panel-item">
                              <label>
                              <input type="text" name="Username" placeholder="Nama Pengguna" />
                              </label>
                           </div>
                           <div class="login-panel-item">
                              <label>
                              <input type="password" name="Password" placeholder="Kata Sandi" />
                              </label>
                           </div>
                           <div class="login-panel-item">
                              <input type="submit" class="login-button" value="Masuk" />
                           </div>
                           <div class="login-panel-item">
                              <a href="https://139.162.43.183/Register/" class="register-button">
                              Daftar
                              </a>
                           </div>
                           <a href="/#" class="forgot-password-link" data-toggle="modal" data-target="#forgot_password_modal">
                           Lupa Kata Sandi
                           </a>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="site-header">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="site-header-inner-container">
                        <a href="https://139.162.43.183/desktop/home" class="logo">
                        <img src="https://api2-bkn.tr8ngames.com/images/logo_dc124875-757b-49a7-9aa2-733afd3b2846_1625914236090.png" alt="" hidden/>
                        </a>
                        <ul class="top-menu">
                           <li data-active="true">
                              <a href="https://139.162.43.183/desktop/home">
                              Beranda
                              </a>
                           </li>
                           <li data-active="false">
                              <a href="https://139.162.43.183/desktop/hot-games">
                              Hot Games
                              </a>
                              <div class="game-list-container">
                                 <div class="container">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <ul class="games-container">
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/trg.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/trg.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/trg.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/ion-slot">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pgs.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pgs.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pgs.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/onepoker.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/onepoker.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/onepoker.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/g8poker.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/g8poker.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/g8poker.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/pragmatic">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pp.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pp.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pp.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/slot88.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/slot88.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/slot88.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/live22.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/live22.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/live22.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/arcade/giocoplus">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/giocoplus.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/giocoplus.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/giocoplus.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li data-active="false">
                              <a href="/desktop/slots">
                              Slots
                              <i class="glyphicon glyphicon-chevron-down"></i>
                              </a>
                              <div class="game-list-container">
                                 <div class="container">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <ul class="games-container">
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/pragmatic">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pp.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pp.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pp.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/live22.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/live22.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/live22.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/slot88.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/slot88.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/slot88.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/ion-slot">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pgs.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pgs.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pgs.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/pgsoft">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pgsoft.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pgsoft.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pgsoft.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/joker">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/joker.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/joker.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/joker.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/spadegaming.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/spadegaming.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/spadegaming.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/jdb">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/jdb.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/jdb.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/jdb.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/playtech">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/playtech.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/playtech.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/playtech.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/microgaming">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/microgaming.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/microgaming.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/microgaming.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/habanero">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/habanero.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/habanero.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/habanero.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbocq9.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbocq9.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbocq9.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/yggdrasil.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/yggdrasil.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/yggdrasil.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/playngo">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/playngo.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/playngo.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/playngo.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/slots/onetouch">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/onetouch.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/onetouch.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/onetouch.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sborealtimegaming.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sborealtimegaming.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sborealtimegaming.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sboflowgaming.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sboflowgaming.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sboflowgaming.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li data-active="false">
                              <a href="https://139.162.43.183/desktop/casino">
                              Casino
                              <i class="glyphicon glyphicon-chevron-down"></i>
                              </a>
                              <div class="game-list-container">
                                 <div class="container">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <ul class="games-container">
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/trg.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/trg.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/trg.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/prettygaming.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/prettygaming.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/prettygaming.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pplivecasino.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pplivecasino.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/pplivecasino.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/casino/evo-gaming">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/evogaming.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/evogaming.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/evogaming.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ag.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ag.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ag.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbocasino.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbocasino.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbocasino.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbosexybaccarat.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbosexybaccarat.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbosexybaccarat.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/dreamgaming.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/dreamgaming.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/dreamgaming.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/allbet.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/allbet.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/allbet.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li data-active="false">
                              <a href="https://139.162.43.183/desktop/sport">
                              Sports
                              <i class="glyphicon glyphicon-chevron-down"></i>
                              </a>
                              <div class="game-list-container">
                                 <div class="container">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <ul class="games-container">
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/bti.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/bti.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/bti.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbo.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbo.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbo.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbovirtualgames.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbovirtualgames.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbovirtualgames.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ibcsports.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ibcsports.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ibcsports.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li data-active="false">
                              <a href="https://139.162.43.183/desktop/arcade">
                              Arcade
                              <i class="glyphicon glyphicon-chevron-down"></i>
                              </a>
                              <div class="game-list-container">
                                 <div class="container">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <ul class="games-container">
                                             <li>
                                                <a href="https://139.162.43.183/desktop/arcade/pragmatic">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ppfishing.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ppfishing.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ppfishing.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/arcade/giocoplus">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/giocoplus.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/giocoplus.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/giocoplus.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ixttangkas.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ixttangkas.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/ixttangkas.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbofunkygame.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbofunkygame.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbofunkygame.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/arcade/joker">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/jokerfishing.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/jokerfishing.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/jokerfishing.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/arcade/spade-gaming">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/spadegamingfishing.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/spadegamingfishing.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/spadegamingfishing.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/arcade/microgaming">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/microgamingfishing.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/microgamingfishing.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/microgamingfishing.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="https://139.162.43.183/desktop/arcade/cq9">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbocq9fishing.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbocq9fishing.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/sbocq9fishing.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li data-active="false">
                              <a href="https://139.162.43.183/desktop/poker">
                              Poker
                              <i class="glyphicon glyphicon-chevron-down"></i>
                              </a>
                              <div class="game-list-container">
                                 <div class="container">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <ul class="games-container">
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/onepoker.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/onepoker.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/onepoker.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/g8poker.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/g8poker.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/g8poker.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/idn.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/idn.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/idn.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li data-active="false">
                              <a href="https://139.162.43.183/desktop/others">
                              Togel
                              <i class="glyphicon glyphicon-chevron-down"></i>
                              </a>
                              <div class="game-list-container">
                                 <div class="container">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <ul class="games-container">
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/balak4d.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/balak4d.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/balak4d.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });">
                                                   <picture>
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/isin.webp?v=202012041507" type="image/webp" />
                                                      <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/isin.png?v=202012041507" type="image/png" />
                                                      <img loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/providers/shortcuts/isin.png?v=202012041507" />
                                                   </picture>
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li data-active="false">
                              <a href="https://139.162.43.183/desktop/promotion">
                              Promosi
                              </a>
                           </li>
                           <li>
                              <a href="javascript:registerPopup({ content:&#39;Silahkan masuk.&#39; });" rel="nofollow">
                              Live Tv
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="banner">
         <div id="banner_carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
               <li class="active" data-target="#banner_carousel" data-slide-to="0"></li>
            </ol>
            <div class="carousel-inner">
               <div class="item active">
                  <a href="/#" target="_blank">
                  <img loading="lazy" title="DEPOSIT SEKARANG BISA VIA DOMPET DIGITAL &amp; PULSA" src="https://btsslot.id/banner.jpg" alt="DEPOSIT SEKARANG BISA VIA DOMPET DIGITAL &amp; PULSA" />
                  </a>
               </div>
            </div>
         </div>
      </div>
      <div class="announcement-outer-container">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="announcement-container">
                     <div data-section="date">
                        <?php echo date("d/m/Y");?> <?php date("H:i:s");?> (GMT+07)
                        <i data-icon="news" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/home/news.png?v=202012041507);"></i>
                     </div>
                     <div data-section="announcements">
                        <ul class="announcement-list" id="announcement_list">
                           <li>Welcome to BTSSLOT</li>
                           <li>Pemeliharaan Terjadwal: Pretty Gaming pada 2021-07-08 dari 10:00 AM sampai 2025-07-08 11:00 AM (GMT + 7). Selama waktu ini, Pretty Gaming permainan tidak akan tersedia. Kami memohon maaf atas ketidaknyamanan yang mungkin ditimbulkan.</li>
                           <li>Pemeliharaan Terjadwal: AllBet pada 2021-07-26 dari 6:00 AM sampai 12:00 PM (GMT + 7). Selama waktu ini, AllBet permainan tidak akan tersedia. Kami memohon maaf atas ketidaknyamanan yang mungkin ditimbulkan.</li>
                           <li>Pemeliharaan Terjadwal: BTI pada 2021-07-19 dari 10:00 PM sampai 2021-07-27 11:59 AM (GMT + 7). Selama waktu ini, BTI permainan tidak akan tersedia. Kami memohon maaf atas ketidaknyamanan yang mungkin ditimbulkan.</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div data-container-background="home" style="background-image: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/backgrounds/home.jpg?v=202012041507);">
      </div>
      <div class="site-contacts">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <ul class="contact-list">
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <footer class="site-footer">
         <div class="container">
            <div class="row">
               <div class="col-md-8">
                  <ul class="footer-links">
                     <li>
                        <a href="https://139.162.43.183/desktop/contact-us">
                        Hubungi Kami
                        </a>
                     </li>
                     <li>
                        <a href="javascript:openPopup(&#39;/desktop/about-us&#39;, &#39;master&#39;)" rel="nofollow">Tentang BTSSLOT</a>
                     </li>
                     <li>
                        <a href="javascript:openPopup(&#39;/desktop/responsible-gaming&#39;, &#39;master&#39;)" rel="nofollow">Responsible Gambling</a>
                     </li>
                     <li>
                        <a href="javascript:openPopup(&#39;/desktop/faq&#39;, &#39;master&#39;)" rel="nofollow">Pusat Bantuan</a>
                     </li>
                     <li>
                        <a href="javascript:openPopup(&#39;/desktop/terms-of-use&#39;, &#39;master&#39;)" rel="nofollow">Syarat dan Ketentuan</a>
                     </li>
                  </ul>
               </div>
               <div class="col-md-4 copyright">
                  ©2021 BTSSLOT. All rights reserved | 18+
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <hr class="footer-separator" />
                  <div class="site-description">
                     <center><h1 style="color: #820505;">Pragmatic Online Slot Games</h1></center>
                     <p style="color: white;">
                     '.$this->article_generator()['satu'].'
                     </p>
                  </div>
                  <div class="site-description">
                     <center><h1 style="color: #820505;">Online Football Betting Site</h1></center>
                     <p style="color: white;">
                     '.$this->article_generator()['dua'].'
                     </p>
                  </div>
                  <div class="site-description">
                     <center><h1 style="color: #820505;">Money Making Game Site</h1></center>
                     <p style="color: white;">
                     '.$this->article_generator()['tiga'].'
                     </p>
                  </div>
                  <div class="site-description">
                     <center><h1 style="color: #820505;">Online Casino & Slots Apps</h1></center>
                     <p style="color: white;">
                     '.$this->article_generator()['empat'].'
                     </p>
                  </div>
                  <div class="site-description">
                     <center><h1 style="color: #820505;">Similarities and differences between Casino and Trading Apps</h1></center>
                     <p style="color: white;">
                     '.$this->article_generator()['lima'].'
                     </p>
                  </div>
                  <div class="site-description">
                     <center><h1 style="color: #820505;">Trusted Casino Game Site</h1></center>
                     <p style="color: white;">
                     '.$this->article_generator()['enam'].'
                     </p>
                  </div>
                  <div class="site-description">
                     <center><h1 style="color: #820505;">Fast Money Making Site</h1></center>
                     <p style="color: white;">
                     '.$this->article_generator()['tujuh'].'
                     </p>
                  </div>
                  <hr class="footer-separator" />
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="footer-info-container">
                     <div class="site-info">
                        <div class="site-info-title">
                           <i data-icon="service" style="background-image: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/icon-sprite.png?v=202012041507);"></i>
                           <div>
                              <h3>
                                 PELAYANAN
                              </h3>
                              <p>
                                 Keunggulan Pelayanan
                              </p>
                           </div>
                        </div>
                        <div class="site-info-description">
                           <h5>
                              DEPOSIT
                           </h5>
                           <p>
                              Rata-Rata Waktu
                           </p>
                           <div>
                              <div id="deposit_progress" data-average-time="0.00"></div>
                           </div>
                        </div>
                        <div class="site-info-description">
                           <h5>
                              PENARIKAN
                           </h5>
                           <p>
                              Rata-Rata Waktu
                           </p>
                           <div>
                              <div id="withdrawal_progress" data-average-time="5.00"></div>
                           </div>
                        </div>
                        <div class="site-info-description">
                           <p>
                              * Selama bank maintenance dan bank offline deposit dan penarikan tidak dapat diproses
                           </p>
                           <ul class="bank-list">
                              <li data-ztip-title="Senin - Jumat online 00:00-23:00 WIB Sabtu online 00:00-23:00 WIB Minggu online 00:00-23:00 WIB" data-online="true">
                                 <img src="https://api2-bkn.tr8ngames.com/images/BCA_e1bab23f-dda6-4835-b3ce-d5039f28546c_1618547094760.png" />
                              </li>
                              <li data-ztip-title="Senin - Jumat online 00:00-23:00 WIB Sabtu online 00:00-23:00 WIB Minggu online 00:00-23:00 WIB" data-online="true">
                                 <img src="https://api2-bkn.tr8ngames.com/images/BNI_3d30334c-d871-46fb-80b3-0fcb12f99b87_1618547094760.png" />
                              </li>
                              <li data-ztip-title="Senin - Jumat online 00:00-23:00 WIB Sabtu online 00:00-23:00 WIB Minggu online 00:00-23:00 WIB" data-online="true">
                                 <img src="https://api2-bkn.tr8ngames.com/images/BRI_a458ab91-91a3-49ac-98b3-1bfc5d1966bd_1623667417017.png" />
                              </li>
                              <li data-ztip-title="Senin - Jumat online 00:00-00:00 WIB Sabtu online 00:00-00:00 WIB Minggu online 00:00-00:00 WIB" data-online="true">
                                 <img src="https://api2-bkn.tr8ngames.com/images/GOPAY_6d9f75a3-3a2c-4be2-8179-3bbfd755d7cd_1625908275667.png" />
                              </li>
                              <li data-ztip-title="Senin - Jumat online 00:00-23:00 WIB Sabtu online 00:00-23:00 WIB Minggu online 00:00-23:00 WIB" data-online="true">
                                 <img src="https://api2-bkn.tr8ngames.com/images/MANDIRI_ec4427ff-2e6e-4657-a2fe-b3702bc15e7c_1623667471210.png" />
                              </li>
                              <li data-ztip-title="Senin - Jumat online 00:00-00:00 WIB Sabtu online 00:00-00:00 WIB Minggu online 00:00-00:00 WIB" data-online="true">
                                 <img src="https://api2-bkn.tr8ngames.com/images/OVO_ddd6e876-f366-4b0b-a506-d0e8210c55e9_1625908247433.png" />
                              </li>
                              <li data-ztip-title="Senin - Jumat online 00:00-00:00 WIB Sabtu online 00:00-00:00 WIB Minggu online 00:00-00:00 WIB" data-online="true">
                                 <img src="https://api2-bkn.tr8ngames.com/images/TELKOMSEL_708c135d-74c5-482f-9d03-27a5f7035c60_1625908238840.png" />
                              </li>
                              <li data-ztip-title="Senin - Jumat online 00:00-00:00 WIB Sabtu online 00:00-00:00 WIB Minggu online 00:00-00:00 WIB" data-online="true">
                                 <img src="https://api2-bkn.tr8ngames.com/images/XL_ea2a82b1-ca96-4eb1-9a52-cf378c6405e7_1625908229650.png" />
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="site-info">
                        <div class="site-info-title">
                           <i data-icon="product" style="background-image: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/icon-sprite.png?v=202012041507);"></i>
                           <div>
                              <h3>
                                 PRODUK
                              </h3>
                              <p>
                                 Keunggulan Produk
                              </p>
                           </div>
                        </div>
                        <div class="site-info-description with-seperator">
                           <h5>
                              SPORTS BETTING
                           </h5>
                           <p>
                              Sportsbook Gaming Platform Terbaik menawarkan lebih banyak game, odds yang lebih tinggi, dan menyediakan pilihan yang lebih banyak untuk pemain.
                           </p>
                        </div>
                        <div class="site-info-description with-seperator">
                           <h5>
                              LIVE CASINO BETTING
                           </h5>
                           <p>
                              Platform Pilihan bagi perusahaan-perusahaan terbaik di dunia, dengan pilihan variasi game terbanyak
                           </p>
                        </div>
                     </div>
                     <div class="site-info">
                        <div class="site-info-title">
                           <i data-icon="help-and-service" style="background-image: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/icon-sprite.png?v=202012041507);"></i>
                           <div>
                              <h3>
                                 BANTUAN &amp; DUKUNGAN
                              </h3>
                              <p>
                                 Servis Lainnya
                              </p>
                           </div>
                        </div>
                        <div class="site-info-description with-seperator">
                           <h5>
                              TERHUBUNG DENGAN KAMI
                           </h5>
                           <ul class="social-media-list">
                           </ul>
                        </div>
                        <div class="site-info-description with-seperator">
                           <div class="qr-codes">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <hr class="footer-separator" />
            <div class="row">
               <div class="col-md-7">
                  <p class="footer-section-title">
                     Bersertifikasi Dari
                  </p>
                  <ul class="hover-list" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/provider-sprite.png?v=202012041507);">
                     <li>
                        <a href="https://nexusengine.com" target="_blank" rel="nofollow noopener">
                        <i data-icon="nexus-engine"></i>
                        </a>
                     </li>
                  </ul>
               </div>
               <div class="col-md-3">
                  <p class="footer-section-title">
                     Tanggung Jawab Bermain
                  </p>
                  <ul class="hover-list" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/provider-sprite.png?v=202012041507);">
                     <li><i data-icon="problem-gambling-support"></i></li>
                     <li><i data-icon="18+"></i></li>
                  </ul>
               </div>
               <div class="col-md-2 supported-browser-container">
                  <div>
                     <p class="footer-section-title">
                        Browser Yang Didukung
                     </p>
                     <ul class="hover-list" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/provider-sprite.png?v=202012041507);">
                        <li><i data-icon="chrome"></i></li>
                        <li><i data-icon="edge"></i></li>
                        <li><i data-icon="firefox"></i></li>
                     </ul>
                  </div>
               </div>
            </div>
            <hr class="footer-separator" />
            <div class="row">
               <div class="col-md-12">
                  <p class="footer-section-title">
                     Platform Penyedia Layanan
                  </p>
                  <fieldset class="provider-container">
                     <legend>
                        Slots
                     </legend>
                     <ul class="hover-list" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/provider-sprite.png?v=202012041507);">
                        <li><i data-icon="pp"></i></li>
                        <li><i data-icon="playtech"></i></li>
                        <li><i data-icon="joker"></i></li>
                        <li><i data-icon="pgsoft"></i></li>
                        <li><i data-icon="cq9"></i></li>
                        <li><i data-icon="habanero"></i></li>
                        <li><i data-icon="microgaming"></i></li>
                        <li><i data-icon="playngo"></i></li>
                        <li><i data-icon="real-time-gaming"></i></li>
                        <li><i data-icon="flow-gaming"></i></li>
                        <li><i data-icon="spade-gaming"></i></li>
                        <li><i data-icon="1-touch"></i></li>
                        <li><i data-icon="slot88"></i></li>
                        <li><i data-icon="yggdrasil"></i></li>
                        <li><i data-icon="live22"></i></li>
                        <li><i data-icon="ion-slot"></i></li>
                        <li><i data-icon="jdb"></i></li>
                     </ul>
                  </fieldset>
                  <fieldset class="provider-container">
                     <legend>
                        Casino
                     </legend>
                     <ul class="hover-list" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/provider-sprite.png?v=202012041507);">
                        <li><i data-icon="trg"></i></li>
                        <li><i data-icon="sbo-casino"></i></li>
                        <li><i data-icon="ag"></i></li>
                        <li><i data-icon="sexy-baccarat"></i></li>
                        <li><i data-icon="evo-gaming"></i></li>
                        <li><i data-icon="pretty-gaming"></i></li>
                        <li><i data-icon="dream-gaming"></i></li>
                        <li><i data-icon="allbet"></i></li>
                     </ul>
                  </fieldset>
                  <fieldset class="provider-container">
                     <legend>
                        Sports
                     </legend>
                     <ul class="hover-list" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/provider-sprite.png?v=202012041507);">
                        <li><i data-icon="sbo"></i></li>
                        <li><i data-icon="ibc-sports"></i></li>
                        <li><i data-icon="bti"></i></li>
                     </ul>
                  </fieldset>
                  <fieldset class="provider-container">
                     <legend>
                        Arcade
                     </legend>
                     <ul class="hover-list" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/provider-sprite.png?v=202012041507);">
                        <li><i data-icon="giocoplus"></i></li>
                        <li><i data-icon="joker"></i></li>
                        <li><i data-icon="mm-tangkas"></i></li>
                        <li><i data-icon="funky-games"></i></li>
                        <li><i data-icon="cq9"></i></li>
                        <li><i data-icon="microgaming"></i></li>
                        <li><i data-icon="spade-gaming"></i></li>
                        <li><i data-icon="pp"></i></li>
                     </ul>
                  </fieldset>
                  <fieldset class="provider-container">
                     <legend>
                        Poker
                     </legend>
                     <ul class="hover-list" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/provider-sprite.png?v=202012041507);">
                        <li><i data-icon="idn"></i></li>
                        <li><i data-icon="g8-poker"></i></li>
                        <li><i data-icon="1-gaming"></i></li>
                     </ul>
                  </fieldset>
                  <fieldset class="provider-container">
                     <legend>
                        Togel
                     </legend>
                     <ul class="hover-list" style="--image-src: url(https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/provider-sprite.png?v=202012041507);">
                        <li><i data-icon="isin"></i></li>
                        <li><i data-icon="balak-4d"></i></li>
                     </ul>
                  </fieldset>
               </div>
            </div>
         </div>
      </footer>
      <div id="forgot_password_modal" class="modal forgot-password-modal" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title">
                     Lupa Kata Sandi?
                  </h4>
               </div>
               <div class="modal-body">
                  <picture>
                     <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/forgot-password/dice-1.webp?v=202012041507" type="image/webp" />
                     <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/forgot-password/dice-1.png?v=202012041507" type="image/png" />
                     <img class="forgot-password-dice-1" loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/forgot-password/dice-1.png?v=202012041507" />
                  </picture>
                  <picture>
                     <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/forgot-password/dice-2.webp?v=202012041507" type="image/webp" />
                     <source srcset="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/forgot-password/dice-2.png?v=202012041507" type="image/png" />
                     <img class="forgot-password-dice-2" loading="lazy" src="https://nx-cdn.trgwl.com/Images/nexus-beta/dark-red/desktop/layout/forgot-password/dice-2.png?v=202012041507" />
                  </picture>
                  <form action="https://139.162.43.183/Account/ForgotPasswordSubmit" data-ajax="true" data-ajax-begin="onAjaxRequestBegin" data-ajax-complete="onAjaxRequestComplete" data-ajax-method="POST" data-ajax-success="onForgotPasswordAjaxRequestSuccess" id="form0" method="post">
                     <input name="__RequestVerificationToken" type="hidden" value="iuY8tahxnsExcg_EQFusDyXun-n1BOCGfbqJq0vx_SpRnAPd8ZK2oyJlUFFpxfpLcsIwd6OJYt9KzPSZZDBquWKauryQ1WLZIzDq_ffwfok1" />    
                     <div class="form-group">
                        <div class="alert-danger" id="forgot_password_alert"></div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="Username">Nama Pengguna</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input">
                           <input class="form-control" data-val="true" data-val-required="The Username field is required." id="Username" name="Username" placeholder="Nama Pengguna" type="text" value="" />
                           <span class="standard-required-message">Kolom ini tidak boleh kosong.</span>
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="VerificationCode">Kode Verifikasi</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input" class="captcha-input">
                           <input autocomplete="off" class="form-control" data-val="true" data-val-required="The VerificationCode field is required." id="VerificationCode" name="VerificationCode" placeholder="Validasi" type="text" value="" />
                           <span class="standard-required-message">Captcha salah.</span>
                           <div class="captcha-container captcha_container">
                              <i class="glyphicon glyphicon-refresh refresh-captcha-button refresh_captcha_button"></i>
                              <img class="captcha_image" src="https://139.162.43.183/captcha" />
                           </div>
                        </div>
                     </div>
                     <div class="standard-button-group">
                        <input type="submit" class="btn btn-primary" value="Reset Sekarang" />
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div id="register_modal" class="modal register-modal" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title">
                     DAFTAR
                  </h4>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <div class="alert-danger" id="register_alert"></div>
                     <div class="alert-success" id="register_success_alert"></div>
                  </div>
                  <form action="https://139.162.43.183/Register/RegisterSubmit" data-ajax="true" data-ajax-begin="onAjaxRequestBegin" data-ajax-complete="onAjaxRequestComplete" data-ajax-method="POST" data-ajax-success="onRegisterAjaxRequestSuccess" enctype="multipart/form-data" id="form1" method="post">
                     <input name="__RequestVerificationToken" type="hidden" value="6FXz7bZ6VA74GorxOn3wE2FA4JSaGfzM6PufZ7MbJ2sHjjl22bsCRKOK6F4QebjBEHxe4SK-4DnKV4Z0oWN0EyXPCh2MeKAxzVqBZeQTwjU1" />    
                     <div class="standard-inline-form-group">
                        <label for="UserName">Nama Pengguna</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input">
                           <input MaxLength="12" autocomplete="off" class="form-control lowercase" data-val="true" data-val-regex="The field UserName must match the regular expression &#39;^[0-9a-zA-Z]{3,12}$&#39;." data-val-regex-pattern="^[0-9a-zA-Z]{3,12}$" data-val-required="The UserName field is required." id="UserName" name="UserName" placeholder="Nama Pengguna Anda" type="text" value="" />
                           <span class="standard-required-message">
                           Harap masukkan antara 3 - 12 karakter dalam alfanumerik!
                           <br />
                           Nama pengguna tidak boleh memiliki spasi!
                           </span>
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="Password">Kata Sandi</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input" class="standard-password-field">
                           <input MaxLength="20" class="form-control" data-val="true" data-val-regex="The field Password must match the regular expression &#39;^(?=.{8,20}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9]).*$&#39;." data-val-regex-pattern="^(?=.{8,20}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9]).*$" data-val-required="The Password field is required." id="Password" name="Password" placeholder="Kata Sandi Anda" type="password" />
                           <span class="standard-required-message">Password harus terdiri dari 8-20 karakter, dan harus mengandung setidaknya satu huruf besar, satu huruf kecil, dan satu angka.</span>
                           <i class="glyphicon glyphicon-eye-open password_input_trigger"></i>
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="ConfirmedPassword">Ulangi Kata Sandi</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input" class="standard-password-field">
                           <input MaxLength="20" class="form-control" data-val="true" data-val-equalto="&#39;ConfirmedPassword&#39; and &#39;Password&#39; do not match." data-val-equalto-other="*.Password" data-val-required="The ConfirmedPassword field is required." id="ConfirmedPassword" name="ConfirmedPassword" placeholder="Ulangi Kata Sandi Anda" type="password" />
                           <span class="standard-required-message">Konfirmasi kata sandi tidak cocok!</span>
                           <i class="glyphicon glyphicon-eye-open password_input_trigger"></i>
                        </div>
                     </div>
                     <div class="standard-form-note">
                        <span>Catatan:</span><br>*Password harus terdiri dari 8-20 karakter.<br>*Password harus mengandung setidaknya satu huruf besar, satu huruf kecil, dan satu angka. <br>*Password tidak boleh mengandung username.
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="FullName">Nama Lengkap</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input">
                           <input MaxLength="100" autocomplete="off" class="form-control" data-val="true" data-val-regex="The field FullName must match the regular expression &#39;^[a-zA-Z ]*$&#39;." data-val-regex-pattern="^[a-zA-Z ]*$" data-val-required="The FullName field is required." id="FullName" name="FullName" placeholder="Nama Lengkap Anda" type="text" value="" />
                           <span class="standard-required-message">Nama lengkap hanya boleh berisi karakter alfabet.</span>
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="Email">Email</label>
                        <div data-section="input">
                           <input MaxLength="100" autocomplete="off" class="form-control" data-val="true" data-val-email="The Email field is not a valid e-mail address." id="Email" name="Email" placeholder="Email@example.com" type="text" value="" />
                           <span class="standard-required-message">Email salah.</span>
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <div data-section="input">
                           Silakan masukkan email yang aktif untuk tujuan reset kata sandi
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="Phone">No. Kontak</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input" class="copy-input-button-field">
                           <input MaxLength="13" autocomplete="off" class="form-control" data-val="true" data-val-length="The field Phone must be a string with a minimum length of 10 and a maximum length of 13." data-val-length-max="13" data-val-length-min="10" data-val-regex="The field Phone must match the regular expression &#39;^[0-9]+$&#39;." data-val-regex-pattern="^[0-9]+$" data-val-required="The Phone field is required." id="Phone" name="Phone" placeholder="Nomor Telepon Anda" type="text" value="" />
                           <span class="standard-required-message">Nomor Kontak Harus diantara 10 dan 13 digit</span>
                           <button class="copy-input-button" id="copy_phone_button" type="button">
                           <i class="glyphicon glyphicon-file"></i>
                           </button>
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="SelectedBank">Bank</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input">
                           <select class="form-control" data-val="true" data-val-required="The SelectedBank field is required." id="SelectedBank" name="SelectedBank">
                              <option value="">-- Pilih Bank --</option>
                              <option value="e1bab23f-dda6-4835-b3ce-d5039f28546c">BCA</option>
                              <option value="3d30334c-d871-46fb-80b3-0fcb12f99b87">BNI</option>
                              <option value="a458ab91-91a3-49ac-98b3-1bfc5d1966bd">BRI</option>
                              <option value="a54b63b0-4aee-49bc-b65d-21a61dd50e0f">CIMB</option>
                              <option value="ec4427ff-2e6e-4657-a2fe-b3702bc15e7c">MANDIRI</option>
                           </select>
                           <span class="standard-required-message">Bank harus diisi.</span>
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="BankAccountName">Nama Rekening</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input">
                           <input MaxLength="100" autocomplete="off" class="form-control" data-val="true" data-val-regex="The field BankAccountName must match the regular expression &#39;^[a-zA-Z ]*$&#39;." data-val-regex-pattern="^[a-zA-Z ]*$" data-val-required="The BankAccountName field is required." id="BankAccountName" name="BankAccountName" placeholder="Nama lengkap anda sesuai dengan buku tabungan" type="text" value="" />
                           <span class="standard-required-message">Nama rekening bank harus diisi dan hanya boleh berisi karakter alfabet.</span>
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="BankAccountNumber">Nomor Rekening</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input">
                           <input MaxLength="20" autocomplete="off" class="form-control" data-val="true" data-val-regex="The field BankAccountNumber must match the regular expression &#39;^[0-9]+$&#39;." data-val-regex-pattern="^[0-9]+$" data-val-required="The BankAccountNumber field is required." id="BankAccountNumber" name="BankAccountNumber" placeholder="Nomor rekening anda" type="text" value="" />
                           <span class="standard-required-message">Rekening bank harus diisi. (Hanya nomor)</span>
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="ReferrerCode">Kode Referensi</label>
                        <div data-section="input">
                           <input autocomplete="off" class="form-control" id="ReferrerCode" name="ReferrerCode" placeholder="Kode Referensi" type="text" value="" />            
                        </div>
                     </div>
                     <div class="standard-inline-form-group">
                        <label for="VerificationCode">Kode Verifikasi</label>
                        <div data-section="asterisk">*</div>
                        <div data-section="input" class="captcha-input">
                           <input autocomplete="off" class="form-control" data-val="true" data-val-required="The VerificationCode field is required." id="register_verification_code" name="VerificationCode" placeholder="Validasi" type="text" value="" />
                           <span class="standard-required-message">Silakan masukkan captcha!</span>
                           <div class="captcha-container captcha_container">
                              <i class="glyphicon glyphicon-refresh refresh-captcha-button refresh_captcha_button"></i>
                              <img class="captcha_image" src="https://139.162.43.183/captcha" />
                           </div>
                        </div>
                     </div>
                     <input data-val="true" data-val-required="The FullName field is required." id="Setup_FullName" name="Setup.FullName" type="hidden" value="True" /><input data-val="true" data-val-required="The Email field is required." id="Setup_Email" name="Setup.Email" type="hidden" value="False" /><input data-val="true" data-val-required="The Birthday field is required." id="Setup_Birthday" name="Setup.Birthday" type="hidden" value="False" /><input data-val="true" data-val-required="The Address field is required." id="Setup_Address" name="Setup.Address" type="hidden" value="False" /><input data-val="true" data-val-required="The Phone field is required." id="Setup_Phone" name="Setup.Phone" type="hidden" value="True" /><input data-val="true" data-val-required="The Bank field is required." id="Setup_Bank" name="Setup.Bank" type="hidden" value="True" /><input data-val="true" data-val-required="The Identity field is required." id="Setup_Identity" name="Setup.Identity" type="hidden" value="False" /><input data-val="true" data-val-required="The Country field is required." id="Setup_Country" name="Setup.Country" type="hidden" value="False" /><input data-val="true" data-val-required="The SourceInformation field is required." id="Setup_SourceInformation" name="Setup.SourceInformation" type="hidden" value="False" /><input id="ReferrerType" name="ReferrerType" type="hidden" value="Referral" />    
                     <div class="standard-button-group">
                        <input type="submit" class="btn btn-primary" value="Daftar" />
                     </div>
                  </form>
                  <div class="register-page-reminder">
                     Dengan meng-klik tombol DAFTAR, saya menyatakan bahwa saya berumur diatas 18 tahun dan telah membaca dan menyetujui syarat &amp; ketentuan BTSSLOT.
                  </div>
                  <div class="register-page-link">
                     <a href="javascript:window.openPopup("https://139.162.43.183/desktop/terms-of-use","T&C-Page")">
                     SYARAT &amp; KETENTUAN
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="https://139.162.43.183/bundles/nexus-beta-desktop-js?v=s-heHOABmhCr3MTzT3yWjQ4J1_6lfi4MDDjkixZHKE41" defer></script>
      <script>
         window.addEventListener("DOMContentLoaded", () => {
             initializeRegisterInfo({
                 translations: {
                     copied: "Disalin"
                 }
             });
         
             $("#forgot_password_modal, #register_modal").on("show.bs.modal", function (e) {
                 const refreshCaptchaButton = this.querySelector(".refresh_captcha_button");
         
                 refreshCaptchaButton.click();
             });
         
             if (window.location.search.startsWith("?register")) {
                 $("#register_modal").modal();
                 $("#popup_modal").modal("hide");
             }
         });
      </script>
      <script src="https://139.162.43.183/bundles/Home/desktop-js?v=Sej0X2A3mENIdCkQf4pg5cLwYm0ddYSBEpsTaCKaF-I1" defer></script>
      <template id="live_chat_template">
         <!-- Start of LiveChat (www.livechatinc.com) code -->
         <script>
            window.__lc = window.__lc || {};
            window.__lc.license = 12946659;
            ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You cant use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
         </script>
         <noscript><a href="https://www.livechatinc.com/chat-with/12946659/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
         <!-- End of LiveChat code -->
         <div style="position:fixed;top: 15%; left: -30px;margin-left: 1%;">
            <style type="text/css">
               ul#EmoneyIcon {
               width:auto;
               padding:5px;
               position:fixed;
               bottom: 82px;
               left: 10px;
               z-index:9999;
               color: #fff;
               font-weight: normal;
               font-family: "Roboto", "Arial", sans-serif;
               }
               #EmoneyIcon li {
               cursor:pointer;
               height:62px;
               position:relative;
               list-style-type:none;
               }
               #EmoneyIcon .icon {
               background-color:rgba(217,30,118,.42);
               border-radius:2px;
               display:block;
               color:#ffd200;
               float:none;
               height:62px;
               line-height:62px;
               margin:5px 0;
               position:relative;
               text-align:left;
               text-indent:50px;
               text-shadow:#333 0 1px 0;
               white-space:nowrap;
               width:62px;
               z-index:9999;
               -webkit-transition:width .25s ease-in-out,background-color .25s ease-in-out;
               -moz-transition:width .25s ease-in-out,background-color .25s ease-in-out;
               -o-transition:width .25s ease-in-out,background-color .25s ease-in-out;
               transition:width .25s ease-in-out,background-color .25s ease-in-out;
               -webkit-box-shadow:rgba(0,0,0,.28) 0 2px 3px;
               -moz-box-shadow:rgba(0,0,0,.28) 0 2px 3px;
               -o-box-shadow:rgba(0,0,0,.28) 0 2px 3px;
               box-shadow:rgba(0,0,0,.28) 0 2px 3px;
               text-decoration:none;
               }
               #EmoneyIcon span:hover {
               visibility:hidden;
               }
               #EmoneyIcon span {
               display:block;
               top: 15px;
               position:absolute;
               left: 90px;
               }
               #EmoneyIcon .icon {
               color:#000000;
               overflow:hidden;
               }
               #EmoneyIcon .ovo {
               background:#999 url("https://i.imgur.com/ZnJeMv3.png") 0 0 no-repeat;
               background-color: transparent;
               }
               #EmoneyIcon li:hover .icon {
               width: 168px;
               height: 168px;
               }
               #EmoneyIcon li:hover .icon {
               / background-color:#000; /
               }
               #EmoneyIcon li:hover .ovo{
               background:#999 url(https://1.bp.blogspot.com/-TM1XpirjQo8/XwvP7sDZvbI/AAAAAAAACOk/nNZXG_1Mm-Q-UFVRx9yW8qwefNNKXZRFgCLcBGAsYHQ/s1600/OVO150X150.jpg) 0 0 no-repeat;
               position: relative;
               top: -130px;
               background-color: transparent;
               }
               #EmoneyIcon .icon:active {
               bottom:-2px;
               -webkit-box-shadow:none;
               -moz-box-shadow:none;
               -o-box-shadow: none;
               }
            </style>
            <ul id="EmoneyIcon">
               <li>
                  <a href="https://https://1.bp.blogspot.com/-TM1XpirjQo8/XwvP7sDZvbI/AAAAAAAACOk/nNZXG_1Mm-Q-UFVRx9yW8qwefNNKXZRFgCLcBGAsYHQ/s1600/OVO150X150.jpg" class="icon ovo"></a>
               </li>
            </ul>
         </div>
      </template>
      <script>
         window.addEventListener("DOMContentLoaded", () => {
             const template = document.querySelector("#live_chat_template");
         
             document.body.append(template.content.cloneNode(true));
         });
      </script>
   </body>
</html>';
		file_put_contents('index.php', $data);
	}
}
$core = new Nicsx;
$core->main();