<!-- Large modal -->
<div id="modal" class="modal fade bd-example-modal-lg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Service toevoegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="addService" name="addService" action="\classes\validators\submits.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="customer">Klant</label>
                        <input class="form-control" type="text" name="customer" id="customer" value="<?= (isset($_GET['customer']) ? $_GET['customer'] : '') ?>" placeholder="Klant">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" name="type" id="type">
                            <option class="form-control" value="test">Test</option>
                            <option class="form-control" value="productie">Productie</option>
                            <option class="form-control" value="opleiding">Opleiding</option>
                            <option class="form-control" value="acceptatie">Acceptatie</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Service naam</label>
                        <input class="form-control" type="text" minlength="2" name="serviceName" id="serviceName" value="<?= (isset($_GET['serviceName']) ? $_GET['serviceName'] : '') ?>" placeholder="Naam">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" id="submit-button" class="btn btn-primary" name="submit" value="Toevoegen">
                </div>
            </form>
        </div>
    </div>
</div>