<div class="modal update" id="update" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

        <div class='sv-container'>

          <div class="select row">
            <h3 class="col-12 pt-3 text-center active-login">Studio(cijfer)</h3>
          </div>

          <form class="updateform text-center">
            <p class="sv-color-lightest py-1 mb-5 text-center welcome-text">Update reservation</p>

            <div class="input-group my-3 animate__animated animate__fadeIn">
              <?php var_dump($instruments) ?>
              <input type="text" name="name" placeholder="Name" class="input-padding-left sv-input" value="<?=$reservation['user']?>"/>
              <div class="error-field" data-name="name"></div>
            </div>



            <div class="input-group my-3 animate__animated animate__fadeIn">
              <input type="time" name="starttime" placeholder="Start Time" class="input-padding-left sv-input" value="<?=$reservation["starttime"] ?>"/>
              <div class="error-field" data-name="starttime"></div>
            </div>
            <div class="input-group my-3 animate__animated animate__fadeIn">
              <input type="time" name="endtime" placeholder="End Time" class="input-padding-left sv-input" value="<?=$reservation['endtime']?>"/>
              <div class="error-field" data-name="endtime"></div>
            </div>

            <div class="input-group my-3 animate__animated animate__fadeIn">
              <select class="input-padding-left sv-input" id="inlineFormCustomSelect">
                <option class="mx-auto" selected ><?=$reservation['instrument']?></option>
                <?php
                  foreach ($instruments as $row) {?>
                    <option value="1"><?php echo $row['name']?></option>
                        <?php } ?>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
              <div class="error-field" data-name="name"></div>
            </div>

            <input type="hidden" name="function" value="login" class="form-function">
            <button class="sv-button mt-5">Submit</button>

            <p class='mt-5 closemodal'>Close Window</p>
          </form>

          <div class="panel invisible error animated">
            <div class="panel-body errorMSG"></div>
          </div>

        </div>
    </div>
  </div>
</div>
