<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="js-menu-container" ng-controller="MenuCtrl" ng-cloak>
	<div class="we7-padding-bottom clearfix">
		<div class="pull-right">
			<a class="btn btn-primary we7-padding-horizontal" ng-click="editItemPanel({group : 'frame'})">+新建菜单</a>
		</div>
	</div>
	<div class="panel we7-panel panel-table">
		<div class="panel-heading">
			<div class="table-div table-div-menu">
				<div class="table-div__item order">排序</div>
				<div class="table-div__item name">菜单</div>
				<div class="table-div__item display">开关</div>
				<div class="table-div__item action">操作</div>
			</div>
		</div>
		<div class="panel-body system-menu-list">
			<ul class="one">
				<?php  if(is_array($system_menu)) { foreach($system_menu as $permission_name => $menu) { ?>
				<?php  if($menu['title']!='') { ?>
				<li class="menu-item">
					<div class="table-div table-div-menu">
						<div class="table-div__item order">
							<?php  echo intval($menu['displayorder'])?>
						</div>
						<div class="table-div__item name"><?php  echo $menu['title'];?></div>
						<div class="table-div__item display">
							<?php  if(in_array($permission_name, array('appmarket', 'site', 'myself'))) { ?>
							<span class="color-gray">不可关闭</span>
							<?php  } else { ?>
							<span class="switch" ng-init="displayStatus['<?php  echo $permission_name;?>'] = <?php echo $menu['is_display'] ? 'true' : 'false'?>" ng-click="changeDisplay('<?php  echo $permission_name;?>')" ng-class="{'switchOn' : displayStatus['<?php  echo $permission_name;?>'], 'switchOff' : !displayStatus['<?php  echo $permission_name;?>']}"></span>
							<?php  } ?>
						</div>
						<div class="table-div__item action">
							<div class="link-group">
								<?php  if(empty($menu['is_system'])) { ?>
								<a href="javascript:;" ng-click="removeSubItem('<?php  echo $menu['permission_name'];?>')">删除</a>
								<?php  } ?>
								<a href="javascript:;" ng-click="editMainMenu(<?php  echo intval($menu['displayorder'])?>, '<?php  echo $permission_name;?>')">编辑</a>
								<?php  if(!empty($menu['section'])) { ?>
								<a href="javascript:;" class="toggle"></a>
								<?php  } ?>
							</div>
						</div>
					</div>
					<ul class="two">
						<?php  if(is_array($menu['section'])) { foreach($menu['section'] as $section_name => $section) { ?>
						<li class="menu-item">
							<div class="table-div table-div-menu">
								<div class="table-div__item order">
									<?php  echo intval($section['displayorder'])?>
								</div>
								<div class="table-div__item name"><?php  echo $section['title'];?></div>
								<div class="table-div__item display">
									<?php  if(in_array($section_name, $account_all_type_sign)) { ?>
									<span class="switch" ng-init="displayStatus['<?php  echo $section_name;?>'] = <?php echo $section['is_display'] ? 'true' : 'false'?>" ng-click="changeDisplay('<?php  echo $section_name;?>')" ng-class="{'switchOn' : displayStatus['<?php  echo $section_name;?>'], 'switchOff' : !displayStatus['<?php  echo $section_name;?>']}"></span>
									<?php  } ?>
									<!--<span class="switch switchOn"></span>-->
								</div>
								<div class="table-div__item action">
									<div class="link-group">
										<a href="javascript:;" class="toggle"></a>
									</div>
								</div>
							</div>
							<ul class="three">
								<?php  if(in_array($section_name, $account_all_type_sign)) { ?>
									<?php  $section_menu_two = $section['section']?>
								<?php  } else { ?>
									<?php  $section_menu_two = $section['menu']?>
								<?php  } ?>
								<?php  if(is_array($section_menu_two)) { foreach($section_menu_two as $sub_permission_name => $sub_menu) { ?>

								<?php  if($sub_permission_name == 'wxapp_platform_material') { ?>
									<?php  continue;?>
								<?php  } ?>
								<li class="menu-item ">
									<div class="table-div table-div-menu">
										<div class="table-div__item order">
											<?php  echo intval($sub_menu['displayorder'])?>
										</div>
										<div class="table-div__item name"><?php  echo $sub_menu['title'];?></div>
										<div class="table-div__item display">
											<?php  if($sub_permission_name == 'system_setting_menu') { ?>
											<span class="color-gray">默认开启</span>
											<?php  } else { ?>

											<?php  if(!in_array($section_name, $account_all_type_sign)) { ?>
											<span class="switch" ng-init="displayStatus['<?php  echo $sub_menu['permission_name'];?>'] = <?php echo $sub_menu['is_display'] ? 'true' : 'false'?>" ng-click="changeDisplay('<?php  echo $sub_menu['permission_name'];?>')" ng-class="{'switchOn' : displayStatus['<?php  echo $sub_menu['permission_name'];?>'], 'switchOff' : !displayStatus['<?php  echo $sub_menu['permission_name'];?>']}"></span>
											<?php  } ?>

											<?php  } ?>
										</div>
										<div class="table-div__item action">
											<div class="link-group">
												<?php  if($section_name != 'platform_module') { ?>
												<a href="javascript:;" ng-click="addSubItem('<?php  echo $sub_permission_name;?>', {title : '', displayorder : 0, isDisplay : 1})">+添加子菜单</a>
												<?php  } ?>
												<a href="javascript:;" ng-click="editItemPanel({displayorder: '<?php  echo $sub_menu['displayorder'];?>', title : '<?php  echo $sub_menu['title'];?>', url : '<?php  echo $sub_menu['url'];?>', permissionName : '<?php  echo $sub_menu['permission_name'];?>', isSystem : '<?php  echo $sub_menu['is_system'];?>', id : '<?php  echo $sub_menu['id'];?>', 'group' : '<?php  echo $sub_menu['group'];?>', 'icon' : '<?php  echo $sub_menu['icon'];?>'})">编辑</a>
												<?php  if(empty($sub_menu['is_system'])) { ?><a href="javascript:;" ng-click="removeSubItem('<?php  echo $sub_permission_name;?>')">删除</a><?php  } ?>
												<?php  if(!empty($sub_menu['menu'])) { ?>
												<a href="javascript:;" class="toggle"></a>
												<?php  } ?>
											</div>
										</div>
									</div>
									<ul class="four">
										<?php  if(in_array($section_name, $account_all_type_sign)) { ?>
										<?php  if(is_array($sub_menu['menu'])) { foreach($sub_menu['menu'] as $sub_menu_permission_name => $sub_menu_permission) { ?>
										<li class="menu-item ">
											<div class="table-div table-div-menu">
												<div class="table-div__item order">
													<?php  echo intval($sub_menu_permission['displayorder'])?>
												</div>
												<div class="table-div__item name"><?php  echo $sub_menu_permission['title'];?></div>
												<div class="table-div__item display">
													<?php  if($sub_menu_permission_name == 'system_setting_menu') { ?>
													<span class="color-gray">默认开启</span>
													<?php  } else { ?>
													<span class="switch" ng-init="displayStatus['<?php  echo $sub_menu_permission['permission_name'];?>'] = <?php echo $sub_menu_permission['is_display'] ? 'true' : 'false'?>" ng-click="changeDisplay('<?php  echo $sub_menu_permission['permission_name'];?>')" ng-class="{'switchOn' : displayStatus['<?php  echo $sub_menu_permission['permission_name'];?>'], 'switchOff' : !displayStatus['<?php  echo $sub_menu_permission['permission_name'];?>']}"></span>
													<?php  } ?>
												</div>
												<div class="table-div__item action">
													<div class="link-group">
														<a href="javascript:;" ng-click="editItemPanel({displayorder: '<?php  echo $sub_menu_permission['displayorder'];?>', title : '<?php  echo $sub_menu_permission['title'];?>', url : '<?php  echo $sub_menu_permission['url'];?>', permissionName : '<?php  echo $sub_menu_permission['permission_name'];?>', isSystem : '<?php  echo $sub_menu_permission['is_system'];?>', id : '<?php  echo $sub_menu_permission['id'];?>', 'group' : '<?php  echo $sub_menu_permission['group'];?>', 'icon' : '<?php  echo $sub_menu_permission['icon'];?>'})">编辑</a>
														<?php  if(empty($sub_menu_permission['is_system'])) { ?><a href="javascript:;" ng-click="removeSubItem('<?php  echo $sub_menu_permission['permission_name'];?>')">删除</a><?php  } ?>
														<a href="javascript:;" class="toggle"></a>
													</div>
												</div>
											</div>
										</li>
										<?php  } } ?>
										<?php  } ?>
									</ul>
								</li>
								<?php  } } ?>
							</ul>
						</li>
						<?php  } } ?>
					</ul>
				</li>
				<?php  } ?>
				<?php  } } ?>
			</ul>
		</div>
	</div>
	<script>
		$('.toggle').click(function () {
			$(this).parent().parent().parent().parent().toggleClass('menu-open')
		})
	</script>
	<div class="modal fade bs-example-modal-sm" id="editorder" tabindex="-1" style="z-index:1039" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">编辑菜单</h4>
				</div>
				<form action="" method="post" enctype="multipart/form-data" class="we7-form form" >
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">菜单排序</label>
							<div class="col-sm-10">
								<input type="text"  min="0" ng-model="mainMenu.displayorder" class="form-control">
								<span class="help-block">注：生序排列。数字越小，排名越靠前</span>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<button type="button" class="btn btn-primary" name="submit" value="保存" ng-click="saveorder()">保存</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade bs-example-modal-sm js-edit-panel" id="edit" tabindex="-1" style="z-index:1039" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">编辑菜单</h4>
				</div>
				<form action="" method="post" enctype="multipart/form-data" class="we7-form form" >
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">菜单排序</label>
							<div class="col-sm-10">
								<input type="text" name="displayorder" ng-model="activeItem.displayorder" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">菜单名称</label>
							<div class="col-sm-10">
								<input type="text" name="title" ng-model="activeItem.title" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"> 菜单标识</label>
							<div class="col-sm-10">
								<input type="text" name="permission_name" ng-readonly="activeItem.isSystem == '1'" ng-model="activeItem.permissionName" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"> 菜单链接</label>
							<div class="col-sm-10">
								<input type="text" name="url" ng-readonly="activeItem.isSystem == '1'" ng-model="activeItem.url" class="form-control">
								<span class="help-block">注：支持相对链接。非相对链接请填写以http或https开头的完整链接</span>
							</div>
						</div>
						<div class="form-group" ng-hide="activeItem.isSystem == '1'">
							<label class="col-sm-2 control-label"> 菜单图标</label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" name="icon" value="" ng-model="activeItem.icon" class="form-control">
									<span class="input-group-addon" style="width:35px; border-left:none"><i class="fa fa-external-link"></i></span>
									<span class="input-group-btn"> <a href="javascript:;" class="btn btn-default" ng-click="selectMenuIcon();">&nbsp;选择图标</a></span>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<button type="button" class="btn btn-primary" name="submit" value="保存" ng-click="editItem()">保存</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		angular.bootstrap($('.js-menu-container'), ['systemApp']);
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>