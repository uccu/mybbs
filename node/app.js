const ws = require("nodejs-websocket");
const crypto = require('crypto');
const fs = require('fs');
const md5 = d=>crypto.createHash('md5').update(d).digest('hex');

Function.prototype.merge = function(o){for(let k in o)this[k] = o[k]};
console.log("start...");



let UserMap		= new Map;

let ChannelMap	= new Map;

let ConnectMap	= new Map;



class User{
	constructor(uid = null,password = null) {
		if(uid == 'admin' && password == md5('admin'))this.UID = uid;
		else if(!uid || typeof uid !== 'string' || !uid.match(/^[a-f0-9]{32}$/i))
			this.UID = md5(Math.random.toString()+Date.now().toString());
		else this.UID = uid;
		this.password = password;
		this.channelMap = new Map;
		this.connectMap = new Map;
		this.channel
	}

	addChannel(Channel){
		if(!this.channelMap.has(Channel.CID)){
			this.channelMap.set(Channel.CID,Channel);
			Channel.addUser(this)
		}
		return this
	}

	removeChannel(Channel){
		if(this.channelMap.has(Channel.CID)){
			delete this.channelMap.delete(Channel.CID);
			Channel.removeUser(this)
		}
		return this
	}
	sendObject(m){
		this.send(JSON.stringify(m));return this;
	}
	send(m){
		this.connectMap.forEach(c=>c.sendText(m));
		return this;
	}
	recyle(){
		return User.remove(this);
	}
}

class Channel{
	constructor(cid = null) {
		this.CID = cid;
		this.userMap = new Map;
		this.video = {};
	}
	get master(){
		return this.userMap.values().next().value
	}
	addUser(User){
		if(!this.userMap.has(User.UID)){
			this.userMap.set(User.UID,User);
			User.addChannel(this)
		}
		return this
	}
	removeUser(User){
		if(this.userMap.has(User.UID)){
			this.userMap.delete(User.UID);
			User.removeChannel(this);
			if(!this.userMap.size)this.recyle();
		}
		return this
	}
	sendObject(m){
		this.send(JSON.stringify(m));return this;
	}
	send(m){
		this.userMap.forEach(u=>u.connectMap.forEach(c=>c.sendText(m)));
		return this;
	}
	recyle(){
		return Channel.remove(this);
	}


}

User.merge({
	get(t,p){
		if(p)p = md5(p);
		if(UserMap.has(t)){
			if(UserMap.get(t).password !== p)return false;
			return UserMap.get(t);
		}
		let newUser = new this(t,p);
		UserMap.set(newUser.UID,newUser);
		return newUser;
	},
	remove(u,conSymbol){
		if(u instanceof User)u = u.UID;
		let user = UserMap.get(u);
		if(!user)return this;
		if(conSymbol){

			user.connectMap.delete(conSymbol);
			if(!user.connectMap.size){
				UserMap.delete(u);
			}
		}else{
			
			UserMap.delete(u);
		}
		ConnectMap.delete(conSymbol);
		
		return true;
	}
});

Channel.merge({
	get(t){
		if(ChannelMap.has(t))return ChannelMap.get(t);
		let newChannel = new this(t);
		ChannelMap.set(newChannel.CID,newChannel);
		return newChannel;
	},
	remove(c){
		if(c instanceof Channel)c = c.CID;
		let channel = ChannelMap.get(c);
		if(!channel)return this;
		channel.userMap.forEach(c=>c.removeChannel(channel));
		ChannelMap.delete(c);
		return true;
	}
});



class Message{
	constructor(str) {
		let l = str.length;


	}


}




















