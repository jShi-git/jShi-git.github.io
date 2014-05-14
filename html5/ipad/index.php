<?php 
  $title = "iPad2 simulator - Css3, Jquery and HTML5";
  include_once("../tpl/header.php");
?>

  <link rel="stylesheet" href="style/ipad.css" type="text/css" media="screen"/>
  
  <div id="externalContainer">
        <div id="content_overflow">
            <div id="content" class="hide_spring">
                <div id="window"></div>
                <div id="iframe_holder"></div>
                <div id="black"></div>
                <div class="topbar">
                    <span class="time">--:--</span>
                    <span class="percentage">99%</span>
                </div>
                <div id="general_wrap">
                    <div id="drag" style="left:0">
                        <div id="page0" class="page">
                            <form>
                                <input type="text" id="search" autocomplete=”off” name="app_search"/>
                            </form>
                            <div id="search_result_wrapper">
                                <ul id="search_result"></ul>
                            </div>
                            <div id="tr" class="corner"></div>
                            <div id="tl" class="corner"></div>
                            <div id="br" class="corner"></div>
                            <div id="bl" class="corner"></div>
                            <div id="whiteSep"></div>
                            <div id="noResults">No Results</div>

                        </div>
                        <ul id="page1" class="apps page">
                            <li id="maps" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/maps.jpg')"></div>
                                <span>Maps</span>
                            </li>
                            <li id="Folder" class="app folder">
                                <div class="app_logo">
                                    <ul class="ui-sortable">
                                        <li data-id="Messages" class="app">
                                            <div class="delete">x</div>
                                            <div class="app_logo" style="background:url('apps/messages.jpg')"></div>
                                            <span>Messages</span>
                                        </li>
                                        <li data-id="Weather" class="app">
                                            <div class="delete">x</div>
                                            <div class="app_logo" style="background:url('apps/weather.jpg')"></div>
                                            <span>Weather</span>
                                        </li>
                                        <li data-id="Clock" class="app">
                                            <div class="delete">x</div>
                                            <div class="app_logo" style="background:url('apps/clock.jpg')"></div>
                                            <span>Clock</span>
                                        </li>
                                        <li data-id="Maps" class="app">
                                            <div class="delete">x</div>
                                            <div class="app_logo" style="background:url('apps/maps.jpg')"></div>
                                            <span>Maps</span>
                                        </li>
                                        <li data-id="Notes" class="app">
                                            <div class="delete">x</div>
                                            <div class="app_logo" style="background:url('apps/notes.jpg')"></div>
                                            <span>Notes</span>
                                        </li>
                                        <li data-id="Timezones" class="app">
                                            <div class="delete">x</div>
                                            <div class="app_logo" style="background:url('apps/timezones.jpg')"></div>
                                            <span>Timezones</span>
                                        </li>
                                    </ul>
                                </div>
                                <span>Folder</span>
                            </li>
                            <li id="camera" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/camera.jpg')"></div>
                                <span>camera</span>
                            </li>
                            <li id="photobooth" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/photobooth.jpg')"></div>
                                <span>Photo Booth</span>
                            </li>
                            <li id="facetime" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/facetime.jpg')"></div>
                                <span>facetime</span>
                            </li>
                            <li id="gamecenter" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/gamecenter.jpg')"></div>
                                <span>Game Center</span>
                            </li>
                            <li id="notes" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/notes.jpg')"></div>
                                <span>Notes</span>
                            </li>
                            <li id="photos" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/photos.jpg')"></div>
                                <span>Photos</span>
                            </li>
                            <li id="hnreader" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/hnreader.jpg')"></div>
                                <span>HN reader</span>
                            </li>
                            <li id="weather" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/weather.jpg')"></div>
                                <span>Weather</span>
                            </li>
                        </ul>
                        <ul id="page2" class="apps page">
                            <li id="mail" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/mail.jpg')"></div>
                                <span>Mail</span>
                            </li>
                            <li id="stocks" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/stocks.jpg')"></div>
                                <span>Stocks</span>
                            </li>
                            <li id="maps" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/maps.jpg')"></div>
                                <span>Maps</span>
                            </li>
                            <li id="notes" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/notes.jpg')"></div>
                                <span>Notes</span>
                            </li>
                            <li id="photos" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/photos.jpg')"></div>
                                <span>Photos</span>
                            </li>
                            <li id="imovie" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/imovie.jpg')"></div>
                                <span>iMovie</span>
                            </li>
                        </ul>
                        <ul id="page3" class="apps page">
                            <li id="mail" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/mail.jpg')"></div>
                                <span>Mail</span>
                            </li>
                            <li id="stocks" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/stocks.jpg')"></div>
                                <span>Stocks</span>
                            </li>
                            <li id="maps" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/maps.jpg')"></div>
                                <span>Maps</span>
                            </li>
                            <li id="notes" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/notes.jpg')"></div>
                                <span>Notes</span>
                            </li>
                            <li id="photos" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/photos.jpg')"></div>
                                <span>Photos</span>
                            </li>
                            <li id="imovie" class="app">
                                <div class="delete">x</div>
                                <div class="app_logo" style="background:url('apps/imovie.jpg')"></div>
                                <span>iMovie</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="folder_cont"></div>
                <ul id="pages">
                    <li class="first">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAAJCAYAAADkZNYtAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAKVJREFUeNpi+P//PwMQSwDxfCB+AsRvgXgmEHNC5eCYiYGBgRmItzNAgAMQmwCxEFSMjQEZAHV4APEZNFOYgfgGEIegm6wOxBcYUMFfIL4GxKLIgiDFp4DYHog5kcRBbEsg/o7uDBDeCMR7gdgeiAOB+OR/BJgA8yxMMRsQV0DdfhiIc4DYFRoyIHAeiIUY0IMHDcsB8TGoBg9GsPGEAcgP3wECDACpaMIIrgD3fQAAAABJRU5ErkJggg==" width="11" height="9" />
                    </li>
                    <li class="active">•</li>
                    <li>•</li>
                    <li>•</li>
                </ul>
                <ul id="dock" class="apps">
                    <li id="ipod" class="app">
                        <div class="delete">x</div>
                        <div class="app_logo" style="background:url('apps/ipod.jpg')"></div>
                        <span>iPod</span>
                    </li>
                    <li id="settings" class="app">
                        <div class="delete">x</div>
                        <div class="app_logo" style="background:url('apps/settings.jpg')"></div>
                        <span>Settings</span>
                    </li>
                    <li id="clock" class="app">
                        <div class="delete">x</div>
                        <div class="app_logo" style="background:url('apps/clock.jpg')"></div>
                        <span>Clock</span>
                    </li>
                    <li id="safari" class="app">
                        <div class="delete">x</div>
                        <div class="app_logo" style="background:url('apps/safari.jpg')"></div>
                        <span>Safari</span>
                    </li>
                    <li id="mail" class="app">
                        <div class="delete">x</div>
                        <div class="app_logo" style="background:url('apps/mail.jpg')"></div>
                        <span>Mail</span>
                    </li>
                    <li id="imovie" class="app">
                        <div class="delete">x</div>
                        <div class="app_logo" style="background:url('apps/imovie.jpg')"></div>
                        <span>iMovie</span>
                    </li>
                </ul>

                <div id="lockscreen">
                    <div class="topbar">
                        <img src="apps/lock.png" alt=""/>
                        <span class="percentage">99%</span>
                    </div>
                    <div id="lockscreentime" class="time">--:--</div>
                    <div id="slide_here">
                        <div id="slider"></div>
                        <div id="drop"></div>
                    </div>
                </div>

            </div>
        </div>
        <div id="multitask_bar">
            <ul class="apps"></ul>
        </div>
        <div id="home"></div>
        <div id="sleep"></div>
    </div>

    <script type="text/javascript" src="<?php echo JQUERY; ?>"></script>
    <script src="http://code.jquery.com/ui/1.8.22/jquery-ui.js"></script>
    <script src="js/plugins-ck.js"></script>
    <script src="js/jquery.ui.ipad.js"></script>
    <script src="js/ipad-ck.js"></script>
<?php
include_once("../tpl/footer.php");
?>