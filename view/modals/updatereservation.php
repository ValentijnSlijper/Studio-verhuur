<div class="modal updateresform" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class='sv-container'>

            <form class="updatereservationform text-center">
                <p class="sv-color-lightest py-1 mb-5 text-center welcome-text">Book your studio</p>

                <input type="hidden" name="id" value="<?= $reservation['id'] ?>">

                <div class="input-group my-3">
                    <select name='studio' class='sv-input'>
                    <option selected value='empty'>Select your studio</option>
                        <?php foreach($studios as $key => $value): ?>
                            <option value=<?= $key + 1 ?> ><?=$value['name'] . ' - $' . $value['price'] . ' per hour'?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-group my-3">
                    <select name='name' class='sv-input'>
                        <option value="<?= $user['id'] ?>" selected><?= $_SESSION['name'] ?></option>
                    </select>
                </div>

                <div class="input-group my-3">
                    <select name='starttime' class='sv-input'>
                        <option selected value='empty'>Starttime</option>
                    </select>
                </div>

                <div class="input-group my-3">
                    <select name='endtime' class='sv-input'>
                        <option selected value='empty'>Endtime</option>
                    </select>
                </div>

                <select name='instrument' class="sv-input">
                    <option selected value='empty'>Add an instrument</option>
                    <?php foreach($instruments as $key=>$value): ?>
                        
                        <option value=<?=$value['name']?>><?=$value['name'] . ' - $' . $value['price'] . ' per hour'?></option>
                    <?php endforeach; ?>   
                </select>

                <p class="sv-color-white mt-5">Price:</p>
                <div class='sv-input mb-3 sv-color-white bookprice'></div>

                <div class="errorwrapper"></div>

                <input type="hidden" name="function" value="updatereservation" class="form-function">

                <button class="sv-button mt-5">UPDATE</button>

                <p class='mt-5 closemodal'>Close Window</p>    
            </form>

            </div>
        </div>
    </div>
</div>