let server = ws.createServer({
	secure:false,
	// key: fs.readFileSync('server.key'),
  	// cert: fs.readFileSync('yoooo_co.crt'),
	// requestCert: true,
	// ca: [ fs.readFileSync('yoooo_co.ca-bundle') ]

},function(con){
	console.log("one connection linked");
	let path = con.path.split('/'),user;
	// if(path[1]=='channel' && path[2] && path[2].match(/[a-z0-9]+/i))cid = path[2];
	// else cid = null;
	
	// let thisRoom = Channel.get(cid);

	let conSymbol = Symbol();
	
	ConnectMap.set(conSymbol,con);

	con.sendText(JSON.stringify({status:200,type:'connect'}));
	con.on("text", function (str){
		try{
			var obj = JSON.parse(str);
			if(typeof obj !== 'object')return;
			switch(obj.type){
				case 'user_login':{
					if(user)break;
					user = User.get(obj.uid,obj.password);
					if(!user)break;
					if(!user.avatar)user.avatar = obj.avatar;
					if(!user.nickname)user.nickname = obj.nickname;

					user.connectMap.set(conSymbol,con);
					
					if(user.UID != 'admin'){
						user.nickname = '用户'+user.UID.slice(0,6);
						z = {};
						let u = UserMap.get('admin');
						if(u){
							z.uid = u.UID;
							z.avatar = u.avatar;
							z.nickname = u.nickname;
							z.message = '你好，有什么可以帮您的吗？';
							z.type = 'user_message';
							user.sendObject(z);
							z2 = {};
							z2.uid = user.UID;
							z2.avatar = user.avatar;
							z2.nickname = user.nickname;
							z2.type = 'user_link';
							u.sendObject(z2);
						}else{
							z.uid = 'system';
							z.avatar = 'http://new.shuhuaty.com/templets/default/images/tx_shuhua.png';
							z.nickname = '系统消息';
							z.message = '当前客服不在线！';
							z.type = 'user_message';
							user.sendObject(z);
							
						}
						
						user.sendObject({status:200,type:'user_login',uid:user.UID});
					}else{
						z = {};
						z.uid = 'system';
						z.avatar = 'http://new.shuhuaty.com/templets/default/images/tx_shuhua.png';
						z.nickname = '系统消息';
						z.message = '客服已上线！';
						z.type = 'user_message';

						z3 = [];
						UserMap.forEach(g=>{
							g.sendObject(z)
							
							z2 = {};
							z2.uid = g.UID;
							z2.avatar = g.avatar;
							z2.nickname = g.nickname;
							z3.push(z2);
							
						})
						user.sendObject({status:200,type:'user_login',uid:user.UID,users:z3});
					}
					
					
					break;
				}case 'user_logout':{
					if(!user)break;
					user.sendObject({status:200,type:'user_logout'});
					User.remove(user,conSymbol);
					user = undefined;
					break;
				}case 'user_info':{
					let user_x = UserMap.get(obj.uid);
					if(!user_x)break;
					let z = {};
					z.uid = user_x.UID;
					z.avatar = user_x.avatar;
					z.nickname = user_x.nickname;
					z.type = obj.type;
					user.sendObject(z);
					break;
				}case 'user_message':{
					if(!user)break;
					let toUser = UserMap.get(obj.uid);
					if(!toUser){
						user.sendObject({type:'err',message:'对方不在线！'});
					}
					if(!obj.message)break;
					let z = {};
					z.uid = user.UID;
					z.avatar = user.avatar;
					z.nickname = user.nickname;
					z.message = obj.message;
					z.type = obj.type;
					toUser.sendObject(z);
					if(toUser != user)user.sendObject(z);
					break;
				}case 'user_list':{
					if(!user)break;
					let z = [];
					UserMap.forEach(d=>{
					
						z.push ({
							uid:d.UID,
							avatar:d.avatar,
							nickname:d.nickname
						});
					})
					let o = {type:obj.type,data:z};
					user.sendObject(o);
					break;
				}default:break;
			}
			
		}catch(e){
			console.error(e.message);
		}
	});

	con.on("binary", function (frameBuffer){

		console.log(frameBuffer,typeof frameBuffer);
	});

	
	con.on("close", function (code, reason) {
		if(user)User.remove(user,conSymbol);

		if(UserMap.get(user.UID))return;

		if(user.UID == 'admin'){
			z = {};
			z.uid = 'system';
			z.avatar = 'http://new.shuhuaty.com/templets/default/images/tx_shuhua.png';
			z.nickname = '系统消息';
			z.message = '客服已离线！';
			z.type = 'user_message';
			UserMap.forEach(g=>{
				g.sendObject(z)		
			})
		}else{
			z = {};
			z.uid = user.UID;
			z.type = 'user_leave';
			u = UserMap.get('admin');
			if(u){
				u.sendObject(z)
			}

		}

		console.log("one connection closed")
	});
	con.on("error", function (code, reason) {
		if(user)User.remove(user,conSymbol);
		console.log("one connection occurred error")
	});
}).listen(7777);

