## 接口

所有的接口统一前缀http://www.yunweiweishi.com/  

返回的数据格式为json的字典，有4个参数，`data（object）`,`desc(string)`,`url(string)`,`code(int)`；后续所有所说的返回参数都是指data对象。  

code为200为正常输出，结果在data内，其他为错误，错误信息在desc内。  

错误分类为4类。第一类为2，3开头，需要有后续操作；第二类为4，5开头，参数/查询报错信息，第三类为7开头，安全类型报错信息；第四类为9开头，服务器类型报错信息.

**所有时间均采用时间戳**

**需要登录的接口需要附加上user_token参数**


##### 成功样例
```
{
    "data": {
        xxxx
    },
    "desc": "",
    "url": "",
    "code": 200
}

```

##### 错误样例：
```
{
    "data": {},
    "desc": "xxxxx",
    "url": "",
    "code": xxxx
}
```

[H5相关接口](h5.md)

[登录相关接口](in.md)

[首页相关接口](home.md)

[设备相关接口](equip.md)

[运维相关接口](maintenance.md)

[问诊相关接口](inquiry.md)

[课程相关接口](lession.md)

[我的相关接口](my.md)

[用户相关接口](user.md)

[缺陷相关接口](defect.md)

[巡检相关接口](xj.md)

[工具相关接口](tool.md)

[接口错误返回](error.md)

