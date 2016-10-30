[返回](main.md)


***

### 1. choose_char

###### 说明：`选择用户角色`

###### 接口地址：`app/my/choose_char`

###### 传入参数：

无

###### 返回参数：

无



***

### 1. change_u_info

###### 说明：`修改用户信息`

###### 接口地址：`app/my/change_u_info`

###### 传入参数：

**nickname** `昵称` 

**sex** `性别，1男2女` 

**city** `城市ID` 

**plant** `关注设备ID`

**thumb** `头像地址`

###### 返回参数：

无



***

### 2. change_o_info

###### 说明：`完善资料并申请成为运维/专家完善资料`

###### 接口地址：`app/my/change_o_info`

###### 传入参数：

**nametrue** `名字` 

**sex** `性别，1男2女` 

**city** `城市ID` 

**plant** `关注设备ID`

**company** `供职单位`

**at_start** `供职时间起`

**at_end** `供职时间止`

**experience** `从业经验`

**generator** `发电机组`

**标签** `label`

**field** `擅长领域`

**thumb** `头像地址`

**post** `职务`

###### 返回参数：

无

***



### 3. my_info

###### 说明：`获取我的信息`

###### 接口地址：`app/my/my_info`

###### 传入参数：

无

###### 返回参数：

**info** [用户信息字典](#用户信息字典)

**fans** `粉丝数量`

**follow** `关注数量`

**collect** `收藏数量`

**message** `是否有消息`

**sign** `是否签到`

**wx**  `是否绑定`

***




### 4. my_fans

###### 说明：`获取我的粉丝`

###### 接口地址：`app/my/my_fans`

###### 传入参数：

无

###### 返回参数：

**fans** [关注用户信息字典](#关注用户信息字典) 的数组

***


### 5. my_follow

###### 说明：`获取我的关注`

###### 接口地址：`app/my/my_follow`

###### 传入参数：

无

###### 返回参数：

**folllow** [关注用户信息字典](#关注用户信息字典) 的数组

***



### 6. my_inquiry

###### 说明：`获取我的问诊`

###### 接口地址：`app/my/my_inquiry`

###### 传入参数：

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list** [我的问诊字典](#我的问诊字典) 的数组

*** 





### 7. take_reply

###### 说明：`问诊回答设置为答案`

###### 接口地址：`app/my/take_reply`

###### 传入参数：

**id**       `回答ID`

**thank**      `感谢词`

###### 返回参数：

无

*** 







### 8. del_inquiry

###### 说明：`删除问诊`

###### 接口地址：`app/my/del_inquiry`

###### 传入参数：

**id**       `问诊ID`

###### 返回参数：

无

*** 




### 9. my_reply

###### 说明：`我的问诊回答`

###### 接口地址：`app/my/my_reply`

###### 传入参数：

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list** [我的回答字典](#我的回答字典) 的数组

*** 




### 9. my_equip

###### 说明：`我的设备`

###### 接口地址：`app/my/my_equip`

###### 传入参数：

无

###### 返回参数：

**list** [我的设备字典](#我的设备字典) 的数组

*** 






### 10. my_equip_info

###### 说明：`我的设备详情`

###### 接口地址：`app/my/my_equip_info`

###### 传入参数：

**content** `设备ID`

###### 返回参数：

**info** [我的设备字典](#我的设备字典)

*** 








### 11. feedback

###### 说明：`反馈`

###### 接口地址：`app/my/feedback`

###### 传入参数：

**content** `内容`

###### 返回参数：

无

*** 




### 12. sign

###### 说明：`签到`

###### 接口地址：`app/my/sign`

###### 传入参数：

无

###### 返回参数：

无

*** 




### 13. score

###### 说明：`积分`

###### 接口地址：`app/my/score`

###### 传入参数：

无

###### 返回参数：

**score** `积分`

**wx**  `是否绑定`

*** 





### 14. score_log

###### 说明：`积分记录`

###### 接口地址：`app/my/score_log`

###### 传入参数：

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list** [积分记录字典](#积分记录字典)  的数组

*** 




### 15. cash_bind

###### 说明：`绑定提款微信账号`

###### 接口地址：`app/my/cash_bind`

###### 传入参数：

**wx_pay**       `账号标识`

###### 返回参数：

无

*** 




### 16. cash_apply

###### 说明：`取款`

###### 接口地址：`app/my/cash_apply`

###### 传入参数：

**money**       `金额`

###### 返回参数：

无

*** 




### 17. cash_log

###### 说明：`取款记录`

###### 接口地址：`app/my/cash_log`

###### 传入参数：

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list** [提款记录字典](#提款记录字典)  的数组

*** 





### 18. paper_list

###### 说明：`我的考试`

###### 接口地址：`app/my/paper_list`

###### 传入参数：

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list** [考试信息字典](#考试信息字典)  的数组

*** 




### 18. paper_info

###### 说明：`我的考试`

###### 接口地址：`app/my/paper_info`

###### 传入参数：

**id**       `考试编号`

###### 返回参数：

**result**   	`考卷分数` 

**rank**        `排名`

**all**        	`总人数`

**percent**     `超越的百分比`

***







### 18. message

###### 说明：`消息`

###### 接口地址：`app/my/message`

###### 传入参数：

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list**   	[消息字典](#消息字典)  的数组


***





### 19. collect_inquiry

###### 说明：`问诊收藏`

###### 接口地址：`app/my/collect_inquiry`

###### 传入参数：

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list**   	[问诊信息字典](#问诊信息字典)  的数组


***




### 20. collect_lession

###### 说明：`课程收藏`

###### 接口地址：`app/my/collect_lession`

###### 传入参数：

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list**   	[课程信息字典](#课程信息字典)  的数组


***




### 21. collect_repository

###### 说明：`知识库收藏`

###### 接口地址：`app/my/collect_repository`

###### 传入参数：

**page**       `页数`

**limit**      `每页数量`

###### 返回参数：

**list**   	[知识库字典](#知识库字典)  的数组


***




### 22. my_equip_remove

###### 说明：`我的设备删除`

###### 接口地址：`app/my/my_equip_remove`

###### 传入参数：

**id**       `ID`


###### 返回参数：

无


***




### 22. share

###### 说明：`首次分享增加积分`

###### 接口地址：`app/my/share`

###### 传入参数：

无

###### 返回参数：

无


***



### 23. pay

###### 说明：`付费VIP`

###### 接口地址：`app/lession/pay`

###### 传入参数：

**type**         `付费类型，0为积分，1支付宝，2微信`

**time**         `时间类型，1为月，2季度，3年`

###### 返回参数：

无

***

















# 字典



#### **考试信息字典**

**id**              `考试编号`

**img**        		`封面`

**name**       		`标题`


```
{
    "id": "2",
    "name": "考卷",
    "img": "1474979133.jpeg",
    
}
```





#### **用户信息字典**

**nickname**  `用户标识`

**uid**         `用户UID`

**type**        `用户的类型，-1未选择，0用户，1运维，2专家`

**label**       `标签`

**thumb**       `头像`

**sex**         `性别`

**score**       `积分`

**vip**         `VIP到期时间`

**vip**         `是否VIP`

```
{
    "uid":"1",
    "nickname": "用户_1475134153",
    "type": "0",
    "label": "",
    "thumb": "x.jpg",
    "sex": "0",
    "score": "999999999999999999999999999999",
    "vip": "1999999999",
    "isvip": "1",
}

```



#### **关注用户信息字典**

**nickname**    `用户昵称`

**fuid**        `用户UID`

**type**        `用户的类型，-1未选择，0用户，1运维，2专家`

**label**       `标签`

**thumb**       `头像`

**follow**      `是否关注`

```
{
    "fuid": "3",
    "type": "2",
    "nickname": "用户_1475134303",
    "label": "大佬",
    "thumb": "x.jpg",
    "follow": "1"
}
```



#### **我的问诊字典**

**id**          `问诊ID`

**uid**         `用户UID`

**bid**         `设备分类`

**title**       `标题`

**content**     `内容`

**img**         `图片`

**ctime**       `创建时间`

**finish**      `完成时间`

**answer**      `回答数`

**read**        `访问数`

**collect**     `收藏数`

**thumb**       `头像`

**nickname**    `昵称`


```
{
    "id": "2",
    "uid": "2",
    "bid": "1",
    "title": "dfasdf",
    "content": "adfasdfasdf",
    "img": "",
    "ctime": "1476092202",
    "finish": "0",
    "answer": "0",
    "read": "1",
    "collect": "0",
    "thumb": "",
    "nickname": "用户_1475134153"
}
```




#### **我的回答字典**

**id**          `回答ID`

**uid**         `回复用户UID`

**bid**         `问诊ID`

**content**     `回复内容`

**img**         `回复图片`

**ctime**       `创建时间`

**adopt**      `是否采纳`

**thank**        `感谢词`

**zan**         `点赞数`

**title**         `问诊标题`

**iuid**         `发布问诊用户UID`

**ithumb**         `发布问诊用户头像`

**icontent**         `发布问诊用户内容`

**iimg**         `发布问诊用户图片`

**nickname**    `昵称`

**inickname**    `发布问诊用户昵称`

**thumb**         `回复用户头像`


```
{
    "id": "2",
    "uid": "2",
    "bid": "1",
    "content": "adfasdfasdf",
    "img": "",
    "ctime": "1476093226",
    "adopt": "0",
    "thank": "",
    "zan": "0",
    "iuid": "1",
    "title": "askdf",
    "icontent": "adfasdfasdf",
    "iimg": "",
    "thumb": "",
    "nickname": "用户_1475134153",
    "ithumb": "",
    "inickname": ""
}
```



#### **问诊信息字典**

**id**          `问诊ID`

**uid**         `用户UID`

**bid**         `设备分类`

**title**       `标题`

**content**     `内容`

**img**         `图片`

**ctime**       `创建时间`

**finish**      `完成时间`

**answer**      `回答数`

**read**        `访问数`

**collect**     `收藏数`

**thumb**       `头像`

**nickname**    `昵称`

**collected**   `是否收藏`

```
{
    "id": "1",
    "uid": "1",
    "bid": "1",
    "title": "123",
    "content": "123",
    "img": "",
    "ctime": "0",
    "finish": "0",
    "answer": "0",
    "read": "2",
    "collect": "0",
    "thumb": "",
    "nickname": "",
    "collected":"0"
}

```



#### **课程信息字典**

**cid**        		`课程ID`

**title**       	`标题`

**thumb**       	`封面`

**people**			`演讲人`

**open_time**		`开始时间`

**etime**			`结束时间`

**etime**			`结束时间`

**content**			`内容`

**look_nums**		`观看人数限制`

**nums**			`观看人数`

**ctime**			`创建时间`

**movie_url**		`视频地址`

**now**				`当前时间`

```
{
	"cid": "1",
	"title": "为什么讲师这么帅",
	"thumb": "baka.jpg",
	"people": "zz",
	"open_time": "1100000000",
	"content": "天生的强生的",
	"look_nums": "1000",
	"etime": "1200000000",
	"movie_url": "baka.mp4",
	"ctime": "1000000000",
	"nums": "999",
	"now": "1800000000"
}
```


#### **知识库字典**


**rid**         `ID`

**bid**         `分类ID`

**title**       `标题`

**content**     `内容`

**collection**  `收藏数`

**reading**     `阅读数`

**ctime**       `创建时间`

**describe**    `描述`

**thumb**       `缩略图`

**name**        `分类名字`


```
{
    "rid": "1",
    "mid": "1",
    "bid": "2",
    "title": "etrert",
    "content": "<p>erterter</p>",
    "collection": "0",
    "reading": "0",
    "ctime": "1474908939",
    "thumb": "",
    "describe":"",
    "name": "精选",
    "del": "0"
}
```




#### **消息字典**

**content**        `消息内容`


```
{
    "mid": "1",
    "uid": "2",
    "ctime": "0",
    "content": "测试数据",
    "read": "1"
}
```



#### **提款记录字典**

**money**         `钱`

**status**        `提款状态`

**ctime**         `时间`

**content**       `固定值：积分提现`

**num**           `金钱变化`

```

{
    "id": "1",
    "uid": "2",
    "money": "100",
    "num": "-100",
    "status": "0",
    "ctime": "0"
}
```


#### **积分记录字典**

**score**         `积分变化`

**content**       `说明`

**ctime**         `时间`

**num**           `积分变化`

```
{
    "id": "1",
    "uid": "2",
    "score": "100",
    "content": "dwwd",
    "ctime": "0"
    "num": "100",
}
```



#### **我的设备字典**

**id**         `我的设备ID`

**uid**       `用户ID`

**ontent**         `说明`

**bid**           `设备分类ID`

**img_url**           `图片`

**ctime**           `创建时间`

**ename2**           `耳机分类名称`

**ename1**           `主分类名称`


```
{
    id: "1",
    uid: "2",
    bid: "30",
    content: "你明明",
    img_url: "1476792501.png",
    ctime: "1476792501",
    ename2: "煤样采、制、化",
    ename1: "燃料及化水设备"
}
```