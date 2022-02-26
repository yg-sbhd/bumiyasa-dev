<!-- Page Header Start-->

<div class="page-main-header">

  <div class="main-header-right row m-0">

    <div class="main-header-left">

      <div class="logo-wrapper">

        <!-- <a href="index.html"><img class="img-fluid" src="assets/images/logo/logo.png" alt=""></a> -->

        <a href="#"><img class="img-fluid" src="<?=$base_www?>/library/_images/bumiyasa-logo-colored.svg" alt="BUMIYASA" /></a>

      </div>

    </div>

    

    <div class="toggle-sidebar">

      <i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"></i>

    </div>

    

    <div class="left-menu-header col"></div>

    <div class="nav-right col pull-right right-menu">

      <ul class="nav-menus">

        <!-- </li> -->

        

        <li>

          <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a>

        </li>

        

        <?

        if(isset($_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")])){?>

        <li class="onhover-dropdown p-0">

          <?

          $usr=cmsDB();

          $foto = 'assets/images/dashboard/Profile.jpg';

          $usr->query("select * from ref_user where user_id=".$_SESSION["user_id_" .$ANOM_VARS["app_session_code"] . date("mdY")]);

          if($usr->recordCount()){

            $usr->next();

            $user_name=$usr->row("full_name");

            if(strlen($usr->row("photo"))){

              $foto = $ANOM_VARS["www_file_url"] ."upload_photo/" . $usr->row("photo");

            }



          }else{

            $user_name="Undefined";

          }

          ?>

          <div class="media profile-media">

            <img class="b-r-10" src="<?=$foto?>" style="max-height: 37px;" alt="">

            <div class="media-body">

              <span><?=$user_name?></span>

              <p class="mb-0 font-roboto"><?=$_SESSION["group_name_" .$ANOM_VARS["app_session_code"] . date("mdY")]?> <i class="middle fa fa-angle-down"></i></p>

            </div>

          </div>

          <ul class="profile-dropdown onhover-show-div">

            <!-- <li><i data-feather="user"></i><span>Account </span></li> -->

            <!-- <li><i data-feather="mail"></i><span>Inbox</span></li> -->

            <!-- <li><i data-feather="file-text"></i><span>Taskboard</span></li> -->

            <!-- <li><i data-feather="settings"></i><span>Settings</span></li> -->

            

            <li>

              <a href="index-template.php?tmp=<?=encryptStringArray('templates/chgpwd/index.php');?>&refresh=<?=md5(date("mdYHis"))?>">

                <i data-feather="user"></i><span>Change Password</span>

              </a>

            </li>

            <li>

              <a href="logout.php?ref=<?=md5(date("mdYHis"))?>">

                <i data-feather="log-out"> </i><span>Log Out</span>

              </a>

            </li>

          </ul>

        </li>

        <?}?>

      </ul>

    </div>

    <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>

  </div>