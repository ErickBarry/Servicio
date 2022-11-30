$(document).ready(function(){

        start();
        window.addEventListener('resize', start);

        function start(){
            let anchoPagina=document.documentElement.clientWidth;
            let altoPagina=document.documentElement.clientHeight;
            if(anchoPagina<=500)
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='7.5px';
            }
            else if(anchoPagina>500&& anchoPagina<=600)
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='11.5px';
            }
            else if(anchoPagina>600 && anchoPagina<=650)
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='14px';
            }
            else if(anchoPagina>650 && anchoPagina<=767)
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='15px';
            }
            else if(anchoPagina>767 && anchoPagina<=800)//aqui ya aparece el menu lateral completo
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='12px';
            }
            else if(anchoPagina>800 && anchoPagina<=900)
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='13px';
            }
            else if(anchoPagina>900 && anchoPagina<=1000)
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='14px';
            }
            else if(anchoPagina>1000 && anchoPagina<=1100)
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='17px';
            }
            else if(anchoPagina>1100 && anchoPagina<=1200)
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='19px';
            }
            else if(anchoPagina>1200 && anchoPagina<=1345)
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='21px';
            }
            else if(anchoPagina>1345)
            {
                let titulo=document.getElementById('TituloPagina');
                titulo.style.fontSize='25px';
            }

            //Tamaño del boton de inicio
            if(anchoPagina<=767)
            {
                let bontoncasa=document.getElementById('BotonCasa');
                bontoncasa.className="fa-solid fa-house-chimney fa-sm";

                let tamlogoIPN=document.getElementById('idLogoIPN');
                tamlogoIPN.innerHTML='<figure><img src="https://serviciosocialescom.herokuapp.com/assets/img/IPNBlancoyNegro.png" class="rensponsive-img"  alt="LogoIPN" width:60%></figure>';
            }
            else
            {
                let bontoncasa=document.getElementById('BotonCasa');
                bontoncasa.className="fa-solid fa-house-chimney fa-xl small";

                let tamlogoIPN=document.getElementById('idLogoIPN');
                tamlogoIPN.innerHTML='<figure><img src="https://serviciosocialescom.herokuapp.com/assets/img/IPNBlancoyNegro.png" class="rensponsive-img"  alt="LogoIPN" style="width:150%"></figure>';
            }
        document.getElementById('SpanID1').innerText = document.documentElement.clientWidth;
        document.getElementById('SpanID2').innerText = document.documentElement.clientHeight;
        console.log(document.documentElement.clientWidth);
        }

    //Cambiar el nombre del usuario

    $('.NavLateral-DropDown').on('click', function(e){
        e.preventDefault();
        var DropMenu=$(this).next('ul');
        var CaretDown=$(this).children('i.NavLateral-CaretDown');
        DropMenu.slideToggle('fast');
        if(CaretDown.hasClass('NavLateral-CaretDownRotate')){
            CaretDown.removeClass('NavLateral-CaretDownRotate');    
        }else{
            CaretDown.addClass('NavLateral-CaretDownRotate');    
        }
        
    });
    $('.tooltipped').tooltip({delay: 50});
    $('.ShowHideMenu').on('click', function(){
        var MobileMenu=$('.NavLateral');
        if(MobileMenu.css('opacity')==="0"){
            MobileMenu.addClass('Show-menu');   
        }else{
            MobileMenu.removeClass('Show-menu'); 
        }   
    }); 
    $('.btn-ExitSystem').on('click', function(e){
        e.preventDefault();
        swal({ 
            title: "You want out of the system?",   
            text: "The current session will be closed and will leave the system",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes",
            animation: "slide-from-top",   
            closeOnConfirm: false,
            cancelButtonText: "Cancel"
        }, function(){   
            window.location='index.html'; 
        });
    }); 
    $('.btn-Search').on('click', function(e){
        e.preventDefault();
        swal({   
            title: "What are you looking for?",   
            text: "Write what you want",   
            type: "input",   
            showCancelButton: true,   
            closeOnConfirm: false,   
            animation: "slide-from-top",   
            inputPlaceholder: "Write here",
            confirmButtonText: "Search",
            cancelButtonText: "Cancel" 
        }, function(inputValue){   
            if (inputValue === false) return false;      
            if (inputValue === "") {     swal.showInputError("You must write something");     
            return false   
            }      
            swal("Nice!", "You wrote: " + inputValue, "success"); 
        });    
    });
    $('.btn-Notification').on('click', function(){
        var NotificationArea=$('.NotificationArea');
        if(NotificationArea.hasClass('NotificationArea-show')){
            NotificationArea.removeClass('NotificationArea-show');
        }else{
            NotificationArea.addClass('NotificationArea-show');
        }
    });     
});
(function($){
    $(window).load(function(){
        $(".NavLateral-content").mCustomScrollbar({
            theme:"light-thin",
            scrollbarPosition: "inside",
            autoHideScrollbar: true,
            scrollButtons:{ enable: true }
        });
        $(".ContentPage, .NotificationArea").mCustomScrollbar({
            theme:"dark-thin",
            scrollbarPosition: "inside",
            autoHideScrollbar: true,
            scrollButtons:{ enable: true }
        });
    });
})(jQuery);