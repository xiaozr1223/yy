/**
 * Created by MACHENIKE on 2017/5/23.
 */
$(function () {
   let imgs=$("img",".wyf-gkmiddle");
    let img=$("img",".wyf-gkleft");
    img.map(function (value, index) {
        index.onclick=function () {
            for(let i=0;i<imgs.length;i++){
                if(i==0){
                    continue;
                }
                imgs[i].style.display="none";
            }
            for(let i=0;i<img.length;i++){
                if(i==0){
                    continue;
                }
                img[i].className="clock";
            }
            if(value!=0){
                img[0].className="clock";
            }
            imgs[value].style.display="block";
            img[value].className="clock wyf-border";
        }

    });

})