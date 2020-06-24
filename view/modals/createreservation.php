<div class="modal resform" id="login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class='sv-container'>

            <form class="reservationform text-center">
                <p class="sv-color-lightest py-1 mb-5 text-center welcome-text">Book your studio</p>

                <div class="input-group my-3">
                    <select class='sv-input'>
                    <option disabled selected>Select your studio</option>
                        <?php foreach($studios as $key=>$value): ?>
                            <option><?=$value['name'] . ' - $' . $value['price'] . ' per hour'?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-group my-3">
                    <select class='sv-input'>
                    <option disabled selected>Select your username</option>
                        <?php foreach($users as $key=>$value): ?>
                            <option><?=$value['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-group my-3">
                    <input type="time" name="starttime" class='sv-input'>
                </div>

                <div class="input-group my-3">
                    <input type="time" name="starttime" class='sv-input'>
                </div>

                <select class="sv-input">
                    <option disabled selected>Add an instrument</option>
                    <?php foreach($instruments as $key=>$value): ?>
                        
                        <option><?=$value['name'] . ' - $' . $value['price'] . ' per hour'?></option>
                    <?php endforeach; ?>   
                </select>


                <div class="errorwrapper"></div>

                <button class="sv-button mt-5">BOOK</button>

                <p class='mt-5 closemodal'>Close Window</p>    
            </form>

            </div>
        </div>
    </div>
</div>