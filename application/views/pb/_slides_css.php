<?php function css_section(){ ?>
 <style>
    body {
      -webkit-font-smoothing: antialiased;
      font: normal 15px/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
      color: #232525;
      padding-top:70px;
    }

    #slides {
      display: none;
      position:relative;
    }

    #slides .slidesjs-navigation {
      margin-top:3px;
      display:none;
    }

    #slides:hover .slidesjs-navigation{
      display:block;
    }

    #slides .slidesjs-previous {
      margin-right: 5px;
      /*float: left; */
      position:absolute;
      top:120px;
      z-index:100;
    }

    #slides .slidesjs-next {
      margin-right: 5px;
      position:absolute;
      top:120px;
      right:0px;
      z-index:100;
    }

    .slidesjs-pagination {
      margin: 6px 0 0;
      float: right;
      list-style: none;
    }

    .slidesjs-pagination li {
      float: left;
      margin: 0 1px;
    }

    .slidesjs-pagination li a {
      display: block;
      width: 13px;
      height: 0;
      padding-top: 13px;
/*      background-image: url(/img/pagination.png);*/      background-position: 0 0;
      float: left;
      overflow: hidden;
    }

    .slidesjs-pagination li a.active,
    .slidesjs-pagination li a:hover.active {
      background-position: 0 -13px
    }

    .slidesjs-pagination li a:hover {
      background-position: 0 -26px
    }

    #slides a:link,
    #slides a:visited {
      color: #333
    }

    #slides a:hover,
    #slides a:active {
      color: #9e2020
    }

    .navbar {
      overflow: hidden
    }

    .slidesjs-play,.slidesjs-stop{
      display:none !important;
    }
  </style>
<?php } ?>