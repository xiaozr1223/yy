/* Demo Note:  This demo uses a FileProgress class that handles the UI for displaying the file name and percent complete.
The FileProgress class is not part of SWFUpload.
*/


/* **********************
   Event Handlers
   These are my custom event handlers to make my
   web application behave the way I went when SWFUpload
   completes different tasks.  These aren't part of the SWFUpload
   package.  They are part of my application.  Without these none
   of the actions SWFUpload makes will show up in my application.
   ********************** */
function fileQueued(file) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus("�ȴ��ϴ�...");
		progress.toggleCancel(true, this);

	} catch (ex) {
		this.debug(ex);
	}

}

function fileQueueError(file, errorCode, message) {
	try {
		if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
			alert("�Բ���ÿ���������ѡ��"+message+"���ļ�");
			return;
		}

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			progress.setStatus("�ļ�̫��.");
			this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			progress.setStatus("�������ϴ�0�ֽڵ��ļ�.");
			this.debug("Error Code: Zero byte file, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
			progress.setStatus("δ֪�ļ�����.");
			this.debug("Error Code: Invalid File Type, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		default:
			if (file !== null) {
				progress.setStatus("δ֪����");
			}
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
	try {
		if (numFilesSelected > 0) {
			document.getElementById('btnUpload').disabled = false;
			document.getElementById(this.customSettings.cancelButtonId).disabled = false;
		}

		/* I want auto start the upload and I can do that here */
		//this.startUpload();
	} catch (ex)  {
        this.debug(ex);
	}
}

function uploadStart(file) {
	try {
		/* I don't want to do any file validation or anything,  I'll just update the UI and
		return true to indicate that the upload should start.
		It's important to update the UI here because in Linux no uploadProgress events are called. The best
		we can do is say we are uploading.
		 */
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus("�ϴ���...");
		progress.toggleCancel(true, this);
	}
	catch (ex) {}

	return true;
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
	try {
		var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setProgress(percent);
		progress.setStatus("�ϴ���...");
	} catch (ex) {
		this.debug(ex);
	}
}
function SetCopy(obj)
{
   var str=obj.parent().prev().eq(0).children().attr("href");
   if (document.all){                                            //�ж�Ie
	   window.clipboardData.setData('text', str);
	   alert("���Ƴɹ���������ʼ�ɣ�");
	   }else{
	   alert("�����������֧�ּ���������������и��ơ�"); 
	     }
}
function uploadSuccess(file, serverData) {
	try {
		
		 var obj=window.location;
		 var url="http://";
		 var path=obj.pathname;
		 path=path.substring(path.indexOf("/"),path.lastIndexOf("/"));
		 if(obj.protocol.indexOf("http:")!=-1||obj.protocol.indexOf("https:")!=-1)
	     {
			 url=obj.protocol+"//";
	     }
		 url+=obj.host;
		 if(path!="")
	     {
			 url+=path;
	     }
		//if (serverData.substring(1, 5) === "suc:") {
		if (serverData.indexOf("suc")!=-1) {
			serverData=serverData.replace(/^(\s*)|(\s*)$/g,'');
			var fileinfo = serverData.replace(/suc:/g,'').split(",");
			//var fileinfo =serverData.substring(4).split(",");
			//alert(fileinfo[0].length+"|"+fileinfo);
			var progress = new FileProgress(file, this.customSettings.progressTarget);
			progress.setComplete();
			progress.setText("<a href=\""+url+"/"+fileinfo[0]+fileinfo[1]+"\" target=\"_blank\">"+fileinfo[1]+"</a>");
			var status = "��ϲ�㣬�ļ��ϴ��ɹ��� <br />";
			status += "��С��"+parseFloat(parseInt(fileinfo[2])/1024).toFixed(2)+ "K&nbsp;&nbsp;&nbsp;<a href=\"#\" onclick=\"SetCopy($(this))\" >����</a> <br />";
			status += "��ַ��"+url+"/"+fileinfo[0]+fileinfo[1];  //������Ҫ�Լ������Լ���վʵ����������޸�
			progress.setStatus(status);
			progress.toggleCancel(false);
			document.getElementById('imglist').innerHTML += "[img]"+url+"/"+fileinfo[0]+fileinfo[1]+'[/img]<br/>';
			getimgtip();
		}else{
			var progress = new FileProgress(file, this.customSettings.progressTarget);
			progress.setError();
			progress.setStatus("�ϴ�ʧ�ܣ�"+serverData.substring(5));
			progress.toggleCancel(false);
		}

	} catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			progress.setStatus("�ļ��ϴ�ʧ��: " + message);
			this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			progress.setStatus("�ļ��ϴ�ʧ��");
			this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			progress.setStatus("������IO����");
			this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			progress.setStatus("��ȫ����");
			this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			progress.setStatus("�ļ���С��������");
			this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
			progress.setStatus("��֤ʧ�ܣ��ϴ��ѱ�����");
			this.debug("Error Code: File Validation Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			// If there aren't any files left (they were all cancelled) disable the cancel button
			if (this.getStats().files_queued === 0) {
				document.getElementById('btnUpload').disabled = true;
				document.getElementById(this.customSettings.cancelButtonId).disabled = true;
			}
			progress.setStatus("��ȡ���ϴ�");
			progress.setCancelled();
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			progress.setStatus("��ֹͣ�ϴ�");
			break;
		default:
			progress.setStatus("δ֪����: " + errorCode);
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function uploadComplete(file) {
	if (this.getStats().files_queued === 0) {
		document.getElementById('btnUpload').disabled = true;
		document.getElementById(this.customSettings.cancelButtonId).disabled = true;
	}
}

// This event comes from the Queue Plugin
function queueComplete(numFilesUploaded) {
	var status = document.getElementById("divStatus");
	status.innerHTML = numFilesUploaded + " ���ļ����ϴ�.";
}

function AddonloadEvent(func)
{
  var oldonload=window.onload;
  if(typeof oldonload!='function')
  {
       window.onload=func;
  }
  else
  {
      window.onload=function(){
        oldonload();
        func();
      };
  } 
}
function AddEvent(el, type, fn){
	el.addEventListener ? el.addEventListener(type, fn, false) : el.attachEvent('on' + type, fn);
}
function DelEvent(el, type, fn){
	el.removeEventListener ? el.removeEventListener(type, fn, false) : el.detachEvent('on' + type, fn);
}
/*
 * 
 * 
 * www.qhjsw.net
   qhjsw@qhjsw.net
   QQ:909507090
       ����ע�⣺������Ϊ��Դ���������ʹ�ñ��������κε���ҵ������ҵ��Ŀ������վ�С���������ر��������������Ϣ��ҳ��logo��ҳ���ϱ�Ҫ�����ӿ����������
	 ��Ϊ����̳��www.qhjsw.net��������ַ���ӣ�лл֧�֡���Ϊ����������Զ���Ӧ�ĺ�̨���ܽ�����չ����ɾ����Ӧ���룩,���뱣�������������Դ��Ϣ�����磺����̳��ַ������ȣ���
          �����������޸�����ذ��޸Ĺ��ĳ������ʼ���ʽ���͸����ˣ�qhjsw#qhjsw.net #�Ż�Ϊ@����лл������
 * 
 */