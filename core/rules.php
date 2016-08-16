<?php
/**
 * Rules set
 */

function signedCheck() {
    global $res; global $db;

    if ($res->user->isSigned()) return true;
    else return false;
}
function rulesCheck($rulName) {
    global $res; global $db;

    if (signedCheck()) {
        if (in_array($res->user->GroupID, $res->rulSet[$rulName]->set) || $res->rulSet[$rulName]->set[0] == '*') {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function guestOnlyCheck($rulName) {
    global $res; global $db;

    if (isset($res->rulSet[$rulName]->guestOnly) && $res->rulSet[$rulName]->guestOnly === true) {
        return true;
    } else {
        return false;
    }
}
function guestGO($rulName) {
    global $res; global $db;
    if (isset($res->rulSet[$rulName]->set) && $res->rulSet[$rulName]->set[0] === 0) {
        return true;
    } else {
        return false;
    }
}
function rulesGo($rulName) {
    global $res; global $db;

    // IF FALSE - You are Guest
    if (signedCheck()) {
        if (rulesCheck($rulName)) {
            return true;
        } else {
            redirect("/serv/false/");
        }
    } else {
        if (guestGO($rulName)) {
            return true;
        } else {
            redirect("/login/");
        }
    }
}

/**
 * Function Rules
 */

$res->rulSet['comStaticPageCtrl']->set = array(0);
$res->rulSet['comArticleOnePageCtrl']->set = array(0);
$res->rulSet['comCategoryOnePageCtrl']->set = array(0);
$res->rulSet['comCategoryListPageCtrl']->set = array(0);
$res->rulSet['comOnlyFilePageCtrl']->set = array(0);
$res->rulSet['comSitemapXMLPageCtrl']->set = array(0);
$res->rulSet['comSitemapPageCtrl']->set = array(0);

$res->rulSet[34]->set = array('*');
$res->rulSet[34]->guestOnly = false;
$res->rulSet['comCoreUserLogout']->set = array('*');
$res->rulSet['comCoreUserLogout']->guestOnly = false;

$res->rulSet['comCoreUserAccessFalse']->set = array(0);

$res->rulSet['comCoreUserAccountPanel']->set = array('*');

$res->rulSet[31]->set = array(0);
$res->rulSet[31]->guestOnly = true;
$res->rulSet['comCoreUserLoginView']->set = array(0);
$res->rulSet['comCoreUserLoginView']->guestOnly = true;

$res->rulSet[32]->set = array(0);
$res->rulSet[32]->guestOnly = true;
$res->rulSet['comCoreUserRegisterView']->set = array(0);
$res->rulSet['comCoreUserRegisterView']->guestOnly = true;

$res->rulSet[33]->set = array(0);
$res->rulSet[33]->guestOnly = true;
$res->rulSet['comCoreUserForgotPassView']->set = array(0);
$res->rulSet['comCoreUserForgotPassView']->guestOnly = true;

$res->rulSet['comCoreUserLogin']->set = array(0);
$res->rulSet['comCoreUserLogin']->guestOnly = true;
$res->rulSet['comCoreUserRegister']->set = array(0);
$res->rulSet['comCoreUserRegister']->guestOnly = true;
$res->rulSet['comCoreUserForgotPass']->set = array(0);
$res->rulSet['comCoreUserForgotPass']->guestOnly = true;


/**
 * Extension Component Rules
 */

// $res