<?php
//ִ���ļ���ͼƬ���ϴ�
date_default_timezone_set("PRC");
//1.��ȡ�ϴ��ļ���Ϣ
 $upfile = $_FILES["pic"];
 $typelist = array("image/jpeg","image/jpg","image/png","image/gif"); //�������������
 $path="./uploads/";  //����һ���ϴ������Ŀ¼
 
//2. �����ϴ��ļ��Ĵ����
  if($upfile["error"]>0){
	//��ȡ������Ϣ
	switch($upfile['error']){
		case 1:
			$info="�ϴ����ļ������� php.ini �� upload_max_filesize ѡ�����Ƶ�ֵ��"; 
			break;
		case 2:
			$info="�ϴ��ļ��Ĵ�С������ HTML ���� MAX_FILE_SIZE ѡ��ָ����ֵ��"; 
			break;
		case 3:
			$info="�ļ�ֻ�в��ֱ��ϴ���"; 
			break;
		case 4:
			$info="û���ļ����ϴ��� ";
		case 6:
			$info="�Ҳ�����ʱ�ļ��С�"; 
			break;
		case 7:
			$info="�ļ�д��ʧ��"; 
			break;
	}

	die("�ϴ��ļ�����ԭ��".$info);
  }
  
//3. �����ϴ��ļ���С�Ĺ��ˣ��Լ�ѡ��
	if($upfile["size"]>200000){
		die("�ϴ��ļ���С�������ƣ�");
	}
	
//4. ���͹���
	if(!in_array($upfile["type"],$typelist)){
		die("�ϴ��ļ����ͷǷ���".$upfile["type"]);
	}

//5. �ϴ�����ļ�������(�����ȡһ���ļ��������ֺ�׺�����䣩)
	$fileinfo = pathinfo($upfile["name"]);//�����ϴ��ļ�����
	do{
		$newfile= date("YmdHis").rand(1000,9999).".".$fileinfo["extension"];
	}while(file_exists($path.$newfile));
//6. ִ���ļ��ϴ�
	//�ж��Ƿ���һ���ϴ����ļ�
	if(is_uploaded_file($upfile["tmp_name"])){
		//ִ���ļ��ϴ����ƶ��ϴ��ļ���
		if(move_uploaded_file($upfile["tmp_name"],$path.$newfile)){
			echo "<script> alert('�ļ��ϴ��ɹ���'); window.location.href='product.php';</script>";
		}else{
			die("�ϴ��ļ�ʧ��");
		}
	}else{
		die("����һ���ϴ��ļ���");
	}



