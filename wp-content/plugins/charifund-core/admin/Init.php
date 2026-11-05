<?php

namespace IMAddons\Admin;

class Init{
    function __construct(){
        new Enqueue;
        new Menu\Init;
		new Menu\Ajax;
        // new Layouts\Init;
        // new HeaderFooter\Init;
        new Header\Init;
        new Footer\Init;
        new Popup\Init;
    }
}