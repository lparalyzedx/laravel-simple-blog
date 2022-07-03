<script src="https://use.fontawesome.com/a24e4a8777.js"></script>
<div class="page">
  <div>
   <h1>lparalyzed</h1>
  </div>
  <div class="speech-bubble">
    <div class="maintenance-message active">
      <h1>Üzgünüz, Sistemimiz şu anda bakımda</h1>
      <p>Açılış: (XX:XX:XX)</p>
      <i class="translate fa fa-language" aria-hidden="true"></i>
    </div>
    <div class="maintenance-message">
      <h1>Sorry, our system is now in maintenance</h1>
      <p>Opening: (XX:XX:XX)</p>
      <i class="translate fa fa-language" aria-hidden="true"></i>
    </div>
    <div class="maintenance-message">
      <h1>К сожалению, наша система теперь находится в обслуживании</h1>
      <p>открытие: (XX:XX:XX)</p>
      <i class="translate fa fa-language" aria-hidden="true"></i>
    </div>
    <div class="maintenance-message">
      <h1>Désolé, notre système est maintenant en maintenance</h1>
      <p>Ouverture: (XX:XX:XX)</p>
      <i class="translate fa fa-language" aria-hidden="true"></i>
    </div>
    <div class="maintenance-message">
      <h1>Spiacenti, il nostro sistema è ora in manutenzione</h1>
      <p>Scusa: (XX:XX:XX)</p>
      <i class="translate fa fa-language" aria-hidden="true"></i>
    </div>
  </div>
  <footer>
    <img class="maintenance-icon" src="https://icons.iconarchive.com/icons/dakirby309/simply-styled/256/VLC-Media-Player-icon.png" />
  </footer>
</div>
<style>
body{
  background-color: #e57a07d4;
  color: white;
  font-family: Helvetica Neue, Open Sans;
  user-select: none;
}

.page{
  text-align: center;
}

.speech-bubble{
  position: relative;
}

.brand-logo{
  width: 300px;
  margin: 2em 0;
}

.maintenance-message{
  opacity: 0;
  position: absolute;
  transition: opacity 0.5s;
  color: #555;
  padding: 1em;
  background-color: white;
  border-radius: 2px;
  width: 90%;
  max-width: 300px;
  left: 0;
  right: 0;
  margin-left: auto;
  margin-right: auto;
  text-align: center;
  box-shadow: 0 1px 1px #bbb;
  margin-bottom: 1em;
  top: 0;
  pointer-events: none;
}

.maintenance-message.active:hover{
  box-shadow: 0 1px 4px #aaa;
}

.maintenance-message.active{
  opacity: 1;
  pointer-events: all;
}

footer{
  height: 15vh;
  background-color: #bbb;
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  z-index: -1;
}

footer .maintenance-icon{
  height: 100px;
  position: absolute;
  left: 10%;
  top: -50px;
}

.translate{
  position: absolute;
  bottom: 4px;
  right: 4px;
  font-size: 2em;
  color: #999;
  transition: color 0.2s;
  cursor: pointer;
}

.translate:hover{
  color: #666;
}
</style>
<script>
var messageElements = document.getElementsByClassName('maintenance-message'),
    currentMessageIndex = 0,
    timer = null,
    next = function(){
      for(var i=0; i<messageElements.length; i++){
        if(messageElements[i].className.indexOf('active') > -1){
          messageElements[i].className = 'maintenance-message';
        }
      }

      if(currentMessageIndex < messageElements.length - 1){
        currentMessageIndex += 1;
      }else{
        currentMessageIndex = 0;
      }

      messageElements[currentMessageIndex].className = 'maintenance-message active';
    },
    tick = function(){
      timer = setTimeout(function(){

        next();
        tick();

      }, 5000);
    };

tick();

document.getElementsByClassName('speech-bubble')[0].addEventListener('mouseenter', function(e){

  clearTimeout(timer);

});

document.getElementsByClassName('speech-bubble')[0].addEventListener('mouseleave', function(e){

  tick();

});

document.getElementsByClassName('speech-bubble')[0].addEventListener('click', function(e){

  clearTimeout(timer);
  next();

});
</script>
