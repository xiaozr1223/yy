/*
* @Author: Administrator
* @Date:   2017-05-24 19:33:59
* @Last Modified by:   Administrator
* @Last Modified time: 2017-05-26 08:42:52
*/

'use strict';
window.onload=function(){
	let table=document.querySelector('.nav');
	// console.log(table);
	table.onclick=function(e){
		let obj=e.target;
		if(obj.nodeName=="BUTTON"){
			let tr1=obj.parentNode.parentNode;
			console.log(tr1);
			table.removeChild(tr1);
		}
	}
}
