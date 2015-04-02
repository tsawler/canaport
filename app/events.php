<?php
Event::listen('auth.login', function($user)
{
	ini_set("session.cookie_lifetime","86400"); //an hour
	session_start();
    $_SESSION['KCFINDER']['disabled'] = false;
});