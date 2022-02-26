<?



function print_menu($parent){

  global $_SESSION,$ANOM_VARS;

  $qchild = cmsDB();

  $trans_db = cmsDB();



  $counter = 0;



  $sql = "select  ref_menu.*, auth_name, tmp from ref_menu inner join ref_authorization on ref_menu.auth_id=ref_authorization.auth_id where ref_menu.parent_id=". $parent ." order by ref_menu.level,ref_menu.menu_id";

  

  $trans_db->query($sql);

    

  while ($trans_db->next()) { 

  

    if(listLen(trim($trans_db->row("url")),"tmp=")==2){

      $url = "index-template.php?tmp=".encryptStringArray(listGetAt(trim($trans_db->row("url")),2,"tmp="));

    }else{

      $url = trim($trans_db->row("url"));

    }

    

    $tmp_ = str_replace('index-template.php?','',$trans_db->row("url"));

    

    if(listFind($_SESSION["auth_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] ,$trans_db->row("auth_id"))){

      $sql = "select menu_id,parent_id,auth_id

        from ref_menu  where parent_id=". $trans_db->row("menu_id")." order by level,menu_id";

      $qchild->query($sql);

      $crchild = $qchild->recordCount();

      

      if($crchild==0){

        // echo "no child";

        $arrow = "arrow";

        if($parent==0){

            // echo "

            // <li style='position:relative;'>

            //    <a href='".$url."'>

            //    <i class=\"".$trans_db->row("class_menu")."\"></i> 

            //    <span class=\"title\">".$trans_db->row("title")."</span>

               

            //    </a>";

          // echo "string";

          echo "

            <li class='dropdown'>

              <a class='nav-link menu-title link-nav' href='".$url."'>

                <i data-feather='".$trans_db->row("class_menu")."'></i><span>".$trans_db->row("title")."</span>

              </a>

            ";

          

        }else{

          if(decryptStringArray(uriParam("tmp"))==$trans_db->row("tmp")){

            // echo "string 2";

            echo "

            <li class='dropdown'>

              <a class='nav-link menu-title link-nav' href='".$url."'>

                <i data-feather='".$trans_db->row("class_menu")."'></i><span> 

                ".$trans_db->row("title")."

              </a>

            </li>";

          }else{

            // echo "string 3";

            echo "

            <li>

              <a href='".$url."'>

                  <i data-feather='".$trans_db->row("class_menu")."'></i><span> 

                  ".$trans_db->row("title")."                

              </a>

            </li>";

          }

          

        }

        print_menu($trans_db->row("menu_id"));

      }else{

        $arrow = "arrow open";

        // echo "string 4" . $trans_db->row("title");
        if($parent <> 0){
          echo "

           <li>

            <a class='submenu-title' href='".$url."'>

              <i data-feather='".$trans_db->row("class_menu")."'></i><span> 

               ".$trans_db->row("title")."

             </a>

             <ul class='nav-sub-childmenu submenu-content'>";

             print_menu($trans_db->row("menu_id"));

           echo "</ul>

          </li>

          ";

        }else{
          echo "

           <li class='dropdown'>

            <a class='nav-link menu-title' href='".$url."'>

              <i data-feather='".$trans_db->row("class_menu")."'></i><span> 

               ".$trans_db->row("title")."

             </a>

             <ul class='nav-submenu menu-content'>";

             print_menu($trans_db->row("menu_id"));

           echo "</ul>

          </li>

          ";  
        }

        

      }

    }

  }

    

}

?>

<header class="main-nav">
  
<div class="logo-wrapper"><a href="index.php?ref=<?=md5(date("mdyHis"))?>"><img class="img-fluid image-main" src="library/_images/bumiyasa-logo-colored.svg" alt=""></a></div>

    <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid image-main-icon" src="library/_images/bumiyasa-logo-colored-1.svg" alt=""></a></div>

    <nav>

            <div class="main-navbar">

              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>

              <div id="mainnav">

                <ul class="nav-menu custom-scrollbar">

                  <li class="back-btn">

                    <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>

                  </li>

                  <li class="dropdown">

                    <a class="nav-link menu-title link-nav" href="index.php?ref=<?=md5(date("mdyHis"))?>"><i data-feather="home"></i><span>Dashboard</span></a>

                    <!-- <ul class="nav-submenu menu-content">

                      <li><a href="index.html">Default</a></li>

                      <li><a href="dashboard-02.html">Ecommerce</a></li>

                    </ul> -->

                  </li>

                    

                  <?print_menu(0);?>

                 

                  

                  <?if($_SESSION["group_id_" .$ANOM_VARS["app_session_code"] . date("mdY")] =="3"){?>

                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:;"><i data-feather="settings"></i><span>Setting</span></a>

                      <ul class="nav-submenu menu-content">

<!--                         <li>

                          <a href="index-template.php?tmp=<?=encryptStringArray('templates/master_group_location/index.php')?>&ref=<?=md5(date("mdyHis"))?>">Master LKPB</a>

                        </li>

 -->

                        <li>

                          <!-- <a href="javascript:get_method('templates/ref_user/index.php?ref=<?=md5(date("mdyHis"))?>')">Users</a> -->

                          <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_user/index.php')?>&ref=<?=md5(date("mdyHis"))?>')"><i data-feather="user-plus"></i>Users</a>

                          

                        </li>



                        <li>

                          <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_usergroup/index.php')?>&ref=<?=md5(date("mdyHis"))?>')"><i data-feather="users"></i> Group Users</a>

                        </li>



                        <li>

                          <a href="index-template.php?tmp=<?=encryptStringArray('templates/ref_groupauth/index.php')?>&ref=<?=md5(date("mdyHis"))?>')""><i data-feather="sliders"></i>Authorization</a>

                        </li>



                        <!-- <li><a href="chart-google.html">Google Chart</a></li> -->

                      </ul>

                    </li>

                  <?}?>



                    

                  <!-- <li class="dropdown"><a class="nav-link menu-title link-nav" href="starter-kit.html" target="_blank"><i data-feather="anchor"></i><span>Starter kit</span></a></li>

 -->

                </ul>

              </div>

              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>

            </div>

          </nav>

        </header>