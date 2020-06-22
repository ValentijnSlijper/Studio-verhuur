<div class="modal login" id="login" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

        <div class='sv-container'>

          <div class="select row">
            <h3 class="col-6 pt-3 text-center active-login">LOGIN</h3>
            <h3 class="col-6 pt-3 text-center">REGISTER</h3>
          </div>

          <form class="loginform text-center">
            <p class="sv-color-lightest py-1 mb-5 text-center welcome-text">Welcome back</p>

            <div class="input-group my-3 d-none animate__animated animate__fadeIn">
              <input type="name" name="name" placeholder="Name" class="input-padding-left sv-input"/>
            </div>

            <div class="input-group my-3">
              <input type="mail" name="mail" placeholder="Mail" class="input-padding-left sv-input">
            </div>

            <div class="input-group my-3">
              <input type="password" name="password" placeholder="Password (max. 8 characters)" class="input-padding-left password sv-input"/>
            </div>

            <div class="errorwrapper">
              
            </div>

            <input type="hidden" name="function" value="login" class="form-function">
            <button class="sv-button mt-5">LOGIN</button>



            <p class='mt-5 closemodal'>Close Window</p>    
          </form>

        </div>
    </div>
  </div>
</div>