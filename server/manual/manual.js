$(document).ready(function(){
    function hexSet(){
        let calc="";
        this.value = this.value.replaceAll(':','');
        let maxLen=this.value.length;
        console.log();
        for (let i = 0; i < maxLen; i++) {
            if(this.value[i]){
                calc+=this.value[i];
            }else
            {
                calc+=0;
            }
            if(i%2==1 && i!=maxLen-1){
                calc+=":";
            }
        }
        this.value=calc;
    }

    $('.HEX').each(hexSet);
    $('.HEX').change(hexSet);
    $('.HEX').keypress(function(e){
        var txt = String.fromCharCode(e.which);
        if(!txt.match(/[A-fa-f0-9]/)) 
        {
            return false;
        }
    });
    
    

    $("input").change(function(){
        console.log($(this).val().replaceAll(':','')+"   "+$(this).attr('placeholder'));
        if($(this).val().replaceAll(':','') == ""){
            $(this).val($(this).attr('placeholder'));
            $(this).trigger("change");
        }
        if($(this).val().replaceAll(':','') == $(this).attr('placeholder')){
            $(this).removeClass("changed");
        }
        else {
            $(this).addClass("changed");
        }
    });


    $("option").each(function(){
      if($(this).parent().attr("value") == $(this).attr("value")){
        $(this).addClass("default");
        $(this).attr("selected","selected");
      }
      if ($(this).parent().attr("value")>3 && $(this).attr("value")>3){
        $(this).addClass("default");
        $(this).attr("selected","selected");
      }
    })

    $("select").on('change', function() {
      console.log(this.value);
        if(this.value == $(this).attr("value")){
          $(this).removeClass("changed");
        }else{
          $(this).addClass("changed");
        }
    });



    });

    document.onkeydown=function(evt){
    var keyCode = evt.key;
    if(keyCode == 13)
    {
        document.test.submit();
    }
    
}
