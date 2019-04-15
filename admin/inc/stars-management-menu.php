<?php
error_reporting(1);
$UID = $_SESSION['UID'];
$MenuUrl = $_SERVER['REQUEST_URI'];
$uri = trim(strtok($MenuUrl, '?'));

$CanVIEW="";
$CanCREATE="";
$CanUPDATE="";
$CanDELETE=""; 
$moduleactive='';
$CanAPPROVE='';
$pageactive='';
$CanReceive='';
$CanDispatch='';
$canReject=''; 
$modid="";

//Get variables and access rights
$pagename= str_replace('.php', '', basename($_SERVER['PHP_SELF']));
$Getpagename= str_replace('.php', '', basename($_SERVER['PHP_SELF']));
$menu_id='';
$menu_id=$common->CCGetDBValue("SELECT id FROM tbl_modules_pages_access WHERE url='".$pagename."'");

if(empty($menu_id) )
	{
		$moduleactive=$common->CCGetDBValue("SELECT m_active FROM tbl_sys_module_child WHERE url='".$pagename."'");
		$modid=$common->CCGetDBValue("SELECT id FROM tbl_sys_module_child WHERE url='".$pagename."'");
		$ss="SELECT * FROM tbl_pages_actions WHERE mod_id='".$modid."' AND userID = '{$UID}' ";
		$qq=$common->GetRows($ss);
		foreach( $qq as $R)
		{
			$CanVIEW=$R["canView"];
			$CanCREATE=$R["canCreate"];
			$CanUPDATE=$R["canUpdate"];
			$CanDELETE=$R["canDelete"];
			$CanAPPROVE=$R["canApprove"];
			$CanReceive=$R["canReceive"];
			$CanDispatch=$R["canDispatch"];
			$canReject=$R["canReject"]; 
			$approvalLevel=$R["approvalLevel"]; 
		}
	}	
else if(!empty($menu_id))
	{
		$moduleactive=$common->CCGetDBValue("SELECT c.m_active FROM tbl_sys_module_child c LEFT JOIN tbl_modules_pages_access p on c.id=p.par_id WHERE p.url='".$pagename."'");

		$pageactive=$common->CCGetDBValue("SELECT m_active FROM tbl_modules_pages_access WHERE url='".$pagename."'");
		$ss="SELECT * FROM tbl_pages_actions WHERE par_id = '{$menu_id}' AND userID = '{$UID}'  ";
		$qq=$common->GetRows($ss) ;
		foreach($qq as $R)
			{
				$CanVIEW=$R["canView"];
				$CanCREATE=$R["canCreate"];
				$CanUPDATE=$R["canUpdate"];
				$CanDELETE=$R["canDelete"];
				$CanAPPROVE=$R["canApprove"];
				$CanReceive=$R["canReceive"];
				$CanDispatch=$R["canDispatch"];
				$canReject=$R["canReject"]; 
				$approvalLevel=$R["approvalLevel"]; 
			}
	}
?>
<section class="sidebar">
  <!-- Sidebar user panel -->  
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">
    <center>
      <?php echo $SystemName; ?></li>
    </center>
    <?php
		//Displaying the Menus
		foreach($common->GetRows("SELECT * FROM tbl_sys_module_child WHERE par_id=2 AND group_access LIKE  '%".$_SESSION['GrpID']."%'  AND isActive=1 ORDER BY display_id ASC ;") as $menu)
		{
			$active=($moduleactive==$menu["m_active"]) ? 'active' : '';
			$treeview=($menu["url"]=='#') ? 'treeview' : '';		
	?>
    <li class=" <?php echo $treeview.' '.$active; ?>">
      <a href="<?php echo $menu["url"]; ?>">
        <?php echo $menu["linkicon"]; ?>  <span><?php echo $menu["name"]; ?></span>
		<i class="fa fa-angle-left pull-right"></i>
      </a>
		<?php
			if($menu["url"]=='#')
			{
				?>
				<ul class="treeview-menu">
				<?php
				foreach($common->GetRows("SELECT * FROM tbl_modules_pages_access WHERE par_id='".$menu["id"]."' and isActive=1 AND group_access LIKE  '%".$_SESSION['GrpID']."%'  ORDER BY display_id ASC ;") as $P)
				{
					$pgactive=($pageactive==$P["m_active"]) ? 'active' : '';
					?>
						 <li class="<?php echo $pgactive; ?>"><a href='<?php echo $P["url"];?>'><?php echo $P["mIconWebApp"]; ?> <?php echo $P["name"]; ?></a></li>
					<?php
				} ?>
				</ul>
				<?php
			}
		?>
    </li>
	<?php }?>
  </ul>
</section>
<script>
function goBack() {
    window.history.back();
}
</script>