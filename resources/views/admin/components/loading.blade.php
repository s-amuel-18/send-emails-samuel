<style>
.loading {
    display: -ms-flexbox;
  display: flex;
  height: 100vh;
  width: 100%;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 9999;
  background: rgba(255, 255, 255, 0.7);
  visibility: hidden;
  transition: visibility 1s linear 300ms, opacity 300ms;
}

.loading-show{
    animation: 1s fadeIn;
  animation-fill-mode: forwards;
}
.loading-hidden{
    animation: 1s fadeout;
  animation-fill-mode: both;
}


@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    visibility: visible;
    opacity: 1;
  }
}
@keyframes fadeout {
  0% {
    opacity: 1;
    visibility: visible;
  }
  100% {
    visibility: hidden;
    opacity: 0;
  }
}

/* .loading-fadeIn {
  visibility: visible;
  opacity: 1;
  transition: visibility 0s linear 0s, opacity 300ms;
} */

</style>


    <div class=" loading-show loading d-flex flex-column justify-content-center align-items-center">
    
        <div class="spinner-border text-primary my-3" style="width: 3rem; height: 3rem;" role="status">
            <span class="spinner sr-only">Loading...</span>
        </div>
        <h4>Enviando Emails</h4>
    <div class="p-4 w-100" style="max-width: 500px">
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100" style="width:100%"><div class="text-center"> 10%</div></div>
            </div>
        </div>
    </div>

<!-- eviando emails
progress spinner -->
