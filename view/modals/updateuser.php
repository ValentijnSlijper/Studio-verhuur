<div class="modal updateuser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class='sv-container'>

                <form class="updateuserform text-center">
                    <p class="sv-color-lightest py-1 mb-5 text-center welcome-text">Update your profile</p>

                    <input type="hidden" name="id" class='sv-input my-3' value="<?= $user['id'] ?>">

                    <input type="text" name="name" class='sv-input my-3' value="<?= $user['name'] ?>">

                    <input type="mail" name="mail" class='sv-input my-3' value="<?= $user['mail'] ?>">

                    <input type="password" name="password" class='sv-input my-3' value="" placeholder="Password">

                    <div class="errorwrapper"></div>

                    <input type="hidden" name="function" value="updateuser" class="form-function">

                    <button class="sv-button mt-5">UPDATE</button>

                    <p class='mt-5 closemodal'>Close Window</p>
                </form>

            </div>
        </div>
    </div>
</div>