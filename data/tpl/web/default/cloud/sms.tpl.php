<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
.color-error {
    color: #f15333;
}
.color-warning {
    color: #f2af5a;
}
</style>
<div class="we7-page-title">短信管理</div>
<ul class="we7-page-tab">
    <li class="<?php  if($_GPC['type'] == 'info' || $_GPC['type'] == '') { ?> active <?php  } ?>">
        <a href="<?php  echo url('cloud/sms')?>&type=info">概览</a>
    </li>
    <li class="<?php  if($_GPC['type'] == 'log') { ?> active <?php  } ?>">
        <a href="<?php  echo url('cloud/sms')?>&type=log">发送日志</a>
    </li>
    <li class="<?php  if($_GPC['type'] == 'trade') { ?> active <?php  } ?>">
        <a href="<?php  echo url('cloud/sms')?>&type=trade">购买记录</a>
    </li>
    <li class="<?php  if($_GPC['type'] == 'sign') { ?> active <?php  } ?>">
        <a href="<?php  echo url('cloud/sms')?>&type=sign">购买签名</a>
    </li>
</ul>

<?php  if($_GPC['type'] == 'sign') { ?>
<div class="sms-sign" ng-controller="smsSign" ng-cloak>
    <div class="search-box we7-margin-bottom">
        <div class="search-form"></div>
        <a href="//s.w7.cc/goods-7.html" class="btn btn-primary" target="_blank">购买签名</a>
    </div>
    <table class="table we7-table">
        <tr>
            <th>签名</th>
            <th>状态</th>
            <!-- <th>拒绝原因</th> -->
            <th>时间</th>
            <!-- <th>操作</th> -->
        </tr>
        <tr ng-repeat="smssign in smsSigns">
            <td>{{smssign.sign}}</td>
            <td>
                <span ng-class="smssign.status == -1 ? 'color-error' : (smssign.status == 2 ? 'color-warning' : 'color-green')">{{statusText[smssign.status]}}</span>
                <i title="{{'拒绝原因：' + smssign.refuse_reason}}" data-toggle="tooltip" data-placement="bottom"  ng-show="smssign.status == -1" class="wi wi-info color-error"></i>
            </td>
            <!-- <td>{{smssign.refuse_reason}}</td> -->
            <td>{{smssign.createtime}}</td>
            <!-- <td></td> -->
        </tr>
        <tr ng-if="smsSigns | we7IsEmpty">
            <td colspan="100">
                <div class="text-center">暂无数据</div>
            </td>
        </tr>
    </table>
    <we7-page conf="page2"></we7-page>
</div>
<script>

</script>
<?php  } else if($_GPC['type'] == 'log') { ?>
<div class="sms-logs" ng-controller="smsLogs" ng-cloak>
    <div class="search-box we7-margin-bottom">
        <div class="input-group we7-margin-right nice-select" we7-date-range-picker ng-model="date" ng-change="getList(1)">
            <span class="current">{{date.startDate + '至' + date.endDate}}</span>
        </div>
        <div class="search-form">
            <div class="input-group ">
                <input type="text" ng-model="mobile" class="form-control" placeholder="手机号">
                <span class="input-group-btn" ng-click="getList(1)"><button class="btn btn-default button"><i class="fa fa-search"></i></button></span>
            </div>
        </div>
    </div>
    <table class="table we7-table">
        <tr>
            <th>手机号</th>
            <th>时间</th>
            <th>短信内容</th>
            <th>发送状态</th>
            <!-- <th>日志</th> -->
        </tr>
        <tr ng-repeat="smslog in smslogs">
            <td>{{smslog.send_mobile}}</td>
            <td>{{smslog.createtime}}</td>
            <td>{{smslog.content}}</td>
            <td>
                <span ng-if="smslog.status == 0" class="color-green">发送成功</span>
                <span ng-if="smslog.status != 0" class="color-error">发送失败</span>
            </td>
            <!-- <td>{{smslog.log}}</td> -->
        </tr>
        <tr ng-if="smslogs | we7IsEmpty">
                <td colspan="100">
                    <div class="text-center">暂无数据</div>
                </td>
            </tr>
    </table>
    <we7-page conf="page"></we7-page>
</div>
<?php  } else if($_GPC['type'] == 'trade') { ?>
<div class="sms-trade" ng-controller="smsTrade" ng-cloak>
    <div class="search-box we7-margin-bottom">
        <div class="input-group we7-margin-right nice-select"  we7-date-range-picker ng-model="date" ng-change="getTrade(1)">
            <span class="current">{{date.startDate + '至' + date.endDate}}</span>
        </div>
        <div class="search-form"></div>
        <a href="//s.w7.cc/goods-7.html" class="btn btn-primary" target="_blank">购买短信</a>
    </div>
    <table class="table we7-table">
        <tr>
            <th>短信名称</th>
            <th>交易价格</th>
            <th>购买时间</th>
        </tr>
        <tr ng-repeat="smslog in smslogs">
            <td>{{smslog.title}}</td>
            <td>{{smslog.amount}}</td>
            <td>{{smslog.createtime}}</td>
        </tr>
        <tr ng-if="smslogs | we7IsEmpty">
            <td colspan="100">
                <div class="text-center">暂无数据</div>
            </td>
        </tr>
    </table>
    <we7-page conf="page1"></we7-page>
</div>
<?php  } else { ?>
<div class="form-files-box sms-index" ng-controller="smsIndex" ng-cloak>
    <table class="table we7-table">
        <colgroup>
            <col width="200px">
            <col width="">
        </colgroup>
        <tr>
            <th>短信概览</th>
            <th></th>
            <th>操作</th>
        </tr>
        <tr>
            <td>短信数量</td>
            <td class="color-default">{{smsInfo.sms_count || 0}} 条</td>
            <td class="color-default">
                <div class="link-group">
                    <a href="//s.w7.cc/goods-7.html" target="_blank">购买短信</a>
                    <a href="<?php  echo url('cloud/sms', array('type' => 'log'))?>">发送记录</a>
                </div>
            </td>
        </tr>
        <tr>
            <td>可用签名</td>
            <td class="color-default">
                <span ng-repeat="sign in smsInfo.sms_sign|limitTo:5">【{{sign}}】</span>
                <span ng-if="smsInfo.sms_sign.length > 5">...</span>
            </td>
            <td class="color-default">
                <div class="link-group">
                    <a href="//s.w7.cc/goods-7.html" target="_blank">购买签名</a>
                    <a href="<?php  echo url('cloud/sms', array('type' => 'sign'))?>" target="_blank">更多签名</a>
                </div>
            </td>
        </tr>
    </table>

    <table class="table we7-table">
        <colgroup>
            <col width="200px">
            <col>
            <col width="200px">
        </colgroup>
        <tr>
            <th>短信模板</th>
            <th>模板内容</th>
            <th>短信签名</th>
            <th>操作</th>
        </tr>
        <tr>
            <td>注册/绑定验证码</td>
            <td class="color-gray">您的短信验证码为:[数字] 您正在使用短信验证码相关功能, 需要你进行身份确认【xxx】</td>
            <td>【{{settingSmsSign.register || '涛盛微擎团队'}}】</td>
            <td class="color-default">
                <a href="javascript:;" ng-click="showModal('register')">
                    修改签名
                </a>
            </td>
        </tr>
        <tr>
            <td>找回密码验证码</td>
            <td class="color-gray">您的短信验证码为: [数字] 您正在使用短信验证码相关功能, 需要你进行身份确认【xxx】</td>
            <td>【{{settingSmsSign.find_password || '涛盛微擎团队'}}】</td>
            <td class="color-default">
                <a href="javascript:;" ng-click="showModal('find_password')">
                    修改签名
                </a>
            </td>
        </tr>
        <tr>
            <td>用户过期提醒</td>
            <td class="color-gray">您的用户名[username]即将过期。</td>
            <td>【{{settingSmsSign.user_expire || '涛盛微擎团队'}}】</td>
            <td class="color-default">
                <a href="javascript:;" ng-click="showModal('user_expire')">
                    修改签名
                </a>
            </td>
        </tr>
    </table>
    <div class="modal fade bs-example-modal-sm" id="editSign" tabindex="-1" style="z-index:1039" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog we7-modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">选择短信签名</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group text-right color-default">
                        <a href="//s.w7.cc/goods-7.html" target="_blank">购买签名</a>
                    </div>
                    <div class="form-group">
                        <select ng-model="currentSign">
                            <option value="{{item}}" ng-repeat="item in cloudSmsSigns">{{item}}</option>
                            <option value="">涛盛微擎团队</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="submit" value="保存" ng-click="saveSetting()">确认</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php  } ?>
<script>
    require(['moment'], function() {
        angular.module('smsApp').value('config', {
            apiUrl: "<?php  echo url('cloud/profile/common_api')?>&method=",
            smsSettingUrl: "<?php  echo url('cloud/sms-sign/save_sms_sign')?>",
            cloudSmsSigns: <?php  echo json_encode($cloud_sms_signs)?>,
            settingSmsSign: <?php  echo json_encode($setting_sms_sign)?>,
            smsInfo: <?php  echo json_encode($sms_info)?>,
        });
        angular.bootstrap($('.sms-index'), ['smsApp']);
        angular.bootstrap($('.sms-logs'), ['smsApp']);
        angular.bootstrap($('.sms-sign'), ['smsApp']);
        angular.bootstrap($('.sms-trade'), ['smsApp']);
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>