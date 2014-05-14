<?php 
  $title = "CSS3 + Jquery模拟 iPhone4s";
  include_once("../tpl/header.php");
?>

  <link rel="stylesheet" type="text/css" href="css/style.css"/>
  
  <div id="simwrapper">

    <div id="vert" class="bounds column-width-ver">

      <div class="simulator">
        <div id="iphone-scrollcontainer">
          <div id="iphone-inside" class="webpage">
            <div id="unlock-top">
              <p id="timepicker" class="time">08:23</p>
              <p id="datepicker" class="date">Wednesday, July 6</p>
            </div>
            <div id="unlock-spacer">&nbsp;</div>
            <div id="unlock-bottom">
              <div id="slide-to-unlock"></div>
              <div id="unlock-slider-wrapper">
                <div id="unlock-slider">
                  <div id="unlock-handle"></div>
                </div>
              </div>
            </div>
          </div>

          <div id="e×ternalContainer">
            <div id="content_overflow">
              <div id="content" class="hide_spring">
                <div id="window"></div>
                <div id="iframe_holder"></div>
                <div id="black"></div>
                <div id="general_wrap">
                  <div id="drag" style="left:0">
                    <div id="page0" class="page">
                      <form>
                        <input type="te×t" id="search" autocomplete=”off” name="app_search"/>
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
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/maps.png')"></div>
                        <span>Maps</span>
                      </li>
                      <li id="Folder2" class="app folder">
                        <div class="app_logo">
                          <ul class="ui-sortable">
                            <li data-id="Messages" class="app">
                              <div class="delete">×</div>
                              <div class="app_logo" style="background:url('apps/messages.png')"></div>
                              <span>Messages</span>
                            </li>
                            <li data-id="Weather" class="app">
                              <div class="delete">×</div>
                              <div class="app_logo" style="background:url('apps/weather.png')"></div>
                              <span>Weather</span>
                            </li>
                            <li data-id="Clock" class="app">
                              <div class="delete">×</div>
                              <div class="app_logo" style="background:url('apps/clock.png')"></div>
                              <span>Clock</span>
                            </li>
                          </ul>
                        </div>
                        <span>Folder</span>
                      </li>
                      <li id="camera" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/camera.png')"></div>
                        <span>camera</span>
                      </li>
                      <li id="photobooth" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/cacl.png')"></div>
                        <span>Photo Booth</span>
                      </li>
                      <li id="youtube" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/youtube.png')"></div>
                        <span>youtube</span>
                      </li>
                      <li id="app" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/app.png')"></div>
                        <span>app</span>
                      </li>
                      <li id="notes" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/notes.png')"></div>
                        <span>Notes</span>
                      </li>
                      <li id="Folder" class="app folder">
                        <div class="app_logo">
                          <ul class="ui-sortable">
                            <li data-id="Messages" class="app">
                              <div class="delete">×</div>
                              <div class="app_logo" style="background:url('apps/messages.png')"></div>
                              <span>Messages</span>
                            </li>
                            <li data-id="Weather" class="app">
                              <div class="delete">×</div>
                              <div class="app_logo" style="background:url('apps/weather.png')"></div>
                              <span>Weather</span>
                            </li>
                            <li data-id="Clock" class="app">
                              <div class="delete">×</div>
                              <div class="app_logo" style="background:url('apps/clock.png')"></div>
                              <span>Clock</span>
                            </li>
                            <li data-id="Maps" class="app">
                              <div class="delete">×</div>
                              <div class="app_logo" style="background:url('apps/maps.png')"></div>
                              <span>Maps</span>
                            </li>
                            <li data-id="Notes" class="app">
                              <div class="delete">×</div>
                              <div class="app_logo" style="background:url('apps/notes.png')"></div>
                              <span>Notes</span>
                            </li>
                            <li data-id="Timezones" class="app">
                              <div class="delete">×</div>
                              <div class="app_logo" style="background:url('apps/cacl.png')"></div>
                              <span>Timezones</span>
                            </li>
                          </ul>
                        </div>
                        <span>Folder</span>
                      </li>
                      <li id="photos" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/photos.png')"></div>
                        <span>Photos</span>
                      </li>
                      <li id="itunes" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/itunes.png')"></div>
                        <span>itunes</span>
                      </li>
                      <li id="weather" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/weather.png')"></div>
                        <span>Weather</span>
                      </li>
                      <li id="calendar" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/calendar.png')"></div>
                        <span>Calendar</span>
                      </li>
                      <li id="message" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/messages.png')"></div>
                        <span>Message</span>
                      </li>
                      <li id="phone" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/phone.png')"></div>
                        <span>Phone</span>
                      </li>
                    </ul>
                    <ul id="page2" class="apps page">
                      <li id="app" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/app.png')"></div>
                        <span>app</span>
                      </li>
                      <li id="notes" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/notes.png')"></div>
                        <span>Notes</span>
                      </li>
                      <li id="photos" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/photos.png')"></div>
                        <span>Photos</span>
                      </li>
                      <li id="itunes" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/itunes.png')"></div>
                        <span>itunes</span>
                      </li>
                      <li id="weather" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/weather.png')"></div>
                        <span>Weather</span>
                      </li>
                      <li id="calendar" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/calendar.png')"></div>
                        <span>Calendar</span>
                      </li>
                      <li id="message" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/messages.png')"></div>
                        <span>Message</span>
                      </li>
                      <li id="phone" class="app">
                        <div class="delete">×</div>
                        <div class="app_logo" style="background:url('apps/phone.png')"></div>
                        <span>Phone</span>
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
                </ul>
                <ul id="dock" class="apps">
                  <li id="ipod" class="app">
                    <div class="delete">×</div>
                    <div class="app_logo" style="background:url('apps/ipod.png')"></div>
                  </li>
                  <li id="settings" class="app">
                    <div class="delete">×</div>
                    <div class="app_logo" style="background:url('apps/settings.png')"></div>
                  </li>
                  <li id="clock" class="app">
                    <div class="delete">×</div>
                    <div class="app_logo" style="background:url('apps/clock.png')"></div>
                  </li>
                  <li id="safari" class="app">
                    <div class="delete">×</div>
                    <div class="app_logo" style="background:url('apps/safari.png')"></div>
                  </li>
                </ul>
              </div>
            </div>

            <div id="multitask_bar">
              <ul class="apps"></ul>
            </div>

          </div>
        </div>

        <div id="home"></div>
        <div id="sleep"></div>
      </div>
    </div>
  </div>
	<script type="text/javascript" src="<?php echo JQUERY; ?>"></script>
  <script src="http://code.jquery.com/ui/1.8.22/jquery-ui.js"></script>
  <script src="js/iphone.min.js"></script>
<?php include_once("../tpl/footer.php"); ?>