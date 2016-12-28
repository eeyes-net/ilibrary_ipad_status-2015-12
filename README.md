# iLibrary iPad出借状态

爬取西安交通大学InnoPAC的网页，提取并进行整合iPad的出借状态，并给出统计信息

* 2015年12月21日 v1.0
* 2016年01月01日 v2.0
* 2016年05月17日 v3.0
* 2016年07月13日 v3.1
* 2016年12月28日 v4.0

## 安装

1. 要求`php >= 5.4`，打开curl扩展

2. 解压到服务器目录即可

## 说明

1. 爬取：`http://innopac.lib.xjtu.edu.cn/search~S3*chx?/c//,,,/holdings&b` + `条码`

2. 正则提取取表格中的内容

3. ajax返回json给前端

4. 前端分类并进行展示

目前共爬取5个页面

| 条码 | 页面内包含设备 |
| --- | --- |
| ipad | iPad 1-25,36-40 |
| ipad0083 | iPad 26-35,41-83 |
| mini | iPad mini 1-53 |
| mini0057 | iPad mini 54-57 |
| imac | iMac 共11台 |

## LICENSE

[Apache 2.0](http://www.apache.org/licenses/LICENSE-2.0)
