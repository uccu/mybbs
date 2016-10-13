[返回](main.md)



***


### 1. lists

###### 说明：`获取课程列表`

###### 接口地址：`app/lession/lists`

###### 传入参数：

**type**         `1为未开始，2为正在进行，3为结束`

###### 返回参数：

**list**         [课程信息字典](#课程信息字典) 的数组 

***




### 2. info

###### 说明：`获取课程详情`

###### 接口地址：`app/lession/info`

###### 传入参数：

**id**         `课程ID`

###### 返回参数：

**info**         [课程信息字典](#课程信息字典) 

***





### 3. leave

###### 说明：`离开课程`

###### 接口地址：`app/lession/leave`

###### 传入参数：

**id**         `课程ID`

###### 返回参数：

无

***



### 4. collect

###### 说明：`收藏/取消收藏课程`

###### 接口地址：`app/lession/collect`

###### 传入参数：

**id**         `课程ID`

###### 返回参数：

**collected**         `成功后收藏状态，1是0否`

***




### 5. test

###### 说明：`考卷主页`

###### 接口地址：`app/lession/test`

###### 传入参数：

无

###### 返回参数：

**list_r**        `热门` [考卷信息字典](#考卷信息字典) 的数组 

**list_y**        `运维` [考卷信息字典](#考卷信息字典) 的数组 

**list_p**        `收费` [考卷信息字典](#考卷信息字典) 的数组 

***




### 6. test_list

###### 说明：`考卷列表`

###### 接口地址：`app/lession/test_list`

###### 传入参数：

**states**   	`1热门，2运维，3收费` 

###### 返回参数：

**list**        [考卷信息字典](#考卷信息字典) 的数组 

***




### 7. paper

###### 说明：`考卷信息`

###### 接口地址：`app/lession/paper`

###### 传入参数：

**id**   	`考卷ID` 

###### 返回参数：

**list**        [题目信息字典](#题目信息字典) 的数组 

***




### 8. submit

###### 说明：`提交考卷`

###### 接口地址：`app/lession/submit`

###### 传入参数：

**result**   	`考卷分数` 

**pid**   		`考卷ID` 

###### 返回参数：

**rank**        `排名`

**all**        	`总人数`

**percent**     `超越的百分比`

***



















# 字典


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





#### **考卷信息字典**

**pid**        		`考卷ID`

**name**       		`标题`

**charge**       	`费用`

**states**			`类型`

**ctime**			`创建时间`

```
{
    "pid": "2",
    "name": "考卷",
    "img": "1474979133.jpeg",
    
    "charge": "0",
    "states": "2",
    "ctime": "1474979124"
}
```



#### **题目信息字典**

**qid**        			`题目ID`

**title**       		`标题`

**question_one**        `选项A`

**question_two**        `选项B`

**question_three**      `选项C`

**question_four**       `选项D`

**question_true**       `正确的选项`

**states**				`类型`

**ctime**				`创建时间`

```
{
    "qid": "3",
    "title": "3+4=?",
    "question_one": "5",
    "question_two": "6",
    "question_three": "7",
    "question_four": "8",
    "question_true": "C",
    "states": "2",
    "ctime": "1474973923"
}
```

